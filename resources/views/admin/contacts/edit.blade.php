@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 py-12">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.contacts.show', $contact) }}" class="inline-flex items-center text-amber-600 hover:text-amber-800 font-bold text-lg transition transform hover:scale-105">
                ← Back to Contact
            </a>
        </div>

        <!-- Hero Header -->
        <div class="mb-10 bg-gradient-to-r from-amber-600 via-orange-600 to-red-600 text-white rounded-2xl shadow-2xl p-10 transform hover:scale-105 transition">
            <div class="flex items-center gap-4 mb-3">
                <div class="text-6xl animate-bounce">✏️</div>
                <div>
                    <h1 class="text-5xl font-black mb-1">Edit Contact</h1>
                    <p class="text-amber-100 text-lg font-semibold">From: <strong>{{ $contact->name }}</strong></p>
                    <p class="text-amber-100 text-lg font-semibold">{{ $contact->email }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-2xl p-10 border-2 border-orange-200 backdrop-blur-sm">
            <form method="POST" action="{{ route('admin.contacts.update', $contact) }}">
                @csrf
                @method('PUT')

                <!-- Name (Read-only) -->
                <div class="mb-6 p-5 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-3 border-gray-300">
                    <label for="name" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 mb-2 uppercase tracking-wider">
                        👤 Sender Name (Read-only)
                    </label>
                    <input type="text" id="name" value="{{ $contact->name }}" disabled
                           class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-200 text-gray-700 text-lg font-bold">
                </div>

                <!-- Email (Read-only) -->
                <div class="mb-6 p-5 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-3 border-gray-300">
                    <label for="email" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 mb-2 uppercase tracking-wider">
                        📧 Sender Email (Read-only)
                    </label>
                    <input type="email" id="email" value="{{ $contact->email }}" disabled
                           class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-200 text-gray-700 text-lg font-bold">
                </div>

                <!-- Subject -->
                <div class="mb-6 relative">
                    <label for="subject" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 mb-3 uppercase tracking-wider">
                        📝 Subject <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject', $contact->subject) }}"
                           class="w-full px-5 py-4 border-3 border-orange-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-orange-50 to-red-50 @error('subject') border-red-500 @enderror"
                           required>
                    @error('subject')
                        <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="mb-6 relative">
                    <label for="message" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 mb-3 uppercase tracking-wider">
                        💬 Message <span class="text-red-500">*</span>
                    </label>
                    <textarea id="message" name="message" rows="12"
                              class="w-full px-5 py-4 border-3 border-orange-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-orange-50 to-red-50 @error('message') border-red-500 @enderror resize-none"
                              required>{{ old('message', $contact->message) }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                    @enderror
                </div>

                <!-- Status (Read-only) -->
                <div class="mb-6 p-5 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-3 border-gray-300">
                    <label for="status" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 mb-2 uppercase tracking-wider">
                        🏷️ Status (Read-only)
                    </label>
                    <input type="text" id="status" value="{{ ucfirst($contact->status) }}" disabled
                           class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-200 text-gray-700 text-lg font-bold">
                </div>

                <!-- Additional Info -->
                <div class="mb-8 bg-gradient-to-br from-amber-100 via-orange-100 to-red-100 rounded-2xl p-7 border-l-8 border-orange-600 shadow-lg">
                    <h3 class="font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-800 to-orange-800 mb-4 text-2xl">📋 Contact Information</h3>
                    <div class="space-y-3">
                        <p class="text-gray-800 font-bold text-lg"><span class="text-2xl">🌐</span> <strong>IP Address:</strong> {{ $contact->ip_address ?? '❌ Not recorded' }}</p>
                        <p class="text-gray-800 font-bold text-lg"><span class="text-2xl">📅</span> <strong>Submitted:</strong> {{ $contact->created_at->format('M d, Y H:i A') }}</p>
                        <p class="text-gray-800 font-bold text-lg"><span class="text-2xl">✓</span> <strong>Verified:</strong> {{ $contact->is_verified ? '✅ Yes' : '❌ No' }}</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-8 border-t-3 border-orange-200">
                    <button type="submit" class="flex-1 px-8 py-5 bg-gradient-to-r from-amber-600 via-orange-600 to-red-600 text-white rounded-xl hover:from-amber-700 hover:via-orange-700 hover:to-red-700 transition font-black shadow-lg hover:shadow-2xl transform hover:scale-105 text-lg uppercase tracking-wider flex items-center justify-center gap-2">
                        <span class="text-2xl">✅</span> Save Changes
                    </button>
                    <a href="{{ route('admin.contacts.show', $contact) }}" class="flex-1 px-8 py-5 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition font-black shadow-lg hover:shadow-xl transform hover:scale-105 text-lg uppercase tracking-wider text-center flex items-center justify-center gap-2">
                        <span class="text-2xl">✕</span> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
