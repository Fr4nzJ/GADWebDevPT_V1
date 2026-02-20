@extends('layouts.bulma')

@section('title', 'Events & Workshops - CatSu GAD')

@section('content')
<style>
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
    
    .timeline-item {
        display: flex;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .timeline-marker {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    .timeline-content {
        margin-left: 2rem;
        flex: 1;
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }
    
    .timeline-content:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }
    
    .timeline-content h4 {
        color: #667eea;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
</style>

<!-- ===== HERO SECTION WITH BACKGROUND IMAGE ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Events & Workshops</h1>
        <p class="subtitle">Join Us for Learning, Networking, and Advocacy</p>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: #e0aaff;">Home</a></li>
                <li class="is-active"><a href="{{ route('events') }}" style="color: #ffffff;" aria-current="page">Events</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== EVENTS STATISTICS ===== -->
<section class="section" style="background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <h2 class="section-title">Events Overview 2024</h2>
        
        <div class="columns is-multiline">
            <div class="column is-6-tablet is-3-desktop">
                <div style="background: white; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #667eea; margin-bottom: 0.5rem;">35</div>
                    <div style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem;">Total Events</div>
                    <div style="font-size: 0.85rem; color: #999;">Planned for this year</div>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div style="background: white; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #764ba2; margin-bottom: 0.5rem;">15K+</div>
                    <div style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem;">Expected Attendees</div>
                    <div style="font-size: 0.85rem; color: #999;">Participants nationwide</div>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div style="background: white; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #48c774; margin-bottom: 0.5rem;">18</div>
                    <div style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem;">Regions Covered</div>
                    <div style="font-size: 0.85rem; color: #999;">Nationwide reach</div>
                </div>
            </div>
            
            <div class="column is-6-tablet is-3-desktop">
                <div style="background: white; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #f0ad4e; margin-bottom: 0.5rem;">₱25M</div>
                    <div style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem;">Budget Allocated</div>
                    <div style="font-size: 0.85rem; color: #999;">For events & workshops</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== EVENT TYPES ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Event Types & Categories</h2>
        
        <div class="columns is-multiline">
            <div class="column is-6-tablet is-4-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-top: 4px solid #667eea;">
                    <div style="font-size: 2.5rem; color: #667eea; margin-bottom: 1rem;"><i class="fas fa-microphone"></i></div>
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 0.5rem;">Seminars & Conferences</h4>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">Large-scale events with keynote speakers and policy forums</p>
                    <p style="color: #999; font-size: 0.85rem;"><strong>8 Events</strong></p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-4-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-top: 4px solid #764ba2;">
                    <div style="font-size: 2.5rem; color: #764ba2; margin-bottom: 1rem;"><i class="fas fa-graduation-cap"></i></div>
                    <h4 class="title is-5" style="color: #764ba2; margin-bottom: 0.5rem;">Training Workshops</h4>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">Capacity building and skills development programs</p>
                    <p style="color: #999; font-size: 0.85rem;"><strong>12 Workshops</strong></p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-4-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-top: 4px solid #48c774;">
                    <div style="font-size: 2.5rem; color: #48c774; margin-bottom: 1rem;"><i class="fas fa-users"></i></div>
                    <h4 class="title is-5" style="color: #48c774; margin-bottom: 0.5rem;">Community Engagement</h4>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">Local and grassroots advocacy campaigns</p>
                    <p style="color: #999; font-size: 0.85rem;"><strong>15 Events</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== UPCOMING EVENTS TIMELINE ===== -->
<section class="section">
    <div class="container" x-data="{ activeType: 'upcoming' }">
        <h2 class="section-title">Upcoming Events</h2>

<div class="event-timeline">
            <div class="timeline-item">
                <div class="timeline-marker">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="timeline-content">
                    <h4>National Gender Summit 2024</h4>
                    <p style="font-size: 0.9rem; color: #999; margin-bottom: 0.75rem;"><i class="fas fa-calendar"></i> April 2-4, 2024 | <i class="fas fa-map-marker-alt"></i> Manila Convention Center</p>
                    <p style="color: #666; margin-bottom: 1rem;">The premier gathering for gender equality advocates with 40+ speakers, 16 workshops, and 1,500+ participants from government, NGOs, business, media, and academia.</p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span class="tag is-info" style="border-radius: 20px;">Seminar</span>
                        <span class="tag is-success" style="border-radius: 20px;">Upcoming</span>
                        <span class="tag is-warning" style="border-radius: 20px;">₱500-2,500</span>
                    </div>
                    <a href="{{ route('contact') }}" class="button is-small is-primary mt-3"><i class="fas fa-check"></i> Register</a>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-marker" style="background: linear-gradient(135deg, #764ba2, #667eea);">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="timeline-content" style="border-left-color: #764ba2;">
                    <h4>Regional Women Leadership Training</h4>
                    <p style="font-size: 0.9rem; color: #999; margin-bottom: 0.75rem;"><i class="fas fa-calendar"></i> March 15-17, 2024 | <i class="fas fa-map-marker-alt"></i> 5 Regional Venues</p>
                    <p style="color: #666; margin-bottom: 1rem;">Interactive 3-day training for women managers and supervisors across NCR, Visayas, Mindanao, Ilocos, and Bicol regions. 60 participants per venue (300 total).</p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span class="tag is-info" style="border-radius: 20px;">Workshop</span>
                        <span class="tag is-success" style="border-radius: 20px;">Upcoming</span>
                        <span class="tag is-warning" style="border-radius: 20px;">FREE</span>
                    </div>
                    <a href="{{ route('contact') }}" class="button is-small is-primary mt-3"><i class="fas fa-check"></i> Register</a>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-marker" style="background: linear-gradient(135deg, #48c774, #2eb869);">
                    <i class="fas fa-rainbow"></i>
                </div>
                <div class="timeline-content" style="border-left-color: #48c774;">
                    <h4>LGBTQ+ Youth Empowerment Forum</h4>
                    <p style="font-size: 0.9rem; color: #999; margin-bottom: 0.75rem;"><i class="fas fa-calendar"></i> May 10, 2024 | <i class="fas fa-map-marker-alt"></i> Ateneo de Manila University, QC</p>
                    <p style="color: #666; margin-bottom: 1rem;">Festival for LGBTQ+ youth aged 16-30 with workshops on health, legal rights, career development, and mental health. Live performances, health screening, and networking.</p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span class="tag is-info" style="border-radius: 20px;">Community</span>
                        <span class="tag is-success" style="border-radius: 20px;">Upcoming</span>
                        <span class="tag is-warning" style="border-radius: 20px;">FREE</span>
                    </div>
                    <a href="{{ route('contact') }}" class="button is-small is-primary mt-3"><i class="fas fa-check"></i> Register</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PAST EVENTS HIGHLIGHTS ===== -->
<section class="section" style="background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <h2 class="section-title">Past Events Impact</h2>
        
        <div class="columns is-multiline">
            <div class="column is-6-tablet is-6-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-left: 4px solid #667eea;">
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 1rem;"><i class="fas fa-history"></i> Gender Responsive Governance Summit 2023</h4>
                    <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">Landmark event with 1,200+ government leaders from 45 provinces committing to gender-responsive governance.</p>
                    <div style="background: #f9faff; border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                        <p style="color: #667eea; font-weight: 600; margin-bottom: 0.5rem;">Key Outcomes:</p>
                        <ul style="color: #666; font-size: 0.9rem;">
                            <li><i class="fas fa-check" style="color: #48c774; margin-right: 0.5rem;"></i>30+ MOUs signed between agencies</li>
                            <li><i class="fas fa-check" style="color: #48c774; margin-right: 0.5rem;"></i>Framework endorsed to Cabinet</li>
                            <li><i class="fas fa-check" style="color: #48c774; margin-right: 0.5rem;"></i>5 regional committees formed</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="column is-6-tablet is-6-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-left: 4px solid #764ba2;">
                    <h4 class="title is-5" style="color: #764ba2; margin-bottom: 1rem;"><i class="fas fa-history"></i> 16 Days Against Gender-Based Violence</h4>
                    <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">International campaign reaching 2 million people across all regions with awareness and violence prevention activities.</p>
                    <div style="background: #f9faff; border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                        <p style="color: #764ba2; font-weight: 600; margin-bottom: 0.5rem;">Campaign Reach:</p>
                        <ul style="color: #666; font-size: 0.9rem;">
                            <li><i class="fas fa-check" style="color: #48c774; margin-right: 0.5rem;"></i>29 walk/march events held</li>
                            <li><i class="fas fa-check" style="color: #48c774; margin-right: 0.5rem;"></i>5,000+ hotline calls processed</li>
                            <li><i class="fas fa-check" style="color: #48c774; margin-right: 0.5rem;"></i>500+ cases reported & processed</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="section">
    <div class="container has-text-centered">
        <h2 class="title is-3">Ready to Join Our Events?</h2>
        <p class="subtitle mb-4">Register for any upcoming event or contact us for more information.</p>
        <a href="{{ route('contact') }}" class="button is-large is-primary">
            <span class="icon"><i class="fas fa-calendar-check"></i></span>
            <span>Register Now</span>
        </a>
    </div>
</section>
@endsection
