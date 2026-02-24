<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #007bff; color: white; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .section { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .section h3 { margin-top: 0; color: #007bff; }
        .message-box { background-color: white; border-left: 4px solid #007bff; padding: 15px; margin: 20px 0; }
        .details { font-size: 12px; color: #666; margin-top: 15px; padding-top: 15px; border-top: 1px solid #ddd; }
        .footer { color: #666; border-top: 1px solid #ddd; padding-top: 20px; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>

        <div class="section">
            <h3>Sender Information</h3>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
            <p><strong>Subject:</strong> {{ $subject }}</p>
        </div>

        <div class="section">
            <h3>Message</h3>
            <div class="message-box">
                {!! nl2br(e($message)) !!}
            </div>
        </div>

        <div class="details">
            <p><strong>Submission Details:</strong></p>
            <ul>
                <li><strong>Sender IP:</strong> {{ $ipAddress }}</li>
                <li><strong>Submitted at:</strong> {{ now()->format('Y-m-d H:i:s') }}</li>
                <li><strong>Status:</strong> Verified and Received</li>
            </ul>
        </div>

        <div class="footer">
            <p>You can reply directly to this email to contact the sender.</p>
            <p>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
