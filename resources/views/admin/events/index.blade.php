@extends('admin.layout')

@section('title', 'Manage Events - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header" style="display: flex; align-items: center; gap: 1rem;">
    <h1 class="page-title">Manage Events</h1>
    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('admin.events.create') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
            <span class="icon"><i class="fas fa-plus"></i></span>
            <span>Add New Event</span>
        </a>
    </div>
</div>

<!-- ===== FILTER BAR ===== -->
<div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <div class="columns">
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Events</label>
                <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Enter event name...">
                    <span class="icon is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Event Status</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Status</option>
                            <option>Upcoming</option>
                            <option>Ongoing</option>
                            <option>Completed</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Location</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Locations</option>
                            <option>National (NCR)</option>
                            <option>Luzon</option>
                            <option>Visayas</option>
                            <option>Mindanao</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== EVENTS TABLE ===== -->
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">Event</th>
                <th style="padding: 1.25rem;">Date & Time</th>
                <th style="padding: 1.25rem;">Location</th>
                <th style="padding: 1.25rem;">Status</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events ?? [] as $event)
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        {{-- NEW: Show thumbnail if event has images --}}
                        @if($event->first_image)
                        <div style="width: 60px; height: 60px; border-radius: 8px; overflow: hidden; flex-shrink: 0;">
                            <img src="{{ asset('storage/' . $event->first_image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @else
                        <div style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-calendar-alt" style="color: white; font-size: 1.5rem;"></i>
                        </div>
                        @endif
                        <div>
                            <strong style="color: #2c3e50; display: block; margin-bottom: 0.25rem;">{{ $event->title }}</strong>
                            @if(!empty($event->images))
                            <span style="font-size: 0.75rem; color: #667eea;">
                                <i class="fas fa-images"></i> {{ count($event->images) }} image(s)
                            </span>
                            @endif
                        </div>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <div style="color: #667eea; font-weight: 500; font-size: 0.95rem;">
                        {{ $event->event_date ? $event->event_date->format('F j, Y') : 'TBD' }}
                    </div>
                    <div style="color: #999; font-size: 0.85rem;">
                        {{ $event->event_date ? $event->event_date->format('g:i A') : '' }}
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">{{ $event->location ?? 'TBD' }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    @php
                        $statusClass = [
                            'upcoming' => 'status-pending',
                            'ongoing' => 'status-active',
                            'completed' => 'status-published',
                            'cancelled' => 'status-inactive'
                        ][$event->status] ?? 'status-pending';
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        {{ ucfirst($event->status ?? 'Upcoming') }}
                    </span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <a href="{{ route('admin.events.show', $event) }}" class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalEvent{{ $event->id }}').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            {{-- Static fallback data --}}
            @php
                $staticEvents = [
                    ['id' => 1, 'title' => 'Gender Mainstreaming Training', 'date' => '2024-03-15', 'time' => '9:00 AM - 5:00 PM', 'location' => 'NEDA Building, NCR', 'status' => 'upcoming', 'images' => []],
                    ['id' => 2, 'title' => 'VAWG Prevention Program', 'date' => '2024-03-08', 'time' => '2:00 PM - 5:00 PM', 'location' => 'Various Barangay Halls', 'status' => 'ongoing', 'images' => []],
                ];
            @endphp
            
            @foreach($staticEvents as $event)
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 60px; height: 60px; border-radius: 8px; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-calendar-alt" style="color: white; font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <strong style="color: #2c3e50;">{{ $event['title'] }}</strong>
                        </div>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <div style="color: #667eea; font-weight: 500; font-size: 0.95rem;">
                        {{ \Carbon\Carbon::parse($event['date'])->format('F j, Y') }}
                    </div>
                    <div style="color: #999; font-size: 0.85rem;">{{ $event['time'] }}</div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">{{ $event['location'] }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    @php
                        $statusClass = [
                            'upcoming' => 'status-pending',
                            'ongoing' => 'status-active',
                            'completed' => 'status-published',
                            'cancelled' => 'status-inactive'
                        ][$event['status']];
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        {{ ucfirst($event['status']) }}
                    </span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <button class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="{{ route('admin.events.edit', $event['id']) }}" class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalEvent{{ $event['id'] }}').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
            @endforelse
        </tbody>
    </table>
</div>

<!-- ===== PAGINATION ===== -->
@if(isset($events) && $events->count() > 0)
    {{ $events->links() }}
@endif

<!-- ===== DELETE MODALS ===== -->
@if(isset($events) && $events->count() > 0)
    @foreach($events as $event)
    <div class="modal" id="deleteModalEvent{{ $event->id }}">
        <div class="modal-background" x-data @click="document.getElementById('deleteModalEvent{{ $event->id }}').classList.remove('is-active')"></div>
        <div class="modal-card">
            <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
                <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                    <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                    Confirm Deletion
                </p>
                <button class="delete" x-data @click="document.getElementById('deleteModalEvent{{ $event->id }}').classList.remove('is-active')"></button>
            </header>
            <section class="modal-card-body" style="padding: 2rem;">
                @if(!empty($event->images))
                <div style="background: #fff3cd; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                    <p style="color: #856404; font-size: 0.9rem;">
                        <i class="fas fa-images" style="margin-right: 0.5rem;"></i>
                        <strong>Note:</strong> This event has {{ count($event->images) }} image(s) that will also be deleted.
                    </p>
                </div>
                @endif
                <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                    Are you sure you want to delete <strong>{{ $event->title }}</strong>? All associated data will be removed.
                </p>
            </section>
            <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
                <button class="button" x-data @click="document.getElementById('deleteModalEvent{{ $event->id }}').classList.remove('is-active')">
                    Cancel
                </button>
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button is-danger" style="background: #e74c3c; color: white;">
                        <span class="icon"><i class="fas fa-trash"></i></span>
                        <span>Delete</span>
                    </button>
                </form>
            </footer>
        </div>
    </div>
    @endforeach
@endif

@endsection