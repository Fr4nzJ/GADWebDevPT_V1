@extends('admin.layout')

@section('title', 'Edit Resource')

@section('content')
<div class="container mt-5">
    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h1 class="title">Edit Resource</h1>

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

            <form action="{{ route('admin.resources.update', $resource) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="field">
                    <label class="label">Title <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('title') is-danger @enderror" type="text" name="title" 
                            placeholder="e.g., Gender-Responsive Research Toolkit" value="{{ old('title', $resource->title) }}" required>
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
                            placeholder="Resource description" rows="4" required>{{ old('description', $resource->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="columns">
                    <div class="column is-half">
                        <!-- Icon -->
                        <div class="field">
                            <label class="label">Icon (FontAwesome Class)</label>
                            <div class="control">
                                <input class="input @error('icon') is-danger @enderror" type="text" name="icon" 
                                    placeholder="e.g., fas fa-book" value="{{ old('icon', $resource->icon) }}">
                            </div>
                            @error('icon')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="column is-half">
                        <!-- Color -->
                        <div class="field">
                            <label class="label">Title Color (Hex)</label>
                            <div class="control">
                                <input class="input @error('color') is-danger @enderror" type="text" name="color" 
                                    placeholder="e.g., #667eea" value="{{ old('color', $resource->color) }}">
                            </div>
                            @error('color')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Button Text -->
                <div class="field">
                    <label class="label">Button Text <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('button_text') is-danger @enderror" type="text" name="button_text" 
                            placeholder="e.g., Download Toolkit" value="{{ old('button_text', $resource->button_text) }}" required>
                    </div>
                    @error('button_text')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button URL -->
                <div class="field">
                    <label class="label">Button URL / Link</label>
                    <div class="control">
                        <input class="input @error('button_url') is-danger @enderror" type="text" name="button_url" 
                            placeholder="https://example.com/resource.pdf" value="{{ old('button_url', $resource->button_url) }}">
                    </div>
                    @error('button_url')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button Action -->
                <div class="field">
                    <label class="label">Button Action <span style="color: red;">*</span></label>
                    <div class="control">
                        <div class="select @error('button_action') is-danger @enderror is-fullwidth">
                            <select name="button_action" required>
                                <option value="download" @if(old('button_action', $resource->button_action) == 'download') selected @endif>Download</option>
                                <option value="access" @if(old('button_action', $resource->button_action) == 'access') selected @endif>Access</option>
                                <option value="view" @if(old('button_action', $resource->button_action) == 'view') selected @endif>View</option>
                                <option value="link" @if(old('button_action', $resource->button_action) == 'link') selected @endif>External Link</option>
                            </select>
                        </div>
                    </div>
                    @error('button_action')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div class="field">
                    <label class="label">Order <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('order') is-danger @enderror" type="number" name="order" 
                            placeholder="0" value="{{ old('order', $resource->order) }}" required min="0">
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
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $resource->is_active) ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">
                            <span class="icon"><i class="fas fa-save"></i></span>
                            <span>Update Resource</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.resources.index') }}" class="button is-light">
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
