<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;
use SendGrid\Mail\To;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\PlainTextContent;
use Illuminate\Mail\Mailable;

class SendGridMailService
{
    private $sendgrid;

    public function __construct()
    {
        $apiKey = env('MAIL_SENDGRID_SECRET');
        if (!$apiKey) {
            throw new \Exception('SendGrid API key not configured (MAIL_SENDGRID_SECRET)');
        }
        $this->sendgrid = new SendGrid($apiKey);
    }

    /**
     * Send a Mailable object via SendGrid
     *
     * @param \Illuminate\Mail\Mailable $mailable The Mailable instance
     * @return bool Success status
     * @throws \Exception
     */
    public function sendMailable(Mailable $mailable)
    {
        try {
            // Get the envelope information
            $envelope = $mailable->envelope();
            $subject = $envelope->subject;

            // Get the recipient(s)
            $recipients = $envelope->to ?? [];
            if (empty($recipients)) {
                throw new \Exception('No recipient email address found in Mailable envelope');
            }
            
            // Handle Address object or string
            $recipient = is_array($recipients) ? $recipients[0] : $recipients;
            if (is_object($recipient) && method_exists($recipient, 'address')) {
                $to = $recipient->address;
            } else {
                $to = (string) $recipient;
            }

            // Get the content and render the view
            $content = $mailable->content();
            $viewData = $content->with;
            $htmlContent = \Illuminate\Support\Facades\View::make($content->view, $viewData)->render();

            // Send via SendGrid
            return $this->send($to, $subject, $htmlContent);
        } catch (\Exception $e) {
            throw new \Exception('Failed to send Mailable via SendGrid: ' . $e->getMessage());
        }
    }

    /**
     * Send email via SendGrid
     *
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $htmlContent HTML email content
     * @param string|null $fromEmail Optional from email (defaults to config)
     * @param string|null $fromName Optional from name (defaults to config)
     * @return bool Success status
     * @throws \Exception
     */
    public function send(
        $to,
        $subject,
        $htmlContent,
        $fromEmail = null,
        $fromName = null
    ) {
        try {
            $fromEmail = $fromEmail ?? config('mail.from.address');
            $fromName = $fromName ?? config('mail.from.name');

            $email = new Mail();
            $email->setFrom($fromEmail, $fromName);
            $email->setSubject($subject);
            $email->addTo(new To($to));
            $email->addContent(new HtmlContent($htmlContent));

            $response = $this->sendgrid->send($email);

            if ($response->statusCode() > 299) {
                throw new \Exception(
                    'SendGrid API returned status ' . $response->statusCode() .
                    ': ' . $response->body()
                );
            }

            return true;
        } catch (\Exception $e) {
            throw new \Exception('SendGrid email delivery failed: ' . $e->getMessage());
        }
    }

    /**
     * Send a text email via SendGrid
     *
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $textContent Plain text email content
     * @param string|null $fromEmail Optional from email
     * @param string|null $fromName Optional from name
     * @return bool Success status
     * @throws \Exception
     */
    public function sendText(
        $to,
        $subject,
        $textContent,
        $fromEmail = null,
        $fromName = null
    ) {
        try {
            $fromEmail = $fromEmail ?? config('mail.from.address');
            $fromName = $fromName ?? config('mail.from.name');

            $email = new Mail();
            $email->setFrom($fromEmail, $fromName);
            $email->setSubject($subject);
            $email->addTo(new To($to));
            $email->addContent(new PlainTextContent($textContent));

            $response = $this->sendgrid->send($email);

            if ($response->statusCode() > 299) {
                throw new \Exception(
                    'SendGrid API returned status ' . $response->statusCode() .
                    ': ' . $response->body()
                );
            }

            return true;
        } catch (\Exception $e) {
            throw new \Exception('SendGrid email delivery failed: ' . $e->getMessage());
        }
    }
}
