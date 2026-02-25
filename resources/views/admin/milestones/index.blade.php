@extends('admin.layout')

@section('title', 'Manage Milestones - Admin Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Manage Milestones</h2>
                    <a href="{{ route('admin.milestones.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        + Add Milestone
                    </a>
                </div>

                @if($milestones->count())
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="border px-4 py-2 text-left">Year</th>
                                    <th class="border px-4 py-2 text-left">Description</th>
                                    <th class="border px-4 py-2 text-left">Page</th>
                                    <th class="border px-4 py-2 text-left">Active</th>
                                    <th class="border px-4 py-2 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($milestones as $milestone)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="border px-4 py-2">{{ $milestone->year }}</td>
                                        <td class="border px-4 py-2">{{ Str::limit($milestone->description, 50) }}</td>
                                        <td class="border px-4 py-2">{{ $milestone->page }}</td>
                                        <td class="border px-4 py-2">{{ $milestone->is_active ? '✓' : '✗' }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('admin.milestones.edit', $milestone) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('admin.milestones.destroy', $milestone) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $milestones->links() }}
                @else
                    <p class="text-gray-500">No milestones. <a href="{{ route('admin.milestones.create') }}" class="text-blue-600">Create one</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
