@extends('admin.layout')

@section('title', 'Add Monthly Event Chart Data - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Add Monthly Event Chart Data Point</h1>
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

    <form action="{{ route('admin.monthly-event-charts.store') }}" method="POST">
        @csrf

        <!-- Month Field -->
        <div class="field">
            <label class="label" style="font-weight: 600; color: #2c3e50;">Month <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <div class="select is-fullwidth">
                    <select name="month" required>
                        <option value="">Select a month</option>
                        <option value="January" {{ old('month') === 'January' ? 'selected' : '' }}>January</option>
                        <option value="February" {{ old('month') === 'February' ? 'selected' : '' }}>February</option>
                        <option value="March" {{ old('month') === 'March' ? 'selected' : '' }}>March</option>
                        <option value="April" {{ old('month') === 'April' ? 'selected' : '' }}>April</option>
                        <option value="May" {{ old('month') === 'May' ? 'selected' : '' }}>May</option>
                        <option value="June" {{ old('month') === 'June' ? 'selected' : '' }}>June</option>
                        <option value="July" {{ old('month') === 'July' ? 'selected' : '' }}>July</option>
                        <option value="August" {{ old('month') === 'August' ? 'selected' : '' }}>August</option>
                        <option value="September" {{ old('month') === 'September' ? 'selected' : '' }}>September</option>
                        <option value="October" {{ old('month') === 'October' ? 'selected' : '' }}>October</option>
                        <option value="November" {{ old('month') === 'November' ? 'selected' : '' }}>November</option>
                        <option value="December" {{ old('month') === 'December' ? 'selected' : '' }}>December</option>
                    </select>
                </div>
            </div>
            @error('month')
                <p class="help is-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Value Field -->
        <div class="field">
            <label class="label" style="font-weight: 600; color: #2c3e50;">Value (Number of Events) <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input" type="number" name="value" min="0" value="{{ old('value') }}" required>
            </div>
            @error('value')
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
                <a href="{{ route('admin.monthly-event-charts.index') }}" class="button is-light">
                    <span>Cancel</span>
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
