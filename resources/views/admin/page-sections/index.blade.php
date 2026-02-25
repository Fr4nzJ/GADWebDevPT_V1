@extends('admin.layout')
@section('title', 'Page Sections - Admin')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Page Sections</h2>
                    <a href="{{ route('admin.page-sections.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add</a>
                </div>
                @if($sections->count())
                    <table class="w-full border-collapse border">
                        <thead><tr class="bg-gray-100"><th class="border px-4 py-2">Page</th><th class="border px-4 py-2">Key</th><th class="border px-4 py-2">Title</th><th class="border px-4 py-2">Active</th><th class="border px-4 py-2">Actions</th></tr></thead>
                        <tbody>@foreach($sections as $section)<tr><td class="border px-4 py-2">{{ $section->page }}</td><td class="border px-4 py-2">{{ $section->section_key }}</td><td class="border px-4 py-2">{{ $section->title ?? '(No title)' }}</td><td class="border px-4 py-2">{{ $section->is_active ? '✓' : '✗' }}</td><td class="border px-4 py-2"><a href="{{ route('admin.page-sections.edit', $section) }}" class="text-blue-600">Edit</a> <form action="{{ route('admin.page-sections.destroy', $section) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE') <button class="text-red-600">Del</button></form></td></tr>@endforeach</tbody>
                    </table>
                @else
                    <p>No page sections</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
