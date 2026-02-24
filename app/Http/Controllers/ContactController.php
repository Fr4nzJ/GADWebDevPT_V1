<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
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

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        try {
            // Log the contact form submission
            Log::channel('single')->info('Contact Form Submitted', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now(),
            ]);

            // Optional: Store in database if Contact model exists
            // Uncomment these lines if you create a Contact model and migration
            // Contact::create([
            //     'name' => $validated['name'],
            //     'email' => $validated['email'],
            //     'subject' => $validated['subject'],
            //     'message' => $validated['message'],
            //     'ip_address' => $request->ip(),
            // ]);

            // Optional: Send email notification
            // Uncomment and configure if you have mail setup
            // Mail::send('emails.contact-notification', $validated, function ($message) use ($validated) {
            //     $message->to('info@genderdev.org')
            //             ->replyTo($validated['email'])
            //             ->subject('New Contact Form Submission: ' . $validated['subject']);
            // });

            // Send confirmation email to user (optional)
            // Mail::send('emails.contact-confirmation', [], function ($message) use ($validated) {
            //     $message->to($validated['email'])
            //             ->subject('We received your message');
            // });

            return redirect()->back()
                ->with('success', 'Thank you for reaching out! We will review your message and get back to you soon.')
                ->with('success_type', 'contact_form');

        } catch (\Exception $e) {
            Log::error('Contact Form Submission Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->withErrors(['general' => 'An error occurred while processing your message. Please try again later.'])
                ->withInput();
        }
    }
}