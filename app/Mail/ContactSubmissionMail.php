<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $contactSubject;
    public string $message;
    public string $ipAddress;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $name,
        string $email,
        string $subject,
        string $message,
        string $ipAddress
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->contactSubject = $subject;
        $this->message = $message;
        $this->ipAddress = $ipAddress;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [$this->email],
            subject: 'New Contact Form Submission: ' . $this->contactSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-submission',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->contactSubject,
                'message' => $this->message,
                'ipAddress' => $this->ipAddress,
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
