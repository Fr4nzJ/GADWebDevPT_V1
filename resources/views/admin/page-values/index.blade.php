@extends('admin.layout')
@section('title', 'Page Values - Admin')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Page Values</h2>
                    <a href="{{ route('admin.page-values.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add</a>
                </div>
                @if($values->count())
                    <table class="w-full border-collapse border">
                        <thead><tr class="bg-gray-100"><th class="border px-4 py-2">Type</th><th class="border px-4 py-2">Content</th><th class="border px-4 py-2">Page</th><th class="border px-4 py-2">Active</th><th class="border px-4 py-2">Actions</th></tr></thead>
                        <tbody>@foreach($values as $value)<tr><td class="border px-4 py-2"><span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ $value->type }}</span></td><td class="border px-4 py-2">{{ Str::limit($value->content, 50) }}</td><td class="border px-4 py-2">{{ $value->page }}</td><td class="border px-4 py-2">{{ $value->is_active ? '✓' : '✗' }}</td><td class="border px-4 py-2"><a href="{{ route('admin.page-values.edit', $value) }}" class="text-blue-600">Edit</a> <form action="{{ route('admin.page-values.destroy', $value) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE') <button class="text-red-600">Del</button></form></td></tr>@endforeach</tbody>
                    </table>
                @else
                    <p>No page values</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
