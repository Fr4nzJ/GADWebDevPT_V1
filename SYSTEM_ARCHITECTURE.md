# Email OTP Verification - System Architecture & Flow

## 🏗️ System Architecture

```
┌─────────────────────────────────────────────────────────────────────────┐
│                         USER INTERFACE                                 │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  Contact Form                          Verification Page               │
│  (contact.blade.php)                   (contact-verify.blade.php)       │
│  ┌─────────────────────┐              ┌──────────────────────┐         │
│  │ Name                │              │ Timer (10 min)       │         │
│  │ Email               │──POST────→   │ OTP Input (6 digit)  │         │
│  │ Subject             │ /contact     │ Resend Button        │         │
│  │ Message             │              │ Verify Button        │         │
│  │ [Honeypot]          │              └──────────┬───────────┘         │
│  │ Send Button         │                         │                     │
│  └─────────────────────┘                    POST /contact/verify        │
│                                             (or resend-otp)            │
└──────────────────────────┬───────────────────┬──────────────────────────┘
                           │                   │
                    Throttle: 3/10min    Throttle: 5/10min
                           ↓                   ↓
┌─────────────────────────────────────────────────────────────────────────┐
│                        CONTROLLER LAYER                                 │
├─────────────────────────────────────────────────────────────────────────┤
│                    ContactController                                     │
│ ┌──────────────────────────────────────────────────────────────┐        │
│ │ store($request)                                              │        │
│ │  1. Validate inputs (name, email, subject, message)         │        │
│ │  2. Check honeypot field                                    │        │
│ │  3. generateOtp() → "123456"                                │        │
│ │  4. Store in session:                                       │        │
│ │     - form data                                             │        │
│ │     - OTP code                                              │        │
│ │     - OTP created timestamp                                 │        │
│ │  5. Mail::send(ContactVerificationMail)                     │        │
│ │  6. redirect('contact.verify')                              │        │
│ └──────────────────────────────────────────────────────────────┘        │
│                                                                         │
│ ┌──────────────────────────────────────────────────────────────┐        │
│ │ verify($request)                                             │        │
│ │  1. Check session has contact_form_data                     │        │
│ │  2. Validate OTP (6 digits)                                 │        │
│ │  3. Compare $request->otp with SESSION otp                  │        │
│ │  4. Check OTP not expired (< 10 minutes)                    │        │
│ │  5. If valid:                                               │        │
│ │     - Contact::create($data) → Save to DB                  │        │
│ │     - session()->forget('contact_form_data')                │        │
│ │     - redirect('contact')->with('success')                  │        │
│ │  6. If invalid:                                             │        │
│ │     - Log warning                                           │        │
│ │     - redirect('contact.verify')                            │        │
│ │       ->withErrors(['otp' => 'incorrect'])                  │        │
│ └──────────────────────────────────────────────────────────────┘        │
│                                                                         │
│ ┌──────────────────────────────────────────────────────────────┐        │
│ │ resendOtp($request)                                          │        │
│ │  1. Check session exists                                    │        │
│ │  2. Generate new OTP                                        │        │
│ │  3. Update session with new OTP & timestamp                 │        │
│ │  4. Mail::send(ContactVerificationMail)                     │        │
│ │  5. redirect('contact.verify')                              │        │
│ │     ->with('info', 'New code sent')                         │        │
│ └──────────────────────────────────────────────────────────────┘        │
└──────────────────────┬──────────────────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────────────────┐
│                         SERVICE LAYER                                   │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  MAILING SERVICE              SESSION SERVICE                          │
│  ┌──────────────────────┐     ┌──────────────────────┐                │
│  │ ContactVerification  │     │ Session Storage      │                │
│  │ Mail (Mailable)      │     │ (Encrypted)          │                │
│  │ ↓                    │     │ ↓                    │                │
│  │ render email templ   │     │ Store form data      │                │
│  │ ↓                    │     │ Store OTP            │                │
│  │ Mail::send()         │     │ Auto expire          │                │
│  │ ↓                    │     │ on logout            │                │
│  │ SMTP Provider        │     └──────────────────────┘                │
│  └──────────────────────┘                                             │
└──────────────┬───────────────────────────────────────────────────────┘
               ↓
┌─────────────────────────────────────────────────────────────────────────┐
│                         DATA LAYER                                      │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  MySQL Database              Application Logs                          │
│  ┌─────────────────┐        ┌──────────────────────┐                 │
│  │ contacts table  │        │ storage/logs/        │                 │
│  │ ├─ id           │        │ laravel.log          │                 │
│  │ ├─ name         │        │                      │                 │
│  │ ├─ email        │        │ Logged events:       │                 │
│  │ ├─ subject      │        │ • OTP sent           │                 │
│  │ ├─ message      │        │ • OTP verified       │                 │
│  │ ├─ verification │        │ • Honeypot trigger   │                 │
│  │ │  _code        │        │ • Verification fails │                 │
│  │ ├─ is_verified  │        │ • OTP expired        │                 │
│  │ ├─ ip_address   │        │ • Errors             │                 │
│  │ ├─ user_agent   │        │                      │                 │
│  │ └─ timestamps   │        └──────────────────────┘                 │
│  └─────────────────┘                                                 │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## 🔄 Complete Request/Response Cycle

### Phase 1: Form Submission
```
USER ACTION: Fill & Submit Contact Form
    ↓
REQUEST: POST /contact
    ├─ Middleware: throttle:3,10
    │  └─ Blocks if >3 requests per 10 minutes
    ├─ Validate: name, email, subject, message
    ├─ Check: honeypot field (should be empty)
    └─ Generate: 6-digit OTP
        ↓
    SESSION STORAGE:
    ├─ name: "John Doe"
    ├─ email: "john@example.com"
    ├─ subject: "Inquiry about GAD Programs"
    ├─ message: "I would like to know..."
    ├─ otp: "123456"
    ├─ otp_created_at: "2026-02-24 10:30:00"
    ├─ ip_address: "192.168.1.100"
    └─ user_agent: "Mozilla/5.0..."
        ↓
    MAIL SENT: ContactVerificationMail
    ├─ To: john@example.com
    ├─ Subject: Verify Your Contact Form Submission
    ├─ Body: HTML with OTP code
    └─ Via: SMTP/Mail provider
        ↓
RESPONSE: Redirect to /contact/verify
    └─ Status: 302 (Temporary Redirect)
        ↓
USER SEES: Verification Page
    ├─ OTP Input Field
    ├─ Countdown Timer (10:00 remaining)
    ├─ Resend Button
    └─ Cancel Button
```

### Phase 2: OTP Verification
```
USER ACTION: Enter OTP & Click "Verify"
    ↓
REQUEST: POST /contact/verify
    ├─ Input: OTP = "123456"
    ├─ Middleware: throttle:5,10
    │  └─ Blocks if >5 attempts per 10 minutes
    └─ Retrieve: Session data
        ↓
VALIDATION CHECKS:
    ├─ Is session data present? ✓
    ├─ Is OTP 6 digits? ✓
    ├─ Does OTP match? ✓ (123456 == 123456)
    └─ Is OTP not expired?
        ├─ Now: 2026-02-24 10:35:00
        ├─ Created: 2026-02-24 10:30:00
        ├─ Diff: 5 minutes (< 10 min)
        └─ ✓ Valid (not expired)
        ↓
ACTION: Save to Database
    ├─ Contact::create([
    │  ├─ name: "John Doe"
    │  ├─ email: "john@example.com"
    │  ├─ subject: "Inquiry about GAD Programs"
    │  ├─ message: "I would like to know..."
    │  ├─ verification_code: "123456"
    │  ├─ is_verified: true ← SET TO TRUE
    │  ├─ ip_address: "192.168.1.100"
    │  └─ user_agent: "Mozilla/5.0..."
    │ ])
    ├─ session()->forget('contact_form_data')
    │  └─ Clear temp session storage
    └─ Log: "Contact Form Verified and Stored"
        ↓
ACTION: Send Confirmation Email (optional)
    └─ To: john@example.com
        ↓
RESPONSE: Redirect to /contact
    ├─ Status: 302 (Temporary Redirect)
    └─ Session: success = "Thank you! Message received."
        ↓
USER SEES: Contact Form
    └─ Green success notification
        ├─ "Thank you!"
        ├─ "Your message has been verified and received"
        └─ "We'll respond within 24 hours"
```

### Phase 3: Error Scenarios

#### Scenario A: Wrong OTP
```
USER ENTERS: "654321" (wrong code)
    ↓
VALIDATION: "654321" != "123456" ✗
    ↓
ACTION: Log Warning (failed attempt)
    ├─ timestamp
    ├─ ip_address
    └─ provided_otp
    ↓
RESPONSE: Redirect to /contact/verify
    ├─ Status: 302
    └─ Error: "The verification code is incorrect"
        ↓
USER SEES: Verification Page
    ├─ Error message (red notification)
    ├─ OTP field cleared (for security)
    ├─ Timer still running
    ├─ Can try again or resend
    └─ Session data intact for retry
```

#### Scenario B: Expired OTP
```
USER: Waits 11 minutes to enter OTP
    ↓
REQUEST: POST /contact/verify with old OTP
    ↓
VALIDATION: Check expiration
    ├─ Now: 2026-02-24 10:41:00
    ├─ Created: 2026-02-24 10:30:00
    ├─ Diff: 11 minutes (> 10 min)
    └─ ✗ EXPIRED
        ↓
ACTION:
    ├─ Log: "Contact Form OTP Expired"
    ├─ session()->forget('contact_form_data')
    │  └─ Clear session (force restart)
    └─ NOT saved to database
        ↓
RESPONSE: Redirect to /contact
    ├─ Status: 302
    └─ Error: "Code expired. Please submit again."
        ↓
USER MUST: Resubmit contact form
```

#### Scenario C: Honeypot Triggered
```
USER/BOT: Fills hidden "website" field
    ↓
REQUEST: POST /contact with website="http://spam.com"
    ↓
CONTROLLER: Detects honeypot filled
    ├─ Log: "Honeypot triggered"
    ├─ Alert: Possible bot/spam attempt
    └─ No OTP sent, no email sent
        ↓
RESPONSE: Success (silently)
    ├─ Status: 302
    └─ Message: "Thank you for reaching out! We will review..."
        ↓ (Same as legitimate submission)
USER/BOT: Thinks success → Has no idea it was blocked
    ↓
RESULT: Spam avoided, no message stored
```

---

## 🗺️ Route Map with Middleware

```
GET  /contact                    → Display form
                                   (no throttle)

POST /contact                    → Submit form
  ├─ Middleware: throttle:3,10
  │  └─ Max 3 per 10 minutes
  ├─ Handler: ContactController@store
  ├─ Actions:
  │  ├─ Validate
  │  ├─ Generate OTP
  │  ├─ Store in session
  │  └─ Send email
  └─ Response: Redirect to verify

GET  /contact/verify             → Show verification form
                                   (no throttle)

POST /contact/verify             → Submit OTP
  ├─ Middleware: throttle:5,10
  │  └─ Max 5 per 10 minutes
  ├─ Handler: ContactController@verify
  ├─ Actions:
  │  ├─ Validate OTP
  │  ├─ Check expiration
  │  ├─ Save to DB if valid
  │  └─ Clear session
  └─ Response: Status-based redirect

POST /contact/resend-otp         → Request new OTP
  ├─ Middleware: throttle:3,10
  │  └─ Max 3 per 10 minutes
  ├─ Handler: ContactController@resendOtp
  ├─ Actions:
  │  ├─ Generate new OTP
  │  ├─ Update session
  │  └─ Send email
  └─ Response: Redirect to verify with info message
```

---

## 💾 Data Flow Through Sessions

```
SESSION DATA LIFECYCLE:
═══════════════════════════════════════════

TIME 0: Form Submitted
┌──────────────────────────────────────┐
│ session()->put('contact_form_data', │
│ {                                    │
│   'name': 'John',                    │
│   'email': 'john@ex.com',           │
│   'subject': 'Help',                 │
│   'message': '...',                  │
│   'otp': '123456',                   │
│   'otp_created_at': NOW,            │
│   'ip_address': '192.168.1.1',       │
│   'user_agent': 'Mozilla...'         │
│ })                                   │
│ [Encrypted by Laravel]               │
└──────────────────────────────────────┘
        ↓
        ├─ User receives OTP email
        ├─ User clicks verification page
        └─ Session data retrieved for display
        ↓
TIME N: User Enters OTP
        ├─ Check session still exists ✓
        ├─ Verify OTP matches ✓
        ├─ Check not expired ✓
        ├─ Save to DB:
        │  Contact::create([...form_data...])
        │  is_verified = TRUE
        └─ Clear session:
           session()->forget('contact_form_data')
           [Data permanently deleted]

        ↓ User can no longer retry
        ↓ (Won't have session data)
```

---

## 🔒 Security Layers

```
┌─────────────────────────────────────────────────────────┐
│                   REQUEST ARRIVES                       │
└──────────────────┬──────────────────────────────────────┘
                   ↓
      ┌────────────────────────────┐
      │ LAYER 1: RATE LIMITING     │
      │ throttle:3,10              │
      │ Check request count        │
      │ from IP/user               │
      │ If exceeded → 429 error    │
      └────────────────────────────┘
                   ↓
      ┌────────────────────────────┐
      │ LAYER 2: CSRF PROTECTION   │
      │ Check @csrf token          │
      │ Compare with session       │
      │ If invalid → 419 error     │
      └────────────────────────────┘
                   ↓
      ┌────────────────────────────┐
      │ LAYER 3: INPUT VALIDATION  │
      │ Check all fields present   │
      │ Check email format         │
      │ Check message length       │
      │ If invalid → return errors │
      └────────────────────────────┘
                   ↓
      ┌────────────────────────────┐
      │ LAYER 4: HONEYPOT CHECK    │
      │ Check hidden website field │
      │ If filled → silent fail    │
      └────────────────────────────┘
                   ↓
      ┌────────────────────────────┐
      │ LAYER 5: OTP VALIDATION    │
      │ Check OTP length           │
      │ Check OTP format (digits)  │
      │ Check OTP expiration       │
      │ Check OTP match            │
      │ If invalid → return error  │
      └────────────────────────────┘
                   ↓
      ┌────────────────────────────┐
      │ LAYER 6: SESSION CHECK     │
      │ Verify session exists      │
      │ Verify not expired         │
      │ If invalid → redirect      │
      └────────────────────────────┘
                   ↓
┌──────────────────────────────────────┐
│ ACTION: SAVE TO DATABASE             │
│ ✓ All checks passed                  │
│ ✓ Message verified                   │
│ ✓ is_verified = true                 │
└──────────────────────────────────────┘
```

---

## 📊 Database Relationships

```
MySQL: contacts TABLE
│
├─ VERIFIED MESSAGES (is_verified = true)
│  ├─ Message 1: Stored immediately after verification
│  ├─ Message 2: Full details with user info
│  └─ Message 3: Includes IP for security audit
│
├─ UNVERIFIED ENTRIES (is_verified = false)
│  └─ Should be empty (only in session, not DB)
│
└─ INDEXES
   ├─ PRIMARY KEY: id
   ├─ INDEX: email (for quick lookups)
   └─ INDEX: is_verified (for admin dashboard)
```

---

## 🎯 Key Decision Points in Code

```
Form Submitted
    ↓
┌───────────────────────────┐
│ Is honeypot field filled? │
├───────────────────────────┤
│ YES → Log & Silently       │
│ succeed (prevent bot      │
│ awareness)                │
│ NO → Continue             │
└──────────────┬────────────┘
               ↓
┌───────────────────────────┐
│ Are all fields valid?     │
├───────────────────────────┤
│ NO → Return with errors   │
│ YES → Continue            │
└──────────────┬────────────┘
               ↓
            [OTP Sent]
               ↓
OTP Verification
    ↓
┌───────────────────────────┐
│ Does OTP match?           │
├───────────────────────────┤
│ NO → Return error, retry  │
│ YES → Continue            │
└──────────────┬────────────┘
               ↓
┌───────────────────────────┐
│ Is OTP expired?           │
├───────────────────────────┤
│ YES → Redirect to form    │
│ NO → Continue             │
└──────────────┬────────────┘
               ↓
         [Save to DB]
               ↓
    [Clear Session]
               ↓
  [Show Success Message]
```

---

## ⏱️ Timeline Example

```
10:30:00 - User submits form
10:30:05 - OTP email sent to user
10:30:10 - User receives email, opens verification page
10:30:15 - Sees "09:45" countdown timer
10:32:00 - Timer shows "07:00"
10:35:00 - User enters OTP
10:35:01 - OTP verified (5 min < 10 min limit)
10:35:02 - Message saved to DB with is_verified=true
10:35:03 - Success message shown
10:35:04 - Session cleared

────────────────

If user waits too long:

10:30:00 - Form submitted, OTP sent
10:35:00 - Timer shows "05:00", countdown continues
10:40:00 - User enters OTP
10:40:01 - Check: 10 minutes have passed
10:40:02 - OTP is EXPIRED
10:40:03 - Session cleared
10:40:04 - Error: "Code expired, submit again"
10:40:05 - User redirected to contact form
          [Message NOT saved to DB]
```

---

This architecture ensures security, user experience, and data integrity across all verification flows.
