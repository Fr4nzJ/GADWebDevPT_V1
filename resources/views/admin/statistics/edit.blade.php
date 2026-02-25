@extends('admin.layout')

@section('title', 'Edit Statistic - Admin Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold mb-6">Edit Statistic</h2>

                <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block font-medium mb-2">Title <span class="text-red-600">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $statistic->title) }}" required class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg @error('title') border-red-600 @enderror">
                        @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="value" class="block font-medium mb-2">Value <span class="text-red-600">*</span></label>
                        <input type="text" id="value" name="value" value="{{ old('value', $statistic->value) }}" required class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg @error('value') border-red-600 @enderror">
                        @error('value') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="label" class="block font-medium mb-2">Label <span class="text-red-600">*</span></label>
                        <input type="text" id="label" name="label" value="{{ old('label', $statistic->label) }}" required class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg @error('label') border-red-600 @enderror">
                        @error('label') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="icon" class="block font-medium mb-2">Icon (FontAwesome class)</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $statistic->icon) }}" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg">
                        @error('icon') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="color" class="block font-medium mb-2">Color <span class="text-red-600">*</span></label>
                        <select id="color" name="color" required class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg">
                            <option value="blue" {{ old('color', $statistic->color) == 'blue' ? 'selected' : '' }}>Blue</option>
                            <option value="green" {{ old('color', $statistic->color) == 'green' ? 'selected' : '' }}>Green</option>
                            <option value="orange" {{ old('color', $statistic->color) == 'orange' ? 'selected' : '' }}>Orange</option>
                            <option value="purple" {{ old('color', $statistic->color) == 'purple' ? 'selected' : '' }}>Purple</option>
                        </select>
                        @error('color') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="page" class="block font-medium mb-2">Page <span class="text-red-600">*</span></label>
                        <input type="text" id="page" name="page" value="{{ old('page', $statistic->page) }}" required class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg">
                        @error('page') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="order" class="block font-medium mb-2">Display Order</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $statistic->order) }}" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg">
                        @error('order') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block font-medium mb-2">Description</label>
                        <textarea id="description" name="description" rows="3" class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 px-3 py-2 rounded-lg">{{ old('description', $statistic->description) }}</textarea>
                        @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" {{ old('is_active', $statistic->is_active) ? 'checked' : '' }} class="rounded">
                        <label for="is_active" class="ml-2">Active</label>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Update</button>
                        <a href="{{ route('admin.statistics.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
