@extends('admin.layout')

@section('title', 'Edit Policy Brief')

@section('content')
<div class="container mt-5">
    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h1 class="title">Edit Policy Brief</h1>

            @if ($errors->any())
                <div class="notification is-danger">
                    <button class="delete"></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.policy-briefs.update', $policyBrief) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="field">
                    <label class="label">Title <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('title') is-danger @enderror" type="text" name="title" 
                            placeholder="e.g., Only 1 in 4 Women Agricultural Workers..." value="{{ old('title', $policyBrief->title) }}" required>
                    </div>
                    @error('title')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="field">
                    <label class="label">Description <span style="color: red;">*</span></label>
                    <div class="control">
                        <textarea class="textarea @error('description') is-danger @enderror" name="description" 
                            placeholder="Brief summary of the policy brief" rows="4" required>{{ old('description', $policyBrief->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pages -->
                <div class="field">
                    <label class="label">Pages</label>
                    <div class="control">
                        <input class="input @error('pages') is-danger @enderror" type="number" name="pages" 
                            placeholder="0" value="{{ old('pages', $policyBrief->pages) }}" min="0">
                    </div>
                    @error('pages')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="columns">
                    <div class="column is-half">
                        <!-- Year -->
                        <div class="field">
                            <label class="label">Year</label>
                            <div class="control">
                                <input class="input @error('year') is-danger @enderror" type="text" name="year" 
                                    placeholder="e.g., 2024" value="{{ old('year', $policyBrief->year) }}" pattern="\d{4}">
                            </div>
                            @error('year')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="column is-half">
                        <!-- Color -->
                        <div class="field">
                            <label class="label">Border Color (Hex)</label>
                            <div class="control">
                                <input class="input @error('color') is-danger @enderror" type="text" name="color" 
                                    placeholder="e.g., #667eea" value="{{ old('color', $policyBrief->color) }}">
                            </div>
                            @error('color')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Icon -->
                <div class="field">
                    <label class="label">Icon (FontAwesome Class)</label>
                    <div class="control">
                        <input class="input @error('icon') is-danger @enderror" type="text" name="icon" 
                            placeholder="e.g., fas fa-file-alt" value="{{ old('icon', $policyBrief->icon) }}">
                    </div>
                    <p class="help">Optional. Use FontAwesome icon classes.</p>
                    @error('icon')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div class="field">
                    <label class="label">Order <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('order') is-danger @enderror" type="number" name="order" 
                            placeholder="0" value="{{ old('order', $policyBrief->order) }}" required min="0">
                    </div>
                    <p class="help">Display order (0 = first)</p>
                    @error('order')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active -->
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $policyBrief->is_active) ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">
                            <span class="icon"><i class="fas fa-save"></i></span>
                            <span>Update Policy Brief</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.policy-briefs.index') }}" class="button is-light">
                            <span>Cancel</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
</script>
@endsection
