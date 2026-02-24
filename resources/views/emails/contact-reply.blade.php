<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #28a745; color: white; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .section { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .section h3 { margin-top: 0; color: #28a745; }
        .message-box { background-color: white; border-left: 4px solid #28a745; padding: 15px; margin: 20px 0; }
        .original-message { background-color: #f8f9fa; border-left: 4px solid #ccc; padding: 15px; margin-top: 20px; font-style: italic; color: #666; }
        .footer { color: #666; border-top: 1px solid #ddd; padding-top: 20px; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>We've Replied to Your Message</h2>
        </div>

        <p>Hello {{ $name }},</p>

        <p>Thank you for contacting us. We have reviewed your message and sent you a reply below:</p>

        <div class="section">
            <h3>Our Reply:</h3>
            <div class="message-box">
                {!! nl2br(e($replyMessage)) !!}
            </div>
        </div>

        <div class="original-message">
            <p><strong>Original Message Subject:</strong> {{ $subject }}</p>
            <p><em>This was in response to your inquiry with the above subject line.</em></p>
        </div>

        <div class="footer">
            <p>If you have any further questions, feel free to reach out to us again.</p>
            <p>Best regards,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
