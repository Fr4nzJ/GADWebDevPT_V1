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
     * Store contact form data temporarily and send OTP verification email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
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
            Log::warning('Honeypot triggered on contact form', [
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);
            // Silently fail to prevent bot awareness
            return redirect()->back()
                ->with('success', 'Thank you for reaching out! We will review your message and get back to you soon.')
                ->with('success_type', 'contact_form');
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        try {
            // Generate 6-digit OTP
            $otp = $this->generateOtp();

            // Store form data in session for verification step
            $sessionData = [
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

            Log::info('Contact Form - Data stored in session', [
                'email' => $validated['email'],
                'name' => $validated['name'],
                'otp' => $otp,
                'session_id' => session()->getId(),
                'timestamp' => now(),
            ]);

            // Send OTP verification email (asynchronous via queue)
            try {
                Log::info('Attempting to queue OTP email', [
                    'mail_default' => config('mail.default'),
                    'mail_host' => config('mail.mailers.smtp.host'),
                    'mail_port' => config('mail.mailers.smtp.port'),
                    'mail_encryption' => config('mail.mailers.smtp.encryption'),
                    'email' => $validated['email'],
                ]);
                
                Mail::to($validated['email'])->queue(
                    new ContactVerificationMail(
                        $validated['name'],
                        $validated['email'],
                        $otp,
                        $validated['subject']
                    )
                );
                
                Log::info('OTP email queued successfully', [
                    'email' => $validated['email'],
                    'timestamp' => now(),
                ]);
            } catch (\Exception $emailException) {
                Log::error('Email queueing failed', [
                    'error' => $emailException->getMessage(),
                    'email' => $validated['email'],
                    'file' => $emailException->getFile(),
                    'line' => $emailException->getLine(),
                    'trace' => $emailException->getTraceAsString(),
                ]);
                // Continue anyway - OTP is in session
            }

            // Log OTP sent
            Log::channel('single')->info('Contact Form OTP Sent', [
                'email' => $validated['email'],
                'name' => $validated['name'],
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);

            // Redirect to verification page
            return redirect()->route('contact.verify')
                ->with('info', 'We\'ve sent a 6-digit verification code to your email. Please enter it below to complete your submission.');

        } catch (\Exception $e) {
            Log::error('Contact Form OTP Generation/Send Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
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
        // Check if there's contact form data in session
        if (!session()->has('contact_form_data')) {
            return redirect()->route('contact')
                ->withErrors(['general' => 'No verification data found. Please submit the contact form again.']);
        }

        return view('contact-verify');
    }

    /**
     * Verify OTP and store contact message in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        // Check if there's contact form data in session
        if (!session()->has('contact_form_data')) {
            Log::error('Contact Form Verification - No Session Data', [
                'ip_address' => $request->ip(),
                'timestamp' => now(),
                'session_id' => session()->getId(),
                'all_session_data' => session()->all(),
            ]);
            return redirect()->route('contact')
                ->withErrors(['general' => 'Verification session expired. Please submit the contact form again.']);
        }

        Log::info('Contact Form Verification - Session Data Found', [
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
            Log::warning('Contact Form OTP Validation Failed', [
                'errors' => $validator->errors(),
                'timestamp' => now(),
            ]);
            return redirect()->route('contact.verify')
                ->withErrors($validator);
        }

        $formData = session()->get('contact_form_data');

        // Check if OTP is correct
        if ($request->input('otp') !== $formData['otp']) {
            Log::warning('Contact Form OTP Verification Failed', [
                'email' => $formData['email'],
                'provided_otp' => $request->input('otp'),
                'expected_otp' => $formData['otp'],
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);

            return redirect()->route('contact.verify')
                ->withErrors(['otp' => 'The verification code is incorrect. Please try again.']);
        }

        // Check if OTP is not expired (10 minutes)
        $otpCreatedAt = $formData['otp_created_at'];
        if (now()->diffInMinutes($otpCreatedAt) > 10) {
            Log::warning('Contact Form OTP Expired', [
                'email' => $formData['email'],
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);

            session()->forget('contact_form_data');

            return redirect()->route('contact')
                ->withErrors(['general' => 'Verification code has expired. Please submit the contact form again.']);
        }

        try {
            // Store the verified contact message in database
            Log::info('Contact Form - Attempting to store in database', [
                'email' => $formData['email'],
                'name' => $formData['name'],
                'timestamp' => now(),
            ]);

            $contact = Contact::create([
                'name' => $formData['name'],
                'email' => $formData['email'],
                'subject' => $formData['subject'],
                'message' => $formData['message'],
                'verification_code' => $formData['otp'],
                'is_verified' => true,
                'ip_address' => $formData['ip_address'],
                'user_agent' => $formData['user_agent'],
                'status' => 'new',
            ]);

            Log::info('Contact Form - Successfully stored in database', [
                'contact_id' => $contact->id,
                'email' => $formData['email'],
                'name' => $formData['name'],
                'subject' => $formData['subject'],
                'timestamp' => now(),
            ]);

            // Send the contact message to the admin (gadcatsu@gmail.com) - asynchronous via queue
            try {
                Log::info('Contact Form - Preparing to send admin notification email', [
                    'contact_id' => $contact->id,
                    'email' => $formData['email'],
                    'admin_email' => env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'),
                    'mail_driver' => config('mail.default'),
                    'queue_connection' => config('queue.default'),
                    'smtp_host' => config('mail.mailers.smtp.host'),
                    'smtp_port' => config('mail.mailers.smtp.port'),
                    'smtp_encryption' => config('mail.mailers.smtp.encryption'),
                    'timestamp' => now(),
                ]);

                Mail::to(env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'))->queue(
                    new ContactSubmissionMail(
                        $formData['name'],
                        $formData['email'],
                        $formData['subject'],
                        $formData['message'],
                        $formData['ip_address']
                    )
                );

                Log::info('Contact Form - Admin notification email queued successfully', [
                    'contact_id' => $contact->id,
                    'email' => $formData['email'],
                    'recipient' => env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'),
                    'mailable_class' => 'ContactSubmissionMail',
                    'reply_to' => $formData['email'],
                    'subject' => 'New Contact Form Submission: ' . $formData['subject'],
                    'timestamp' => now(),
                ]);
            } catch (\Exception $emailException) {
                Log::error('Contact Form - Admin notification email queueing failed', [
                    'contact_id' => $contact->id,
                    'sender_email' => $formData['email'],
                    'admin_email' => env('MAIL_FROM_ADDRESS', 'gadcatsu@gmail.com'),
                    'error_message' => $emailException->getMessage(),
                    'error_code' => $emailException->getCode(),
                    'error_file' => $emailException->getFile(),
                    'error_line' => $emailException->getLine(),
                    'mail_driver' => config('mail.default'),
                    'trace' => $emailException->getTraceAsString(),
                ]);
                // Continue anyway - contact is stored in database, email retry can happen later
            }

            // Log successful verification
            Log::channel('single')->info('Contact Form Verified and Stored', [
                'email' => $formData['email'],
                'name' => $formData['name'],
                'subject' => $formData['subject'],
                'ip_address' => $formData['ip_address'],
                'contact_id' => $contact->id,
                'timestamp' => now(),
            ]);

            // Clear session data
            session()->forget('contact_form_data');

            // Redirect to contact page with success message
            return redirect()->route('contact')
                ->with('success', 'Thank you for reaching out! Your message has been verified and received. We will review your message and get back to you within 24 hours.');

        } catch (\Exception $e) {
            Log::error('Contact Form Storage Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'email' => $formData['email'] ?? 'unknown',
            ]);

            return redirect()->route('contact.verify')
                ->withErrors(['general' => 'An error occurred while storing your message. Please try again.']);
        }
    }

    /**
     * Resend OTP verification email (optional enhancement).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendOtp(Request $request)
    {
        if (!session()->has('contact_form_data')) {
            return redirect()->route('contact')
                ->withErrors(['general' => 'No verification data found. Please submit the contact form again.']);
        }

        try {
            $formData = session()->get('contact_form_data');

            // Generate new OTP
            $newOtp = $this->generateOtp();

            // Update session with new OTP
            $formData['otp'] = $newOtp;
            $formData['otp_created_at'] = now();
            session()->put('contact_form_data', $formData);

            // Send new OTP email (asynchronous via queue)
            try {
                Mail::to($formData['email'])->queue(
                    new ContactVerificationMail(
                        $formData['name'],
                        $formData['email'],
                        $newOtp,
                        $formData['subject']
                    )
                );
            } catch (\Exception $emailException) {
                Log::error('Email requeue failed, but continuing', [
                    'error' => $emailException->getMessage(),
                    'email' => $formData['email'],
                ]);
                // Continue anyway - new OTP is in session
            }

            Log::channel('single')->info('Contact Form OTP Resent', [
                'email' => $formData['email'],
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);

            return redirect()->route('contact.verify')
                ->with('info', 'A new verification code has been sent to your email.');

        } catch (\Exception $e) {
            Log::error('Contact Form OTP Resend Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->route('contact.verify')
                ->withErrors(['general' => 'An error occurred while resending the verification code. Please try again.']);
        }
    }
}