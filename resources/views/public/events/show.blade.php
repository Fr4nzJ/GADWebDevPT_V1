@extends('layouts.bulma')

@section('title', $event->title . ' - Events - CatSu GAD')

@section('content')
<!-- ===== HERO SECTION ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>{{ $event->title }}</h1>
        <p class="subtitle">
            @php
                $statusText = [
                    'upcoming' => 'Upcoming Event',
                    'ongoing' => 'Ongoing Event',
                    'completed' => 'Past Event',
                    'cancelled' => 'Cancelled Event'
                ][$event->status] ?? 'Event';
            @endphp
            {{ $statusText }}
        </p>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: #e0aaff;">Home</a></li>
                <li><a href="{{ route('events') }}" style="color: #e0aaff;">Events</a></li>
                <li class="is-active"><a href="{{ route('events.show', $event) }}" style="color: #ffffff;" aria-current="page">{{ $event->title }}</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== EVENT DETAILS ===== -->
<section class="section">
    <div class="container">
        <div class="columns is-multiline">
            <!-- ===== MAIN CONTENT ===== -->
            <div class="column is-8-tablet is-8-desktop">
                <!-- Event Images Gallery -->
                @if($event->images && count($event->images) > 0)
                <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem; color: #333;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem;">
                        @foreach($event->images as $image)
                        <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);">
                            <img src="{{ asset('storage/' . $image) }}" style="width: 100%; height: 300px; object-fit: cover; cursor: pointer;" alt="{{ $event->title }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Event Description -->
                <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem; color: #333;">
                    <h2 class="title is-4" style="color: #2c3e50; border-bottom: 3px solid #667eea; padding-bottom: 1rem; margin-bottom: 1.5rem;">Event Description</h2>
                    <div style="color: #666; line-height: 1.8; font-size: 1rem;">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>

                <!-- Event Details -->
                <div style="background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
                    <h3 class="title is-5" style="color: #667eea; margin-bottom: 1.5rem;">
                        <i class="fas fa-info-circle"></i> Event Information
                    </h3>
                    
                    <div class="columns is-multiline">
                        <div class="column is-6-tablet is-6-desktop">
                            <div style="background: white; border-radius: 8px; padding: 1.5rem; color: #333;">
                                <p style="color: #999; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                                    <i class="fas fa-calendar-alt" style="color: #667eea; margin-right: 0.5rem;"></i>Date & Time
                                </p>
                                @if($event->event_date)
                                <p style="color: #2c3e50; font-weight: 600; font-size: 1.1rem; margin: 0;">
                                    {{ $event->event_date->format('F j, Y') }}
                                </p>
                                <p style="color: #666; margin-top: 0.5rem;">
                                    {{ $event->event_date->format('g:i A') }}
                                </p>
                                @else
                                <p style="color: #999; margin-top: 0.5rem;">Date not specified</p>
                                @endif
                            </div>
                        </div>

                        <div class="column is-6-tablet is-6-desktop">
                            <div style="background: white; border-radius: 8px; padding: 1.5rem; color: #333;">
                                <p style="color: #999; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                                    <i class="fas fa-map-marker-alt" style="color: #667eea; margin-right: 0.5rem;"></i>Location
                                </p>
                                <p style="color: #2c3e50; font-weight: 600; font-size: 1.1rem; margin: 0;">
                                    {{ $event->location }}
                                </p>
                            </div>
                        </div>

                        <div class="column is-6-tablet is-6-desktop">
                            <div style="background: white; border-radius: 8px; padding: 1.5rem; color: #333;">
                                <p style="color: #999; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                                    <i class="fas fa-flag" style="color: #667eea; margin-right: 0.5rem;"></i>Status
                                </p>
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
                                <span style="display: inline-block; background: {{ $statusBg }}; color: {{ $statusColor }}; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="column is-6-tablet is-6-desktop">
                            <div style="background: white; border-radius: 8px; padding: 1.5rem; color: #333;">
                                <p style="color: #999; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                                    <i class="fas fa-clock" style="color: #667eea; margin-right: 0.5rem;"></i>Posted
                                </p>
                                @if($event->created_at)
                                <p style="color: #2c3e50; font-weight: 600; margin: 0;">
                                    {{ $event->created_at->format('M d, Y') }}
                                </p>
                                @else
                                <p style="color: #999; font-weight: 600; margin: 0;">Date not available</p>
                                @endif
                                @if($event->updated_at)
                                <p style="color: #666; font-size: 0.9rem;">
                                    Updated: {{ $event->updated_at->format('M d, Y') }}
                                </p>
                                @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                @if($event->status === 'upcoming' || $event->status === 'ongoing')
                <div style="background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 12px; padding: 2rem; color: white; text-align: center;">
                    <h3 class="title is-4" style="color: white; margin-bottom: 1rem;">Interested in attending?</h3>
                    <p style="font-size: 1.1rem; margin-bottom: 1.5rem; opacity: 0.95;">
                        Join us for this exciting event. Register now to secure your spot!
                    </p>
                    <a href="{{ route('contact') }}" class="button is-large" style="background: white; color: #333; font-weight: 600;">
                        <span class="icon"><i class="fas fa-user-plus"></i></span>
                        <span>Register Now</span>
                    </a>
                </div>
                @endif
            </div>

            <!-- ===== SIDEBAR ===== -->
            <div class="column is-4-tablet is-4-desktop">
                <!-- Event Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1); position: sticky; top: 2rem; color: #333;">
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem; margin: 0 auto;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>

                    <div style="background: #f5f7ff; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; text-align: center;">
                        <p style="color: #999; font-size: 0.85rem; margin: 0 0 0.5rem 0;">WHEN</p>
                        @if($event->event_date)
                        <p style="color: #2c3e50; font-weight: 700; font-size: 1.1rem; margin: 0;">
                            {{ $event->event_date->format('M d, Y') }}
                        </p>
                        <p style="color: #667eea; font-weight: 600; margin: 0.5rem 0 0 0;">
                            {{ $event->event_date->format('g:i A') }}
                        </p>
                        @else
                        <p style="color: #999; font-weight: 700; font-size: 1.1rem; margin: 0;">Date not specified</p>
                        @endif
                    </div>

                    <div style="background: #f5f7ff; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; text-align: center;">
                        <p style="color: #999; font-size: 0.85rem; margin: 0 0 0.5rem 0;">WHERE</p>
                        <p style="color: #2c3e50; font-weight: 700; margin: 0;">
                            {{ $event->location }}
                        </p>
                    </div>

                    <div style="background: #f5f7ff; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; text-align: center;">
                        <p style="color: #999; font-size: 0.85rem; margin: 0 0 0.5rem 0;">EVENT STATUS</p>
                        <span style="display: inline-block; background: {{ $statusBg }}; color: {{ $statusColor }}; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>

                    @if($event->status === 'upcoming' || $event->status === 'ongoing')
                    <a href="{{ route('contact') }}" class="button is-fullwidth" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                        <span class="icon"><i class="fas fa-check"></i></span>
                        <span>Register</span>
                    </a>
                    @endif

                    <a href="{{ route('events') }}" class="button is-fullwidth is-light" style="margin-top: 1rem;">
                        <span class="icon"><i class="fas fa-arrow-left"></i></span>
                        <span>Back to Events</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== OTHER UPCOMING EVENTS ===== -->
@php
    $otherEvents = \App\Models\Event::where('status', 'upcoming')
        ->where('id', '!=', $event->id)
        ->latest()
        ->limit(3)
        ->get();
@endphp

@if($otherEvents->count() > 0)
<section class="section" style="background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <h2 class="section-title">Other Upcoming Events</h2>
        
        <div class="columns is-multiline">
            @foreach($otherEvents as $otherEvent)
            <div class="column is-6-tablet is-4-desktop">
                <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; color: #333;" onmouseenter="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 6px 16px rgba(0, 0, 0, 0.12)';" onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.08)';" >
                    @if($otherEvent->images && count($otherEvent->images) > 0)
                    <div style="height: 180px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $otherEvent->images[0]) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $otherEvent->title }}">
                    </div>
                    @endif
                    
                    <div style="padding: 1.5rem;">
                        <h4 style="color: #2c3e50; font-weight: 700; margin: 0 0 0.75rem 0; line-height: 1.4;">
                            {{ Str::limit($otherEvent->title, 50) }}
                        </h4>
                        @if($otherEvent->event_date)
                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.75rem;">
                            <i class="fas fa-calendar"></i> {{ $otherEvent->event_date->format('M d, Y') }}
                        </p>
                        @endif
                        <a href="{{ route('events.show', $otherEvent) }}" class="button is-small is-primary" style="background: linear-gradient(135deg, #667eea, #764ba2); border: none; width: 100%; color: white; font-weight: 600;">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
