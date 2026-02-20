@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Edit Event</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="title">Event Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $event->title) }}" required>
                    @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                    @error('description')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <label for="event_date">Event Date</label>
                    <input type="datetime-local" class="form-control @error('event_date') is-invalid @enderror" 
                           id="event_date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required>
                    @error('event_date')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <label for="location">Location</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                           id="location" name="location" value="{{ old('location', $event->location) }}" required>
                    @error('location')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ old('status', $event->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Update Event</button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 40px 20px;
    }

    .col-md-8 {
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    h2 {
        color: #333;
        font-weight: 700;
        margin-bottom: 30px;
        border-bottom: 3px solid #667eea;
        padding-bottom: 15px;
    }

    .form-group label {
        color: #555;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        padding: 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 10px 30px;
        border-radius: 5px;
        font-weight: 600;
        transition: transform 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 10px 30px;
        border-radius: 5px;
        font-weight: 600;
    }

    .alert-danger {
        background: #f8d7da;
        border: 2px solid #f5c6cb;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>
@endpush