@extends('layouts.bulma')

@section('title', 'Events & Workshops - GAD Philippines')

@section('content')
<!-- ===== HERO SECTION ===== -->
<section class="hero hero-gradient is-large">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title is-1" style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                Events & Workshops
            </h1>
            <p class="subtitle is-4" style="color: #f0f0f0;">
                Join Us for Learning, Networking, and Advocacy
            </p>
        </div>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}">Home</a></li>
                <li class="is-active"><a href="{{ route('events') }}" aria-current="page">Events</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== EVENT FILTER ===== -->
<section class="section">
    <div class="container" x-data="{ activeType: 'upcoming' }">
        <div class="content mb-4">
            <h2 class="section-title">Event Calendar</h2>
        </div>

        <div class="buttons mb-5" style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
            <button class="button" 
                    @click="activeType = 'upcoming'" 
                    :class="activeType === 'upcoming' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-calendar-plus"></i></span>
                <span>Upcoming</span>
            </button>
            <button class="button" 
                    @click="activeType = 'past'" 
                    :class="activeType === 'past' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-history"></i></span>
                <span>Past Events</span>
            </button>
        </div>

        <!-- ===== UPCOMING EVENT 1 ===== -->
        <div class="event-card" x-show="activeType === 'upcoming'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-microphone"></i></span>
                        <span>National Gender Summit 2024</span>
                    </p>
                    <span class="status-badge status-upcoming">UPCOMING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-5">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Gender+Summit" alt="Gender Summit">
                            </div>
                            <div class="box mt-3" style="background-color: #f5f5f5;">
                                <h5 class="title is-6"><i class="fas fa-calendar"></i> Date & Time</h5>
                                <p><strong>April 2-4, 2024</strong></p>
                                <p>8:00 AM - 6:00 PM (Daily)</p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-map-marker-alt"></i> Venue</h5>
                                <p><strong>Manila Convention Center</strong></p>
                                <p>CCP Complex, Roxas Boulevard, Manila</p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-tag"></i> Registration Fee</h5>
                                <p><strong>PHP 500 - PHP 2,500</strong> (depending on delegates)</p>
                            </div>
                        </div>
                        <div class="column is-7">
                            <h4 class="title is-5">Event Overview</h4>
                            <p>
                                The National Gender Summit is the premier gathering for gender equality advocates, policymakers, 
                                and practitioners in the Philippines. This three-day conference brings together government officials, 
                                NGO leaders, academic experts, and private sector representatives to discuss critical gender issues 
                                and share innovative solutions.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Event Highlights:</strong></h5>
                            <ul>
                                <li><strong>Day 1:</strong> Gender mainstreaming policies & strategies for government agencies</li>
                                <li><strong>Day 2:</strong> Women's economic empowerment and financial inclusion programs</li>
                                <li><strong>Day 3:</strong> LGBTQ+ rights protection, violence prevention, and civil society advocacy</li>
                                <li>40+ expert speakers and panelists</li>
                                <li>16 interactive workshops and parallel sessions</li>
                                <li>Networking cocktail (Day 2 evening)</li>
                                <li>Awards ceremony honoring champions for gender equality</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Expected Participants:</strong></h5>
                            <p>
                                1,500+ participants from government agencies, LGUs, NGOs, business sector, media, and academia
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Event Organizer:</strong></h5>
                            <p>
                                <strong>Atty. Jennifer Reyes</strong>, Deputy Administrator<br>
                                Email: <a href="mailto:events@gad.gov.ph">events@gad.gov.ph</a><br>
                                Phone: (632) 811-5678 Ext. 2520
                            </p>

                            <a href="#register" class="button is-primary mt-4">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                <span>Register Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== UPCOMING EVENT 2 ===== -->
        <div class="event-card" x-show="activeType === 'upcoming'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                        <span>Regional Women Leadership Training Workshop</span>
                    </p>
                    <span class="status-badge status-upcoming">UPCOMING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-5">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Leadership+Training" alt="Leadership Training">
                            </div>
                            <div class="box mt-3" style="background-color: #f5f5f5;">
                                <h5 class="title is-6"><i class="fas fa-calendar"></i> Date & Time</h5>
                                <p><strong>March 15-17, 2024</strong></p>
                                <p>9:00 AM - 5:00 PM (Daily)</p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-map-marker-alt"></i> Venues</h5>
                                <p>
                                    <strong>5 Simultaneous Venues:</strong><br>
                                    • NCR (Makati City)<br>
                                    • Visayas (Cebu City)<br>
                                    • Mindanao (Davao City)<br>
                                    • Ilocos (Vigan City)<br>
                                    • Bicol (Naga City)
                                </p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-tag"></i> Registration Fee</h5>
                                <p><strong>FREE</strong> for government employees and NGO staff</p>
                            </div>
                        </div>
                        <div class="column is-7">
                            <h4 class="title is-5">Event Overview</h4>
                            <p>
                                Interactive regional training workshops designed to build the leadership skills and gender knowledge 
                                of women managers, supervisors, and aspiring leaders in government agencies and organizations.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Training Modules:</strong></h5>
                            <ul>
                                <li>Strategic leadership and decision-making</li>
                                <li>Gender analysis and budgeting fundamentals</li>
                                <li>Project management and team leadership</li>
                                <li>Gender mainstreaming in institutional planning</li>
                                <li>Conflict resolution and negotiation skills</li>
                                <li>Building confidence and personal branding</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Target Participants:</strong></h5>
                            <p>
                                Women branch managers, department heads, program coordinators, and mid-level supervisors. 
                                60 participants per venue (300 total).
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Event Organizer:</strong></h5>
                            <p>
                                <strong>Ms. Clara Gonzales</strong>, Director, Policy & Planning Division<br>
                                Email: <a href="mailto:training@gad.gov.ph">training@gad.gov.ph</a><br>
                                Phone: (632) 811-5678 Ext. 2502
                            </p>

                            <a href="#register" class="button is-primary mt-4">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                <span>Register Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== UPCOMING EVENT 3 ===== -->
        <div class="event-card" x-show="activeType === 'upcoming'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-rainbow"></i></span>
                        <span>LGBTQ+ Youth Empowerment Forum</span>
                    </p>
                    <span class="status-badge status-upcoming">UPCOMING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-5">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Youth+Forum" alt="Youth Forum">
                            </div>
                            <div class="box mt-3" style="background-color: #f5f5f5;">
                                <h5 class="title is-6"><i class="fas fa-calendar"></i> Date & Time</h5>
                                <p><strong>May 10, 2024</strong></p>
                                <p>2:00 PM - 8:00 PM</p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-map-marker-alt"></i> Venue</h5>
                                <p><strong>Ateneo de Manila University</strong></p>
                                <p>Quezon City</p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-tag"></i> Registration Fee</h5>
                                <p><strong>FREE</strong> (Limited slots: 500 youth)</p>
                            </div>
                        </div>
                        <div class="column is-7">
                            <h4 class="title is-5">Event Overview</h4>
                            <p>
                                A celebratory and educational forum designed by and for LGBTQ+ youth aged 16-30. Features workshops, 
                                mentorship sessions, and community building activities to empower sexual minorities and gender non-conforming youth.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Workshop Topics:</strong></h5>
                            <ul>
                                <li>Health and wellness for LGBTQ+ individuals</li>
                                <li>Legal rights and protections</li>
                                <li>Career development and professional networking</li>
                                <li>Mental health support and peer counseling</li>
                                <li>Activism and social change</li>
                                <li>LGBTQ+ history and pride celebration</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Event Highlights:</strong></h5>
                            <p>
                                Live performances from LGBTQ+ artists, raffle draws for prizes, free health screening, 
                                light snacks and dinner, and networking opportunities.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Event Organizer:</strong></h5>
                            <p>
                                <strong>Engr. Rebecca Torres</strong>, Director, Programs & Projects<br>
                                Email: <a href="mailto:lgbtq@gad.gov.ph">lgbtq@gad.gov.ph</a><br>
                                Phone: (632) 811-5678 Ext. 2503
                            </p>

                            <a href="#register" class="button is-primary mt-4">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                <span>Register Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PAST EVENT 1 ===== -->
        <div class="event-card" x-show="activeType === 'past'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        <span>Gender Responsive Governance Summit 2023</span>
                    </p>
                    <span class="status-badge status-completed">COMPLETED</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-5">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Past+Event" alt="Past Event">
                            </div>
                            <div class="box mt-3" style="background-color: #f5f5f5;">
                                <h5 class="title is-6"><i class="fas fa-calendar"></i> Date</h5>
                                <p><strong>November 20-22, 2023</strong></p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-users"></i> Participants</h5>
                                <p><strong>1,200+</strong> from 45 provinces</p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-check"></i> Outcomes</h5>
                                <p>
                                    • Adopted Gender-Responsive Governance Framework<br>
                                    • 30+ MOUs signed between agencies<br>
                                    • Endorsed to policy committee
                                </p>
                            </div>
                        </div>
                        <div class="column is-7">
                            <h4 class="title is-5">Event Summary</h4>
                            <p>
                                A landmark event that brought together government leaders to commit to gender-responsive governance. 
                                The summit resulted in significant policy commitments and inter-agency partnerships for gender mainstreaming.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Key Outcomes:</strong></h5>
                            <ul>
                                <li>Gender-Responsive Governance Framework adopted by all agencies represented</li>
                                <li>30+ Memoranda of Understanding signed for inter-agency collaboration</li>
                                <li>Commitment to allocate 5% of budgets to GAD initiatives (reaching PHP 50B target)</li>
                                <li>Endorsement of the National Gender Mainstreaming Plan to the President's Cabinet</li>
                                <li>Formation of 5 regional gender coordination committees</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Event Report:</strong></h5>
                            <p>
                                <a href="#" style="color: #667eea;"><i class="fas fa-file-pdf"></i> Download Full Report (PDF)</a>
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Event Organizer:</strong></h5>
                            <p>
                                <strong>Dr. Maria Santos</strong>, Office Administrator
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PAST EVENT 2 ===== -->
        <div class="event-card" x-show="activeType === 'past'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-history"></i></span>
                        <span>16 Days of Activism Against Gender-Based Violence Campaign</span>
                    </p>
                    <span class="status-badge status-completed">COMPLETED</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-5">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=16+Days" alt="Campaign">
                            </div>
                            <div class="box mt-3" style="background-color: #f5f5f5;">
                                <h5 class="title is-6"><i class="fas fa-calendar"></i> Date</h5>
                                <p><strong>November 25 - December 10, 2023</strong></p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-users"></i> Reach</h5>
                                <p><strong>2 million people</strong> across all regions</p>

                                <h5 class="title is-6 mt-3"><i class="fas fa-check"></i> Activities</h5>
                                <p>
                                    • Walk awareness events<br>
                                    • Community forums<br>
                                    • Social media campaign<br>
                                    • Training for responders
                                </p>
                            </div>
                        </div>
                        <div class="column is-7">
                            <h4 class="title is-5">Campaign Overview</h4>
                            <p>
                                Annual international campaign to raise awareness about and end violence against women and girls. 
                                The 2023 campaign reached millions with the theme "Each for Equal."
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Campaign Activities:</strong></h5>
                            <ul>
                                <li>Nationwide walk and march events (29 events across regions)</li>
                                <li>Community education forums in 100+ municipalities</li>
                                <li>Social media campaign with #16DaysOfActivism reaching 2 million people</li>
                                <li>Free hotline counseling services (processed 5,000+ calls)</li>
                                <li>Training of police and barangay officials on VAWG response</li>
                                <li>Documentary screening and live panel discussions</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Reported Impact:</strong></h5>
                            <p>
                                Increased awareness on VAWG prevention, 500+ cases reported and processed, 
                                5 new gender focal persons appointed in communities.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Event Organizer:</strong></h5>
                            <p>
                                <strong>Atty. Jennifer Reyes</strong>, Deputy Administrator
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== REGISTRATION MODAL CTA ===== -->
<section class="section has-background-light" id="register">
    <div class="container">
        <div class="box">
            <div class="content has-text-centered">
                <h2 class="title is-3">Ready to Register?</h2>
                <p>For event registration and inquiries, please contact us directly.</p>
                
                <div class="mt-5">
                    <a href="mailto:events@gad.gov.ph" class="button is-primary is-large mr-2">
                        <span class="icon"><i class="fas fa-envelope"></i></span>
                        <span>Email Us</span>
                    </a>
                    <a href="tel:+63281156780" class="button is-info is-large">
                        <span class="icon"><i class="fas fa-phone"></i></span>
                        <span>Call Us</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
