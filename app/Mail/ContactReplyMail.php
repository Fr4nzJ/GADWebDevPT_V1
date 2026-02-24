<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $originalSubject;
    public string $replyMessage;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $name,
        string $email,
        string $originalSubject,
        string $replyMessage
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->originalSubject = $originalSubject;
        $this->replyMessage = $replyMessage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: [$this->email],
            subject: 'Re: ' . $this->originalSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-reply',
            with: [
                'name' => $this->name,
                'subject' => $this->originalSubject,
                'replyMessage' => $this->replyMessage,
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
