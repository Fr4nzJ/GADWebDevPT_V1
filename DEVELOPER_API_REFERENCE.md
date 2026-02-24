# Email OTP Verification - Developer API Reference

## 📚 Quick API Reference

### ContactController Methods

#### 1. `store(Request $request) → RedirectResponse`

**Purpose**: Handle initial contact form submission

**Flow**:
```php
POST /contact → Throttled (3 per 10 min)
├─ Validate form inputs
├─ Check honeypot
├─ Generate 6-digit OTP
└─ Send verification email
```

**Input Variables**:
```php
$request->input('name')      // string | required | 2-255 chars
$request->input('email')     // string | required | valid email
$request->input('subject')   // string | required | 3-255 chars
$request->input('message')   // string | required | 10-5000 chars
$request->input('website')   // string | hidden honeypot (should be empty)
```

**Session Data Created**:
```php
session('contact_form_data') = [
    'name' => string,
    'email' => string,
    'subject' => string,
    'message' => string,
    'ip_address' => string,
    'user_agent' => string,
    'otp' => '123456',                    // 6-digit code
    'otp_created_at' => CarbonInstance,   // Datetime
]
```

**Output**:
- ✅ Success: Redirect to `contact.verify` with info message
- ❌ Validation Error: Redirect back with errors
- ❌ Honeypot Triggered: Silent success (no email sent)
- ❌ Mail Error: Redirect back with error message

**Example Usage**:
```php
// In your tests or commands:
Route::post('/contact', [ContactController::class, 'store']);

// Manual call:
$controller = new ContactController();
$request = Request::create('/contact', 'POST', [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'subject' => 'Test',
    'message' => 'This is a test message'
]);
$response = $controller->store($request);
```

---

#### 2. `showVerify() → View`

**Purpose**: Display OTP verification page

**Flow**:
```php
GET /contact/verify → No throttle
├─ Check session exists
└─ Render verification form
```

**Requirements**:
- Must have `contact_form_data` in session
- Session must not be expired (default: 120 min)

**Session Data Used**:
```php
session('contact_form_data')
// Read to verify session exists, but not displayed
```

**Output**:
- ✅ Success: Display `contact-verify.blade.php`
- ❌ No Session: Redirect to contact with error

**Example Usage**:
```php
// In your templates:
<a href="{{ route('contact.verify') }}">Go to Verification</a>

// Manual call:
$controller = new ContactController();
$response = $controller->showVerify();
// Returns: View with countdown timer & OTP form
```

---

#### 3. `verify(Request $request) → RedirectResponse`

**Purpose**: Validate OTP and save verified message to database

**Flow**:
```php
POST /contact/verify → Throttled (5 per 10 min)
├─ Check session exists
├─ Validate OTP format (6 digits)
├─ Compare with session OTP
├─ Check expiration (< 10 minutes old)
├─ Save to database if valid
└─ Clear session
```

**Input Variables**:
```php
$request->input('otp')  // string | required | exactly 6 digits
```

**Database Action**:
```php
Contact::create([
    'name' => $formData['name'],
    'email' => $formData['email'],
    'subject' => $formData['subject'],
    'message' => $formData['message'],
    'verification_code' => $formData['otp'],
    'is_verified' => true,  // ← VERIFIED FLAG SET
    'ip_address' => $formData['ip_address'],
    'user_agent' => $formData['user_agent'],
]);
```

**Output**:
- ✅ Correct OTP: Redirect to contact with success
- ❌ Wrong OTP: Redirect to verify with error (keep session)
- ❌ Expired OTP: Redirect to contact with error (clear session)
- ❌ No Session: Redirect to contact with error

**Example Usage**:
```php
// In your tests:
$response = $controller->verify(
    Request::create('/contact/verify', 'POST', [
        'otp' => '123456'
    ])
);

// In your JavaScript (already implemented):
document.querySelector('form').addEventListener('submit', function() {
    // OTP auto-formatted to 6 digits only
});
```

**Validation Messages**:
```
'otp.required' => 'Please enter the verification code.'
'otp.size' => 'Verification code must be 6 digits.'
'otp.regex' => 'Verification code must contain only digits.'
```

---

#### 4. `resendOtp(Request $request) → RedirectResponse`

**Purpose**: Generate and send new OTP code

**Flow**:
```php
POST /contact/resend-otp → Throttled (3 per 10 min)
├─ Check session exists
├─ Generate new OTP
├─ Update session timestamp
├─ Send new email
└─ Redirect to verify
```

**Session Data Updated**:
```php
// Update these in session:
session('contact_form_data.otp') = 'new_otp_code'
session('contact_form_data.otp_created_at') = now()
```

**Output**:
- ✅ Success: Redirect to verify with info message
- ❌ No Session: Redirect to contact with error
- ❌ Mail Error: Redirect to verify with error

**Example Usage**:
```php
// In your HTML/Blade:
<form action="{{ route('contact.resend-otp') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="resend-link">
        Send a new verification code
    </button>
</form>

// Manual call:
$response = $controller->resendOtp(new Request());
```

---

#### 5. `generateOtp() → string` (Private Helper)

**Purpose**: Generate random 6-digit OTP code

**Parameters**: None

**Returns**: 
```php
// '123456' (always 6 characters, zero-padded)
```

**Implementation**:
```php
private function generateOtp(): string {
    return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
}
```

**Example Outputs**:
```
000001
042857
999999
123456
```

**Used By**:
- `store()` - generates initial OTP
- `resendOtp()` - generates new OTP

---

## 🗄️ Contact Model API

### Contact Model

**Location**: `app/Models/Contact.php`

**Fillable Attributes**:
```php
protected $fillable = [
    'name',                // string
    'email',               // string
    'subject',             // string
    'message',             // text/longtext
    'verification_code',   // string | nullable
    'is_verified',         // boolean
    'ip_address',          // string | nullable
    'user_agent',          // text | nullable
];
```

**Casts**:
```php
protected $casts = [
    'is_verified' => 'boolean',  // Automatically cast to bool
];
```

**Query Methods**:

```php
// Get all verified contacts
Contact::verified()->get();

// Get specific verified contact
Contact::verified()->where('email', 'john@ex.com')->first();

// Get all unverified (should be empty)
Contact::unverified()->get();

// Create verified contact (done in verify())
Contact::create([
    'name' => 'John',
    'email' => 'john@example.com',
    'subject' => 'Help',
    'message' => 'Can you help?',
    'verification_code' => '123456',
    'is_verified' => true,
    'ip_address' => '192.168.1.1',
    'user_agent' => 'Mozilla...'
]);

// Query verified by email
Contact::verified()->where('email', 'john@example.com')->first();

// Count verified contacts
Contact::verified()->count();

// Latest verified contacts
Contact::verified()->latest()->first();
Contact::verified()->latest()->limit(10)->get();

// Today's verified contacts
Contact::verified()
    ->whereDate('created_at', today())
    ->get();
```

---

## 📧 ContactVerificationMail API

### Mailable Class

**Location**: `app/Mail/ContactVerificationMail.php`

**Constructor**:
```php
public function __construct(
    public string $name,
    public string $email,
    public string $verificationCode,
    public string $subject
)
```

**Usage**:
```php
// Send email:
Mail::to($email)->send(
    new ContactVerificationMail(
        'John Doe',                    // name
        'john@example.com',            // email
        '123456',                      // 6-digit OTP
        'Inquiry about Programs'       // subject of contact
    )
);

// Queue for background sending:
Mail::to($email)->queue(
    new ContactVerificationMail(...)
);

// With CC/BCC:
Mail::to($email)
    ->cc('admin@gad.gov.ph')
    ->send(new ContactVerificationMail(...));
```

**Email Template Variables**:
```php
// Available in: resources/views/emails/contact-verification.blade.php
$name                // string - user's name
$email               // string - user's email
$verificationCode    // string - '123456'
$subject             // string - contact subject
```

---

## 🛣️ Routes API

### Route Definitions

```php
// Display contact form (GET)
Route::get('/contact', ...)->name('contact');
// Response: View with contact form

// Submit form (POST) - Throttled
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store')
    ->middleware('throttle:3,10');
// Input: name, email, subject, message, website
// Output: Redirect to verify or back with errors

// Display verification page (GET)
Route::get('/contact/verify', [ContactController::class, 'showVerify'])
    ->name('contact.verify');
// Response: View with OTP input form

// Verify OTP (POST) - Throttled
Route::post('/contact/verify', [ContactController::class, 'verify'])
    ->name('contact.verify')
    ->middleware('throttle:5,10');
// Input: otp
// Output: Redirect to contact with success/error

// Resend OTP (POST) - Throttled
Route::post('/contact/resend-otp', [ContactController::class, 'resendOtp'])
    ->name('contact.resend-otp')
    ->middleware('throttle:3,10');
// Input: (none - uses session)
// Output: Redirect to verify with info message
```

### Named Routes

```php
// In Blade templates:
route('contact')              // GET /contact
route('contact.store')        // POST /contact
route('contact.verify')       // GET /contact/verify, POST /contact/verify
route('contact.resend-otp')   // POST /contact/resend-otp

// Examples:
<form action="{{ route('contact.store') }}" method="POST">
<a href="{{ route('contact') }}">Back</a>
<form action="{{ route('contact.verify') }}" method="POST">
<form action="{{ route('contact.resend-otp') }}" method="POST">
```

---

## 🔐 Middleware Reference

### Throttling Middleware

```php
throttle:requests,minutes

// Examples:
throttle:3,10     // Max 3 requests per 10 minutes
throttle:5,10     // Max 5 requests per 10 minutes
throttle:60,1     // Max 60 requests per 1 minute

// Identified by:
- User ID (if authenticated)
- IP address (if guest)
- Unique key (if specified)
```

**Rate Limit Headers** (in response):
```
X-RateLimit-Limit: 3          // Max allowed
X-RateLimit-Remaining: 1      // Remaining requests
X-RateLimit-Reset: 1234567890 // Unix timestamp
```

**Exceeded Response**:
```
Status: 429 Too Many Requests
```

---

## 📊 Validation Rules

### Form Validation (store method)

```php
[
    'name' => 'required|string|min:2|max:255',
    'email' => 'required|email|max:255',
    'subject' => 'required|string|min:3|max:255',
    'message' => 'required|string|min:10|max:5000',
    'website' => 'nullable|string|max:255',  // honeypot
]
```

**Custom Messages**:
```php
'name.required' => 'Please provide your full name.'
'name.min' => 'Name must be at least 2 characters.'
'email.required' => 'Email address is required.'
'email.email' => 'Please provide a valid email address.'
'subject.required' => 'Subject field is required.'
'subject.min' => 'Subject must be at least 3 characters.'
'message.required' => 'Please provide a message.'
'message.min' => 'Message must be at least 10 characters.'
```

### OTP Validation (verify method)

```php
[
    'otp' => 'required|string|size:6|regex:/^\d{6}$/',
]
```

**Custom Messages**:
```php
'otp.required' => 'Please enter the verification code.'
'otp.size' => 'Verification code must be 6 digits.'
'otp.regex' => 'Verification code must contain only digits.'
```

---

## 📝 Logging Points

### Events Logged

Location: `storage/logs/laravel.log`

**Log Types**:

```php
// Information level:
Log::channel('single')->info('Contact Form OTP Sent', [
    'email' => $validated['email'],
    'name' => $validated['name'],
    'ip_address' => $request->ip(),
    'timestamp' => now(),
]);

Log::channel('single')->info('Contact Form Verified and Stored', [
    'email' => $formData['email'],
    'name' => $formData['name'],
    'subject' => $formData['subject'],
    'ip_address' => $formData['ip_address'],
    'timestamp' => now(),
]);

// Warning level:
Log::warning('Honeypot triggered on contact form', [
    'ip_address' => $request->ip(),
    'timestamp' => now(),
]);

Log::warning('Contact Form OTP Verification Failed', [
    'email' => $formData['email'],
    'provided_otp' => $request->input('otp'),
    'ip_address' => $request->ip(),
    'timestamp' => now(),
]);

// Error level:
Log::error('Contact Form OTP Generation/Send Error', [
    'error' => $e->getMessage(),
    'file' => $e->getFile(),
    'line' => $e->getLine(),
]);
```

---

## 🧪 Testing Examples

### Unit Test Example

```php
// Test successful verification
public function test_contact_otp_verification()
{
    // Arrange
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'subject' => 'Test',
        'message' => 'This is a test message',
    ];

    // Act - Submit form
    $response = $this->post(route('contact.store'), $data);
    
    // Assert
    $this->assertEquals(302, $response->status()); // Redirect
    $this->assertTrue(session()->has('contact_form_data'));
    
    // Get OTP from session
    $otp = session('contact_form_data.otp');
    
    // Act - Verify OTP
    $verifyResponse = $this->post(route('contact.verify'), [
        'otp' => $otp
    ]);
    
    // Assert
    $this->assertDatabaseHas('contacts', [
        'email' => 'john@example.com',
        'is_verified' => true,
    ]);
    $this->assertFalse(session()->has('contact_form_data'));
}

// Test wrong OTP
public function test_wrong_otp_returns_error()
{
    $this->post(route('contact.store'), [...]);
    
    $response = $this->post(route('contact.verify'), [
        'otp' => '000000'  // Wrong
    ]);
    
    $this->assertTrue($response->has('errors'));
    $this->assertDatabaseMissing('contacts', ['is_verified' => true]);
}
```

---

## 🎯 Common Use Cases

### Accessing Verified Contacts

```php
// In controller or command:
$verifiedContacts = Contact::verified()->get();

foreach ($verifiedContacts as $contact) {
    echo $contact->name;           // John Doe
    echo $contact->email;          // john@example.com
    echo $contact->is_verified;    // true (boolean)
    echo $contact->created_at;     // 2026-02-24 10:30:00
}
```

### Building Admin Dashboard

```php
// Count statistics
$total = Contact::count();
$verified = Contact::verified()->count();
$unverified = Contact::unverified()->count();  // Should be 0

// Recent contacts
$recent = Contact::verified()
    ->latest()
    ->limit(10)
    ->get();

// Search by email
$contact = Contact::verified()
    ->where('email', 'john@example.com')
    ->first();
```

### Debugging in Tinker

```php
php artisan tinker

>>> Contact::verified()->count()       // Total verified
>>> Contact::latest()->first()         // Latest submission
>>> Contact::where('email', 'x@y')->first()
>>> session('contact_form_data')       // Current session
```

---

## 🚀 Advanced Configuration

### Change OTP Settings

**In ContactController.php**:

```php
// Change generated OTP length
private function generateOtp(): string {
    // For 8 digits:
    return str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
}

// Change expiration time (line ~165)
if (now()->diffInMinutes($otpCreatedAt) > 15) {  // 15 minutes instead of 10
    // Expired
}
```

### Change Throttle Limits

**In routes/web.php**:

```php
// More lenient limits:
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:10,10');  // 10 per 10 minutes

// Stricter limits:
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:1,10');   // 1 per 10 minutes
```

---

This API reference covers all methods, variables, and usage patterns for the Email OTP Verification system.
