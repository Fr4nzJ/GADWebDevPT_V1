@extends('admin.layout')

@section('title', 'Create Program - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Create New Program</h1>
    <a href="{{ route('admin.programs.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-arrow-left"></i></span>
        <span>Back to Programs</span>
    </a>
</div>

<!-- ===== FORM ERROR MESSAGES ===== -->
@if ($errors->any())
<div class="notification is-danger" style="background: #ffe8e8; border-left: 4px solid #e74c3c; color: #2c3e50;">
    <button class="delete"></button>
    <strong>Please fix the following errors:</strong>
    <ul style="margin-top: 1rem; margin-left: 1.5rem;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- ===== FORM ===== -->
<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="columns">
            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Program Title *</label>
                    <div class="control">
                        <input class="input" type="text" name="title" value="{{ old('title') }}" placeholder="Enter program title" required>
                    </div>
                    @error('title')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Program Image</label>
                    <div class="control">
                        <input class="input" type="file" name="image" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <p class="help">Accepted formats: JPEG, PNG, JPG, GIF, WebP (Max 2MB)</p>
                    @error('image')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    <div id="imagePreview" style="margin-top: 1rem;"></div>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-6-tablet is-6-desktop">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Category *</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="category" required>
                                <option value="">-- Select Category --</option>
                                <option value="women_empowerment" {{ old('category') === 'women_empowerment' ? 'selected' : '' }}>Women Empowerment</option>
                                <option value="education" {{ old('category') === 'education' ? 'selected' : '' }}>Education & Skills</option>
                                <option value="safety" {{ old('category') === 'safety' ? 'selected' : '' }}>Safety & Protection</option>
                                <option value="leadership" {{ old('category') === 'leadership' ? 'selected' : '' }}>Leadership</option>
                                <option value="lgbtq" {{ old('category') === 'lgbtq' ? 'selected' : '' }}>LGBTQ+ Rights</option>
                                <option value="mainstreaming" {{ old('category') === 'mainstreaming' ? 'selected' : '' }}>Mainstreaming</option>
                            </select>
                        </div>
                    </div>
                    @error('category')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-6-tablet is-6-desktop">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Status *</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="status" required>
                                <option value="">-- Select Status --</option>
                                <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="upcoming" {{ old('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="suspended" {{ old('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </div>
                    </div>
                    @error('status')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-6-tablet is-6-desktop">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Start Date *</label>
                    <div class="control">
                        <input class="input" type="date" name="start_date" value="{{ old('start_date') }}" required>
                    </div>
                    @error('start_date')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-6-tablet is-6-desktop">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">End Date</label>
                    <div class="control">
                        <input class="input" type="date" name="end_date" value="{{ old('end_date') }}">
                    </div>
                    @error('end_date')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-6-tablet is-6-desktop">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Number of Beneficiaries</label>
                    <div class="control">
                        <input class="input" type="number" name="beneficiaries" value="{{ old('beneficiaries', 0) }}" min="0">
                    </div>
                    @error('beneficiaries')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="column is-6-tablet is-6-desktop">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Budget (PHP)</label>
                    <div class="control">
                        <input class="input" type="number" name="budget" value="{{ old('budget', 0) }}" min="0">
                    </div>
                    @error('budget')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Location</label>
                    <div class="control">
                        <input class="input" type="text" name="location" value="{{ old('location') }}" placeholder="Enter program location">
                    </div>
                    @error('location')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Description *</label>
                    <div class="control">
                        <textarea class="textarea" name="description" rows="6" placeholder="Enter detailed program description" required>{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Target Group</label>
                    <div class="control">
                        <textarea class="textarea" name="target_group" rows="4" placeholder="Describe the target beneficiaries">{{ old('target_group') }}</textarea>
                    </div>
                    @error('target_group')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-12">
                <div class="field">
                    <label class="label" style="font-weight: 600; color: #2c3e50;">Objectives (one per line)</label>
                    <div class="control">
                        <textarea class="textarea" name="objectives" rows="5" placeholder="Enter program objectives, one per line">{{ old('objectives') ? (is_array(old('objectives')) ? implode("\n", old('objectives')) : old('objectives')) : '' }}</textarea>
                    </div>
                    @error('objectives')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <button type="submit" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600; padding: 0.75rem 2rem;">
                <span class="icon"><i class="fas fa-save"></i></span>
                <span>Create Program</span>
            </button>
            <a href="{{ route('admin.programs.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600; padding: 0.75rem 2rem;">
                <span>Cancel</span>
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '200px';
            img.style.borderRadius = '8px';
            img.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
            preview.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
