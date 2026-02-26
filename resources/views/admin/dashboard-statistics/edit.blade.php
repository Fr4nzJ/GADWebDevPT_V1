@extends('admin.layout')

@section('title', 'Edit Dashboard Statistic - GAD Admin Panel')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="title is-3">Edit Statistic Card</h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="notification is-danger is-light">
            <button class="delete"></button>
            <p><strong>Validation Errors:</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box">
        <form method="POST" action="{{ route('admin.dashboard-statistics.update', $dashboardStatistic) }}">
            @csrf
            @method('PUT')

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Label <span class="has-text-danger">*</span></label>
                        <div class="control">
                            <input class="input @error('label') is-danger @enderror" type="text" name="label" 
                                   value="{{ old('label', $dashboardStatistic->label) }}" required>
                        </div>
                        @error('label')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="column is-6">
                    <div class="field">
                        <label class="label">Value <span class="has-text-danger">*</span></label>
                        <div class="control">
                            <input class="input @error('value') is-danger @enderror" type="number" name="value" 
                                   value="{{ old('value', $dashboardStatistic->value) }}" required min="0">
                        </div>
                        @error('value')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Color Class</label>
                        <div class="control">
                            <div class="select @error('color_class') is-danger @enderror">
                                <select name="color_class">
                                    <option value="blue" {{ old('color_class', $dashboardStatistic->color_class) === 'blue' ? 'selected' : '' }}>Blue</option>
                                    <option value="purple" {{ old('color_class', $dashboardStatistic->color_class) === 'purple' ? 'selected' : '' }}>Purple</option>
                                    <option value="green" {{ old('color_class', $dashboardStatistic->color_class) === 'green' ? 'selected' : '' }}>Green</option>
                                    <option value="orange" {{ old('color_class', $dashboardStatistic->color_class) === 'orange' ? 'selected' : '' }}>Orange</option>
                                    <option value="red" {{ old('color_class', $dashboardStatistic->color_class) === 'red' ? 'selected' : '' }}>Red</option>
                                </select>
                            </div>
                        </div>
                        @error('color_class')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="column is-6">
                    <div class="field">
                        <label class="label">Icon Class (Font Awesome)</label>
                        <div class="control">
                            <input class="input @error('icon_class') is-danger @enderror" type="text" name="icon_class" 
                                   value="{{ old('icon_class', $dashboardStatistic->icon_class) }}">
                        </div>
                        @error('icon_class')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-4">
                    <div class="field">
                        <label class="label">Trend Value</label>
                        <div class="control">
                            <input class="input @error('trend_value') is-danger @enderror" type="number" name="trend_value" 
                                   value="{{ old('trend_value', $dashboardStatistic->trend_value) }}">
                        </div>
                        @error('trend_value')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="column is-4">
                    <div class="field">
                        <label class="label">Trend Direction</label>
                        <div class="control">
                            <div class="select @error('trend_direction') is-danger @enderror">
                                <select name="trend_direction">
                                    <option value="up" {{ old('trend_direction', $dashboardStatistic->trend_direction) === 'up' ? 'selected' : '' }}>Up</option>
                                    <option value="down" {{ old('trend_direction', $dashboardStatistic->trend_direction) === 'down' ? 'selected' : '' }}>Down</option>
                                    <option value="flat" {{ old('trend_direction', $dashboardStatistic->trend_direction) === 'flat' ? 'selected' : '' }}>Flat</option>
                                </select>
                            </div>
                        </div>
                        @error('trend_direction')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="column is-4">
                    <div class="field">
                        <label class="label">Order</label>
                        <div class="control">
                            <input class="input @error('order') is-danger @enderror" type="number" name="order" 
                                   value="{{ old('order', $dashboardStatistic->order) }}" min="0">
                        </div>
                        @error('order')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Trend Text</label>
                <div class="control">
                    <input class="input @error('trend_text') is-danger @enderror" type="text" name="trend_text" 
                           value="{{ old('trend_text', $dashboardStatistic->trend_text) }}">
                </div>
                @error('trend_text')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $dashboardStatistic->is_active) ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        <span class="icon"><i class="fas fa-save"></i></span>
                        <span>Update Statistic</span>
                    </button>
                </div>
                <div class="control">
                    <a href="{{ route('admin.dashboard-statistics.index') }}" class="button is-light">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        (document.querySelectorAll('.notification .delete') || []).forEach(function($delete) {
            var $notification = $delete.parentNode;
            $delete.addEventListener('click', function() {
                $notification.parentNode.removeChild($notification);
            });
        });
    });
</script>
@endsection
