@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Program Distribution Chart Data Point</h1>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.program-distribution-charts.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Label (Program Name) -->
                <div>
                    <label for="label" class="block text-sm font-medium text-gray-700 mb-2">Program Name</label>
                    <input type="text" id="label" name="label" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('label') }}" placeholder="e.g., Gender Empowerment" required>
                    @error('label')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Value -->
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-2">Value (Percentage or Count)</label>
                    <input type="number" id="value" name="value" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('value') }}" required>
                    @error('value')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color (Hex Code) -->
                <div>
                    <label for="color_hex" class="block text-sm font-medium text-gray-700 mb-2">Color (Hex Code)</label>
                    <div class="flex gap-4">
                        <input type="color" id="color_hex" name="color_hex" class="w-16 h-10 border border-gray-300 rounded cursor-pointer" value="{{ old('color_hex', '#667eea') }}">
                        <input type="text" name="color_hex_text" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('color_hex', '#667eea') }}" placeholder="#667eea" readonly>
                    </div>
                    <p class="text-gray-500 text-xs mt-1">Click the color box to choose a color or enter a hex code</p>
                    @error('color_hex')
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
                    <a href="{{ route('admin.program-distribution-charts.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Sync color inputs
    const colorInput = document.getElementById('color_hex');
    const colorText = document.querySelector('input[name="color_hex_text"]');
    
    colorInput.addEventListener('change', function() {
        colorText.value = this.value;
        document.querySelector('input[name="color_hex"]').value = this.value;
    });
</script>
@endsection
