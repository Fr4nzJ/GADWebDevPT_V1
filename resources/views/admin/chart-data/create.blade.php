@extends('admin.layout')

@section('title', 'Create Chart Data - Admin Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Add New Chart Data</h1>
</div>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
    <form action="{{ route('admin.chart-data.store') }}" method="POST">
        @csrf

        <div class="field">
            <label class="label">Chart Type <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <div class="select is-fullwidth">
                    <select name="chart_type" required>
                        <option value="">Select chart type...</option>
                        <option value="growth" {{ old('chart_type') == 'growth' ? 'selected' : '' }}>Growth Chart (Bar)</option>
                        <option value="distribution" {{ old('chart_type') == 'distribution' ? 'selected' : '' }}>Distribution Chart (Pie)</option>
                    </select>
                </div>
            </div>
            @error('chart_type') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Label <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input @error('label') is-danger @enderror" type="text" name="label" placeholder="e.g., 2019, VAWG Prevention" value="{{ old('label') }}" required>
            </div>
            @error('label') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Value <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input @error('value') is-danger @enderror" type="number" name="value" placeholder="15000" value="{{ old('value') }}" required min="0">
            </div>
            @error('value') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Page <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input @error('page') is-danger @enderror" type="text" name="page" placeholder="home" value="{{ old('page', 'home') }}" required>
            </div>
            @error('page') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Order</label>
            <div class="control">
                <input class="input @error('order') is-danger @enderror" type="number" name="order" placeholder="0" value="{{ old('order', 0) }}" min="0">
            </div>
            @error('order') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : 'checked' }}>
                    <span style="margin-left: 0.5rem;">Active</span>
                </label>
            </div>
        </div>

        <div class="field is-grouped" style="margin-top: 2rem;">
            <div class="control">
                <button class="button is-primary" type="submit">
                    <span class="icon"><i class="fas fa-save"></i></span>
                    <span>Save</span>
                </button>
            </div>
            <div class="control">
                <a href="{{ route('admin.chart-data.index') }}" class="button is-light">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
