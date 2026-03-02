<!DOCTYPE html>
<html lang="en" class="light-mode">
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
    
    <!-- Vite CSS & Theme JS -->
    @vite(['resources/css/app.css', 'resources/js/theme.js'])
    
    <!-- Theme Initialization (run before other scripts) -->
    <script>
        (function() {
            // Quick theme check before page renders
            const saved = localStorage.getItem('app-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = saved || (prefersDark ? 'night-mode' : 'light-mode');
            document.documentElement.className = theme;
        })();
    </script>
    
    <style>
        /* ===== GLOBAL STYLES ===== */
        html {
            scroll-behavior: smooth;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: var(--bg-gradient);
            background-attachment: fixed;
            color: var(--text-primary);
            transition: background 0.4s ease, color 0.3s ease;
        }

        main {
            flex: 1;
        }

        /* ===== HERO GRADIENT ===== */
        .hero-gradient {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .hero-gradient.is-large {
            min-height: 600px;
        }

        /* ===== CARDS & BOXES ===== */
        .box, .card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .box:hover, .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 2px solid rgba(255, 200, 100, 0.6);
        }

        /* ===== IMAGE CONTAINERS ===== */
        .image-container {
            height: 250px;
            overflow: hidden;
            border-radius: 15px;
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
            color: rgba(255, 200, 100, 0.9);
        }

        /* ===== NAVBAR ===== */
        .navbar {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: rgba(255, 200, 100, 0.9);
        }

        .navbar-item {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .navbar-item.is-active {
            color: white !important;
            border-bottom: 3px solid rgba(255, 200, 100, 0.8);
        }

        /* ===== FOOTER ===== */
        .footer {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.9);
            margin-top: auto;
        }

        .footer a {
            color: rgba(255, 200, 100, 0.9);
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: white;
        }

        .footer-title {
            color: rgba(255, 200, 100, 0.9);
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* ===== FORM STYLES ===== */
        .label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
        }

        .input, .textarea, .select {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(10px) !important;
            color: white !important;
        }

        .input:focus, .textarea:focus, .select:focus {
            border-color: white !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.4) !important;
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .button.is-primary {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
        }

        .button.is-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: white;
        }

        /* ===== SECTIONS ===== */
        .section {
            background: transparent;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: white;
            font-weight: bold;
            border-bottom: 3px solid rgba(255, 200, 100, 0.6);
            padding-bottom: 1rem;
        }

        /* ===== NEWS ITEM ===== */
        .news-item {
            border-left: 4px solid rgba(255, 200, 100, 0.8);
            padding-left: 1.5rem;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .news-date {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .news-category {
            display: inline-block;
            background: rgba(255, 200, 100, 0.2);
            color: rgba(255, 200, 100, 0.9);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            border: 1px solid rgba(255, 200, 100, 0.4);
        }

        /* ===== EVENT/PROGRAM STATUS ===== */
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.85rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .status-ongoing {
            background: rgba(100, 200, 100, 0.2);
            color: rgba(150, 255, 150, 0.9);
            border-color: rgba(100, 200, 100, 0.4);
        }

        .status-completed {
            background: rgba(120, 150, 255, 0.2);
            color: rgba(200, 220, 255, 0.9);
            border-color: rgba(120, 150, 255, 0.4);
        }

        .status-upcoming {
            background: rgba(255, 180, 100, 0.2);
            color: rgba(255, 220, 150, 0.9);
            border-color: rgba(255, 180, 100, 0.4);
        }

        /* ===== TABLE STYLES ===== */
        .table {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 15px;
            overflow: hidden;
            border-collapse: collapse;
        }

        .table thead td, .table thead th {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-weight: bold;
            border: none;
            padding: 1rem;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table tbody td {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb {
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }

        .breadcrumb a {
            color: rgba(255, 200, 100, 0.9);
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
            background: rgba(12, 12, 28, 0.75);
            backdrop-filter: blur(5px);
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
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
            letter-spacing: -1px;
        }

        .hero-content .subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
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

        /* ===== PURPLE GRADIENT SECTIONS ===== */
        .section-purple-gradient {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: white;
            padding: 2rem;
        }

        .section-purple-gradient .section-title {
            color: white;
            border-bottom-color: rgba(255, 200, 100, 0.6);
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
                    <span style="color: #667eea; font-weight: bold;">CatSu GAD</span>
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
            
            <!-- Theme Toggle in Navbar -->
            <div class="navbar-end">
                <div class="navbar-item">
                    @include('components.theme-toggle')
                </div>
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
