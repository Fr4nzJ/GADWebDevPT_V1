@extends('admin.layout')
@section('title', 'Edit Page Value - Admin')
@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Edit Page Value</h2>
                <form action="{{ route('admin.page-values.update', $pageValue) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div><label class="block font-medium mb-2">Type *</label><select name="type" required class="w-full border px-3 py-2 rounded dark:bg-gray-700"><option value="objective" {{ old('type', $pageValue->type) == 'objective' ? 'selected' : '' }}>Objective</option><option value="value" {{ old('type', $pageValue->type) == 'value' ? 'selected' : '' }}>Value</option><option value="mandate" {{ old('type', $pageValue->type) == 'mandate' ? 'selected' : '' }}>Mandate</option><option value="goal" {{ old('type', $pageValue->type) == 'goal' ? 'selected' : '' }}>Goal</option><option value="vision" {{ old('type', $pageValue->type) == 'vision' ? 'selected' : '' }}>Vision</option><option value="mission" {{ old('type', $pageValue->type) == 'mission' ? 'selected' : '' }}>Mission</option><option value="achievement" {{ old('type', $pageValue->type) == 'achievement' ? 'selected' : '' }}>Achievement</option></select></div>
                    <div><label class="block font-medium mb-2">Content *</label><textarea name="content" rows="4" required class="w-full border px-3 py-2 rounded dark:bg-gray-700">{{ old('content', $pageValue->content) }}</textarea></div>
                    <div><label class="block font-medium mb-2">Page</label><input type="text" name="page" value="{{ old('page', $pageValue->page) }}" class="w-full border px-3 py-2 rounded dark:bg-gray-700"></div>
                    <div><label class="block font-medium mb-2">Icon</label><input type="text" name="icon" value="{{ old('icon', $pageValue->icon) }}" class="w-full border px-3 py-2 rounded dark:bg-gray-700"></div>
                    <div><label class="flex items-center"><input type="checkbox" name="is_active" {{ old('is_active', $pageValue->is_active) ? 'checked' : '' }} class="rounded"><span class="ml-2">Active</span></label></div>
                    <div class="flex gap-4"><button type="submit" class="px-6 py-2 bg-green-600 text-white rounded">Update</button><a href="{{ route('admin.page-values.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded">Cancel</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
