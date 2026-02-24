<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .code-box { background-color: #f8f9fa; border-left: 4px solid #007bff; padding: 15px; margin: 20px 0; font-size: 24px; font-weight: bold; letter-spacing: 2px; }
        .details { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .footer { color: #666; border-top: 1px solid #ddd; padding-top: 20px; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Verify Your Contact Form Submission</h2>
        </div>

        <p>Hello {{ $name }},</p>

        <p>Thank you for reaching out to us! To complete your contact form submission, please verify your email using the code below:</p>

        <div class="code-box">
            {{ $verificationCode }}
        </div>

        <p>This code will expire in <strong>10 minutes</strong>. Please enter it on the verification page to complete your submission.</p>

        <p>If you didn't submit this form, you can safely ignore this email.</p>

        <div class="details">
            <p><strong>Submission Details:</strong></p>
            <ul>
                <li><strong>Your Email:</strong> {{ $email }}</li>
                <li><strong>Subject:</strong> {{ $subject }}</li>
            </ul>
        </div>

        <div class="footer">
            <p>Thanks,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>

