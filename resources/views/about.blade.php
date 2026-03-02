@extends('layouts.bulma')

@section('title', 'About CatSu GAD - Our Mandate, Vision & Mission')

@section('content')

<!-- ===== HERO SECTION WITH BACKGROUND IMAGE ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 style="color: white;">About CatSu GAD</h1>
        <p class="subtitle">Our Vision, Mission, Objectives, Mandate, and Goal</p>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: #e0aaff;">Home</a></li>
                <li class="is-active"><a href="{{ route('about') }}" style="color: #ffffff;" aria-current="page">About</a></li>
            </ul>
        </nav>
    </div>
</section>

<style>
    /* ===== INFOGRAPHIC HOUSE STYLES ===== */
    .mission-vision-hero {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin: 3rem 0;
    }
    
    .vision-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .mission-card {
        background: white;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        border-top: 5px solid #667eea;
        color: #333;
    }
    
    .card-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .card-description {
        line-height: 1.8;
        font-size: 1rem;
    }
    
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }
    
    .value-box {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border-top: 4px solid #667eea;
        transition: all 0.3s ease;
        color: #333;
    }
    
    .value-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    
    .value-icon {
        font-size: 2.5rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }
    
    .achievement-stat {
        background: white;
        padding: 1.5rem;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        color: #333;
    }
    
    .achievement-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #667eea;
        margin: 1rem 0;
    }
    
    .achievement-label {
        color: #666;
        font-size: 0.95rem;
        font-weight: 500;
    }
    
    .mandate-visual {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin: 2rem 0;
    }
    
    .mandate-card {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid #667eea;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        color: #333;
    }
    
    @media (max-width: 768px) {
        .mission-vision-hero {
            grid-template-columns: 1fr;
        }
        
        .mandate-visual {
            grid-template-columns: 1fr;
        }
    }
    .hero-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }
    
    .hero-gradient::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .hero-gradient::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    
    .hero-body {
        position: relative;
        z-index: 1;
    }
    
    .section-title {
        font-size: 2.2rem;
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

<!-- ===== VISION & MISSION - INFOGRAPHIC DESIGN ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Our Vision & Mission</h2>

        <div class="mission-vision-hero">
            <div class="vision-card">
                <div class="card-icon"><i class="fas fa-eye"></i></div>
                <h3 class="card-title" style="color: white;">Our Vision</h3>
                <p class="card-description">
                   A gender sensitive and responsive university in a safe and peaceful environment free from any form of violence
                </p>
            </div>
            <div class="mission-card">
                <div class="card-icon" style="background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"><i class="fas fa-bullseye"></i></div>
                <h3 class="card-title" style="color: #2c3e50;">Our Mission</h3>
                <p class="card-description" style="color: #666;">
                    Faster gender and development advocacy, promote peaceful and safe environment and strengthen partnership network toward achieving equality for all
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== CORE VALUES - VISUAL GRID ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Our Objectives</h2>

        <div class="values-grid">
            <div class="value-box">
                <div class="value-icon"><i class="fas fa-hands-helping"></i></div>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">Integrate GAD concepts in the circular agenda</p>
            </div>
            <div class="value-box">
                <div class="value-icon"><i class="fas fa-microscope"></i></div>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">Conduct Gad-related research and gender-responsive extensionservices</p>
            </div>
            <div class="value-box">
                <div class="value-icon"><i class="fas fa-users"></i></div>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">Institutionalize GAD enabling mechanisms</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== MANDATE - VISUAL FORMAT ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Our Mandate</h2>

        <div style="background: linear-gradient(135deg,  #ff00b398, #06cff3a4); border-left: 4px solid #667eea; border-radius: 8px; padding: 1.5rem; margin-bottom: 2rem;">
            <p style="color: #ffffff; margin: 0;">The Catanduanes State University, in adherence to statutes, undertakes advocacy on gender equality and equity by implementing enabling policies and mechanisms including non-sexist programs, projects and other GAD-related activities.</p>
        </div>
    </div>
</section>

<!-- ===== GOALISUAL FORMAT ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Our Goal</h2>

        <div style="background: linear-gradient(135deg, #ff00b398, #06cff3a4); border-left: 4px solid #667eea; border-radius: 8px; padding: 1.5rem; margin-bottom: 2rem;">
            <p style="color: #ffffff; margin: 0;">Mainstream gender and development in the four-fold functions of the institution.
        </div>
    </div>
</section>

<!-- ===== KEY ACHIEVEMENTS - METRICS INFOGRAPHIC ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Key Achievements (2020-2024)</h2>

        <div class="columns is-multiline">
            @forelse($achievements as $achievement)
                <div class="column is-3-desktop is-6-tablet">
                    <div class="achievement-stat">
                        <div class="achievement-number">{{ $achievement->number }}</div>
                        <p class="achievement-label">{{ $achievement->label }}</p>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                    <p style="color: #999;">Key achievements data coming soon. Check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== ORGANIZATION STRUCTURE - VISUAL ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Organizational Structure</h2>

        <div style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 2rem; border-radius: 10px; text-align: center; margin-bottom: 2rem;">
            <h4 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Leadership & Coordination Network</h4>
            <p style="margin: 0; font-size: 0.95rem;">Connected governance across national office, 250+ agency focal persons, and local government units</p>
        </div>

        <div class="columns">
            <div class="column is-4-desktop is-6-tablet">
                <div style="background: white; border: 2px solid #667eea; border-radius: 10px; padding: 1.5rem; text-align: center; color: #333;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;"><i class="fas fa-sitemap" style="color: #667eea;"></i></div>
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem;">National Coordinating Committee</h5>
                    <p style="color: #666; font-size: 0.9rem; margin: 0;">Inter-agency committee with representatives from 18 departments</p>
                </div>
            </div>
            <div class="column is-4-desktop is-6-tablet">
                <div style="background: white; border: 2px solid #667eea; border-radius: 10px; padding: 1.5rem; text-align: center; color: #333;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;"><i class="fas fa-building" style="color: #667eea;"></i></div>
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem;">Agency Focal Persons</h5>
                    <p style="color: #666; font-size: 0.9rem; margin: 0;">250+ designated officials in government agencies nationwide</p>
                </div>
            </div>
            <div class="column is-4-desktop is-6-tablet">
                <div style="background: white; border: 2px solid #667eea; border-radius: 10px; padding: 1.5rem; text-align: center; color: #333;">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;"><i class="fas fa-city" style="color: #667eea;"></i></div>
                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem;">Local Focal Persons</h5>
                    <p style="color: #666; font-size: 0.9rem; margin: 0;">LGU representatives spanning provincial, municipal, and barangay levels</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== INSTITUTIONAL PARTNERSHIP ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <h2 class="section-title">Our Institutional Partnership</h2>

        <div style="background: linear-gradient(135deg, #ff02b3c9, #2ce6ffb9); border-radius: 12px; padding: 3rem 2rem; margin-bottom: 2rem;">
            <div class="columns is-vcentered is-centered is-multiline">
                <!-- CatSu GAD Logo -->
                <div class="column is-full-mobile is-6-tablet is-4-desktop has-text-centered">
                    <div style="margin-bottom: 1.5rem;">
                        <img src="{{ asset('images/GAD Logo.png') }}" alt="CatSu GAD Logo" style="height: 120px; width: auto;">
                    </div>
                    <h4 style="color: #a5b4c4; font-weight: 600; margin-bottom: 0.5rem;">CatSu GAD</h4>
                    <p style="color: #fffefe; font-size: 0.95rem;">Gender and Development Services</p>
                </div>

                <!-- Connection Icon -->
                <div class="column is-full-mobile is-6-tablet is-4-desktop has-text-centered" style="padding: 0 1rem;">
                    <div style="font-size: 2.5rem; color: #00ffbf;"><i class="fas fa-link"></i></div>
                    <p style="color: #00ffea; font-weight: 600; margin-top: 1rem; font-size: 0.9rem;">Connected<br>Through</p>
                </div>

                <!-- Catanduanes State University Logo -->
                <div class="column is-full-mobile is-6-tablet is-4-desktop has-text-centered">
                    <div style="margin-bottom: 1.5rem;">
                        <img src="{{ asset('images/catsu hr.png') }}" alt="Catanduanes State University Logo" style="height: 120px; width: auto;">
                    </div>
                    <h4 style="color: #acc3da; font-weight: 600; margin-bottom: 0.5rem;">Catanduanes State University</h4>
                    <p style="color: #ffffff; font-size: 0.95rem;">Since 1961</p>
                </div>
            </div>

            <div style="border-top: 1px solid rgba(255, 255, 255, 0.2); margin-top: 2rem; padding-top: 2rem; text-align: center;">
                <p style="color: #eee9e9; margin: 0; line-height: 1.8;">
                    <strong>CatSu GAD</strong> operates as the Gender and Development Services of <strong>Catanduanes State University</strong>, 
                    advancing gender equality and development advocacy within the university and across the province. Our partnership 
                    combines institutional strength with community engagement to promote gender-sensitive policies, programs, and practices 
                    that benefit all stakeholders.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== CALL TO ACTION ===== -->
<section class="section section-purple-gradient" style="padding: 5rem 1.5rem;">
    <div class="container has-text-centered">
        <h2 style="color: white; font-size: 2rem; margin-bottom: 1rem;">Join Our Mission for Gender Equality</h2>
        <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: 2rem; font-size: 1.05rem;">
            Together, we can build a more inclusive and equal Philippines
        </p>
        <a href="{{ route('contact') }}" class="button is-white is-large">
            <span class="icon"><i class="fas fa-envelope"></i></span>
            <span>Get In Touch</span>
        </a>
    </div>
</section>

@endsection
