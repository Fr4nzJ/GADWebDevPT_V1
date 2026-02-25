@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-blue-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-800 font-bold text-lg transition transform hover:scale-105">
                ← Back to Contacts
            </a>
        </div>

        <!-- Header with Actions -->
        <div class="mb-10">
            <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 text-white rounded-2xl shadow-2xl p-10 mb-8 transform hover:scale-105 transition">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="text-5xl">📧</div>
                            <h1 class="text-5xl font-black mb-2">{{ $contact->subject }}</h1>
                        </div>
                        <div class="flex gap-3 flex-wrap items-center">
                            @if($contact->status === 'new')
                                <span class="inline-flex items-center px-4 py-2 bg-yellow-400 text-yellow-900 rounded-full text-sm font-bold">🆕 New</span>
                            @elseif($contact->status === 'read')
                                <span class="inline-flex items-center px-4 py-2 bg-purple-300 text-purple-900 rounded-full text-sm font-bold">👁️ Read</span>
                            @elseif($contact->status === 'replied')
                                <span class="inline-flex items-center px-4 py-2 bg-green-300 text-green-900 rounded-full text-sm font-bold">✅ Replied</span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-900 rounded-full text-sm font-bold">📦 Archived</span>
                            @endif
                            @if($contact->is_verified)
                                <span class="inline-flex items-center px-4 py-2 bg-green-400 text-green-900 rounded-full text-sm font-bold">✓ Verified</span>
                            @else
                                <span class="inline-flex items-center px-4 py-2 bg-red-400 text-red-900 rounded-full text-sm font-bold">⚠ Unverified</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-3 flex-wrap justify-end ml-4">
                        <a href="{{ route('admin.contacts.edit', $contact) }}" class="px-5 py-3 bg-white text-cyan-600 rounded-xl hover:bg-gray-100 transition font-black text-sm shadow-md hover:shadow-lg transform hover:scale-105 flex items-center gap-1">
                            ✏️ Edit
                        </a>
                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Are you sure you want to delete this contact? This action cannot be undone.')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl transition font-black text-sm shadow-md hover:shadow-lg transform hover:scale-105 flex items-center gap-1">
                                🗑️ Delete
                            </button>
                        </form>
                        @if($contact->status !== 'archived')
                            <form method="POST" action="{{ route('admin.contacts.archive', $contact) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-5 py-3 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white rounded-xl transition font-black text-sm shadow-md hover:shadow-lg transform hover:scale-105 flex items-center gap-1">
                                    📦 Archive
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.contacts.restore', $contact) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-5 py-3 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white rounded-xl transition font-black text-sm shadow-md hover:shadow-lg transform hover:scale-105 flex items-center gap-1">
                                    ↩️ Restore
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <!-- Sender Info -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border-l-8 border-cyan-500 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-100 rounded-full -mr-8 -mt-8 group-hover:scale-110 transition"></div>
                <h3 class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 mb-5 flex items-center uppercase tracking-wider"><span class="text-4xl mr-3">👤</span>From</h3>
                <p class="text-3xl font-black text-gray-900 mb-3">{{ $contact->name }}</p>
                <a href="mailto:{{ $contact->email }}" class="text-cyan-600 hover:text-cyan-800 font-bold text-lg inline-flex items-center transition transform hover:scale-105 gap-2">
                    📧 {{ $contact->email }}
                </a>
            </div>

            <!-- Submission Info -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border-l-8 border-blue-500 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100 rounded-full -mr-8 -mt-8 group-hover:scale-110 transition"></div>
                <h3 class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-5 flex items-center uppercase tracking-wider"><span class="text-4xl mr-3">📅</span>Submitted</h3>
                <p class="text-3xl font-black text-gray-900 mb-3">{{ $contact->created_at->format('M d, Y') }}</p>
                <p class="text-gray-700 font-bold text-lg">🕓 {{ $contact->created_at->diffForHumans() }}</p>
            </div>
        </div>

        @if($contact->replied_at)
            <div class="bg-gradient-to-r from-green-100 via-emerald-100 to-teal-100 rounded-2xl shadow-lg p-8 mb-10 border-l-8 border-green-600">
                <h3 class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-emerald-700 mb-4 flex items-center"><span class="text-3xl mr-2">✅</span>Reply Status</h3>
                <div class="space-y-2">
                    <p class="text-lg text-gray-800 font-bold">👤 <strong>Replied by:</strong> {{ $contact->repliedByUser->name ?? 'Unknown' }}</p>
                    <p class="text-lg text-gray-800 font-bold">⏰ <strong>Replied at:</strong> {{ $contact->replied_at->format('M d, Y H:i A') }}</p>
                </div>
            </div>
        @endif

        <!-- Original Message -->
        <div class="bg-white rounded-2xl shadow-xl mb-10 p-10 border-l-8 border-amber-500">
            <h2 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 mb-7 flex items-center uppercase tracking-wider"><span class="text-5xl mr-3">💬</span>Message</h2>
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-8 text-gray-800 text-lg leading-relaxed whitespace-pre-wrap border-l-4 border-amber-400 shadow-inner">
                {!! nl2br(e($contact->message)) !!}
            </div>
        </div>

        <!-- Reply Section -->
        @if($contact->status !== 'replied' || true)
            <div class="bg-white rounded-2xl shadow-xl p-10 border-l-8 border-green-500">
                <h2 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 mb-8 flex items-center uppercase tracking-wider">
                    <span class="text-5xl mr-3">✉️</span>
                    @if($contact->status === 'replied')
                        Reply History
                    @else
                        Send Reply
                    @endif
                </h2>

                @if($contact->status === 'replied' && $contact->reply_message)
                    <div class="bg-gradient-to-r from-green-100 via-emerald-100 to-teal-100 rounded-2xl p-8 mb-10 border-l-8 border-green-600 shadow-lg">
                        <p class="text-lg text-gray-800 mb-5 font-bold">
                            <span class="text-3xl">👤</span> <strong>{{ $contact->repliedByUser->name ?? 'Admin' }}</strong> replied on <strong>{{ $contact->replied_at->format('M d, Y H:i A') }}</strong>
                        </p>
                        <div class="text-gray-900 text-lg leading-relaxed whitespace-pre-wrap bg-white rounded-xl p-6 border-2 border-green-300 shadow-md">
                            {!! nl2br(e($contact->reply_message)) !!}
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}" class="mt-10 pt-8 border-t-4 border-gray-300">
                        @csrf
                        <h3 class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 mb-6 uppercase tracking-wider">Send Another Reply</h3>
                        <div class="mb-8">
                            <label for="reply_message" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 mb-3 uppercase tracking-wider">
                                Reply Message
                            </label>
                            <textarea id="reply_message" name="reply_message" rows="8" 
                                      class="w-full px-5 py-4 border-3 border-green-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-green-50 to-emerald-50 @error('reply_message') border-red-500 @enderror resize-none"
                                      placeholder="📝 Type your reply here..."></textarea>
                            @error('reply_message')
                                <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-8 py-4 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 text-white rounded-xl hover:from-green-600 hover:via-emerald-600 hover:to-teal-600 transition font-black shadow-lg hover:shadow-xl transform hover:scale-105 text-lg uppercase tracking-wider flex items-center gap-2">
                            <span class="text-2xl">✉️</span> Send Reply
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}">
                        @csrf
                        <div class="mb-8">
                            <label for="reply_message" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 mb-3 uppercase tracking-wider">
                                Reply Message <span class="text-red-500 text-2xl">*</span>
                            </label>
                            <textarea id="reply_message" name="reply_message" rows="10" 
                                      class="w-full px-5 py-4 border-3 border-green-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-green-50 to-emerald-50 @error('reply_message') border-red-500 @enderror resize-none"
                                      placeholder="📝 Type your reply here...">{{ old('reply_message') }}</textarea>
                            @error('reply_message')
                                <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 px-8 py-4 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 text-white rounded-xl hover:from-green-600 hover:via-emerald-600 hover:to-teal-600 transition font-black shadow-lg hover:shadow-xl transform hover:scale-105 text-lg uppercase tracking-wider flex items-center justify-center gap-2">
                                <span class="text-2xl">✉️</span> Send Reply & Notify
                            </button>
                            <a href="{{ route('admin.contacts.index') }}" class="flex-1 px-8 py-4 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition font-black shadow-lg hover:shadow-xl transform hover:scale-105 text-lg uppercase tracking-wider text-center flex items-center justify-center gap-2">
                                <span class="text-2xl">✕</span> Cancel
                            </a>
                        </div>
                    </form>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
    .prose {
        word-break: break-word;
        white-space: pre-wrap;
    }
</style>
@endsection
