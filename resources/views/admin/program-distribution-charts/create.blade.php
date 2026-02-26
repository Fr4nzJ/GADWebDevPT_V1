@extends('admin.layout')

@section('title', 'Add Program Distribution Chart Data - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Add Program Distribution Chart Data Point</h1>
</div>

<div class="card" style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    @if ($errors->any())
        <div class="notification is-danger is-light" style="margin-bottom: 2rem;">
            <button class="delete"></button>
            <strong>Error:</strong> Please fix the following errors:
            <ul style="margin-left: 1rem; margin-top: 0.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.program-distribution-charts.store') }}" method="POST">
        @csrf

        <!-- Program Name Field -->
        <div class="field">
            <label class="label" style="font-weight: 600; color: #2c3e50;">Program Name <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input" type="text" name="label" placeholder="e.g., Gender Empowerment" value="{{ old('label') }}" required>
            </div>
            @error('label')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Value Field -->
        <div class="field">
            <label class="label" style="font-weight: 600; color: #2c3e50;">Value (Percentage or Count) <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input" type="number" name="value" min="0" value="{{ old('value') }}" required>
            </div>
            @error('value')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Color Field -->
        <div class="field">
            <label class="label" style="font-weight: 600; color: #2c3e50;">Color (Hex Code) <span style="color: #e74c3c;">*</span></label>
            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field is-narrow" style="flex-grow: 0;">
                        <div class="control">
                            <input type="color" id="color_hex" name="color_hex" class="input" style="width: 80px; height: 50px; cursor: pointer;" value="{{ old('color_hex', '#667eea') }}">
                        </div>
                    </div>
                    <div class="field is-expanded">
                        <div class="control has-icons-left">
                            <input class="input" type="text" name="color_hex_text" placeholder="#667eea" value="{{ old('color_hex', '#667eea') }}" readonly>
                            <span class="icon is-left"><i class="fas fa-palette"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <p class="help" style="color: #999;">Click the color box to choose a color</p>
            @error('color_hex')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Order Field -->
        <div class="field">
            <label class="label" style="font-weight: 600; color: #2c3e50;">Order (Display Order) <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input" type="number" name="order" min="1" value="{{ old('order', 1) }}" required>
            </div>
            <p class="help" style="color: #999;">Lower numbers appear first on the chart</p>
            @error('order')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status Field -->
        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span style="margin-left: 0.5rem; font-weight: 500;">Active (Show on Dashboard)</span>
                </label>
            </div>
            @error('is_active')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="field is-grouped" style="margin-top: 2rem;">
            <div class="control">
                <button type="submit" class="button is-success" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                    <span class="icon"><i class="fas fa-save"></i></span>
                    <span>Save Data Point</span>
                </button>
            </div>
            <div class="control">
                <a href="{{ route('admin.program-distribution-charts.index') }}" class="button is-light">
                    <span>Cancel</span>
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    const colorInput = document.getElementById('color_hex');
    const colorText = document.querySelector('input[name="color_hex_text"]');
    
    colorInput.addEventListener('change', function() {
        colorText.value = this.value;
        document.querySelector('input[name="color_hex"]').value = this.value;
    });
</script>
@endsection
