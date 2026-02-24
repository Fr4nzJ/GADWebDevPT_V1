<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #7b2cbf;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #3b0a63;
            margin: 0;
            font-size: 28px;
        }
        .content {
            color: #555;
            font-size: 16px;
        }
        .greeting {
            margin-bottom: 20px;
        }
        .verification-code {
            background: #f0f0f0;
            border-left: 4px solid #7b2cbf;
            padding: 20px;
            margin: 30px 0;
            border-radius: 4px;
            text-align: center;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #3b0a63;
            letter-spacing: 4px;
            font-family: 'Courier New', monospace;
        }
        .otp-info {
            font-size: 14px;
            color: #999;
            text-align: center;
            margin-top: 15px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
        .button {
            display: inline-block;
            background: #7b2cbf;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin: 20px 0;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 14px;
            color: #856404;
        }
        .subject-info {
            background: #e8f4f8;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 14px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CatSu GAD Contact Verification</h1>
        </div>

        <div class="content">
            <div class="greeting">
                <p>Hello {{ $name }},</p>
                <p>Thank you for reaching out to us through our contact form. To verify your email address and complete your submission, please use the verification code below:</p>
            </div>

            <div class="verification-code">
                <div class="code">{{ $verificationCode }}</div>
                <div class="otp-info">Valid for 10 minutes</div>
            </div>

            <div class="subject-info">
                <strong>Subject:</strong> {{ $subject }}
            </div>

            <p>Enter this 6-digit code on the verification page to complete your contact form submission. Please do not share this code with anyone.</p>

            <div class="warning">
                ⏱️ <strong>Important:</strong> This code will expire in 10 minutes. If the code expires, you can request a new one on the verification page.
            </div>

            <p>If you did not submit a contact form through our website, please disregard this email and take no action.</p>

            <p>
                Best regards,<br>
                <strong>CatSu Gender and Development (GAD) Office</strong>
            </p>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply directly to this message.</p>
            <p>&copy; {{ now()->year }} Catanduanes State University. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
