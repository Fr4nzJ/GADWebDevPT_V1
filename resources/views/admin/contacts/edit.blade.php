@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-800 font-medium">
            ← Back to Contact
        </a>
    </div>

    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Contact</h1>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.contacts.update', $contact) }}">
            @csrf
            @method('PUT')

            <!-- Name (Read-only) -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Sender Name (Read-only)
                </label>
                <input type="text" id="name" value="{{ $contact->name }}" disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <!-- Email (Read-only) -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Sender Email (Read-only)
                </label>
                <input type="email" id="email" value="{{ $contact->email }}" disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <!-- Subject -->
            <div class="mb-6">
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                    Subject <span class="text-red-500">*</span>
                </label>
                <input type="text" id="subject" name="subject" value="{{ old('subject', $contact->subject) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('subject') border-red-500 @enderror"
                       required>
                @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Message -->
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                    Message <span class="text-red-500">*</span>
                </label>
                <textarea id="message" name="message" rows="10"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('message') border-red-500 @enderror"
                          required>{{ old('message', $contact->message) }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status (Read-only) -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status (Read-only)
                </label>
                <input type="text" id="status" value="{{ ucfirst($contact->status) }}" disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <!-- Additional Info -->
            <div class="mb-6 bg-gray-50 rounded-lg p-4 text-sm text-gray-600">
                <p><strong>IP Address:</strong> {{ $contact->ip_address ?? 'Not recorded' }}</p>
                <p><strong>Submitted:</strong> {{ $contact->created_at->format('M d, Y H:i A') }}</p>
                <p><strong>Verified:</strong> {{ $contact->is_verified ? 'Yes' : 'No' }}</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Save Changes
                </button>
                <a href="{{ route('admin.contacts.show', $contact) }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
