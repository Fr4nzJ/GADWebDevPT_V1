@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Monthly Event Chart Data</h1>
                <p class="mt-2 text-gray-600">Manage data points for the monthly events overview line chart</p>
            </div>
            <a href="{{ route('admin.monthly-event-charts.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                + Add New Data Point
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($chartData->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Month</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Value (Events)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($chartData as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $item->month }}</td>
                                <td class="px-6 py-4 font-semibold text-blue-600">{{ $item->value }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $item->order }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $item->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.monthly-event-charts.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.monthly-event-charts.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 border-t">
                    {{ $chartData->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <p class="text-gray-500 mb-4">No chart data points yet.</p>
                    <a href="{{ route('admin.monthly-event-charts.create') }}" class="text-blue-600 hover:underline">Add the first data point</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
