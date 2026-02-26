@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Monthly Event Chart Data Point</h1>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.monthly-event-charts.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Month -->
                <div>
                    <label for="month" class="block text-sm font-medium text-gray-700 mb-2">Month</label>
                    <select id="month" name="month" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
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
                    @error('month')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Value -->
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Value (Number of Events)</label>
                    <input type="number" id="value" name="value" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('value') }}" required>
                    @error('value')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order (Display Order)</label>
                    <input type="number" id="order" name="order" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('order', 1) }}" required>
                    <p class="text-gray-500 text-xs mt-1">Lower numbers appear first on the chart</p>
                    @error('order')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="is_active" class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ old('is_active', true) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Active (Show on Dashboard)</span>
                    </label>
                    @error('is_active')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Save Data Point
                    </button>
                    <a href="{{ route('admin.monthly-event-charts.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
