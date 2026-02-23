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
        font-size: clamp(1.5rem, 5vw, 2.5rem);
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

<!-- ===== HERO SECTION WITH BACKGROUND IMAGE ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Our Programs & Projects</h1>
        <p class="subtitle">Transforming Lives Through Strategic Gender Development Initiatives</p>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: #e0aaff;">Home</a></li>
                <li class="is-active"><a href="{{ route('programs') }}" style="color: #ffffff;" aria-current="page">Programs</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== PROGRAM CATEGORIES OVERVIEW ===== -->
<section class="section section-purple-gradient">
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

<!-- ===== PROGRAMS LIST ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Active Programs</h2>

        @if($programs->count() > 0)
        <div class="columns is-multiline">
            @foreach($programs as $program)
            <div class="column is-12">
                <div class="card mb-5" style="border-left: 4px solid {{ $program->status_color }};">
                    <div class="card-header" style="background: {{ $program->status_bg }};">
                        <p class="card-header-title">
                            <span class="icon"><i class="fas fa-project-diagram"></i></span>
                            <span>{{ $program->title }}</span>
                        </p>
                        <span class="status-badge" style="background: {{ $program->status_color }}; color: white; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">
                            {{ $program->status }}
                        </span>
                    </div>
                    <div class="card-content">
                        <div class="columns">
                            @if($program->image)
                            <div class="column is-5-tablet is-4-desktop">
                                <figure class="image" style="margin-bottom: 1.5rem;">
                                    <img src="{{ $program->image_url }}" alt="{{ $program->title }}" style="border-radius: 8px; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1); width: 100%; height: auto; object-fit: cover;">
                                </figure>
                            </div>
                            <div class="column is-7-tablet is-8-desktop">
                            @else
                            <div class="column is-12">
                            @endif
                                <h4 class="title is-5">Program Overview</h4>
                                <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">
                                    {{ $program->description }}
                                </p>

                                @if($program->objectives && count($program->objectives) > 0)
                                <h5 class="title is-6" style="color: #667eea; margin-top: 1.5rem; margin-bottom: 1rem;"><strong>Objectives:</strong></h5>
                                <ul style="margin-left: 1.5rem; color: #666;">
                                    @foreach($program->objectives as $objective)
                                    <li style="margin-bottom: 0.5rem;">{{ $objective }}</li>
                                    @endforeach
                                </ul>
                                @endif

                                @if($program->target_group)
                                <h5 class="title is-6" style="color: #667eea; margin-top: 1.5rem; margin-bottom: 1rem;"><strong>Target Beneficiaries:</strong></h5>
                                <p style="color: #666; line-height: 1.6;">{{ $program->target_group }}</p>
                                @endif

                                <div class="columns is-multiline" style="margin-top: 1.5rem;">
                                    <div class="column is-6-tablet is-3-desktop">
                                        <div style="background: #f5f7ff; padding: 1rem; border-radius: 8px; text-align: center;">
                                            <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem;">Program Period</p>
                                            <p style="color: #667eea; font-weight: 600;">
                                                {{ $program->start_date->format('M d, Y') }}
                                                @if($program->end_date)
                                                    to {{ $program->end_date->format('M d, Y') }}
                                                @else
                                                    (Ongoing)
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="column is-6-tablet is-3-desktop">
                                        <div style="background: #e8f8f0; padding: 1rem; border-radius: 8px; text-align: center;">
                                            <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem;">Beneficiaries</p>
                                            <p style="color: #48c774; font-weight: 600;">{{ number_format($program->beneficiaries) }}</p>
                                        </div>
                                    </div>

                                    <div class="column is-6-tablet is-3-desktop">
                                        <div style="background: #ffe8e8; padding: 1rem; border-radius: 8px; text-align: center;">
                                            <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem;">Budget</p>
                                            <p style="color: #e74c3c; font-weight: 600;">₱{{ number_format($program->budget) }}</p>
                                        </div>
                                    </div>

                                    <div class="column is-6-tablet is-3-desktop">
                                        <div style="background: #e8f1ff; padding: 1rem; border-radius: 8px; text-align: center;">
                                            <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.5rem;">Category</p>
                                            <p style="color: #667eea; font-weight: 600;">{{ $program->category_display }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($program->location)
                                <h5 class="title is-6" style="color: #667eea; margin-top: 1.5rem; margin-bottom: 0.5rem;"><strong><i class="fas fa-map-marker-alt"></i> Location</strong></h5>
                                <p style="color: #666;">{{ $program->location }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="background: #f5f7ff; padding: 3rem; border-radius: 12px; text-align: center;">
            <p style="color: #667eea; font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem;">
                <i class="fas fa-inbox"></i> No Programs Available
            </p>
            <p style="color: #666;">Currently, there are no programs to display. Please check back soon for updates on our initiatives.</p>
        </div>
        @endif
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
