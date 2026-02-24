<x-mail::message>
# Verify Your Contact Form Submission

Hello {{ $name }},

Thank you for reaching out to us! To complete your contact form submission, please verify your email using the code below:

<x-mail::panel>
## Verification Code

**{{ $verificationCode }}**
</x-mail::panel>

This code will expire in **10 minutes**. Please enter it on the verification page to complete your submission.

If you didn't submit this form, you can safely ignore this email.

---

**Submission Details:**
- **Your Email:** {{ $email }}
- **Subject:** {{ $subject }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
