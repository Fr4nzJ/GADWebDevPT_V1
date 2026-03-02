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
            background: linear-gradient(
                135deg,
                #0c0c0c 0%,
                #1a1a2e 15%,
                #16213e 35%,
                #0f3460 50%,
                #533a7d 70%,
                #8b5a8c 85%,
                #a0616a 100%
            );
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            font-size: 3rem;
            color: rgba(255, 200, 100, 0.9);
            margin-bottom: 15px;
        }

        .register-header h1 {
            color: white;
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .register-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }

        .field {
            margin-bottom: 25px;
        }

        .field label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .input {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s;
            color: white !important;
            backdrop-filter: blur(10px);
        }

        .input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .input:focus {
            border-color: white !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.4) !important;
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .input.is-success {
            border-color: rgba(100, 200, 100, 0.8) !important;
        }

        .input.is-danger {
            border-color: rgba(255, 100, 100, 0.8) !important;
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
            color: rgba(255, 200, 100, 0.9);
            z-index: 10;
        }

        .strength-meter {
            margin-top: 8px;
            height: 6px;
            background-color: rgba(255, 255, 255, 0.1);
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
            font-weight: 600;
            color: rgba(255, 255, 255, 0.8);
        }

        .strength-weak {
            color: rgba(255, 100, 100, 0.9);
        }

        .strength-fair {
            color: rgba(255, 180, 100, 0.9);
        }

        .strength-good {
            color: rgba(120, 150, 255, 0.9);
        }

        .strength-strong {
            color: rgba(100, 200, 100, 0.9);
        }

        .password-requirements {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.6);
        }

        .requirement.met {
            color: rgba(100, 200, 100, 0.9);
        }

        .requirement i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
        }

        .register-button {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s;
            backdrop-filter: blur(10px);
        }

        .register-button:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .register-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .register-footer p {
            color: rgba(255, 255, 255, 0.8);
        }

        .register-footer a {
            color: rgba(255, 200, 100, 0.9);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .register-footer a:hover {
            color: white;
        }

        .error-message {
            background: rgba(255, 100, 100, 0.2);
            border-left: 4px solid rgba(255, 100, 100, 0.8);
            color: rgba(255, 200, 200, 0.9);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .help {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 8px;
        }

        .help.is-danger {
            color: rgba(255, 150, 150, 0.9);
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
