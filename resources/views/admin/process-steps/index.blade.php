@extends('admin.layout')
@section('title', 'Process Steps - Admin')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Process Steps</h2>
                    <a href="{{ route('admin.process-steps.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Add</a>
                </div>
                @if($processSteps->count())
                    <table class="w-full border-collapse border">
                        <thead><tr class="bg-gray-100"><th class="border px-4 py-2">Title</th><th class="border px-4 py-2">Description</th><th class="border px-4 py-2">Page</th><th class="border px-4 py-2">Active</th><th class="border px-4 py-2">Actions</th></tr></thead>
                        <tbody>@foreach($processSteps as $step)<tr><td class="border px-4 py-2">{{ $step->title }}</td><td class="border px-4 py-2">{{ Str::limit($step->description, 40) }}</td><td class="border px-4 py-2">{{ $step->page }}</td><td class="border px-4 py-2">{{ $step->is_active ? '✓' : '✗' }}</td><td class="border px-4 py-2"><a href="{{ route('admin.process-steps.edit', $step) }}" class="text-blue-600">Edit</a> <form action="{{ route('admin.process-steps.destroy', $step) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE') <button class="text-red-600">Del</button></form></td></tr>@endforeach</tbody>
                    </table>
                @else
                    <p>No process steps</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
