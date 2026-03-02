<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CatSu GAD Portal</title>
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
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            font-size: 3rem;
            color: rgba(255, 200, 100, 0.9);
            margin-bottom: 15px;
        }

        .login-header h1 {
            color: white;
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-header p {
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

        .remember-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-right: 10px;
            accent-color: rgba(255, 200, 100, 0.9);
        }

        .remember-checkbox label {
            margin: 0;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            font-weight: normal;
        }

        .login-button {
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

        .login-button:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-footer p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 15px;
        }

        .login-footer a {
            color: rgba(255, 200, 100, 0.9);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .login-footer a:hover {
            color: white;
        }

        .error-message {
            background: rgba(255, 100, 100, 0.2);
            border-left: 4px solid rgba(255, 100, 100, 0.8);
            color: rgba(255, 200, 200, 0.9);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success-message {
            background: rgba(100, 200, 100, 0.2);
            border-left: 4px solid rgba(100, 200, 100, 0.8);
            color: rgba(200, 255, 200, 0.9);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: rgba(255, 255, 255, 0.5);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        .divider span {
            padding: 0 15px;
        }
    </style>
        }

        .login-footer a:hover {
            color: #764ba2;
        }

        .error-message {
            background-color: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #c33;
        }

        .success-message {
            background-color: #efe;
            color: #3c3;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #3c3;
        }

        .text-center {
            text-align: center;
        }

        .help {
            font-size: 0.85rem;
            color: #999;
            margin-top: 8px;
        }

        @media (max-width: 640px) {
            .login-card {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }

            .logo-icon {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon">
                    <i class="fas fa-venus-mars"></i>
                </div>
                <h1>CatSu GAD</h1>
                <p>Gender and Development Portal</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <strong>Login Failed</strong><br>
                    {{ $errors->first('email') ?: 'Invalid email or password' }}
                </div>
            @endif

            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                            autofocus 
                            autocomplete="username"
                        >
                        <span class="icon is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
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
                            placeholder="Enter your password"
                            required 
                            autocomplete="current-password"
                        >
                        <span class="icon is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                        <span class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="remember-checkbox">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Keep me signed in</label>
                </div>

                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Sign In
                </button>

                <div class="login-footer">
                    <p>
                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                    </p>
                    <p style="margin-bottom: 0;">
                        Don't have an account? <a href="{{ route('register') }}">Create one</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');
            
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
    </script>
</body>
</html>
