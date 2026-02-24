<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $verificationCode;
    public string $contactSubject;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $name,
        string $email,
        string $verificationCode,
        string $subject
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->verificationCode = $verificationCode;
        $this->contactSubject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your Contact Form Submission',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-verification',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'verificationCode' => $this->verificationCode,
                'subject' => $this->contactSubject,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
