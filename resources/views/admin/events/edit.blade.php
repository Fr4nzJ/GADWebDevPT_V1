@extends('admin.layout')

@section('title', 'Edit Event - GAD Admin Panel')

@section('content')
<div class="container" style="padding: 2rem;">
    <div class="page-header" style="margin-bottom: 2rem;">
        <h1 class="page-title">Edit Event</h1>
    </div>

    @if ($errors->any())
        <div class="notification is-danger" style="margin-bottom: 1.5rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <label class="label">Event Title</label>
                <div class="control">
                    <input class="input @error('title') is-danger @enderror" 
                           type="text" name="title" value="{{ old('title', $event->title) }}" required>
                </div>
                @error('title')<p class="help is-danger">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="label">Description</label>
                <div class="control">
                    <textarea class="textarea @error('description') is-danger @enderror" 
                              name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                </div>
                @error('description')<p class="help is-danger">{{ $message }}</p>@enderror
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">Event Date</label>
                        <div class="control">
                            <input class="input @error('event_date') is-danger @enderror" 
                                   type="datetime-local" name="event_date" 
                                   value="{{ old('event_date', $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') : '') }}" 
                                   required>
                        </div>
                        @error('event_date')<p class="help is-danger">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">Location</label>
                        <div class="control">
                            <input class="input @error('location') is-danger @enderror" 
                                   type="text" name="location" value="{{ old('location', $event->location) }}" required>
                        </div>
                        @error('location')<p class="help is-danger">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Status</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="status" required>
                            <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing" {{ old('status', $event->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
                @error('status')<p class="help is-danger">{{ $message }}</p>@enderror
            </div>

            {{-- Existing Images Section --}}
            @if(!empty($event->images) && is_array($event->images))
            <div class="field" style="margin-top: 1.5rem;">
                <label class="label">Current Images</label>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                    @foreach($event->images as $index => $image)
                    <div style="position: relative; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <img src="{{ asset('storage/' . $image) }}" style="width: 100%; height: 150px; object-fit: cover;">
                        <label style="position: absolute; top: 5px; right: 5px; background: rgba(231, 76, 60, 0.9); color: white; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 0.75rem;">
                            <input type="checkbox" name="remove_images[]" value="{{ $image }}" style="margin-right: 4px;">
                            Remove
                        </label>
                    </div>
                    @endforeach
                </div>
                <p class="help">Check images to remove them from this event</p>
            </div>
            @endif

            {{-- Add New Images Section --}}
            <div class="field" style="margin-top: 1.5rem;">
                <label class="label">Add New Images</label>
                <div class="control">
                    <div class="file has-name is-boxed" id="image-upload-container">
                        <label class="file-label" style="width: 100%;">
                            <input class="file-input" type="file" name="images[]" id="image-input" multiple accept="image/*">
                            <span class="file-cta" style="flex-direction: column; padding: 2rem; border: 2px dashed #dbdbdb; border-radius: 8px; background: #fafafa;">
                                <span class="file-icon" style="margin-bottom: 0.5rem;">
                                    <i class="fas fa-cloud-upload-alt fa-2x" style="color: #667eea;"></i>
                                </span>
                                <span class="file-label" style="color: #666;">Click to upload additional images</span>
                                <span style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">PNG, JPG, GIF up to 50 MB each</span>
                            </span>
                        </label>
                    </div>
                    <div id="image-preview-container" style="display: none; margin-top: 1rem;">
                        <p class="help" style="margin-bottom: 0.5rem; font-weight: 600;">New Images to Add:</p>
                        <div id="image-preview-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 1rem;"></div>
                    </div>
                </div>
                @error('images')<p class="help is-danger">{{ $message }}</p>@enderror
                @error('images.*')<p class="help is-danger">{{ $message }}</p>@enderror
            </div>

            <div class="field is-grouped" style="margin-top: 2rem;">
                <div class="control">
                    <button type="submit" class="button is-primary" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                        Update Event
                    </button>
                </div>
                <div class="control">
                    <a href="{{ route('admin.events.index') }}" class="button is-light">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image-input');
    const previewContainer = document.getElementById('image-preview-container');
    const previewGrid = document.getElementById('image-preview-grid');

    imageInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        
        if (files.length > 0) {
            previewContainer.style.display = 'block';
            previewGrid.innerHTML = '';
            
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style.cssText = 'position: relative; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: 2px solid #667eea;';
                    div.innerHTML = `
                        <img src="${e.target.result}" style="width: 100%; height: 120px; object-fit: cover;">
                        <div style="position: absolute; top: 5px; right: 5px; background: #667eea; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem;">
                            NEW
                        </div>
                    `;
                    previewGrid.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.style.display = 'none';
        }
    });
});
</script>
@endpush