@extends('admin.layout')

@section('title', 'Edit Key Achievement')

@section('content')
<div class="container mt-5">
    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h1 class="title">Edit Achievement</h1>

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

            <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Number -->
                <div class="field">
                    <label class="label">Number <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('number') is-danger @enderror" type="text" name="number" 
                            placeholder="e.g., 250+, 8.5K" value="{{ old('number', $achievement->number) }}" required>
                    </div>
                    @error('number')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Label -->
                <div class="field">
                    <label class="label">Label (Description) <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('label') is-danger @enderror" type="text" name="label" 
                            placeholder="e.g., Agencies with Gender Focal Persons" value="{{ old('label', $achievement->label) }}" required>
                    </div>
                    @error('label')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div class="field">
                    <label class="label">Icon (FontAwesome Class)</label>
                    <div class="control">
                        <input class="input @error('icon') is-danger @enderror" type="text" name="icon" 
                            placeholder="e.g., fas fa-users, fas fa-chart-bar" value="{{ old('icon', $achievement->icon) }}">
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
                            placeholder="0" value="{{ old('order', $achievement->order) }}" required>
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
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $achievement->is_active) ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">
                            <span class="icon"><i class="fas fa-save"></i></span>
                            <span>Update Achievement</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.achievements.index') }}" class="button is-light">
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
