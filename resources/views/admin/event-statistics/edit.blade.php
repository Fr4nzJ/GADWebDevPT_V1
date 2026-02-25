@extends('admin.layout')

@section('title', 'Edit Event Statistic')

@section('content')
<div class="container mt-5">
    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h1 class="title">Edit Event Statistic</h1>

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

            <form action="{{ route('admin.event-statistics.update', $eventStatistic) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Label -->
                <div class="field">
                    <label class="label">Label <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('label') is-danger @enderror" type="text" name="label" 
                            placeholder="e.g., Total Events, Expected Attendees" value="{{ old('label', $eventStatistic->label) }}" required>
                    </div>
                    @error('label')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Value -->
                <div class="field">
                    <label class="label">Value <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('value') is-danger @enderror" type="text" name="value" 
                            placeholder="e.g., 35, 15K+, ₱25M" value="{{ old('value', $eventStatistic->value) }}" required>
                    </div>
                    @error('value')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div class="field">
                    <label class="label">Icon (FontAwesome Class)</label>
                    <div class="control">
                        <input class="input @error('icon') is-danger @enderror" type="text" name="icon" 
                            placeholder="e.g., fas fa-calendar-alt, fas fa-users" value="{{ old('icon', $eventStatistic->icon) }}">
                    </div>
                    <p class="help">Optional. Use FontAwesome icon classes.</p>
                    @error('icon')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color -->
                <div class="field">
                    <label class="label">Color (Hex Code)</label>
                    <div class="control">
                        <input class="input @error('color') is-danger @enderror" type="text" name="color" 
                            placeholder="e.g., #667eea, #764ba2" value="{{ old('color', $eventStatistic->color) }}">
                    </div>
                    @error('color')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div class="field">
                    <label class="label">Order <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('order') is-danger @enderror" type="number" name="order" 
                            placeholder="0" value="{{ old('order', $eventStatistic->order) }}" required>
                    </div>
                    <p class="help">Display order (0 = first)</p>
                    @error('order')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                        <textarea class="textarea @error('description') is-danger @enderror" name="description" 
                            placeholder="Optional additional description" rows="3">{{ old('description', $eventStatistic->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active -->
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $eventStatistic->is_active) ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">
                            <span class="icon"><i class="fas fa-save"></i></span>
                            <span>Update Statistic</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.event-statistics.index') }}" class="button is-light">
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
