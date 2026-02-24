@extends('layouts.bulma')

@section('title', 'Verify Your Contact - CatSu GAD')

@section('extra_css')
    <style>
        /* ===== HERO WITH BACKGROUND IMAGE ===== */
        .hero-with-image {
            position: relative;
            width: 100%;
            height: 40vh;
            background-image: url("{{ asset('images/GAD Main page BG.gif') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(59, 10, 99, 0.65);
            backdrop-filter: blur(2px);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            animation: fadeInDown 0.8s ease-out;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
            letter-spacing: -1px;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== PURPLE GRADIENT SECTIONS ===== */
        .section-purple-gradient {
            background: linear-gradient(135deg, #3b0a63 0%, #7b2cbf 50%, #5a189a 100%);
            color: white;
        }

        .section-purple-gradient .section-title {
            color: white;
        }

        .section-purple-gradient .section-title::after {
            background: linear-gradient(90deg, #c77dff, #e0aaff);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: #2c3e50;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* ===== OTP VERIFICATION CARD ===== */
        .verification-card {
            background: white;
            border-radius: 12px;
            padding: 3rem 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-top: 4px solid #7b2cbf;
        }

        .verification-icon {
            text-align: center;
            margin-bottom: 2rem;
        }

        .verification-icon i {
            font-size: 3rem;
            color: #7b2cbf;
        }

        .otp-input-field {
            margin-bottom: 1.5rem;
        }

        .otp-input {
            font-size: 2rem;
            letter-spacing: 0.5rem;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            border: 2px solid #ddd !important;
            border-radius: 8px !important;
            padding: 15px !important;
            transition: all 0.3s ease;
        }

        .otp-input:focus {
            border-color: #7b2cbf !important;
            box-shadow: 0 0 0 3px rgba(123, 44, 191, 0.1) !important;
        }

        .otp-input.is-danger {
            border-color: #f14668 !important;
        }

        .info-box {
            background: #f0f7ff;
            border-left: 4px solid #667eea;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            color: #333;
        }

        .timer {
            text-align: center;
            color: #7b2cbf;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .timer.warning {
            color: #f0ad4e;
        }

        .timer.expired {
            color: #f14668;
        }

        .resend-section {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .resend-text {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .resend-link {
            color: #7b2cbf;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
        }

        .resend-link:hover {
            text-decoration: underline;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 2rem;
        }

        .back-link {
            text-align: center;
            margin-top: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media screen and (max-width: 768px) {
            .hero-with-image {
                height: 35vh;
                background-attachment: scroll;
            }

            .hero-content h1 {
                font-size: 1.75rem;
            }

            .verification-card {
                padding: 2rem 1.5rem;
            }

            .otp-input {
                font-size: 1.5rem;
                letter-spacing: 0.25rem;
                padding: 12px !important;
            }

            .button-group {
                flex-direction: column;
            }

            .button-group button,
            .button-group a {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')

<!-- ===== HERO SECTION ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Verify Your Contact</h1>
    </div>
</section>

<!-- ===== VERIFICATION CONTENT ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-full-mobile is-full-tablet is-6-desktop">
                <div class="verification-card">
                    <!-- Icon -->
                    <div class="verification-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>

                    <!-- Title -->
                    <h2 class="title is-4 has-text-centered" style="color: #3b0a63; margin-bottom: 0.5rem;">
                        Verify Your Email
                    </h2>
                    <p class="has-text-centered" style="color: #666; margin-bottom: 2rem;">
                        We've sent a 6-digit code to your email address
                    </p>

                    <!-- Info Box -->
                    <div class="info-box">
                        <strong>📧 Check your email</strong><br>
                        Look for a message from us with your verification code. If you don't see it in your inbox, please check your spam folder.
                    </div>

                    <!-- Timer -->
                    <div class="timer" id="timer">
                        ⏱️ Code expires in <span id="time-remaining">10:00</span>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="notification is-danger mb-4">
                            <button class="delete"></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Verification Form -->
                    <form action="{{ route('contact.verify.submit') }}" method="POST">
                        @csrf

                        <!-- OTP Input -->
                        <div class="otp-input-field">
                            <label class="label" style="color: #3b0a63; font-weight: 600;">
                                Enter Verification Code <span style="color: #f14668;">*</span>
                            </label>
                            <div class="control">
                                <input type="text"
                                       name="otp"
                                       id="otp"
                                       class="input otp-input @error('otp') is-danger @enderror"
                                       placeholder="000000"
                                       maxlength="6"
                                       inputmode="numeric"
                                       pattern="[0-9]{6}"
                                       required
                                       autocomplete="off"
                                       value="{{ old('otp') }}">
                            </div>
                            @error('otp')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="button-group">
                            <button class="button is-primary is-medium" type="submit" style="flex: 1;">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                <span>Verify & Continue</span>
                            </button>
                            <a href="{{ route('contact') }}" class="button is-light is-medium" style="flex: 1;">
                                <span class="icon"><i class="fas fa-times"></i></span>
                                <span>Cancel</span>
                            </a>
                        </div>

                        <p class="is-size-7 has-text-grey mt-3">
                            <span style="color: #f14668;">*</span> Required field
                        </p>
                    </form>

                    <!-- Resend Section -->
                    <div class="resend-section">
                        <p class="resend-text">
                            Didn't receive the code?
                        </p>
                        <form action="{{ route('contact.resend-otp') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="resend-link">
                                Send a new verification code
                            </button>
                        </form>
                    </div>

                    <!-- Back Link -->
                    <div class="back-link">
                        <small>
                            <a href="{{ route('contact') }}" style="color: #999; text-decoration: none;">
                                ← Back to Contact Form
                            </a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== VERIFICATION TIMEOUT SCRIPT ===== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Start OTP timer (10 minutes)
        let timeRemaining = 600; // 10 minutes in seconds
        const timerElement = document.getElementById('time-remaining');
        const timerContainer = document.getElementById('timer');
        const otpInput = document.getElementById('otp');

        // Auto-format OTP input to only accept digits
        otpInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
        });

        // Timer interval
        const timerInterval = setInterval(function() {
            timeRemaining--;

            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            // Change color when less than 2 minutes
            if (timeRemaining < 120 && timeRemaining > 0) {
                timerContainer.classList.add('warning');
                timerContainer.classList.remove('expired');
            }

            // Show expired message
            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                timerContainer.classList.remove('warning');
                timerContainer.classList.add('expired');
                timerContainer.innerHTML = '❌ Verification code has expired. Please request a new one.';
                otpInput.disabled = true;
                document.querySelector('button[type="submit"]').disabled = true;
            }
        }, 1000);

        // Auto-focus on OTP input
        otpInput.focus();
    });
</script>

@endsection
