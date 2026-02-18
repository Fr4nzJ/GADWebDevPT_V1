<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gender and Development - Building Inclusive Communities</title>
    
    <!-- Bulma CSS Framework -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Custom styles to complement Bulma */
        html {
            scroll-behavior: smooth;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Hero Section Custom Styling */
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .hero-gradient.is-large {
            min-height: 600px;
        }

        /* News & Cards Enhancement */
        .box {
            transition: all 0.3s ease;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Image containers */
        .image-container {
            height: 250px;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Program Icons */
        .program-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* Sticky Navigation */
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Footer Enhancement */
        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .footer a {
            color: #ecf0f1;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #667eea;
        }

        /* Label and Input styling */
        .label {
            font-weight: 600;
        }

        .input:focus, .textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.125em rgba(102, 126, 234, 0.25);
        }

        /* Success and Error Messages */
        .notification.is-success {
            background-color: #48c774;
            color: white;
        }

        .notification.is-error {
            background-color: #f14668;
            color: white;
        }

        /* Button Enhancements */
        .button.is-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* Tags for event status */
        .tag.is-status {
            background-color: #667eea;
            color: white;
            font-weight: 600;
        }

        /* Section Spacing */
        section {
            padding: 3rem 1.5rem;
        }

        @media screen and (min-width: 768px) {
            section {
                padding: 4rem 3rem;
            }
        }

        /* Background colors for sections */
        .section-light {
            background-color: #f8f9fa;
        }

        .section-white {
            background-color: white;
        }

        /* Report box styling */
        .report-item {
            border-left: 4px solid #667eea;
            padding-left: 1.5rem;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .hero-gradient.is-large {
                min-height: 400px;
            }

            section {
                padding: 2rem 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- ===== HEADER / NAVIGATION BAR ===== -->
    <nav class="navbar is-light" role="navigation" aria-label="main navigation" x-data="{ navbarActive: false }">
        <div class="navbar-brand">
            <!-- Logo -->
            <a class="navbar-item" href="/">
                <span class="icon-text">
                    <span class="icon is-large has-text-primary">
                        <i class="fas fa-venus-mars fa-2x"></i>
                    </span>
                    <strong style="font-size: 1.25rem; margin-left: 0.5rem;">Gender & Development</strong>
                </span>
            </a>

            <!-- Burger menu for mobile -->
            <a role="button" class="navbar-burger" :class="{ 'is-active': navbarActive }" @click="navbarActive = !navbarActive" aria-label="toggle navigation" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="navbar-menu" :class="{ 'is-active': navbarActive }">
            <div class="navbar-start">
                <a class="navbar-item" href="#home" @click="navbarActive = false">
                    <strong>Home</strong>
                </a>
                <a class="navbar-item" href="#about" @click="navbarActive = false">
                    About
                </a>
                <a class="navbar-item" href="#programs" @click="navbarActive = false">
                    Programs
                </a>
                <a class="navbar-item" href="#news" @click="navbarActive = false">
                    News
                </a>
                <a class="navbar-item" href="#events" @click="navbarActive = false">
                    Events
                </a>
                <a class="navbar-item" href="#reports" @click="navbarActive = false">
                    Reports
                </a>
                <a class="navbar-item" href="#contact" @click="navbarActive = false">
                    Contact
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" href="{{ route('login') }}">
                            <strong>Login</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>


        <!-- ===== HERO SECTION ===== -->
        <section id="home" class="hero hero-gradient is-large">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="content">
                        <h1 class="title is-1 has-text-white">
                            Empowering Communities Through Gender Equality
                        </h1>
                        <p class="subtitle is-4 has-text-white">
                            We are dedicated to advancing gender and development initiatives, promoting inclusive growth,
                            and creating sustainable opportunities for all communities.
                        </p>
                        <div class="buttons is-centered mt-6">
                            <a class="button is-white is-medium is-rounded" href="#programs">
                                <strong>Learn More</strong>
                            </a>
                            <a class="button is-light is-medium is-rounded" href="#contact">
                                <strong>Get Involved</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ===== LATEST NEWS SECTION ===== -->
        <section id="news" class="section section-light">
            <div class="container">
                <div class="content has-text-centered mb-6">
                    <h2 class="title is-2">Latest News</h2>
                    <p class="subtitle is-5">Stay updated with the latest developments in gender and development initiatives</p>
                </div>

                <!-- News Grid -->
                <div class="columns is-multiline">
                    <!-- News Item 1 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image-container">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop" alt="Women in leadership">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">Women Empowerment Program Reaches 10,000 Beneficiaries</p>
                                        <p class="subtitle is-7 has-text-grey">
                                            <time datetime="2026-02-15">February 15, 2026</time>
                                        </p>
                                    </div>
                                </div>
                                <div class="content">
                                    <p>Our flagship women empowerment initiative has successfully reached and trained over 10,000 women in sustainable livelihood skills and financial literacy.</p>
                                    <a href="#" class="has-text-primary">Read More →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Item 2 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image-container">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop" alt="Community development">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">Gender Equality Framework Adopted by Local Government</p>
                                        <p class="subtitle is-7 has-text-grey">
                                            <time datetime="2026-02-10">February 10, 2026</time>
                                        </p>
                                    </div>
                                </div>
                                <div class="content">
                                    <p>In a landmark decision, the local government has adopted our comprehensive gender equality framework for municipal policies and programs implementation.</p>
                                    <a href="#" class="has-text-primary">Read More →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- News Item 3 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image-container">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop" alt="Youth development">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">Youth Leadership Summit Brings Together 500+ Young Changemakers</p>
                                        <p class="subtitle is-7 has-text-grey">
                                            <time datetime="2026-02-05">February 5, 2026</time>
                                        </p>
                                    </div>
                                </div>
                                <div class="content">
                                    <p>The annual Youth Leadership Summit unified 500+ young leaders from across the region to discuss sustainable development and gender-inclusive policies.</p>
                                    <a href="#" class="has-text-primary">Read More →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ===== UPCOMING EVENTS SECTION ===== -->
        <section id="events" class="section section-white">
            <div class="container">
                <div class="content has-text-centered mb-6">
                    <h2 class="title is-2">Upcoming Events</h2>
                    <p class="subtitle is-5">Join us for meaningful discussions and learning opportunities</p>
                </div>

                <!-- Events Grid -->
                <div class="columns is-multiline">
                    <!-- Event 1 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box">
                            <div class="mb-3">
                                <span class="tag is-status">Upcoming</span>
                            </div>
                            <h3 class="title is-5">Women in Business Conference 2026</h3>
                            <div class="content">
                                <p><strong>📅 Date:</strong> March 15-17, 2026</p>
                                <p><strong>📍 Venue:</strong> Convention Center, Main Hall</p>
                                <p>Join us for a 3-day conference bringing together women entrepreneurs, leaders, and change-makers to share experiences and build networks.</p>
                            </div>
                            <a class="button is-primary is-small" href="#">Register Now</a>
                        </div>
                    </div>

                    <!-- Event 2 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box">
                            <div class="mb-3">
                                <span class="tag is-status">Upcoming</span>
                            </div>
                            <h3 class="title is-5">Community Dialogue: Gender-Based Violence Prevention</h3>
                            <div class="content">
                                <p><strong>📅 Date:</strong> March 8, 2026 (International Women's Day)</p>
                                <p><strong>📍 Venue:</strong> Community Center, Multi-Purpose Room</p>
                                <p>A community forum addressing gender-based violence prevention, survivor support services, and building safer communities.</p>
                            </div>
                            <a class="button is-primary is-small" href="#">Register Now</a>
                        </div>
                    </div>

                    <!-- Event 3 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box">
                            <div class="mb-3">
                                <span class="tag is-status">Upcoming</span>
                            </div>
                            <h3 class="title is-5">Skills Training Workshop: Digital Literacy for Women</h3>
                            <div class="content">
                                <p><strong>📅 Date:</strong> March 22-24, 2026 (3 sessions)</p>
                                <p><strong>📍 Venue:</strong> Tech Hub Innovation Center</p>
                                <p>Comprehensive digital literacy training equipping women with essential skills for the modern workforce and entrepreneurship.</p>
                            </div>
                            <a class="button is-primary is-small" href="#">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ===== PROGRAMS / PROJECTS SECTION ===== -->
        <section id="programs" class="section section-light">
            <div class="container">
                <div class="content has-text-centered mb-6">
                    <h2 class="title is-2">Our Programs</h2>
                    <p class="subtitle is-5">Comprehensive initiatives driving gender equality and sustainable development</p>
                </div>

                <!-- Programs Grid -->
                <div class="columns is-multiline">
                    <!-- Program 1 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box has-text-centered">
                            <div class="program-icon">
                                👩‍💼
                            </div>
                            <h3 class="title is-5">Women's Economic Empowerment</h3>
                            <div class="content has-text-left">
                                <p>Building economic capacity through skills training, microfinance access, and business mentorship for low-income women.</p>
                                <p class="is-size-7 has-text-grey">
                                    <strong>Target Group:</strong> Rural and urban women | <strong>Duration:</strong> 12 months
                                </p>
                            </div>
                            <a href="#" class="has-text-primary">Learn More →</a>
                        </div>
                    </div>

                    <!-- Program 2 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box has-text-centered">
                            <div class="program-icon">
                                🎓
                            </div>
                            <h3 class="title is-5">Youth Education & Leadership</h3>
                            <div class="content has-text-left">
                                <p>Fostering the next generation through quality education, leadership training, and mentorship programs for youth.</p>
                                <p class="is-size-7 has-text-grey">
                                    <strong>Target Group:</strong> Ages 15-30 | <strong>Duration:</strong> Ongoing
                                </p>
                            </div>
                            <a href="#" class="has-text-primary">Learn More →</a>
                        </div>
                    </div>

                    <!-- Program 3 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box has-text-centered">
                            <div class="program-icon">
                                ♥️
                            </div>
                            <h3 class="title is-5">Health & Wellness Advocacy</h3>
                            <div class="content has-text-left">
                                <p>Promoting comprehensive health awareness, reproductive health rights, and mental wellness support across communities.</p>
                                <p class="is-size-7 has-text-grey">
                                    <strong>Target Group:</strong> All ages | <strong>Duration:</strong> 6-18 months
                                </p>
                            </div>
                            <a href="#" class="has-text-primary">Learn More →</a>
                        </div>
                    </div>

                    <!-- Program 4 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box has-text-centered">
                            <div class="program-icon">
                                ⚖️
                            </div>
                            <h3 class="title is-5">Policy Advocacy & Governance</h3>
                            <div class="content has-text-left">
                                <p>Strengthening gender-responsive policies and institutional frameworks for inclusive governance at all levels.</p>
                                <p class="is-size-7 has-text-grey">
                                    <strong>Target Group:</strong> Government bodies | <strong>Duration:</strong> Ongoing
                                </p>
                            </div>
                            <a href="#" class="has-text-primary">Learn More →</a>
                        </div>
                    </div>

                    <!-- Program 5 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box has-text-centered">
                            <div class="program-icon">
                                🛡️
                            </div>
                            <h3 class="title is-5">Violence Prevention & Support</h3>
                            <div class="content has-text-left">
                                <p>Comprehensive support services for survivors and prevention programs to combat gender-based violence in communities.</p>
                                <p class="is-size-7 has-text-grey">
                                    <strong>Target Group:</strong> Survivors and advocates | <strong>Duration:</strong> 24 months
                                </p>
                            </div>
                            <a href="#" class="has-text-primary">Learn More →</a>
                        </div>
                    </div>

                    <!-- Program 6 -->
                    <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="box has-text-centered">
                            <div class="program-icon">
                                🌍
                            </div>
                            <h3 class="title is-5">Sustainable Development Goals</h3>
                            <div class="content has-text-left">
                                <p>Integrating gender perspectives into SDG implementation for climate action, poverty reduction, and environmental sustainability.</p>
                                <p class="is-size-7 has-text-grey">
                                    <strong>Target Group:</strong> Communities | <strong>Duration:</strong> Ongoing
                                </p>
                            </div>
                            <a href="#" class="has-text-primary">Learn More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ===== REPORTS SECTION ===== -->
        <section id="reports" class="section section-white">
            <div class="container">
                <div class="content has-text-centered mb-6">
                    <h2 class="title is-2">Latest Reports</h2>
                    <p class="subtitle is-5">Research findings and impact assessments from our initiatives</p>
                </div>

                <!-- Reports List -->
                <div class="columns">
                    <div class="column is-full">
                        <!-- Report 1 -->
                        <div class="box report-item mb-4">
                            <div class="columns is-vcentered">
                                <div class="column">
                                    <p class="heading">📄 Annual Impact Report 2025</p>
                                    <p class="title is-5">Comprehensive review of 2025 initiatives and achievements</p>
                                    <p class="subtitle is-6">Comprehensive review of our 2025 initiatives, achievements, beneficiary feedback, and strategic outcomes across all programs.</p>
                                    <div class="tags">
                                        <span class="tag is-primary">Impact Report</span>
                                        <span class="tag">2025</span>
                                        <span class="tag is-light">📥 PDF (4.2 MB)</span>
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    <a class="button is-primary is-rounded" href="#">Download</a>
                                </div>
                            </div>
                        </div>

                        <!-- Report 2 -->
                        <div class="box report-item mb-4">
                            <div class="columns is-vcentered">
                                <div class="column">
                                    <p class="heading">📊 Gender Equality Baseline Study</p>
                                    <p class="title is-5">Current status of gender equality indicators in target communities</p>
                                    <p class="subtitle is-6">Baseline research establishing the current status of gender equality indicators in our target communities across key development sectors.</p>
                                    <div class="tags">
                                        <span class="tag is-success">Research</span>
                                        <span class="tag">2024</span>
                                        <span class="tag is-light">📥 PDF (3.8 MB)</span>
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    <a class="button is-primary is-rounded" href="#">Download</a>
                                </div>
                            </div>
                        </div>

                        <!-- Report 3 -->
                        <div class="box report-item mb-4">
                            <div class="columns is-vcentered">
                                <div class="column">
                                    <p class="heading">🎓 Youth Leadership Program Evaluation</p>
                                    <p class="title is-5">Program effectiveness and participant outcomes</p>
                                    <p class="subtitle is-6">Evaluation report of the Youth Leadership Program showing effectiveness metrics, participant outcomes, and recommendations for program improvement.</p>
                                    <div class="tags">
                                        <span class="tag is-info">Evaluation</span>
                                        <span class="tag">2025</span>
                                        <span class="tag is-light">📥 PDF (2.5 MB)</span>
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    <a class="button is-primary is-rounded" href="#">Download</a>
                                </div>
                            </div>
                        </div>

                        <!-- Report 4 -->
                        <div class="box report-item">
                            <div class="columns is-vcentered">
                                <div class="column">
                                    <p class="heading">🔍 Gender-Based Violence Prevalence Study</p>
                                    <p class="title is-5">Prevalence rates and policy recommendations</p>
                                    <p class="subtitle is-6">In-depth study examining prevalence rates, risk factors, and protective factors related to gender-based violence in the region with policy recommendations.</p>
                                    <div class="tags">
                                        <span class="tag is-warning">Research</span>
                                        <span class="tag">2024</span>
                                        <span class="tag is-light">📥 PDF (5.1 MB)</span>
                                    </div>
                                </div>
                                <div class="column is-narrow">
                                    <a class="button is-primary is-rounded" href="#">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View All Reports Link -->
                <div class="has-text-centered mt-6">
                    <a href="#" class="button is-text is-large">
                        <strong>View All Reports →</strong>
                    </a>
                </div>
            </div>
        </section>


        <!-- ===== CONTACT / FEEDBACK SECTION ===== -->
        <section id="contact" class="section section-light">
            <div class="container">
                <div class="columns is-multiline">
                    <!-- Contact Information -->
                    <div class="column is-full-mobile is-half-tablet">
                        <div class="content">
                            <h2 class="title is-2">Get In Touch</h2>
                            <p>Have questions or want to collaborate with us? Send us a message and we'll get back to you as soon as possible.</p>
                        </div>

                        <!-- Contact Details -->
                        <div class="mb-5">
                            <article class="media mb-4">
                                <div class="media-left">
                                    <div class="icon is-large has-text-primary">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="media-content">
                                    <strong>Address</strong>
                                    <p class="is-size-6">Gender and Development Center<br>123 Development Street<br>Civic District, Metro City 12345</p>
                                </div>
                            </article>

                            <article class="media mb-4">
                                <div class="media-left">
                                    <div class="icon is-large has-text-primary">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <div class="media-content">
                                    <strong>Phone</strong>
                                    <p class="is-size-6">(+1) 555-123-4567<br>Toll-free: 1-800-GAD-HELP</p>
                                </div>
                            </article>

                            <article class="media mb-4">
                                <div class="media-left">
                                    <div class="icon is-large has-text-primary">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="media-content">
                                    <strong>Email</strong>
                                    <p class="is-size-6">info@genderdev.org<br>support@genderdev.org</p>
                                </div>
                            </article>

                            <article class="media mb-4">
                                <div class="media-left">
                                    <div class="icon is-large has-text-primary">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <div class="media-content">
                                    <strong>Office Hours</strong>
                                    <p class="is-size-6">Monday - Friday: 8:00 AM - 5:00 PM<br>Saturday: 9:00 AM - 1:00 PM</p>
                                </div>
                            </article>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="column is-full-mobile is-half-tablet">
                        <div class="box">
                            <h3 class="title is-4">Send us a Message</h3>
                            
                            <!-- Success Message -->
                            @if (session('success'))
                                <div class="notification is-success mb-4">
                                    <button class="delete"></button>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="notification is-error mb-4">
                                    <button class="delete"></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf

                                <!-- Name Field -->
                                <div class="field">
                                    <label class="label">Full Name</label>
                                    <div class="control has-icons-left">
                                        <input class="input @error('name') is-danger @enderror" type="text" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                        <span class="icon is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    @error('name')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div class="field">
                                    <label class="label">Email Address</label>
                                    <div class="control has-icons-left">
                                        <input class="input @error('email') is-danger @enderror" type="email" id="email" name="email" placeholder="john@example.com" value="{{ old('email') }}" required>
                                        <span class="icon is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    @error('email')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subject Field -->
                                <div class="field">
                                    <label class="label">Subject</label>
                                    <div class="control has-icons-left">
                                        <input class="input @error('subject') is-danger @enderror" type="text" id="subject" name="subject" placeholder="How can we help?" value="{{ old('subject') }}" required>
                                        <span class="icon is-left">
                                            <i class="fas fa-pen"></i>
                                        </span>
                                    </div>
                                    @error('subject')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Message Field -->
                                <div class="field">
                                    <label class="label">Message</label>
                                    <div class="control">
                                        <textarea class="textarea @error('message') is-danger @enderror" id="message" name="message" placeholder="Your message..." rows="6" required>{{ old('message') }}</textarea>
                                    </div>
                                    @error('message')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="field is-grouped">
                                    <div class="control is-expanded">
                                        <button type="submit" class="button is-primary is-fullwidth is-medium">
                                            <span class="icon-text">
                                                <span class="icon">
                                                    <i class="fas fa-paper-plane"></i>
                                                </span>
                                                <span>Send Message</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ===== NEWSLETTER SECTION ===== -->
        <section class="section hero hero-gradient is-medium">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h2 class="title is-2 has-text-white">Stay Updated</h2>
                    <p class="subtitle is-5 has-text-white mb-5">
                        Subscribe to our newsletter for updates on programs, news, and events
                    </p>
                    <form class="field has-addons is-grouped is-grouped-centered">
                        <p class="control is-expanded" style="max-width: 400px;">
                            <input class="input" type="email" placeholder="Enter your email" required>
                        </p>
                        <p class="control">
                            <button type="submit" class="button is-white is-medium">
                                <strong>Subscribe</strong>
                            </button>
                        </p>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
        <div class="container">
            <div class="columns">
                <!-- Footer Column 1: About -->
                <div class="column">
                    <div class="content">
                        <h4 class="title is-5" style="color: #ecf0f1;">
                            <span class="icon-text">
                                <span class="icon">
                                    <i class="fas fa-venus-mars"></i>
                                </span>
                                <span>GAD Initiative</span>
                            </span>
                        </h4>
                        <p>Empowering communities through gender equality, sustainable development, and inclusive participation.</p>
                    </div>
                </div>

                <!-- Footer Column 2: Quick Links -->
                <div class="column">
                    <h4 class="title is-5" style="color: #ecf0f1;">Quick Links</h4>
                    <ul>
                        <li><a href="#" class="has-text-grey-light">About Us</a></li>
                        <li><a href="#" class="has-text-grey-light">Programs</a></li>
                        <li><a href="#" class="has-text-grey-light">News & Blog</a></li>
                        <li><a href="#" class="has-text-grey-light">Events</a></li>
                    </ul>
                </div>

                <!-- Footer Column 3: Resources -->
                <div class="column">
                    <h4 class="title is-5" style="color: #ecf0f1;">Resources</h4>
                    <ul>
                        <li><a href="#" class="has-text-grey-light">Reports</a></li>
                        <li><a href="#" class="has-text-grey-light">Publications</a></li>
                        <li><a href="#" class="has-text-grey-light">Guidelines</a></li>
                        <li><a href="#" class="has-text-grey-light">FAQs</a></li>
                    </ul>
                </div>

                <!-- Footer Column 4: Social Media -->
                <div class="column">
                    <h4 class="title is-5" style="color: #ecf0f1;">Follow Us</h4>
                    <div class="buttons">
                        <a class="button is-dark is-small is-rounded" href="#">
                            <span class="icon">
                                <i class="fab fa-facebook"></i>
                            </span>
                        </a>
                        <a class="button is-dark is-small is-rounded" href="#">
                            <span class="icon">
                                <i class="fab fa-twitter"></i>
                            </span>
                        </a>
                        <a class="button is-dark is-small is-rounded" href="#">
                            <span class="icon">
                                <i class="fab fa-linkedin"></i>
                            </span>
                        </a>
                        <a class="button is-dark is-small is-rounded" href="#">
                            <span class="icon">
                                <i class="fab fa-instagram"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Divider -->
            <hr style="background-color: rgba(255, 255, 255, 0.2); margin: 2rem 0;">

            <div class="columns is-vcentered">
                <div class="column">
                    <p style="color: #bdc3c7;">&copy; 2026 Gender and Development Initiative. All rights reserved.</p>
                </div>
                <div class="column has-text-right">
                    <div class="buttons">
                        <a href="#" class="has-text-grey-light is-size-7">Privacy Policy</a>
                        <a href="#" class="has-text-grey-light is-size-7">Terms of Service</a>
                        <a href="#" class="has-text-grey-light is-size-7">Cookie Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script for smooth scrolling -->
    <script>
        // Close notification when delete button is clicked
        document.querySelectorAll('.notification .delete').forEach(btn => {
            btn.addEventListener('click', () => {
                btn.parentElement.remove();
            });
        });
    </script>

</body>
</html>
