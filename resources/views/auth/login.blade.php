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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .login-header h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .field {
            margin-bottom: 25px;
        }

        .field label {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .input {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: border-color 0.3s;
        }

        .input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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
            color: #667eea;
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
            accent-color: #667eea;
        }

        .remember-checkbox label {
            margin: 0;
            cursor: pointer;
            color: #666;
            font-weight: normal;
        }

        .login-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
        }

        .login-footer p {
            color: #666;
            margin-bottom: 15px;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
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
