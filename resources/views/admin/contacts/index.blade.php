@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-violet-50 via-purple-50 to-pink-50 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="mb-12 flex justify-between items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="text-6xl animate-pulse">📧</div>
                    <h1 class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-purple-600">Contact Messages</h1>
                </div>
                <p class="text-gray-700 text-xl font-bold">🎯 Manage and respond to customer inquiries with ease</p>
            </div>
            <a href="{{ route('admin.contacts.create') }}" class="px-8 py-4 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 text-white rounded-xl hover:from-green-600 hover:via-emerald-600 hover:to-teal-600 transition shadow-lg hover:shadow-2xl font-black transform hover:scale-105 text-lg uppercase tracking-wider flex items-center gap-2">
                <span class="text-2xl">➕</span> New Contact
            </a>
        </div>

        <!-- Status Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg hover:shadow-2xl transition border-r-8 border-blue-700 p-8 transform hover:scale-110 group">
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-sm text-blue-100 font-black uppercase tracking-wider">📬 All Messages</p>
                        <p class="text-5xl font-black mt-3">{{ $statusCounts['new'] + $statusCounts['read'] + $statusCounts['replied'] + $statusCounts['archived'] }}</p>
                    </div>
                    <div class="text-6xl opacity-20 group-hover:opacity-100 transition">📬</div>
                </div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-blue-400 rounded-full -mr-16 -mb-16 group-hover:scale-125 transition"></div>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-2xl shadow-lg hover:shadow-2xl transition border-r-8 border-yellow-700 p-8 transform hover:scale-110 group">
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <a href="{{ route('admin.contacts.index', ['status' => 'new']) }}" class="text-sm text-yellow-100 font-black uppercase tracking-wider hover:text-white">🆕 New Messages</a>
                        <p class="text-5xl font-black mt-3">{{ $statusCounts['new'] }}</p>
                    </div>
                    <div class="text-6xl opacity-20 group-hover:opacity-100 transition">📨</div>
                </div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-yellow-400 rounded-full -mr-16 -mb-16 group-hover:scale-125 transition"></div>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-2xl shadow-lg hover:shadow-2xl transition border-r-8 border-purple-700 p-8 transform hover:scale-110 group">
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <a href="{{ route('admin.contacts.index', ['status' => 'read']) }}" class="text-sm text-purple-100 font-black uppercase tracking-wider hover:text-white">👁️ Read Messages</a>
                        <p class="text-5xl font-black mt-3">{{ $statusCounts['read'] }}</p>
                    </div>
                    <div class="text-6xl opacity-20 group-hover:opacity-100 transition">👁️</div>
                </div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-purple-400 rounded-full -mr-16 -mb-16 group-hover:scale-125 transition"></div>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl shadow-lg hover:shadow-2xl transition border-r-8 border-green-700 p-8 transform hover:scale-110 group">
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <a href="{{ route('admin.contacts.index', ['status' => 'replied']) }}" class="text-sm text-green-100 font-black uppercase tracking-wider hover:text-white">✅ Replied</a>
                        <p class="text-5xl font-black mt-3">{{ $statusCounts['replied'] }}</p>
                    </div>
                    <div class="text-6xl opacity-20 group-hover:opacity-100 transition">✅</div>
                </div>
                <div class="absolute bottom-0 right-0 w-32 h-32 bg-green-400 rounded-full -mr-16 -mb-16 group-hover:scale-125 transition"></div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-2xl shadow-lg mb-10 p-8 border-2 border-purple-200">
            <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex gap-4 flex-wrap">
                <div class="flex-1 min-w-250 relative">
                    <input type="text" name="search" placeholder="🔍 Search by name, email, or subject..." 
                           value="{{ $searchTerm }}" class="w-full px-5 py-4 border-3 border-purple-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-purple-50 to-pink-50">
                </div>
                
                <select name="status" class="px-5 py-4 border-3 border-purple-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition bg-gradient-to-r from-purple-50 to-pink-50 text-lg font-semibold">
                    <option value="">📋 All Statuses</option>
                    <option value="new" {{ $currentStatus === 'new' ? 'selected' : '' }}>🆕 New</option>
                    <option value="read" {{ $currentStatus === 'read' ? 'selected' : '' }}>👁️ Read</option>
                    <option value="replied" {{ $currentStatus === 'replied' ? 'selected' : '' }}>✅ Replied</option>
                    <option value="archived" {{ $currentStatus === 'archived' ? 'selected' : '' }}>📦 Archived</option>
                </select>
                
                <button type="submit" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition font-black shadow-lg hover:shadow-xl text-lg uppercase tracking-wider transform hover:scale-105">
                    🔎 Filter
                </button>
                
                @if($searchTerm || $currentStatus)
                    <a href="{{ route('admin.contacts.index') }}" class="px-8 py-4 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition font-black shadow-lg hover:shadow-xl text-lg uppercase tracking-wider transform hover:scale-105">
                        ✕ Clear
                    </a>
                @endif
            </form>
        </div>

        <!-- Contacts Table -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-purple-200">
            @if($contacts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-purple-900 via-violet-900 to-indigo-900 text-white">
                            <tr>
                                <th class="px-6 py-5 text-left text-sm font-black uppercase tracking-wider">👤 From</th>
                                <th class="px-6 py-5 text-left text-sm font-black uppercase tracking-wider">📝 Subject</th>
                                <th class="px-6 py-5 text-left text-sm font-black uppercase tracking-wider">🏷️ Status</th>
                                <th class="px-6 py-5 text-left text-sm font-black uppercase tracking-wider">📅 Date</th>
                                <th class="px-6 py-5 text-left text-sm font-black uppercase tracking-wider">⚙️ Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-purple-200">
                            @foreach($contacts as $contact)
                                <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition group">
                                    <td class="px-6 py-5">
                                        <div class="font-black text-gray-900 text-lg">{{ $contact->name }}</div>
                                        <div class="text-gray-600 text-sm mt-1 font-semibold">{{ $contact->email }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-gray-900 line-clamp-1 text-lg">{{ Str::limit($contact->subject, 40) }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($contact->status === 'new')
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-black bg-gradient-to-r from-yellow-400 to-yellow-500 text-yellow-900 border-2 border-yellow-600 shadow-md">🆕 New</span>
                                        @elseif($contact->status === 'read')
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-black bg-gradient-to-r from-purple-400 to-purple-500 text-purple-900 border-2 border-purple-600 shadow-md">👁️ Read</span>
                                        @elseif($contact->status === 'replied')
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-black bg-gradient-to-r from-green-400 to-green-500 text-green-900 border-2 border-green-600 shadow-md">✅ Replied</span>
                                        @else
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-black bg-gradient-to-r from-gray-400 to-gray-500 text-gray-900 border-2 border-gray-600 shadow-md">📦 Archived</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-sm text-gray-700 font-bold">
                                        {{ $contact->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex gap-2 flex-wrap opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                                               class="text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 font-black text-xs px-4 py-2 rounded-lg transition transform hover:scale-110 shadow-md hover:shadow-lg">
                                                👁️ View
                                            </a>
                                            <a href="{{ route('admin.contacts.edit', $contact) }}" 
                                               class="text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 font-black text-xs px-4 py-2 rounded-lg transition transform hover:scale-110 shadow-md hover:shadow-lg">
                                                ✏️ Edit
                                            </a>
                                            @if($contact->status !== 'archived')
                                                <form method="POST" action="{{ route('admin.contacts.archive', $contact) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="text-white bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 font-black text-xs px-4 py-2 rounded-lg transition transform hover:scale-110 shadow-md hover:shadow-lg">
                                                        📦 Archive
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.contacts.restore', $contact) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="text-white bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 font-black text-xs px-4 py-2 rounded-lg transition transform hover:scale-110 shadow-md hover:shadow-lg">
                                                        ↩️ Restore
                                                    </button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" 
                                                  onsubmit="return confirm('Are you sure you want to delete this contact?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 font-black text-xs px-4 py-2 rounded-lg transition transform hover:scale-110 shadow-md hover:shadow-lg">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $contacts->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-gradient-to-br from-purple-50 to-pink-50">
                    <div class="text-8xl mb-6 animate-bounce">📭</div>
                    <p class="text-gray-700 text-2xl font-black">No contacts found</p>
                    <p class="text-gray-600 text-lg mt-3 font-semibold">Try adjusting your search or filters</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .min-w-250 {
        min-width: 250px;
    }
</style>
@endsection
