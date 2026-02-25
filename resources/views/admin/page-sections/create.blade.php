@extends('admin.layout')
@section('title', 'Create Page Section - Admin')
@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Create Page Section</h2>
                <form action="{{ route('admin.page-sections.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div><label class="block font-medium mb-2">Page *</label><input type="text" name="page" required class="w-full border px-3 py-2 rounded dark:bg-gray-700" placeholder="home, about, footer"></div>
                    <div><label class="block font-medium mb-2">Section Key *</label><input type="text" name="section_key" required class="w-full border px-3 py-2 rounded dark:bg-gray-700" placeholder="footer_about, hero_title"></div>
                    <div><label class="block font-medium mb-2">Title</label><input type="text" name="title" class="w-full border px-3 py-2 rounded dark:bg-gray-700"></div>
                    <div><label class="block font-medium mb-2">Content *</label><textarea name="content" rows="5" required class="w-full border px-3 py-2 rounded dark:bg-gray-700"></textarea></div>
                    <div><label class="flex items-center"><input type="checkbox" name="is_active" checked class="rounded"><span class="ml-2">Active</span></label></div>
                    <div class="flex gap-4"><button type="submit" class="px-6 py-2 bg-green-600 text-white rounded">Create</button><a href="{{ route('admin.page-sections.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded">Cancel</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
