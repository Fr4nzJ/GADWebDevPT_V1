@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Contact Messages</h1>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
            <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                All Messages
            </a>
            <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['new'] + $statusCounts['read'] + $statusCounts['replied'] + $statusCounts['archived'] }}</p>
        </div>
        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
            <a href="{{ route('admin.contacts.index', ['status' => 'new']) }}" class="text-yellow-600 hover:text-yellow-800 font-semibold">
                New Messages
            </a>
            <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['new'] }}</p>
        </div>
        <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
            <a href="{{ route('admin.contacts.index', ['status' => 'read']) }}" class="text-purple-600 hover:text-purple-800 font-semibold">
                Read Messages
            </a>
            <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['read'] }}</p>
        </div>
        <div class="bg-green-50 rounded-lg p-4 border border-green-200">
            <a href="{{ route('admin.contacts.index', ['status' => 'replied']) }}" class="text-green-600 hover:text-green-800 font-semibold">
                Replied
            </a>
            <p class="text-2xl font-bold text-gray-900">{{ $statusCounts['replied'] }}</p>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex gap-3 flex-wrap">
            <input type="text" name="search" placeholder="Search by name, email, or subject..." 
                   value="{{ $searchTerm }}" class="flex-1 min-w-250 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Statuses</option>
                <option value="new" {{ $currentStatus === 'new' ? 'selected' : '' }}>New</option>
                <option value="read" {{ $currentStatus === 'read' ? 'selected' : '' }}>Read</option>
                <option value="replied" {{ $currentStatus === 'replied' ? 'selected' : '' }}>Replied</option>
                <option value="archived" {{ $currentStatus === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Filter
            </button>
            
            @if($searchTerm || $currentStatus)
                <a href="{{ route('admin.contacts.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Contacts Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($contacts->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">From</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Subject</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($contacts as $contact)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">
                                <div class="font-medium text-gray-900">{{ $contact->name }}</div>
                                <div class="text-gray-500 text-xs">{{ $contact->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="font-medium">{{ Str::limit($contact->subject, 40) }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($contact->status === 'new')
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">New</span>
                                @elseif($contact->status === 'read')
                                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">Read</span>
                                @elseif($contact->status === 'replied')
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Replied</span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">Archived</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $contact->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $contacts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No contacts found.</p>
            </div>
        @endif
    </div>
</div>

<style>
    .min-w-250 {
        min-width: 250px;
    }
</style>
@endsection
