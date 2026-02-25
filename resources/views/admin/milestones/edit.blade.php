@extends('admin.layout')

@section('title', 'Edit Milestone - Admin Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold mb-6">Edit Milestone</h2>

                <form action="{{ route('admin.milestones.update', $milestone) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label for="year" class="block font-medium mb-2">Year <span class="text-red-600">*</span></label>
                        <input type="number" id="year" name="year" value="{{ old('year', $milestone->year) }}" min="1900" max="{{ date('Y') }}" required class="w-full border px-3 py-2 rounded-lg dark:bg-gray-700">
                    </div>

                    <div>
                        <label for="description" class="block font-medium mb-2">Description <span class="text-red-600">*</span></label>
                        <textarea id="description" name="description" rows="4" required class="w-full border px-3 py-2 rounded-lg dark:bg-gray-700">{{ old('description', $milestone->description) }}</textarea>
                    </div>

                    <div>
                        <label for="page" class="block font-medium mb-2">Page <span class="text-red-600">*</span></label>
                        <input type="text" id="page" name="page" value="{{ old('page', $milestone->page) }}" required class="w-full border px-3 py-2 rounded-lg dark:bg-gray-700">
                    </div>

                    <div>
                        <label for="icon" class="block font-medium mb-2">Icon</label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $milestone->icon) }}" class="w-full border px-3 py-2 rounded-lg dark:bg-gray-700">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" {{ old('is_active', $milestone->is_active) ? 'checked' : '' }} class="rounded">
                        <label for="is_active" class="ml-2">Active</label>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Update</button>
                        <a href="{{ route('admin.milestones.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
