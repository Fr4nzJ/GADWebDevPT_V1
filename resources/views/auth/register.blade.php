<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CatSu GAD Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            font-size: 3rem;
            color: #ff6b6b;
            margin-bottom: 15px;
        }

        .register-header h1 {
            color: #2d2d2d;
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .register-header p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .field {
            margin-bottom: 25px;
        }

        .field label {
            color: #2d2d2d;
            font-weight: 700;
            margin-bottom: 8px;
            display: block;
        }

        .input {
            background: #ffffff !important;
            border: 1px solid #e0e0e0 !important;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s;
            color: #2d2d2d !important;
        }

        .input::placeholder {
            color: #b0b0b0;
        }

        .input:focus {
            border-color: #ff6b6b !important;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1) !important;
            background: #ffffff !important;
        }

        .input.is-success {
            border-color: #48c774 !important;
        }

        .input.is-danger {
            border-color: #ff6b6b !important;
        }

        .password-field {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ff6b6b;
            z-index: 10;
        }

        .strength-meter {
            margin-top: 8px;
            height: 6px;
            background-color: #e0e0e0;
            border-radius: 3px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background-color 0.3s;
        }

        .strength-text {
            font-size: 0.85rem;
            margin-top: 5px;
            font-weight: 700;
            color: #6c757d;
        }

        .strength-weak {
            color: #d32f2f;
        }

        .strength-fair {
            color: #f0ad4e;
        }

        .strength-good {
            color: #4e73df;
        }

        .strength-strong {
            color: #48c774;
        }

        .password-requirements {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #6c757d;
        }

        .requirement.met {
            color: #48c774;
        }

        .requirement i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
        }

        .register-button {
            background: #ff6b6b;
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s;
        }

        .register-button:hover {
            background: #ff5252;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .register-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
        }

        .register-footer p {
            color: #6c757d;
        }

        .register-footer a {
            color: #ff6b6b;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }

        .register-footer a:hover {
            color: #ff5252;
        }

        .error-message {
            background: #ffe8e8;
            border-left: 4px solid #ff6b6b;
            color: #d32f2f;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .help {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 8px;
        }

        .help.is-danger {
            color: #d32f2f;
        }

        @media (max-width: 640px) {
            .register-card {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }

            .logo-icon {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo-icon">
                    <i class="fas fa-venus-mars"></i>
                </div>
                <h1>Create Account</h1>
                <p>Join the CatSu GAD Community</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <strong>Registration Error</strong><br>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Name -->
                <div class="field">
                    <label for="name">Full Name</label>
                    <div class="control has-icons-left">
                        <input 
                            id="name" 
                            class="input @error('name') is-danger @enderror" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            required 
                            autofocus 
                            autocomplete="name"
                        >
                        <span class="icon is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    @error('name')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="control has-icons-left">
                        <input 
                            id="email" 
                            class="input @error('email') is-danger @enderror" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required 
                            autocomplete="username"
                        >
                        <span class="icon is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    <p class="help">We'll never share your email address</p>
                </div>

                <!-- Password -->
                <div class="field">
                    <label for="password">Password</label>
                    <div class="control has-icons-left password-field">
                        <input 
                            id="password" 
                            class="input @error('password') is-danger @enderror"
                            type="password"
                            name="password"
                            placeholder="Create a strong password"
                            required 
                            autocomplete="new-password"
                            onchange="checkPasswordStrength(); validatePasswordMatch();"
                            oninput="checkPasswordStrength(); validatePasswordMatch();"
                        >
                        <span class="icon is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                        <span class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <div class="strength-meter">
                        <div class="strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Requirements -->
                <div class="password-requirements">
                    <div class="requirement" id="req-length">
                        <i class="fas fa-circle"></i>
                        <span>At least 8 characters</span>
                    </div>
                    <div class="requirement" id="req-uppercase">
                        <i class="fas fa-circle"></i>
                        <span>One uppercase letter (A-Z)</span>
                    </div>
                    <div class="requirement" id="req-lowercase">
                        <i class="fas fa-circle"></i>
                        <span>One lowercase letter (a-z)</span>
                    </div>
                    <div class="requirement" id="req-number">
                        <i class="fas fa-circle"></i>
                        <span>One number (0-9)</span>
                    </div>
                    <div class="requirement" id="req-special">
                        <i class="fas fa-circle"></i>
                        <span>One special character (!@#$%^&*)</span>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="field" style="margin-top: 25px;">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="control has-icons-left password-field">
                        <input 
                            id="password_confirmation" 
                            class="input @error('password_confirmation') is-danger @enderror"
                            type="password"
                            name="password_confirmation"
                            placeholder="Re-enter your password"
                            required 
                            autocomplete="new-password"
                            onchange="validatePasswordMatch();"
                            oninput="validatePasswordMatch();"
                        >
                        <span class="icon is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                        <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <div id="matchMessage"></div>
                    @error('password_confirmation')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="register-button" id="submitBtn">
                    <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Create Account
                </button>

                <div class="register-footer">
                    <p>
                        Already have an account? <a href="{{ route('login') }}">Sign in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = event.target.closest('.toggle-password').querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            let strength = 0;

            // Check requirements
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
            };

            // Update requirement indicators
            updateRequirement('req-length', requirements.length);
            updateRequirement('req-uppercase', requirements.uppercase);
            updateRequirement('req-lowercase', requirements.lowercase);
            updateRequirement('req-number', requirements.number);
            updateRequirement('req-special', requirements.special);

            // Calculate strength
            if (requirements.length) strength++;
            if (requirements.uppercase) strength++;
            if (requirements.lowercase) strength++;
            if (requirements.number) strength++;
            if (requirements.special) strength++;

            // Update strength display
            if (strength === 0) {
                strengthBar.style.width = '0%';
                strengthText.innerHTML = '';
            } else if (strength < 2) {
                strengthBar.style.width = '25%';
                strengthBar.style.backgroundColor = '#f14668';
                strengthText.innerHTML = '<span class="strength-weak">Weak</span>';
            } else if (strength < 4) {
                strengthBar.style.width = '50%';
                strengthBar.style.backgroundColor = '#ffdd57';
                strengthText.innerHTML = '<span class="strength-fair">Fair</span>';
            } else if (strength < 5) {
                strengthBar.style.width = '75%';
                strengthBar.style.backgroundColor = '#3273dc';
                strengthText.innerHTML = '<span class="strength-good">Good</span>';
            } else {
                strengthBar.style.width = '100%';
                strengthBar.style.backgroundColor = '#48c774';
                strengthText.innerHTML = '<span class="strength-strong">Excellent</span>';
            }
        }

        function updateRequirement(id, met) {
            const element = document.getElementById(id);
            const icon = element.querySelector('i');
            
            if (met) {
                element.classList.add('met');
                icon.classList.remove('fa-circle');
                icon.classList.add('fa-check-circle');
            } else {
                element.classList.remove('met');
                icon.classList.remove('fa-check-circle');
                icon.classList.add('fa-circle');
            }
        }

        function validatePasswordMatch() {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            const matchMessage = document.getElementById('matchMessage');

            if (confirm === '') {
                matchMessage.innerHTML = '';
            } else if (password === confirm) {
                matchMessage.innerHTML = '<p class="help" style="color: #48c774;"><i class="fas fa-check-circle"></i> Passwords match</p>';
            } else {
                matchMessage.innerHTML = '<p class="help is-danger"><i class="fas fa-times-circle"></i> Passwords do not match</p>';
            }
        }
    </script>
</body>
</html>
