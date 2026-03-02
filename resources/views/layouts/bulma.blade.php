<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gender and Development - Building Inclusive Communities')</title>
    
    <!-- Bulma CSS Framework -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
    
    <style>
        /* ===== GLOBAL STYLES ===== */
        html {
            scroll-behavior: smooth;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f8f9fa;
            color: #2d2d2d;
            font-family: 'Poppins', sans-serif;
        }

        main {
            flex: 1;
        }

        /* ===== HERO SECTION ===== */
        .hero-gradient {
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .hero-gradient.is-large {
            min-height: 600px;
        }

        /* ===== CARDS & BOXES ===== */
        .box, .card {
            transition: all 0.3s ease;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;
            color: #2d2d2d;
        }

        .box:hover, .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: #f8f9fa;
            border-bottom: 3px solid #ff6b6b;
            border-radius: 16px 16px 0 0;
        }

        /* ===== IMAGE CONTAINERS ===== */
        .image-container {
            height: 250px;
            overflow: hidden;
            border-radius: 16px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ===== PROGRAM/EVENT ICONS ===== */
        .icon-large {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ff6b6b;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            background: #ffffff;
            border-bottom: none;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #ff6b6b;
        }

        .navbar-item {
            color: #2d2d2d !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-item:hover {
            color: #ff6b6b !important;
        }

        .navbar-item.is-active {
            color: #ff6b6b !important;
            border-bottom: 3px solid #ff6b6b;
            font-weight: 700;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: #2d2d2d;
            border-top: none;
            color: rgba(255, 255, 255, 0.9);
            margin-top: auto;
        }

        .footer a {
            color: #ff6b6b;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ff8787;
        }

        .footer-title {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        /* ===== FORM STYLES ===== */
        .label {
            color: #2d2d2d;
            font-weight: 600;
        }

        .input, .textarea, .select {
            background: #ffffff !important;
            border: 1px solid #e0e0e0 !important;
            color: #2d2d2d !important;
            border-radius: 10px !important;
        }

        .input:focus, .textarea:focus, .select:focus {
            border-color: #ff6b6b !important;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1) !important;
            background: #ffffff !important;
        }

        .button.is-primary {
            background: #ff6b6b;
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .button.is-primary:hover {
            background: #ff5252;
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
            transform: translateY(-2px);
        }

        /* ===== SECTIONS ===== */
        .section {
            background: transparent;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #2d2d2d;
            font-weight: 700;
            border-bottom: 3px solid #ff6b6b;
            padding-bottom: 1rem;
        }

        /* ===== NEWS ITEM ===== */
        .news-item {
            border-left: 4px solid #ff6b6b;
            padding-left: 1.5rem;
            margin-bottom: 2rem;
            color: #2d2d2d;
        }

        .news-date {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .news-category {
            display: inline-block;
            background: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        /* ===== EVENT/PROGRAM STATUS ===== */
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            border: none;
        }

        .status-ongoing {
            background: rgba(76, 175, 80, 0.15);
            color: #2e7d32;
        }

        .status-completed {
            background: rgba(78, 115, 223, 0.15);
            color: #1e40af;
        }

        .status-upcoming {
            background: rgba(255, 107, 107, 0.15);
            color: #d32f2f;
        }

        /* ===== TABLE STYLES ===== */
        .table {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            overflow: hidden;
            border-collapse: collapse;
        }

        .table {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead td, .table thead th {
            background: #f8f9fa;
            color: #2d2d2d;
            font-weight: 700;
            border: none;
            padding: 1rem;
            border-bottom: 2px solid #e0e0e0;
        }

        .table tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .table tbody td {
            color: #2d2d2d;
            padding: 1rem;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb {
            margin-bottom: 2rem;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .breadcrumb a {
            color: #ff6b6b;
            font-weight: 600;
        }

        /* ===== HERO WITH BACKGROUND IMAGE ===== */
        .hero-with-image {
            position: relative;
            width: 100%;
            height: 65vh;
            background-image: url('{{ asset("images/GAD Main page BG.gif") }}');
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
            background: rgba(12, 12, 28, 0.6);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            animation: fadeInDown 0.8s ease-out, floatingAnimation 4s ease-in-out 1s infinite;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -1px;
        }

        .hero-content .subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2rem;
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

        @keyframes floatingAnimation {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* ===== MODERN SECTIONS ===== */
        .section-modern {
            background: #ffffff;
            border-radius: 16px;
            color: #2d2d2d;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .section-modern .section-title {
            color: #2d2d2d;
            border-bottom-color: #ff6b6b;
        }

        /* ===== RESPONSIVE ===== */
        @media screen and (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }

            .icon-large {
                font-size: 2rem;
            }

            .hero-with-image {
                height: 60vh;
                background-attachment: scroll;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content .subtitle {
                font-size: 1.1rem;
            }
        }
    </style>
    
    @yield('extra_css')
</head>
<body>
    <!-- ===== NAVIGATION ===== -->
    <nav class="navbar" role="navigation" aria-label="main navigation" x-data="{ navOpen: false }">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('welcome') }}">
                <span class="icon-text">
                    <img src="{{ asset('images/GAD Logo.png')}}" alt="CatSu GAD Logo" style="height: 40px; margin-right: 10px;">
                    <span style="color: #ff6b6b; font-weight: 700;">CatSu GAD</span>
                </span>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" 
               @click="navOpen = !navOpen" :class="{ 'is-active': navOpen }">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div class="navbar-menu" :class="{ 'is-active': navOpen }">
            <div class="navbar-start">
                <a class="navbar-item {{ request()->routeIs('welcome') ? 'is-active' : '' }}" href="{{ route('welcome') }}">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span>Home</span>
                    </span>
                </a>
                <a class="navbar-item {{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-info-circle"></i></span>
                        <span>About</span>
                    </span>
                </a>
                <a class="navbar-item {{ request()->routeIs('programs') ? 'is-active' : '' }}" href="{{ route('programs') }}">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-project-diagram"></i></span>
                        <span>Programs</span>
                    </span>
                </a>
                <a class="navbar-item {{ request()->routeIs('news-page') ? 'is-active' : '' }}" href="{{ route('news-page') }}">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-newspaper"></i></span>
                        <span>News</span>
                    </span>
                </a>
                <a class="navbar-item {{ request()->routeIs('events') ? 'is-active' : '' }}" href="{{ route('events') }}">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-calendar"></i></span>
                        <span>Events</span>
                    </span>
                </a>
                <a class="navbar-item {{ request()->routeIs('reports') ? 'is-active' : '' }}" href="{{ route('reports') }}">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-file-pdf"></i></span>
                        <span>Reports</span>
                    </span>
                </a>
                <a class="navbar-item {{ request()->routeIs('contact') ? 'is-active' : '' }}" href="{{ route('contact') }}">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <span>Contact</span>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    <main>
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container">
            <div class="columns">
                <!-- About Footer -->
                <div class="column is-4">
                    <h4 class="footer-title">About CatSu GAD</h4>
                    <p>
                        The Gender and Development (GAD) Office is committed to promoting gender equality 
                        and empowering women and LGBTQ+ communities through evidence-based policies, programs, 
                        and advocacy initiatives.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="column is-4">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('about') }}">Our Mandate</a></li>
                        <li><a href="{{ route('programs') }}">Programs & Projects</a></li>
                        <li><a href="{{ route('news-page') }}">Latest News</a></li>
                        <li><a href="{{ route('reports') }}">Research & Reports</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact & Social -->
                <div class="column is-4">
                    <h4 class="footer-title">Get In Touch</h4>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> 15 Development Avenue, Quezon City 1101, Philippines<br>
                        <i class="fas fa-phone"></i> (632) 811-5678 Extension 2500<br>
                        <i class="fas fa-envelope"></i> <a href="mailto:gad@gov.ph">gad@gov.ph</a>
                    </p>
                    <div style="margin-top: 1rem;">
                        <a href="#" style="margin-right: 1rem;"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" style="margin-right: 1rem;"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" style="margin-right: 1rem;"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="#"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
            </div>

            <hr style="background-color: #444;">

            <div class="content has-text-centered">
                <p style="color: white;">
                   &copy; 2024 Gender and Development (GAD) Office - Philippines | 
                    All rights reserved. | 
                    <a href="#">Privacy Policy</a> | 
                    <a href="#">Terms of Service</a>
                </p>
            </div>
        </div>
    </footer>

    @yield('extra_js')
</body>
</html>
