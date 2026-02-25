@extends('admin.layout')

@section('title', 'Add Report Statistic')

@section('content')
<div class="container mt-5">
    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h1 class="title">Add New Report Statistic</h1>

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

            <form action="{{ route('admin.report-statistics.store') }}" method="POST">
                @csrf

                <div class="columns">
                    <div class="column is-half">
                        <!-- Label -->
                        <div class="field">
                            <label class="label">Label <span style="color: red;">*</span></label>
                            <div class="control">
                                <input class="input @error('label') is-danger @enderror" type="text" name="label" 
                                    placeholder="e.g., Research Reports Published" value="{{ old('label') }}" required>
                            </div>
                            @error('label')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="column is-half">
                        <!-- Number -->
                        <div class="field">
                            <label class="label">Number <span style="color: red;">*</span></label>
                            <div class="control">
                                <input class="input @error('number') is-danger @enderror" type="text" name="number" 
                                    placeholder="e.g., 45+" value="{{ old('number') }}" required>
                            </div>
                            @error('number')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Subtitle -->
                <div class="field">
                    <label class="label">Subtitle</label>
                    <div class="control">
                        <input class="input @error('subtitle') is-danger @enderror" type="text" name="subtitle" 
                            placeholder="e.g., Since 2015" value="{{ old('subtitle') }}">
                    </div>
                    @error('subtitle')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div class="field">
                    <label class="label">Icon (FontAwesome Class)</label>
                    <div class="control">
                        <input class="input @error('icon') is-danger @enderror" type="text" name="icon" 
                            placeholder="e.g., fas fa-file-pdf" value="{{ old('icon') }}">
                    </div>
                    <p class="help">Optional. Use FontAwesome icon classes.</p>
                    @error('icon')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="columns">
                    <div class="column is-half">
                        <!-- Gradient Start -->
                        <div class="field">
                            <label class="label">Gradient Start (Hex) <span style="color: red;">*</span></label>
                            <div class="control">
                                <input class="input @error('gradient_start') is-danger @enderror" type="text" name="gradient_start" 
                                    placeholder="#667eea" value="{{ old('gradient_start', '#667eea') }}" required>
                            </div>
                            @error('gradient_start')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="column is-half">
                        <!-- Gradient End -->
                        <div class="field">
                            <label class="label">Gradient End (Hex) <span style="color: red;">*</span></label>
                            <div class="control">
                                <input class="input @error('gradient_end') is-danger @enderror" type="text" name="gradient_end" 
                                    placeholder="#764ba2" value="{{ old('gradient_end', '#764ba2') }}" required>
                            </div>
                            @error('gradient_end')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Order -->
                <div class="field">
                    <label class="label">Order <span style="color: red;">*</span></label>
                    <div class="control">
                        <input class="input @error('order') is-danger @enderror" type="number" name="order" 
                            placeholder="0" value="{{ old('order', 0) }}" required min="0">
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
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                            <span>Active</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">
                            <span class="icon"><i class="fas fa-save"></i></span>
                            <span>Create Statistic</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.report-statistics.index') }}" class="button is-light">
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
