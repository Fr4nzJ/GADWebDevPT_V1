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
        color: #333;
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

    /* ===== NIGHT MODE STYLES ===== */
    html.night-mode .timeline-marker {
        background: linear-gradient(135deg, #667eea, #764ba2) !important;
    }

    html.night-mode .timeline-content {
        background: #0f1620 !important;
        color: #e8e8e8 !important;
        border-left-color: #667eea !important;
    }

    html.night-mode .timeline-content h4 {
        color: #f5f5f5 !important;
    }

    html.night-mode .timeline-content p {
        color: #b8b8b8 !important;
    }

    html.night-mode [style*="background: white"] {
        background: #0f1620 !important;
        color: #e8e8e8 !important;
    }

    html.night-mode [style*="background: linear-gradient(135deg, #f5f7ff"] {
        background: linear-gradient(135deg, #1a1a2e 0%, #0f1620 100%) !important;
    }

    html.night-mode [style*="color: #333"] {
        color: #e8e8e8 !important;
    }

    html.night-mode [style*="color: #666"] {
        color: #b8b8b8 !important;
    }

    html.night-mode [style*="color: #2c3e50"] {
        color: #f5f5f5 !important;
    }

    html.night-mode [style*="color: #999"] {
        color: #7a7a8e !important;
    }

    html.night-mode [style*="border-left: 4px solid #667eea"] {
        border-left-color: #667eea !important;
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
        <h2 class="section-title">Events Overview</h2>
        
        <div class="columns is-multiline">
            @forelse($statistics as $statistic)
            <div class="column is-6-tablet is-3-desktop">
                <div style="background: white; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
                    @if($statistic->icon)
                    <div style="font-size: 2.5rem; color: {{ $statistic->color ?? '#667eea' }}; margin-bottom: 1rem;">
                        <i class="{{ $statistic->icon }}"></i>
                    </div>
                    @endif
                    <div style="font-size: 2.5rem; font-weight: 800; color: {{ $statistic->color ?? '#667eea' }}; margin-bottom: 0.5rem;">{{ $statistic->value }}</div>
                    <div style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem;">{{ $statistic->label }}</div>
                    @if($statistic->description)
                    <div style="font-size: 0.85rem; color: #999;">{{ $statistic->description }}</div>
                    @endif
                </div>
            </div>
            @empty
            <div class="column is-12">
                <div style="text-align: center; padding: 2rem; color: #999;">
                    <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                    <p>Event statistics coming soon. Check back later.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== EVENT TYPES ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Event Types & Categories</h2>
        
        <div class="columns is-multiline">
            <div class="column is-6-tablet is-4-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-top: 4px solid #667eea; color: #333;">
                    <div style="font-size: 2.5rem; color: #667eea; margin-bottom: 1rem;"><i class="fas fa-microphone"></i></div>
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 0.5rem;">Seminars & Conferences</h4>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">Large-scale events with keynote speakers and policy forums</p>
                    <p style="color: #999; font-size: 0.85rem;"><strong>8 Events</strong></p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-4-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-top: 4px solid #764ba2; color: #333;">
                    <div style="font-size: 2.5rem; color: #764ba2; margin-bottom: 1rem;"><i class="fas fa-graduation-cap"></i></div>
                    <h4 class="title is-5" style="color: #764ba2; margin-bottom: 0.5rem;">Training Workshops</h4>
                    <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">Capacity building and skills development programs</p>
                    <p style="color: #999; font-size: 0.85rem;"><strong>12 Workshops</strong></p>
                </div>
            </div>
            
            <div class="column is-6-tablet is-4-desktop">
                <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-top: 4px solid #48c774; color: #333;">
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
    <div class="container">
        <h2 class="section-title">Upcoming Events</h2>

        @forelse(auth()->check() ? \App\Models\Event::where('status', 'upcoming')->latest()->get() : \App\Models\Event::where('status', 'upcoming')->latest()->limit(6)->get() as $event)
        <!-- ===== SOCIAL MEDIA STYLE EVENT POST ===== -->
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1); margin-bottom: 2rem; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; color: #333;" onmouseenter="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 6px 20px rgba(0, 0, 0, 0.15)';" onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 12px rgba(0, 0, 0, 0.1)';" >
            
            <!-- ===== EVENT POST HEADER ===== -->
            <div style="padding: 1.25rem; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <h4 style="color: #2c3e50; font-weight: 700; margin: 0;">{{ $event->title }}</h4>
                        <p style="color: #999; font-size: 0.85rem; margin: 0;">
                            @if($event->created_at)
                                {{ $event->created_at->format('M d, Y') }}
                            @else
                                Date not available
                            @endif
                        </p>
                    </div>
                </div>
                <div style="text-align: right;">
                    @php
                        $statusBg = [
                            'upcoming' => '#fff3cd',
                            'ongoing' => '#d4edda',
                            'completed' => '#cce5ff',
                            'cancelled' => '#f8d7da'
                        ][$event->status] ?? '#e2e3e5';
                        $statusColor = [
                            'upcoming' => '#856404',
                            'ongoing' => '#155724',
                            'completed' => '#004085',
                            'cancelled' => '#721c24'
                        ][$event->status] ?? '#383d41';
                    @endphp
                    <span style="display: inline-block; background: {{ $statusBg }}; color: {{ $statusColor }}; padding: 0.35rem 0.75rem; border-radius: 20px; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>
            </div>

            <!-- ===== EVENT IMAGES CAROUSEL ===== -->
            @if($event->images && count($event->images) > 0)
            <div style="position: relative; height: 350px; background: #f5f5f5;">
                <img src="{{ asset('storage/' . $event->images[0]) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $event->title }}">
                
                @if(count($event->images) > 1)
                <div style="position: absolute; bottom: 1rem; left: 50%; transform: translateX(-50%); display: flex; gap: 0.5rem;">
                    @foreach($event->images as $index => $image)
                    <div style="width: 8px; height: 8px; background: {{ $index === 0 ? '#667eea' : 'rgba(255,255,255,0.5)' }}; border-radius: 50%; cursor: pointer;" onclick="changeEventImage(this.parentElement.parentElement, {{ $index }})"></div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <!-- ===== EVENT CONTENT ===== -->
            <div style="padding: 1.5rem;">
                <!-- ===== DATE & LOCATION ===== -->
                <div style="display: flex; gap: 2rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <p style="color: #999; font-size: 0.85rem; margin: 0 0 0.25rem 0;">
                            <i class="fas fa-calendar-check" style="color: #667eea; margin-right: 0.5rem;"></i>DATE & TIME
                        </p>
                        @if($event->event_date)
                        <p style="color: #2c3e50; font-weight: 600; font-size: 1.1rem; margin: 0;">
                            {{ $event->event_date->format('F d, Y') }}
                        </p>
                        <p style="color: #666; font-size: 0.9rem; margin: 0.25rem 0 0 0;">
                            {{ $event->event_date->format('g:i A') }}
                        </p>
                        @else
                        <p style="color: #999; font-weight: 600; font-size: 1.1rem; margin: 0;">Date not specified</p>
                        @endif
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <p style="color: #999; font-size: 0.85rem; margin: 0 0 0.25rem 0;">
                            <i class="fas fa-map-marker-alt" style="color: #667eea; margin-right: 0.5rem;"></i>LOCATION
                        </p>
                        <p style="color: #2c3e50; font-weight: 600; font-size: 1.1rem; margin: 0;">
                            {{ $event->location }}
                        </p>
                    </div>
                </div>

                <!-- ===== DESCRIPTION ===== -->
                <div style="margin-bottom: 1.5rem;">
                    <p style="color: #666; line-height: 1.6; margin: 0;">
                        {{ Str::limit($event->description, 150, '...') }}
                    </p>
                </div>

                <!-- ===== ACTION BUTTONS ===== -->
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ route('events.show', $event) }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600; flex: 1;">
                        <span class="icon"><i class="fas fa-eye"></i></span>
                        <span>View Details</span>
                    </a>
                    <a href="{{ route('contact') }}" class="button is-outlined" style="border: 2px solid #667eea; color: #667eea; font-weight: 600; flex: 1;">
                        <span class="icon"><i class="fas fa-user-plus"></i></span>
                        <span>Register</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="background: white; border-radius: 12px; padding: 3rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
            <i class="fas fa-calendar-times" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem;"></i>
            <h4 style="color: #999; font-size: 1.2rem; margin-bottom: 0.5rem;">No Upcoming Events</h4>
            <p style="color: #bbb;">Check back soon for new events!</p>
        </div>
        @endforelse
    </div>
</section>

<!-- ===== COMPLETED EVENTS / PAST EVENTS ===== -->
<section class="section" style="background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <h2 class="section-title">Past Events Highlights</h2>
        
        @forelse(\App\Models\Event::where('status', 'completed')->latest()->limit(4)->get() as $event)
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); border-left: 4px solid #667eea; margin-bottom: 1.5rem; color: #333;">
            <div style="display: flex; gap: 1.5rem; align-items: flex-start;">
                @if($event->images && count($event->images) > 0)
                <div style="flex-shrink: 0; width: 150px; height: 150px; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $event->images[0]) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $event->title }}">
                </div>
                @endif
                <div style="flex: 1;">
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 0.75rem; margin-top: 0;">
                        <i class="fas fa-history"></i> {{ $event->title }}
                    </h4>
                    <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                        {{ Str::limit($event->description, 200, '...') }}
                    </p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        @if($event->event_date)
                        <span style="color: #999; font-size: 0.9rem;">
                            <i class="fas fa-calendar" style="color: #667eea; margin-right: 0.5rem;"></i>
                            {{ $event->event_date->format('F d, Y') }}
                        </span>
                        @endif
                        <span style="color: #999; font-size: 0.9rem;">
                            <i class="fas fa-map-marker-alt" style="color: #667eea; margin-right: 0.5rem;"></i>
                            {{ $event->location }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div style="background: white; border-radius: 12px; padding: 2rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
            <p style="color: #999;">No past events to display yet.</p>
        </div>
        @endforelse
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

<script>
function changeEventImage(container, index) {
    // This function would scroll through images in the carousel
    // For now, simple implementation - can be enhanced with actual carousel
    const images = container.querySelectorAll('img');
    if (images.length > 0 && index < images.length) {
        const img = images[0];
        const dots = container.querySelectorAll('[style*="border-radius: 50%"]');
        dots.forEach((dot, i) => {
            dot.style.background = i === index ? '#667eea' : 'rgba(255,255,255,0.5)';
        });
    }
}
</script>
