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
    
    <style>
        /* ===== GLOBAL STYLES ===== */
        html {
            scroll-behavior: smooth;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #fafafa;
        }

        main {
            flex: 1;
        }

        /* ===== HERO GRADIENT ===== */
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .hero-gradient.is-large {
            min-height: 600px;
        }

        /* ===== CARDS & BOXES ===== */
        .box, .card {
            transition: all 0.3s ease;
            background-color: white;
        }

        .box:hover, .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: #f5f5f5;
            border-bottom: 2px solid #667eea;
        }

        /* ===== IMAGE CONTAINERS ===== */
        .image-container {
            height: 250px;
            overflow: hidden;
            border-radius: 4px;
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
            color: #667eea;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #667eea;
        }

        .navbar-item.is-active {
            color: #667eea;
            border-bottom: 3px solid #667eea;
        }

        /* ===== FOOTER ===== */
        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            margin-top: auto;
        }

        .footer a {
            color: #ecf0f1;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #667eea;
        }

        .footer-title {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* ===== FORM STYLES ===== */
        .label {
            color: #363636;
            font-weight: 600;
        }

        .input:focus, .textarea:focus, .select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.125em rgba(102, 126, 234, 0.25);
        }

        .button.is-primary {
            background-color: #667eea;
        }

        .button.is-primary:hover {
            background-color: #5568d3;
        }

        /* ===== SECTIONS ===== */
        .section {
            background-color: white;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #2c3e50;
            font-weight: bold;
            border-bottom: 3px solid #667eea;
            padding-bottom: 1rem;
        }

        /* ===== NEWS ITEM ===== */
        .news-item {
            border-left: 4px solid #667eea;
            padding-left: 1.5rem;
            margin-bottom: 2rem;
        }

        .news-date {
            color: #7a7a7a;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .news-category {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        /* ===== EVENT/PROGRAM STATUS ===== */
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.85rem;
        }

        .status-ongoing {
            background-color: #48c774;
            color: white;
        }

        .status-completed {
            background-color: #3273dc;
            color: white;
        }

        .status-upcoming {
            background-color: #ffdd57;
            color: #363636;
        }

        /* ===== TABLE STYLES ===== */
        .table {
            background-color: white;
        }

        .table thead td, .table thead th {
            background-color: #667eea;
            color: white;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb {
            margin-bottom: 2rem;
        }

        .breadcrumb a {
            color: #667eea;
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
            background: rgba(59, 10, 99, 0.65);
            backdrop-filter: blur(2px);
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
            background: linear-gradient(135deg, #3b0a63 0%, #7b2cbf 50%, #5a189a 100%);
            color: white;
        }

        .section-purple-gradient .section-title {
            color: white;
        }

        .section-purple-gradient .section-title::after {
            background: linear-gradient(90deg, #c77dff, #e0aaff);
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
