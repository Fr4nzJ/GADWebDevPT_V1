# Email OTP Verification for Contact Form - Implementation Guide

## Overview
This implementation adds Email OTP (One-Time Password) verification to the contact form, ensuring that only verified email submissions are stored in the database. The system does NOT require user authentication and maintains the existing contact page layout using Bulma CSS.

---

## 📁 Files Created

### 1. **Model** - `app/Models/Contact.php`
- Represents the contacts table in the database
- Contains attributes: `name`, `email`, `subject`, `message`, `verification_code`, `is_verified`, `ip_address`, `user_agent`
- Includes query scopes: `verified()` and `unverified()`
- Automatically casts `is_verified` to boolean

### 2. **Migration** - `database/migrations/2026_02_24_000010_create_contacts_table.php`
- Creates the `contacts` table with all necessary columns
- Adds indexes on `email` and `is_verified` for faster queries
- Stores `verification_code` (nullable) and `is_verified` (default false) fields
- Notes: By default stores `ip_address` and `user_agent` for security tracking

### 3. **Mailable** - `app/Mail/ContactVerificationMail.php`
- Sends OTP verification emails to users
- Parameters: name, email, verificationCode (6-digit), subject
- Uses blade view template for rich HTML email formatting

### 4. **Email Template** - `resources/views/emails/contact-verification.blade.php`
- Professional HTML email template
- Displays 6-digit OTP code prominently
- Includes countdown timer message (code valid for 10 minutes)
- Shows submission subject for context
- Contains warning about code expiration

### 5. **Verification View** - `resources/views/contact-verify.blade.php`
- Clean verification page matching Bulma design
- Displays OTP input field (6-digit format only)
- Real-time digit countdown timer (JavaScript)
- Auto-formats input to accept only digits
- Resend OTP functionality
- Back to contact link for user convenience
- Responsive design for mobile/tablet/desktop

### 6. **Updated Controller** - `app/Http/Controllers/ContactController.php`
Key methods:
- **`store(Request $request)`**: Handles initial form submission
  - Validates all fields including honeypot check
  - Generates 6-digit OTP
  - Stores form data in session
  - Sends OTP email
  - Redirects to verification page
  
- **`showVerify()`**: Displays OTP verification page
  - Checks if session data exists
  - Redirects to contact if no session data
  
- **`verify(Request $request)`**: Validates OTP and stores message
  - Compares entered OTP with session OTP
  - Checks OTP expiration (10 minutes)
  - If valid: Saves to database with `is_verified = true`
  - If invalid: Returns error message
  - Clears session data on success or expiration
  
- **`resendOtp(Request $request)`**: Resend OTP email (optional)
  - Generates new OTP
  - Updates session
  - Sends new email

### 7. **Updated Routes** - `routes/web.php`
```php
// Original contact form display (unchanged)
Route::get('/contact', function () { ... })->name('contact');

// Contact form submission with throttling (3 attempts per 10 minutes)
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store')
    ->middleware('throttle:3,10');

// Show OTP verification page
Route::get('/contact/verify', [ContactController::class, 'showVerify'])
    ->name('contact.verify');

// Verify OTP and store message (5 attempts per 10 minutes)
Route::post('/contact/verify', [ContactController::class, 'verify'])
    ->name('contact.verify')
    ->middleware('throttle:5,10');

// Resend OTP (3 attempts per 10 minutes)
Route::post('/contact/resend-otp', [ContactController::class, 'resendOtp'])
    ->name('contact.resend-otp')
    ->middleware('throttle:3,10');
```

### 8. **Updated Contact Form** - `resources/views/contact.blade.php`
- Added hidden honeypot field (`website`) for spam prevention
- Field is positioned off-screen and hidden from users
- Bots typically fill this field, which triggers silent failure
- All other styling and layout remains unchanged

---

## 🔄 User Flow

### Complete Journey:

```
1. User visits /contact → See contact form
   ↓
2. User fills form and submits → POST /contact
   ↓
3. Controller validates + checks honeypot
   ↓
4. If valid:
   - Generate 6-digit OTP
   - Store form data in session
   - Send OTP email
   - Redirect to verification page
   ↓
5. User sees OTP verification page → GET /contact/verify
   - Countdown timer (10 minutes)
   - Input field for 6-digit code
   - Option to resend OTP
   ↓
6. User enters OTP → POST /contact/verify
   ↓
7. If OTP matches and not expired:
   - Save to database as verified
   - Clear session
   - Show success message on contact page
   ↓
8. If OTP incorrect:
   - Show error message
   - Keep session data (user can retry)
   ↓
9. If OTP expired:
   - Clear session
   - Redirect to contact form
   - Show error message
```

---

## 🔐 Security Features Implemented

### 1. **Rate Limiting (Throttling)**
   - Form submission: 3 attempts per 10 minutes (prevents spam)
   - OTP verification: 5 attempts per 10 minutes (allows retries)
   - Resend OTP: 3 attempts per 10 minutes

### 2. **Honeypot Field**
   - Hidden `website` field in contact form
   - If filled, request silently succeeds (hides exploit attempt)
   - Logged as warning for admin monitoring

### 3. **CSRF Protection**
   - Already enabled via Laravel, maintained in all forms
   - `@csrf` directive in all form templates

### 4. **OTP Validation**
   - 6-digit numeric only
   - 10-minute expiration
   - Encrypted in session (Laravel automatically encrypts session data)

### 5. **IP Tracking**
   - Stores user's IP address with contact
   - Useful for security audits and preventing abuse

### 6. **Email Validation**
   - JavaScript: Input accepts only digits, auto-formatted
   - Backend: Validated as 6-digit numeric string
   - Prevents invalid input submission

---

## 🗄️ Database Schema

### Contacts Table
```sql
CREATE TABLE contacts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message LONGTEXT NOT NULL,
    verification_code VARCHAR(255) NULLABLE, -- Stores 6-digit OTP
    is_verified BOOLEAN DEFAULT false,      -- True only after verification
    ip_address VARCHAR(255) NULLABLE,       -- User's IP for security
    user_agent TEXT NULLABLE,               -- Browser/device info
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    INDEX email (email),
    INDEX is_verified (is_verified)
);
```

---

## 📧 Email Configuration Required

Ensure your `.env` file is configured:
```env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io (or your email provider)
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="noreply@gad.gov.ph"
MAIL_FROM_NAME="CatSu GAD"
```

---

## 🚀 Installation Steps

### 1. **Run Migration**
```bash
php artisan migrate
```

### 2. **Clear Cache** (if needed)
```bash
php artisan config:cache
php artisan route:cache
```

### 3. **Test the Form**
- Go to `/contact`
- Fill and submit form
- Check email for OTP
- Verify OTP on verification page
- Check database for stored message

---

## 🧪 Testing Scenarios

### Scenario 1: Valid OTP
- Submit form → Receive email → Enter correct OTP → Success stored in DB

### Scenario 2: Invalid OTP
- Submit form → Receive email → Enter wrong OTP → Error, try again

### Scenario 3: Expired OTP
- Submit form → Wait 11+ minutes → Try to verify → Error, redirect to form

### Scenario 4: Resend OTP
- Submit form → Click "Send a new code" → Receive new OTP → Verify with new code

### Scenario 5: Rate Limiting
- Submit form 3 times in 10 minutes → 4th attempt throttled (429 error)

### Scenario 6: Honeypot Trigger
- Fill honeypot field → Form silently succeeds (no email sent, logged)

---

## 📝 Important Notes

### ✅ What's Preserved
- Original contact form layout and styling
- Existing Bulma CSS framework
- All original form validations
- Navigation and header/footer
- Responsive design
- No user authentication required

### ⚠️ Session Storage
- Form data stored in session (not database) until verified
- Session data automatically encrypted by Laravel
- Session expires per your Laravel config (default: 120 minutes)
- Session cleared after successful verification or expiration

### 🔔 Optional Enhancements (Not Included)
- SMS OTP (requires Twilio integration)
- Two-factor authentication
- Email notification to admin when verified
- Admin dashboard for viewing contacts

---

## 📂 File Summary

| File | Type | Purpose |
|------|------|---------|
| `app/Models/Contact.php` | Model | Contact data representation |
| `database/migrations/2026_02_24_000010_create_contacts_table.php` | Migration | Create contacts table |
| `app/Mail/ContactVerificationMail.php` | Mailable | OTP email class |
| `resources/views/emails/contact-verification.blade.php` | View | OTP email template |
| `resources/views/contact-verify.blade.php` | View | OTP verification page |
| `app/Http/Controllers/ContactController.php` | Controller | Form and verification logic |
| `routes/web.php` | Routes | Endpoint definitions |
| `resources/views/contact.blade.php` | View | Contact form (updated) |

---

## 🛠️ Troubleshooting

### Problem: Emails not sending
**Solution**: Check `.env` mail configuration and test with `php artisan tinker`:
```php
Mail::raw('Test', function($msg) { $msg->to('test@example.com'); });
```

### Problem: Throttle errors
**Solution**: Ensure your cache driver is working (not array). Test with `php artisan cache:clear`

### Problem: Session not persisting
**Solution**: Check session driver in `.env` (default: file). Ensure `storage/framework/sessions` is writable

### Problem: OTP not expiring
**Solution**: Verify server time is correct with `date` command

---

## ✨ Production Checklist

- [ ] Run migrations: `php artisan migrate`
- [ ] Configure mail driver in `.env`
- [ ] Test email sending
- [ ] Test all user flows
- [ ] Configure cache for throttling
- [ ] Monitor logs for honeypot triggers
- [ ] Set up rate limiting alerts (optional)
- [ ] Review security logs regularly
- [ ] Backup database before migration

---

## Support

For issues or questions, refer to the commit messages and code comments throughout the implementation.

