@extends('layouts.bulma')

@section('title', 'GAD Programs & Projects - Empowering Communities')

@section('content')
<!-- ===== HERO SECTION ===== -->
<section class="hero hero-gradient is-large">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title is-1" style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                Our Programs & Projects
            </h1>
            <p class="subtitle is-4" style="color: #f0f0f0;">
                Transforming Lives Through Strategic Gender Development Initiatives
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
                <li class="is-active"><a href="{{ route('programs') }}" aria-current="page">Programs</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== PROGRAM FILTER (Alpine.js) ===== -->
<section class="section">
    <div class="container" x-data="{ activeFilter: 'all' }">
        <div class="content mb-4">
            <h2 class="section-title">Filter Programs</h2>
        </div>

        <div class="buttons mb-5" style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
            <button class="button" 
                    @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'is-primary' : 'is-light'">
                All Programs
            </button>
            <button class="button" 
                    @click="activeFilter = 'ongoing'" 
                    :class="activeFilter === 'ongoing' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-play-circle"></i></span>
                <span>Ongoing</span>
            </button>
            <button class="button" 
                    @click="activeFilter = 'completed'" 
                    :class="activeFilter === 'completed' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-check-circle"></i></span>
                <span>Completed</span>
            </button>
            <button class="button" 
                    @click="activeFilter = 'upcoming'" 
                    :class="activeFilter === 'upcoming' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-calendar"></i></span>
                <span>Upcoming</span>
            </button>
        </div>

        <!-- ===== PROGRAM 1: Women Empowerment & Economic Independence ===== -->
        <div class="program-card" x-show="activeFilter === 'all' || activeFilter === 'ongoing'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                        <span>Women Empowerment & Economic Independence Program</span>
                    </p>
                    <span class="status-badge status-ongoing">ONGOING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Women+Entrepreneurship" alt="Women in Business">
                            </div>
                        </div>
                        <div class="column is-8">
                            <h4 class="title is-5">Program Overview</h4>
                            <p>
                                This comprehensive program equips women with skills and resources to establish and sustain 
                                their own businesses, creating pathways to economic independence and family stability.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Objectives:</strong></h5>
                            <ul>
                                <li>Build financial literacy and business management skills for 5,000 women annually</li>
                                <li>Provide microfinance access and business startup grants</li>
                                <li>Create women's entrepreneurship networks and mentorship programs</li>
                                <li>Facilitate market linkages for women entrepreneurs</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Target Beneficiaries:</strong></h5>
                            <p>
                                Low-income women aged 18-65, particularly in rural areas and from marginalized communities. 
                                Special focus on solo parents and women with disabilities.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Program Period:</strong></h5>
                            <p>January 2022 - December 2025</p>

                            <h5 class="title is-6 mt-4"><strong>Budget:</strong></h5>
                            <p>PHP 150 Million (National Budget)</p>

                            <a href="#" class="button is-dark is-small mt-4">
                                <span>Learn More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PROGRAM 2: Gender-Sensitive School Program ===== -->
        <div class="program-card" x-show="activeFilter === 'all' || activeFilter === 'ongoing'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-graduation-cap"></i></span>
                        <span>Gender-Sensitive School Program (GSSP)</span>
                    </p>
                    <span class="status-badge status-ongoing">ONGOING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Education+Gender" alt="School Program">
                            </div>
                        </div>
                        <div class="column is-8">
                            <h4 class="title is-5">Program Overview</h4>
                            <p>
                                The GSSP works with schools nationwide to promote gender equality, eliminate stereotypes, 
                                and provide safe, inclusive learning environments where all students thrive regardless of gender.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Objectives:</strong></h5>
                            <ul>
                                <li>Train 1,000 teachers in gender-sensitive pedagogy annually</li>
                                <li>Develop and distribute gender-responsive learning materials</li>
                                <li>Establish school-based anti-bullying and sexual harassment protocols</li>
                                <li>Support LGBTQ+ student inclusion and support groups</li>
                                <li>Establish safe, gender-friendly facilities (toilets, changing rooms)</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Target Beneficiaries:</strong></h5>
                            <p>
                                500+ schools nationwide, reaching 150,000+ students and 5,000+ educators. 
                                Prioritizing rural schools and underserved communities.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Program Period:</strong></h5>
                            <p>June 2021 - Ongoing</p>

                            <h5 class="title is-6 mt-4"><strong>Budget:</strong></h5>
                            <p>PHP 120 Million (Phase 1: 2021-2023, Phase 2: 2024-2026)</p>

                            <a href="#" class="button is-dark is-small mt-4">
                                <span>Learn More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PROGRAM 3: Violence Against Women Prevention ===== -->
        <div class="program-card" x-show="activeFilter === 'all' || activeFilter === 'ongoing'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-hand-paper"></i></span>
                        <span>Violence Against Women & Children Prevention Program</span>
                    </p>
                    <span class="status-badge status-ongoing">ONGOING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Women+Safety" alt="Safety Program">
                            </div>
                        </div>
                        <div class="column is-8">
                            <h4 class="title is-5">Program Overview</h4>
                            <p>
                                Comprehensive program aimed at preventing violence against women and children through awareness, 
                                survivor support, and strengthening institutional response mechanisms.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Objectives:</strong></h5>
                            <ul>
                                <li>Establish 50 Women & Children Resource Centers providing counseling and legal aid</li>
                                <li>Train 2,000 police officers and social workers in trauma-informed response</li>
                                <li>Implement community awareness campaigns on violence prevention</li>
                                <li>Provide safe shelter and livelihood assistance to survivors</li>
                                <li>Strengthen enforcement of VAWC-related laws (RA 9262, RA 11861)</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Target Beneficiaries:</strong></h5>
                            <p>
                                Survivors of intimate partner violence, child abuse, and sexual harassment; 
                                50,000+ beneficiaries annually.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Program Period:</strong></h5>
                            <p>January 2020 - December 2025</p>

                            <h5 class="title is-6 mt-4"><strong>Budget:</strong></h5>
                            <p>PHP 200 Million</p>

                            <a href="#" class="button is-dark is-small mt-4">
                                <span>Learn More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PROGRAM 4: Women in Leadership Development ===== -->
        <div class="program-card" x-show="activeFilter === 'all' || activeFilter === 'ongoing'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-crown"></i></span>
                        <span>Women in Leadership Development Program (WILD)</span>
                    </p>
                    <span class="status-badge status-ongoing">ONGOING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Women+Leadership" alt="Leadership Program">
                            </div>
                        </div>
                        <div class="column is-8">
                            <h4 class="title is-5">Program Overview</h4>
                            <p>
                                The WILD program develops women leaders in government, private sector, and civil society, 
                                creating a pipeline of qualified women candidates for executive positions.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Objectives:</strong></h5>
                            <ul>
                                <li>Train 3,000 women leaders annually in strategic management and governance</li>
                                <li>Mentor 500 young women leaders for legislative and executive positions</li>
                                <li>Facilitate networking and coalition-building among women leaders</li>
                                <li>Monitor and strengthen women's political participation</li>
                                <li>Advocate for gender quotas in corporate boards and government</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Target Beneficiaries:</strong></h5>
                            <p>
                                Aspiring and emerging women leaders from government, business, NGOs, and academia. 
                                Focus on young women aged 25-45 and women from marginalized sectors.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Program Period:</strong></h5>
                            <p>March 2022 - December 2026</p>

                            <h5 class="title is-6 mt-4"><strong>Budget:</strong></h5>
                            <p>PHP 80 Million</p>

                            <a href="#" class="button is-dark is-small mt-4">
                                <span>Learn More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PROGRAM 5: LGBTQ+ Inclusion & Rights Protection ===== -->
        <div class="program-card" x-show="activeFilter === 'all' || activeFilter === 'ongoing'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-rainbow"></i></span>
                        <span>LGBTQ+ Inclusion & Rights Protection Program</span>
                    </p>
                    <span class="status-badge status-upcoming">UPCOMING</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=LGBTQ+Inclusion" alt="LGBTQ+ Program">
                            </div>
                        </div>
                        <div class="column is-8">
                            <h4 class="title is-5">Program Overview</h4>
                            <p>
                                Program focused on advancing LGBTQ+ rights, combating discrimination, and ensuring equal 
                                protection under the law for sexual minorities and gender non-conforming individuals.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Objectives:</strong></h5>
                            <ul>
                                <li>Develop and advocate for comprehensive SOGIE Equality Bill</li>
                                <li>Establish LGBTQ+ health and mental health support services</li>
                                <li>Create institutional anti-discrimination policies in 100+ government agencies</li>
                                <li>Provide legal aid for LGBTQ+ individuals facing discrimination</li>
                                <li>Support transgender persons' legal name and gender marker change process</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Target Beneficiaries:</strong></h5>
                            <p>
                                LGBTQ+ individuals (estimated 2-3 million in the Philippines), 
                                priority on trans and gender non-conforming persons.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Program Period:</strong></h5>
                            <p>July 2024 - December 2028 (New Program)</p>

                            <h5 class="title is-6 mt-4"><strong>Budget:</strong></h5>
                            <p>PHP 50 Million (Initial Phase)</p>

                            <a href="#" class="button is-dark is-small mt-4">
                                <span>Learn More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PROGRAM 6: Completed Programs ===== -->
        <div class="program-card" x-show="activeFilter === 'all' || activeFilter === 'completed'">
            <div class="card mb-5">
                <div class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="fas fa-check"></i></span>
                        <span>Rural Women Access to Credit Project</span>
                    </p>
                    <span class="status-badge status-completed">COMPLETED</span>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column is-4">
                            <div class="image-container">
                                <img src="https://via.placeholder.com/400x300?text=Rural+Development" alt="Rural Project">
                            </div>
                        </div>
                        <div class="column is-8">
                            <h4 class="title is-5">Program Overview</h4>
                            <p>
                                Successfully empowered rural women by facilitating access to microfinance through 
                                community-based savings groups and partnerships with rural banks.
                            </p>

                            <h5 class="title is-6 mt-4"><strong>Key Results:</strong></h5>
                            <ul>
                                <li>Established 250 savings and loan associations in 20 provinces</li>
                                <li>Facilitated PHP 45 Million in loans to 8,000 women</li>
                                <li>80% loan repayment rate (exceeding national average)</li>
                                <li>Average income increase of 120% among beneficiaries</li>
                            </ul>

                            <h5 class="title is-6 mt-4"><strong>Program Period:</strong></h5>
                            <p>January 2019 - December 2023</p>

                            <a href="#" class="button is-dark is-small mt-4">
                                <span>View Final Report</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROGRAM STATISTICS ===== -->
<section class="section has-background-light">
    <div class="container">
        <h2 class="section-title">Program Impact at a Glance</h2>

        <div class="columns">
            <div class="column is-3">
                <div class="box has-text-centered has-background-success-light">
                    <h3 class="title is-2" style="color: #48c774;">6</h3>
                    <p style="color: #2c3e50;"><strong>Active Programs</strong></p>
                </div>
            </div>

            <div class="column is-3">
                <div class="box has-text-centered has-background-info-light">
                    <h3 class="title is-2" style="color: #3273dc;">250K+</h3>
                    <p style="color: #2c3e50;"><strong>Total Beneficiaries</strong></p>
                </div>
            </div>

            <div class="column is-3">
                <div class="box has-text-centered has-background-warning-light">
                    <h3 class="title is-2" style="color: #ffdd57;">PHP 600M</h3>
                    <p style="color: #2c3e50;"><strong>Total Investment</strong></p>
                </div>
            </div>

            <div class="column is-3">
                <div class="box has-text-centered has-background-link-light">
                    <h3 class="title is-2" style="color: #667eea;">24/7</h3>
                    <p style="color: #2c3e50;"><strong>Support Hotline</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="section">
    <div class="container has-text-centered">
        <h2 class="title is-3">Ready to Benefit from Our Programs?</h2>
        <p class="subtitle mb-4">Contact us for enrollment information or program details.</p>
        <a href="{{ route('contact') }}" class="button is-large is-primary">
            <span class="icon"><i class="fas fa-phone"></i></span>
            <span>Contact Us</span>
        </a>
    </div>
</section>
@endsection
