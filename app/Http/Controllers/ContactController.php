<?php

namespace App\Http\Controllers;

use App\Mail\ContactVerificationMail;
use App\Mail\ContactSubmissionMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Generate a 6-digit OTP code.
     *
     * @return string
     */
    private function generateOtp(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Store contact form data into database and send OTP verification email.
     * 
     * DATA IS INSERTED BEFORE EMAIL SENDING to ensure it's saved regardless
     * of email delivery success or failure.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Log::info('[CONTACT FORM] ==== STORE METHOD STARTED ====', [
            'ip_address' => $request->ip(),
            'timestamp' => now(),
            'request_all' => $request->except('website'),
        ]);

        // Validate incoming request data with custom messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|min:3|max:255',
            'message' => 'required|string|min:10|max:5000',
            'website' => 'nullable|string|max:255', // Honeypot field - should be empty
        ], [
            'name.required' => 'Please provide your full name.',
            'name.min' => 'Name must be at least 2 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'subject.required' => 'Subject field is required.',
            'subject.min' => 'Subject must be at least 3 characters.',
            'message.required' => 'Please provide a message.',
            'message.min' => 'Message must be at least 10 characters.',
        ]);

        // Check honeypot field (spam prevention)
        if (!empty($request->input('website'))) {
            Log::warning('[CONTACT FORM] Honeypot triggered on contact form', [
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);
            // Silently fail to prevent bot awareness
            return redirect()->back()
                ->with('success', 'Thank you for reaching out! We will review your message and get back to you soon.')
                ->with('success_type', 'contact_form');
        }

        if ($validator->fails()) {
            Log::warning('[CONTACT FORM] Validation failed', [
                'errors' => $validator->errors()->toArray(),
                'timestamp' => now(),
            ]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        try {
            // ============================================================
            // STEP 1: GENERATE OTP FIRST (needed for database insert)
            // ============================================================
            Log::info('[CONTACT FORM] STEP 1: Generating OTP before database insert', [
                'email' => $validated['email'],
                'timestamp' => now(),
            ]);

            $otp = $this->generateOtp();

            Log::info('[CONTACT FORM] STEP 1 SUCCESS: OTP generated', [
                'email' => $validated['email'],
                'otp_length' => strlen($otp),
                'timestamp' => now(),
            ]);

            // ============================================================
            // STEP 2: INSERT INTO DATABASE IMMEDIATELY
            // This ensures data is saved before any external API calls
            // ============================================================
            Log::info('[CONTACT FORM] STEP 2: Attempting database insert', [
                'email' => $validated['email'],
                'name' => $validated['name'],
                'timestamp' => now(),
            ]);

            $contact = Contact::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'new',
                'is_verified' => false,
                'verification_code' => $otp,
            ]);

            Log::info('[CONTACT FORM] STEP 2 SUCCESS: Contact inserted into database', [
                'contact_id' => $contact->id,
                'email' => $validated['email'],
                'name' => $validated['name'],
                'verification_code_set' => !empty($contact->verification_code),
                'timestamp' => now(),
            ]);

            // ============================================================
            // STEP 3: STORE DATA IN SESSION FOR VERIFICATION FLOW
            // ============================================================
            Log::info('[CONTACT FORM] STEP 3: Storing session data for verification flow', [
                'contact_id' => $contact->id,
                'timestamp' => now(),
            ]);

            $sessionData = [
                'contact_id' => $contact->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'otp' => $otp,
                'otp_created_at' => now(),
            ];

            $request->session()->put('contact_form_data', $sessionData);

            Log::info('[CONTACT FORM] STEP 3 SUCCESS: Session data stored', [
                'session_id' => session()->getId(),
                'contact_id' => $contact->id,
                'timestamp' => now(),
            ]);

            // ============================================================
            // STEP 4: SEND OTP VERIFICATION EMAIL
            // If email fails, data is already in database - this is acceptable
            // ============================================================
            Log::info('[CONTACT FORM] STEP 4: Attempting to queue OTP email', [
                'contact_id' => $contact->id,
                'email' => $validated['email'],
                'mail_default' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'timestamp' => now(),
            ]);

            try {
                Mail::to($validated['email'])->send(
                    new ContactVerificationMail(
                        $validated['name'],
                        $validated['email'],
                        $otp,
                        $validated['subject']
                    )
                );
                
                Log::info('[CONTACT FORM] STEP 4 SUCCESS: OTP email queued to mailbox', [
                    'contact_id' => $contact->id,
                    'email' => $validated['email'],
                    'timestamp' => now(),
                ]);
            } catch (\Exception $emailException) {
                Log::error('[CONTACT FORM] STEP 4 WARNING: Email queueing failed (data still saved)', [
                    'contact_id' => $contact->id,
                    'email' => $validated['email'],
                    'error' => $emailException->getMessage(),
                    'error_code' => $emailException->getCode(),
                    'file' => $emailException->getFile(),
                    'line' => $emailException->getLine(),
                    'trace' => $emailException->getTraceAsString(),
                    'timestamp' => now(),
                ]);
                // Email failure does NOT affect data persistence
                // Data is already in database
            }

            Log::info('[CONTACT FORM] ==== STORE METHOD COMPLETED SUCCESSFULLY ====', [
                'contact_id' => $contact->id,
                'email' => $validated['email'],
                'timestamp' => now(),
            ]);

            // Redirect to verification page
            return redirect()->route('contact.verify')
                ->with('info', 'We\'ve sent a 6-digit verification code to your email. Please enter it below to complete your submission.');

        } catch (\Exception $e) {
            Log::error('[CONTACT FORM] ==== STORE METHOD FAILED WITH EXCEPTION ====', [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'timestamp' => now(),
                'email' => $validated['email'] ?? 'unknown',
            ]);

            return redirect()->back()
                ->withErrors(['general' => 'An error occurred while processing your request. Please try again later.'])
                ->withInput();
        }
    }

    /**
     * Show the OTP verification page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showVerify()
    {
        Log::info('[CONTACT FORM] showVerify() called', [
            'timestamp' => now(),
            'session_id' => session()->getId(),
            'has_contact_form_data' => session()->has('contact_form_data'),
        ]);

        // Check if there's contact form data in session
        if (!session()->has('contact_form_data')) {
            Log::warning('[CONTACT FORM] showVerify() - No session data found', [
                'timestamp' => now(),
                'session_id' => session()->getId(),
                'all_session_keys' => collect(session()->all())->keys()->toArray(),
            ]);
            return redirect()->route('contact')
                ->withErrors(['general' => 'No verification data found. Please submit the contact form again.']);
        }

        $formData = session()->get('contact_form_data');
        Log::info('[CONTACT FORM] showVerify() - Session data available, showing verification page', [
            'contact_id' => $formData['contact_id'] ?? null,
            'email' => $formData['email'],
            'timestamp' => now(),
        ]);

        return view('contact-verify');
    }

    /**
     * Verify OTP and mark contact as verified.
     * 
     * Data is already in database from store() method.
     * This method just verifies and marks the record as confirmed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        Log::info('[CONTACT FORM] ==== VERIFY METHOD STARTED ====', [
            'timestamp' => now(),
            'session_id' => session()->getId(),
        ]);

        // Check if there's contact form data in session
        if (!session()->has('contact_form_data')) {
            Log::error('[CONTACT FORM] VERIFY FAILED: No session data found', [
                'ip_address' => $request->ip(),
                'timestamp' => now(),
                'session_id' => session()->getId(),
                'all_session_data_keys' => collect(session()->all())->keys()->toArray(),
            ]);
            return redirect()->route('contact')
                ->withErrors(['general' => 'Verification session expired. Please submit the contact form again.']);
        }

        Log::info('[CONTACT FORM] VERIFY: Session data found', [
            'session_id' => session()->getId(),
            'timestamp' => now(),
        ]);

        // Validate OTP input
        $validator = Validator::make($request->all(), [
            'otp' => 'required|string|size:6|regex:/^\d{6}$/',
        ], [
            'otp.required' => 'Please enter the verification code.',
            'otp.size' => 'Verification code must be 6 digits.',
            'otp.regex' => 'Verification code must contain only digits.',
        ]);

        if ($validator->fails()) {
            Log::warning('[CONTACT FORM] VERIFY: OTP format validation failed', [
                'errors' => $validator->errors()->toArray(),
                'timestamp' => now(),
            ]);
            return redirect()->route('contact.verify')
                ->withErrors($validator);
        }

        $formData = session()->get('contact_form_data');
        $contactId = $formData['contact_id'] ?? null;

        Log::info('[CONTACT FORM] VERIFY: Session data extracted', [
            'contact_id' => $contactId,
            'email' => $formData['email'],
            'otp_provided' => $request->input('otp'),
            'otp_expected' => $formData['otp'],
            'timestamp' => now(),
        ]);

        // Check if contact exists in database
        if (!$contactId) {
            Log::error('[CONTACT FORM] VERIFY FAILED: No contact ID in session', [
                'timestamp' => now(),
                'email' => $formData['email'] ?? 'unknown',
            ]);
            return redirect()->route('contact')
                ->withErrors(['general' => 'Contact record not found. Please submit the form again.']);
        }

        $contact = Contact::find($contactId);
        if (!$contact) {
            Log::error('[CONTACT FORM] VERIFY FAILED: Contact not found in database', [
                'contact_id' => $contactId,
                'email' => $formData['email'],
                'timestamp' => now(),
            ]);
            return redirect()->route('contact')
                ->withErrors(['general' => 'Contact record not found in database. Please submit the form again.']);
        }

        // Check if OTP is correct
        if ($request->input('otp') !== $formData['otp']) {
            Log::warning('[CONTACT FORM] VERIFY FAILED: OTP mismatch', [
                'contact_id' => $contactId,
                'email' => $formData['email'],
                'provided_otp' => $request->input('otp'),
                'expected_otp' => $formData['otp'],
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);

            return redirect()->route('contact.verify')
                ->withErrors(['otp' => 'The verification code is incorrect. Please try again.']);
        }

        Log::info('[CONTACT FORM] VERIFY: OTP matched', [
            'contact_id' => $contactId,
            'email' => $formData['email'],
            'timestamp' => now(),
        ]);

        // Check if OTP is not expired (10 minutes)
        $otpCreatedAt = $formData['otp_created_at'];
        if (now()->diffInMinutes($otpCreatedAt) > 10) {
            Log::warning('[CONTACT FORM] VERIFY FAILED: OTP expired', [
                'contact_id' => $contactId,
                'email' => $formData['email'],
                'otp_created_at' => $otpCreatedAt,
                'minutes_elapsed' => now()->diffInMinutes($otpCreatedAt),
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);

            session()->forget('contact_form_data');

            return redirect()->route('contact')
                ->withErrors(['general' => 'Verification code has expired. Please submit the contact form again.']);
        }

        Log::info('[CONTACT FORM] VERIFY: OTP not expired', [
            'contact_id' => $contactId,
            'minutes_elapsed' => now()->diffInMinutes($otpCreatedAt),
            'timestamp' => now(),
        ]);

        try {
            // ============================================================
            // STEP 1: UPDATE CONTACT TO MARK AS VERIFIED
            // ============================================================
            Log::info('[CONTACT FORM] VERIFY STEP 1: Updating contact to mark as verified', [
                'contact_id' => $contactId,
                'email' => $formData['email'],
                'timestamp' => now(),
            ]);

            $contact->update([
                'is_verified' => true,
            ]);

            Log::info('[CONTACT FORM] VERIFY STEP 1 SUCCESS: Contact marked as verified', [
                'contact_id' => $contactId,
                'email' => $formData['email'],
                'timestamp' => now(),
            ]);

            // ============================================================
            // STEP 2: SEND ADMIN NOTIFICATION EMAIL
            // If email fails, data remains in database marked as verified
            // ============================================================
            Log::info('[CONTACT FORM] VERIFY STEP 2: Preparing admin notification email', [
                'contact_id' => $contactId,
                'email' => $formData['email'],
                'admin_email' => env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'),
                'mail_driver' => config('mail.default'),
                'queue_connection' => config('queue.default'),
                'timestamp' => now(),
            ]);

            try {
                Mail::to(env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'))->send(
                    new ContactSubmissionMail(
                        $formData['name'],
                        $formData['email'],
                        $formData['subject'],
                        $formData['message'],
                        $formData['ip_address']
                    )
                );

                Log::info('[CONTACT FORM] VERIFY STEP 2 SUCCESS: Admin notification queued', [
                    'contact_id' => $contactId,
                    'email' => $formData['email'],
                    'recipient' => env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'),
                    'timestamp' => now(),
                ]);
            } catch (\Exception $emailException) {
                Log::error('[CONTACT FORM] VERIFY STEP 2 WARNING: Admin email queueing failed (data still saved)', [
                    'contact_id' => $contactId,
                    'email' => $formData['email'],
                    'admin_email' => env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'),
                    'error_message' => $emailException->getMessage(),
                    'error_code' => $emailException->getCode(),
                    'file' => $emailException->getFile(),
                    'line' => $emailException->getLine(),
                    'trace' => $emailException->getTraceAsString(),
                    'timestamp' => now(),
                ]);
                // Email failure does NOT affect verification
                // Contact is already marked as verified in database
            }

            // Clear session data
            session()->forget('contact_form_data');

            Log::info('[CONTACT FORM] ==== VERIFY METHOD COMPLETED SUCCESSFULLY ====', [
                'contact_id' => $contactId,
                'email' => $formData['email'],
                'timestamp' => now(),
            ]);

            // Redirect to contact page with success message
            return redirect()->route('contact')
                ->with('success', 'Thank you for reaching out! Your message has been verified and received. We will review your message and get back to you within 24 hours.');

        } catch (\Exception $e) {
            Log::error('[CONTACT FORM] ==== VERIFY METHOD FAILED WITH EXCEPTION ====', [
                'contact_id' => $contactId,
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'email' => $formData['email'] ?? 'unknown',
                'timestamp' => now(),
            ]);

            return redirect()->route('contact.verify')
                ->withErrors(['general' => 'An error occurred while verifying your message. Please try again.']);
        }
    }

    /**
     * Resend OTP verification email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendOtp(Request $request)
    {
        Log::info('[CONTACT FORM] ==== RESEND OTP METHOD STARTED ====', [
            'timestamp' => now(),
            'session_id' => session()->getId(),
        ]);

        if (!session()->has('contact_form_data')) {
            Log::error('[CONTACT FORM] RESEND OTP FAILED: No session data', [
                'timestamp' => now(),
                'session_id' => session()->getId(),
            ]);
            return redirect()->route('contact')
                ->withErrors(['general' => 'No verification data found. Please submit the contact form again.']);
        }

        try {
            $formData = session()->get('contact_form_data');
            
            Log::info('[CONTACT FORM] RESEND OTP: Generating new OTP', [
                'contact_id' => $formData['contact_id'] ?? null,
                'email' => $formData['email'],
                'timestamp' => now(),
            ]);

            // Generate new OTP
            $newOtp = $this->generateOtp();

            // Update session with new OTP
            $formData['otp'] = $newOtp;
            $formData['otp_created_at'] = now();
            session()->put('contact_form_data', $formData);

            Log::info('[CONTACT FORM] RESEND OTP: New OTP generated and session updated', [
                'contact_id' => $formData['contact_id'] ?? null,
                'email' => $formData['email'],
                'otp_length' => strlen($newOtp),
                'timestamp' => now(),
            ]);

            // Update database with new verification code
            if (isset($formData['contact_id'])) {
                Contact::find($formData['contact_id'])?->update([
                    'verification_code' => $newOtp,
                ]);
                
                Log::info('[CONTACT FORM] RESEND OTP: Database updated with new verification code', [
                    'contact_id' => $formData['contact_id'],
                    'email' => $formData['email'],
                    'timestamp' => now(),
                ]);
            }

            // Send new OTP email (asynchronous via queue)
            try {
                Log::info('[CONTACT FORM] RESEND OTP: Sending new OTP email', [
                    'contact_id' => $formData['contact_id'] ?? null,
                    'email' => $formData['email'],
                    'timestamp' => now(),
                ]);

                Mail::to($formData['email'])->send(
                    new ContactVerificationMail(
                        $formData['name'],
                        $formData['email'],
                        $newOtp,
                        $formData['subject']
                    )
                );

                Log::info('[CONTACT FORM] RESEND OTP: Email queued successfully', [
                    'contact_id' => $formData['contact_id'] ?? null,
                    'email' => $formData['email'],
                    'timestamp' => now(),
                ]);
            } catch (\Exception $emailException) {
                Log::error('[CONTACT FORM] RESEND OTP: Email queueing failed (but OTP updated)', [
                    'contact_id' => $formData['contact_id'] ?? null,
                    'email' => $formData['email'],
                    'error' => $emailException->getMessage(),
                    'file' => $emailException->getFile(),
                    'line' => $emailException->getLine(),
                    'timestamp' => now(),
                ]);
                // Continue anyway - new OTP is in session and database
            }

            Log::info('[CONTACT FORM] ==== RESEND OTP METHOD COMPLETED SUCCESSFULLY ====', [
                'contact_id' => $formData['contact_id'] ?? null,
                'email' => $formData['email'],
                'timestamp' => now(),
            ]);

            return redirect()->route('contact.verify')
                ->with('info', 'A new verification code has been sent to your email.');

        } catch (\Exception $e) {
            Log::error('[CONTACT FORM] ==== RESEND OTP METHOD FAILED WITH EXCEPTION ====', [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'timestamp' => now(),
            ]);

            return redirect()->route('contact.verify')
                ->withErrors(['general' => 'An error occurred while resending the verification code. Please try again.']);
        }
    }
}