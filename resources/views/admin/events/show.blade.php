@extends('admin.layout')

@section('title', 'View Event - GAD Admin Panel')

@section('content')
<div class="container" style="padding: 2rem;">
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 class="page-title">Event Details</h1>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('admin.events.edit', $event) }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                <span class="icon"><i class="fas fa-edit"></i></span>
                <span>Edit Event</span>
            </a>
            <a href="{{ route('admin.events.index') }}" class="button is-light">Back to List</a>
        </div>
    </div>

    {{-- NEW: Image Gallery Section --}}
    @if(!empty($event->images) && is_array($event->images))
    <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
        <h3 style="font-size: 1.1rem; font-weight: 600; color: #2c3e50; margin-bottom: 1rem;">
            <i class="fas fa-images" style="color: #667eea; margin-right: 0.5rem;"></i>
            Event Images ({{ count($event->images) }})
        </h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
            @foreach($event->images as $image)
            <div style="position: relative; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer;" onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                <img src="{{ asset('storage/' . $image) }}" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); padding: 1rem; color: white; font-size: 0.85rem;">
                    <i class="fas fa-search-plus"></i> Click to enlarge
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
        <div class="field">
            <label class="label" style="color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Event Title</label>
            <p style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 1.5rem;">{{ $event->title }}</p>
        </div>

        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label" style="color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Status</label>
                    @php
                        $statusColors = [
                            'upcoming' => ['bg' => '#fff3cd', 'text' => '#856404'],
                            'ongoing' => ['bg' => '#d4edda', 'text' => '#155724'],
                            'completed' => ['bg' => '#cce5ff', 'text' => '#004085'],
                            'cancelled' => ['bg' => '#f8d7da', 'text' => '#721c24']
                        ];
                        $statusStyle = $statusColors[$event->status] ?? ['bg' => '#e2e3e5', 'text' => '#383d41'];
                    @endphp
                    <span style="display: inline-block; background: {{ $statusStyle['bg'] }}; color: {{ $statusStyle['text'] }}; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>
            </div>
            <div class="column">
                <div class="field">
                    <label class="label" style="color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Event Date</label>
                    <p style="font-size: 1.1rem; color: #2c3e50;">
                        <i class="fas fa-calendar-alt" style="color: #667eea; margin-right: 0.5rem;"></i>
                        {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('F j, Y') : 'Not set' }}
                    </p>
                    <p style="font-size: 0.95rem; color: #666; margin-top: 0.25rem;">
                        <i class="fas fa-clock" style="color: #667eea; margin-right: 0.5rem;"></i>
                        {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('g:i A') : '' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="field" style="margin-top: 1.5rem;">
            <label class="label" style="color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Location</label>
            <p style="font-size: 1.1rem; color: #2c3e50;">
                <i class="fas fa-map-marker-alt" style="color: #667eea; margin-right: 0.5rem;"></i>
                {{ $event->location ?? 'Not specified' }}
            </p>
        </div>

        <div class="field" style="margin-top: 1.5rem;">
            <label class="label" style="color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Event Images</label>
            @if($event->images && count($event->images) > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
                @foreach($event->images as $image)
                <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);">
                    <img src="{{ asset('storage/' . $image) }}" style="width: 100%; height: 250px; object-fit: cover;" alt="{{ $event->title }}">
                </div>
                @endforeach
            </div>
            @else
            <p style="color: #999; font-style: italic;">No images uploaded for this event.</p>
            @endif
        </div>

        <div class="field" style="margin-top: 1.5rem;">
            <div style="background: #f8f9fa; border-radius: 8px; padding: 1.5rem; line-height: 1.8; color: #444;">
                {{ $event->description }}
            </div>
        </div>

        <div class="field" style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee;">
            <p style="color: #999; font-size: 0.85rem;">
                <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                Created: {{ $event->created_at->format('M d, Y H:i') }} | 
                Last Updated: {{ $event->updated_at->format('M d, Y H:i') }}
            </p>
        </div>
    </div>
</div>

{{-- NEW: Image Modal for Full View --}}
<div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; justify-content: center; align-items: center;" onclick="closeImageModal()">
    <img id="modalImage" src="" style="max-width: 90%; max-height: 90%; object-fit: contain; border-radius: 8px;">
    <button style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: white; font-size: 2rem; cursor: pointer;">
        <i class="fas fa-times"></i>
    </button>
</div>
@endsection

@push('scripts')
<script>
function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('modalImage');
    img.src = src;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endpush