@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
            ← Back to Contacts
        </a>
    </div>

    <!-- Header with Actions -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $contact->subject }}</h1>
            <div class="flex gap-2">
                @if($contact->status === 'new')
                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">New</span>
                @elseif($contact->status === 'read')
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">Read</span>
                @elseif($contact->status === 'replied')
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Replied</span>
                @else
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">Archived</span>
                @endif
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.contacts.edit', $contact) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Edit
            </a>
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" onsubmit="return confirm('Are you sure?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="bg-white rounded-lg shadow mb-6 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 border-b pb-6">
            <div>
                <p class="text-sm text-gray-500 font-semibold">From</p>
                <p class="text-lg font-medium text-gray-900">{{ $contact->name }}</p>
                <p class="text-sm text-gray-600">
                    <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">{{ $contact->email }}</a>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-semibold">Submitted</p>
                <p class="text-lg font-medium text-gray-900">{{ $contact->created_at->format('M d, Y H:i A') }}</p>
                <p class="text-sm text-gray-600">{{ $contact->created_at->diffForHumans() }}</p>
            </div>
        </div>

        @if($contact->replied_at)
            <div class="border-t pt-4 text-sm text-gray-600">
                <p><strong>Replied by:</strong> {{ $contact->repliedByUser->name ?? 'Unknown' }}</p>
                <p><strong>Replied at:</strong> {{ $contact->replied_at->format('M d, Y H:i A') }}</p>
            </div>
        @endif
    </div>

    <!-- Original Message -->
    <div class="bg-white rounded-lg shadow mb-6 p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Message</h2>
        <div class="prose prose-sm max-w-none bg-gray-50 rounded-lg p-4 text-gray-800">
            {!! nl2br(e($contact->message)) !!}
        </div>
    </div>

    <!-- Reply Section -->
    @if($contact->status !== 'replied' || true)
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                @if($contact->status === 'replied')
                    Existing Reply
                @else
                    Send Reply
                @endif
            </h2>

            @if($contact->status === 'replied' && $contact->reply_message)
                <div class="bg-green-50 rounded-lg p-4 mb-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-600 mb-3">
                        <strong>{{ $contact->repliedByUser->name ?? 'Admin' }}</strong> replied on <strong>{{ $contact->replied_at->format('M d, Y H:i A') }}</strong>
                    </p>
                    <div class="prose prose-sm max-w-none text-gray-800">
                        {!! nl2br(e($contact->reply_message)) !!}
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}" class="mt-6">
                    @csrf
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Send Another Reply</h3>
                    <div class="mb-4">
                        <label for="reply_message" class="block text-sm font-medium text-gray-700 mb-2">
                            Reply Message
                        </label>
                        <textarea id="reply_message" name="reply_message" rows="6" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('reply_message') border-red-500 @enderror"
                                  placeholder="Type your reply here..."></textarea>
                        @error('reply_message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Send Reply
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="reply_message" class="block text-sm font-medium text-gray-700 mb-2">
                            Reply Message
                        </label>
                        <textarea id="reply_message" name="reply_message" rows="8" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('reply_message') border-red-500 @enderror"
                                  placeholder="Type your reply here...">{{ old('reply_message') }}</textarea>
                        @error('reply_message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                            Send Reply & Notify
                        </button>
                        <a href="{{ route('admin.contacts.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                            Cancel
                        </a>
                    </div>
                </form>
            @endif
        </div>
    @endif

    <!-- Additional Actions -->
    <div class="mt-6 flex gap-2">
        @if($contact->status !== 'archived')
            <form method="POST" action="{{ route('admin.contacts.archive', $contact) }}" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    Archive
                </button>
            </form>
        @else
            <form method="POST" action="{{ route('admin.contacts.restore', $contact) }}" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Restore
                </button>
            </form>
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
