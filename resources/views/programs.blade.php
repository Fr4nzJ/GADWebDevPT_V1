@extends('layouts.bulma')

@section('title', 'GAD Programs & Projects - Empowering Communities')

@section('content')
<style>
    .program-category-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .program-category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }
    
    .program-category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .program-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: inline-block;
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
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
</style>

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

<!-- ===== PROGRAM CATEGORIES OVERVIEW ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Program Categories</h2>
        
        <div class="columns is-multiline">
            <div class="column is-4-tablet is-6-desktop">
                <div class="program-category-card">
                    <div class="program-icon" style="background: linear-gradient(135deg, #667eea, #3273dc);">
                        <i class="fas fa-female"></i>
                    </div>
                    <h3 class="title is-5" style="color: #667eea; margin-bottom: 0.5rem;">Women Empowerment</h3>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Economic independence, entrepreneurship & financial literacy for women</p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 1rem;"><strong>3 Active Programs</strong></p>
                </div>
            </div>
            
            <div class="column is-4-tablet is-6-desktop">
                <div class="program-category-card">
                    <div class="program-icon" style="background: linear-gradient(135deg, #764ba2, #667eea);">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="title is-5" style="color: #764ba2; margin-bottom: 0.5rem;">Education & Skills</h3>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Gender-sensitive education, training & professional development</p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 1rem;"><strong>2 Active Programs</strong></p>
                </div>
            </div>
            
            <div class="column is-4-tablet is-6-desktop">
                <div class="program-category-card">
                    <div class="program-icon" style="background: linear-gradient(135deg, #48c774, #2eb869);">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="title is-5" style="color: #48c774; margin-bottom: 0.5rem;">Safety & Protection</h3>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Violence prevention, survivor support & advocacy programs</p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 1rem;"><strong>1 Active Program</strong></p>
                </div>
            </div>
            
            <div class="column is-4-tablet is-6-desktop">
                <div class="program-category-card">
                    <div class="program-icon" style="background: linear-gradient(135deg, #f0ad4e, #ffb81c);">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="title is-5" style="color: #f0ad4e; margin-bottom: 0.5rem;">Leadership Dev.</h3>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Women leaders pipeline & political participation programs</p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 1rem;"><strong>1 Active Program</strong></p>
                </div>
            </div>
            
            <div class="column is-4-tablet is-6-desktop">
                <div class="program-category-card">
                    <div class="program-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                        <i class="fas fa-rainbow"></i>
                    </div>
                    <h3 class="title is-5" style="color: #e74c3c; margin-bottom: 0.5rem;">LGBTQ+ Rights</h3>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Inclusion, rights protection & anti-discrimination initiatives</p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 1rem;"><strong>1 Active Program</strong></p>
                </div>
            </div>
            
            <div class="column is-4-tablet is-6-desktop">
                <div class="program-category-card">
                    <div class="program-icon" style="background: linear-gradient(135deg, #3273dc, #0162f0);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="title is-5" style="color: #3273dc; margin-bottom: 0.5rem;">Mainstreaming</h3>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">Gender mainstreaming in policy, budgets & institutional operations</p>
                    <p style="color: #999; font-size: 0.85rem; margin-top: 1rem;"><strong>1 Active Program</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROGRAM STATISTICS ===== -->
<section class="section" style="background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-6-tablet is-3-desktop">
                <div class="box has-text-centered" style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <h3 class="title is-2" style="color: #667eea; margin-bottom: 0.5rem;">8</h3>
                    <p style="color: #2c3e50; font-weight: 600;">Active Programs</p>
                    <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">Ongoing initiatives</p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div class="box has-text-centered" style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <h3 class="title is-2" style="color: #764ba2; margin-bottom: 0.5rem;">250K+</h3>
                    <p style="color: #2c3e50; font-weight: 600;">Beneficiaries</p>
                    <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">This year</p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div class="box has-text-centered" style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <h3 class="title is-2" style="color: #48c774; margin-bottom: 0.5rem;">₱600M+</h3>
                    <p style="color: #2c3e50; font-weight: 600;">Total Budget</p>
                    <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">Allocated funds</p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div class="box has-text-centered" style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <h3 class="title is-2" style="color: #f0ad4e; margin-bottom: 0.5rem;">17</h3>
                    <p style="color: #2c3e50; font-weight: 600;">Regions</p>
                    <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">Nationwide coverage</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROGRAM FILTER (Alpine.js) ===== -->
<section class="section">
    <div class="container" x-data="{ activeFilter: 'all' }">
        <h2 class="section-title">Active Programs</h2>

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
