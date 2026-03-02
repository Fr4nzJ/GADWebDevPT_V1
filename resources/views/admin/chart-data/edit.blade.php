@extends('admin.layout')

@section('title', 'Edit Chart Data - Admin Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Chart Data</h1>
</div>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
    <form action="{{ route('admin.chart-data.update', $chartDatum) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="field">
            <label class="label">Chart Type <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <div class="select is-fullwidth">
                    <select name="chart_type" required>
                        <option value="growth" {{ old('chart_type', $chartDatum->chart_type) == 'growth' ? 'selected' : '' }}>Growth Chart (Bar)</option>
                        <option value="distribution" {{ old('chart_type', $chartDatum->chart_type) == 'distribution' ? 'selected' : '' }}>Distribution Chart (Pie)</option>
                    </select>
                </div>
            </div>
            @error('chart_type') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Label <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input @error('label') is-danger @enderror" type="text" name="label" value="{{ old('label', $chartDatum->label) }}" required>
            </div>
            @error('label') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Value <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input @error('value') is-danger @enderror" type="number" name="value" value="{{ old('value', $chartDatum->value) }}" required min="0">
            </div>
            @error('value') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Page <span style="color: #e74c3c;">*</span></label>
            <div class="control">
                <input class="input @error('page') is-danger @enderror" type="text" name="page" value="{{ old('page', $chartDatum->page) }}" required>
            </div>
            @error('page') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label class="label">Order</label>
            <div class="control">
                <input class="input @error('order') is-danger @enderror" type="number" name="order" value="{{ old('order', $chartDatum->order) }}" min="0">
            </div>
            @error('order') <p class="help is-danger">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $chartDatum->is_active) ? 'checked' : '' }}>
                    <span style="margin-left: 0.5rem;">Active</span>
                </label>
            </div>
        </div>

        <div class="field is-grouped" style="margin-top: 2rem;">
            <div class="control">
                <button class="button is-primary" type="submit">
                    <span class="icon"><i class="fas fa-save"></i></span>
                    <span>Update</span>
                </button>
            </div>
            <div class="control">
                <a href="{{ route('admin.chart-data.index') }}" class="button is-light">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
