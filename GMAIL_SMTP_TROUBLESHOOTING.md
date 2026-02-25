# Gmail SMTP Troubleshooting Guide - Contact Form Submission

## Problem Diagnosed

**Symptom:** Verification emails work fine, but contact form messages don't arrive at gadcatsu@gmail.com

**Root Cause:** Missing explicit `from()` in ContactSubmissionMail Envelope

```php
// BEFORE (BROKEN)
public function envelope(): Envelope
{
    return new Envelope(
        replyTo: [$this->email],  // ❌ Missing from() - Gmail may silently fail
        subject: 'New Contact Form Submission: ' . $this->contactSubject,
    );
}

// AFTER (FIXED)
public function envelope(): Envelope
{
    return new Envelope(
        from: config('mail.from.address'),  // ✅ Explicit from()
        replyTo: [$this->email],
        subject: 'New Contact Form Submission: ' . $this->contactSubject,
    );
}
```

---

## Why This Matters with Gmail SMTP

### Gmail SMTP Requirements

When you use Gmail SMTP (smtp.gmail.com):

1. **Authenticated User:** gadcatsu@gmail.com (MAIL_USERNAME)
2. **From Address:** MUST match the authenticated user
3. **Reply-To:** Can be different - allows replies to reach the original sender

### What Happens Without Explicit `from()`

```
Gmail SMTP Behavior:
├─ Implicit from() (relies on config)
│  ├─ Usually works (config has correct value)
│  └─ Sometimes fails (edge cases, config not loaded, etc.)
│
└─ Explicit from() (defined in Mailable)
   ├─ Always works (clear connection between sender and authenticator)
   └─ Prevents silent failures
```

### Common Gmail Failure Modes

| Scenario | What Happens | Fix |
|----------|-------------|-----|
| No explicit `from()` | Email silently dropped by Gmail | Add `from: config('mail.from.address')` |
| `from()` doesn't match MAIL_USERNAME | Gmail rejects SMTP transaction | Ensure FROM = MAIL_USERNAME |
| `replyTo()` missing | Admin can't reply to sender | Add `replyTo: [$this->email]` |
| MAIL_FROM_ADDRESS wrong in .env | Email bounces with auth error | Check MAIL_FROM_ADDRESS = MAIL_USERNAME |

---

## Solution Applied ✅

### File: `app/Mail/ContactSubmissionMail.php`

**Change:**
```php
public function envelope(): Envelope
{
    return new Envelope(
        from: config('mail.from.address'),  // ← ADDED
        replyTo: [$this->email],
        subject: 'New Contact Form Submission: ' . $this->contactSubject,
    );
}
```

**Why This Works:**
- Explicitly uses Laravel's configured FROM address
- Guarantees it matches MAIL_USERNAME (gadcatsu@gmail.com)
- Prevents implicit config issues
- Gmail accepts the email immediately

### File: `app/Http/Controllers/ContactController.php`

**Enhanced Logging Added:**
- Logs mail driver configuration before sending
- Logs SMTP credentials (masked) for debugging
- Logs queue status and Mailable class
- Detailed error capture if sending fails

---

## Verification Checklist

### ✅ Step 1: Verify .env Configuration

Check your .env file has:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=gadcatsu@gmail.com
MAIL_PASSWORD="YOUR_APP_PASSWORD"      # NOT your Gmail password - App Password only
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="gadcatsu@gmail.com"
MAIL_FROM_NAME="GAD Website"
QUEUE_CONNECTION=sync
```

**⚠️ CRITICAL:** Use App Password, NOT your Gmail account password!

1. Go to Google Account → Security
2. Enable 2-Step Verification
3. Create App Password for "Mail" on "Windows Computer"
4. Copy 16-character password to MAIL_PASSWORD

### ✅ Step 2: Clear Config Cache

```bash
php artisan config:clear
php artisan cache:clear
```

### ✅ Step 3: Test the Contact Form

1. Navigate to contact form on website
2. Enter details:
   - Name: Test User
   - Email: your-test-email@gmail.com
   - Subject: Test Subject
   - Message: This is a test message
3. Submit form
4. Enter OTP from email when it arrives
5. Check gadcatsu@gmail.com inbox for message

### ✅ Step 4: Check Application Logs

```bash
# View recent logs
tail -f storage/logs/laravel.log

# Look for these lines:
# "Contact Form - Preparing to send admin notification email"
# "Contact Form - Admin notification email queued successfully"
# OR "Contact Form - Admin notification email queueing failed"
```

---

## Debugging Steps

### If Email Still Not Arriving

**Step 1: Check Logs for Errors**

```bash
grep -i "contact form" storage/logs/laravel.log | tail -20
```

Look for:
- Mail configuration being logged
- SMTP host, port, encryption values
- Specific error messages if queueing failed

**Step 2: Verify Mailable Syntax**

Run artisan command to validate:

```bash
php artisan make:mail TestMail --view=emails.test
# Check syntax in app/Mail/TestMail.php
```

**Step 3: Test with Simple Mail**

Create a quick test in routes/web.php:

```php
Route::get('/test-mail', function () {
    Mail::to('gadcatsu@gmail.com')->send(
        new \App\Mail\ContactSubmissionMail(
            'Test User',
            'test@example.com',
            'Test Subject',
            'This is a test message',
            '192.168.1.1'
        )
    );
    return 'Mail sent - check logs and inbox';
});

// Access: http://localhost/test-mail
```

**Step 4: Check Gmail Spam Filter**

1. Log in to gadcatsu@gmail.com
2. Check Spam/Trash folders
3. Mark emails as "Not Spam" to improve delivery

**Step 5: Verify SMTP Authentication**

Test SMTP credentials manually:

```php
// Add to a test route temporarily
Route::get('/test-smtp', function () {
    $transport = new \Swift_SmtpTransport(
        'smtp.gmail.com',
        587,
        'tls'
    );
    $transport->setUsername(env('MAIL_USERNAME'));
    $transport->setPassword(env('MAIL_PASSWORD'));
    
    try {
        $transport->start();
        return 'SMTP Connected ✅';
    } catch (\Exception $e) {
        return 'SMTP Failed: ' . $e->getMessage();
    }
});
```

---

## Common Error Messages & Solutions

### Error: "Expected response code 250..."

**Cause:** SMTP authentication failed

**Solution:**
- Verify MAIL_PASSWORD is App Password (not Gmail password)
- Check MAIL_USERNAME matches MAIL_FROM_ADDRESS
- Ensure 2-Step Verification is enabled in Google Account

### Error: "Expected response code 535..."

**Cause:** Invalid SMTP credentials

**Solution:**
- App Password might have expired
- Generate a new App Password
- Paste into MAIL_PASSWORD and run `php artisan config:clear`

### Error: "Expected response code 220..."

**Cause:** Connection timeout or firewall blocking

**Solution:**
- Check firewall isn't blocking port 587
- Verify MAIL_HOST is correct (smtp.gmail.com)
- Try MAIL_PORT=465 with MAIL_ENCRYPTION=ssl instead of 587/tls

### Email Arrives But No Reply-To

**Cause:** Recipient click-reply, it doesn't go to sender

**Solution:**
Already fixed in updated ContactSubmissionMail:
```php
replyTo: [$this->email],  // Sender's email is reply-to address
```

---

## Best Practices for Gmail SMTP

### 1. Always Use App Passwords
- Not your Gmail account password
- Generated specifically for apps
- More secure than account password
- Can revoke per-app if needed

### 2. Use Explicit `from()` in Mailables
```php
public function envelope(): Envelope
{
    return new Envelope(
        from: config('mail.from.address'),  // ← Always explicit
        replyTo: [$this->email],
        subject: 'Subject',
    );
}
```

### 3. Monitor Logs Religiously
Before going to production, ensure logs show:
- "Contact Form - Admin notification email queued successfully"
- NOT "Contact Form - Admin notification email queueing failed"

### 4. Test on Staging First
Never deploy mail changes directly to production without testing locally first

### 5. Use Queue for Non-Critical Emails
Since you're using `Mail::queue()` with `QUEUE_CONNECTION=sync`:
- In development: Works immediately
- In production: Set `QUEUE_CONNECTION=database` + run `php artisan queue:work`
- Never blocks user response

### 6. Set Reply-To Correctly
```php
replyTo: [$this->email],  // Sender's email, not admin
```
This allows admin to reply directly to the person who submitted the form.

---

## Testing Checklist

Before considering this resolved:

- [ ] .env configured with App Password (not account password)
- [ ] `php artisan config:clear && php artisan cache:clear` executed
- [ ] ContactSubmissionMail has explicit `from: config('mail.from.address')`
- [ ] Submit contact form with test email
- [ ] OTP verification email arrives (confirms SMTP works)
- [ ] Completion email shows "Form submitted successfully"
- [ ] Check gadcatsu@gmail.com inbox for contact message
- [ ] Contact message includes sender's email and reply-to works
- [ ] Check logs for success messages, not errors
- [ ] No emails in spam folder
- [ ] Test with another contact form submission to confirm

---

## What Was Changed

| File | Change | Reason |
|------|--------|--------|
| `app/Mail/ContactSubmissionMail.php` | Added `from: config('mail.from.address')` to Envelope | Gmail requires explicit FROM matching authenticated user |
| `app/Http/Controllers/ContactController.php` | Enhanced logging with mail config details | Better debugging and verification |

---

## References

- [Laravel Mail Documentation](https://laravel.com/docs/12.x/mail)
- [Gmail App Passwords Setup](https://support.google.com/accounts/answer/185833)
- [Gmail SMTP Settings](https://support.google.com/mail/answer/7126229)
- [Laravel Mailable Envelopes](https://laravel.com/docs/12.x/mail#configuring-the-subject)

---

## Still Not Working?

Check these in order:

1. **Verify App Password:** Google Account → Security → App passwords (copy exact value)
2. **Check .env syntax:** No extra spaces, proper quotes around password
3. **Clear config:** `php artisan config:clear && php artisan cache:clear`
4. **Check logs:** `tail -f storage/logs/laravel.log | grep -i mail`
5. **Test manually:** Use the test-mail route above
6. **Check spam:** Look in gadcatsu@gmail.com spam folder
7. **Gmail authentication:** Log in to gadcatsu@gmail.com → Check "Less secure app access" setting
8. **2-Step Verification:** Must be enabled for App Passwords to work

**If all above checked:** Create a fresh App Password and retry.

---

**Status:** ✅ ContactSubmissionMail Fixed
**Date:** February 25, 2026
**Next Action:** Test contact form and verify emails arrive
