@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-bold text-lg transition transform hover:scale-105">
                ← Back to Contacts
            </a>
        </div>

        <!-- Hero Header -->
        <div class="mb-10 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white rounded-2xl shadow-2xl p-10 transform hover:scale-105 transition">
            <div class="flex items-center gap-4 mb-3">
                <div class="text-6xl animate-pulse">✏️</div>
                <div>
                    <h1 class="text-5xl font-black mb-1">Create Contact</h1>
                    <p class="text-indigo-100 text-lg font-semibold">Add a new message to your contact system</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-2xl p-10 border-2 border-purple-200 backdrop-blur-sm">
            <form method="POST" action="{{ route('admin.contacts.store') }}">
                @csrf

                <!-- Form Fields Grid -->
                <div class="space-y-6">
                    <!-- Name -->
                    <div class="relative">
                        <label for="name" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-3 uppercase tracking-wider">
                            👤 Sender Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="w-full px-5 py-4 border-3 border-purple-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-purple-50 to-pink-50 @error('name') border-red-500 @enderror"
                               placeholder="👤 Enter sender's full name"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <label for="email" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-3 uppercase tracking-wider">
                            📧 Sender Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="w-full px-5 py-4 border-3 border-purple-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-purple-50 to-pink-50 @error('email') border-red-500 @enderror"
                               placeholder="📧 Enter sender's email address"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div class="relative">
                        <label for="subject" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-3 uppercase tracking-wider">
                            📝 Subject <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                               class="w-full px-5 py-4 border-3 border-purple-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-purple-50 to-pink-50 @error('subject') border-red-500 @enderror"
                               placeholder="📝 Enter the subject line"
                               required>
                        @error('subject')
                            <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="relative">
                        <label for="message" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-3 uppercase tracking-wider">
                            💬 Message <span class="text-red-500">*</span>
                        </label>
                        <textarea id="message" name="message" rows="12"
                                  class="w-full px-5 py-4 border-3 border-purple-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-purple-50 to-pink-50 @error('message') border-red-500 @enderror resize-none"
                                  placeholder="💬 Enter the contact message"
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="relative">
                        <label for="status" class="block text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-3 uppercase tracking-wider">
                            🏷️ Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" 
                                class="w-full px-5 py-4 border-3 border-purple-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition text-lg font-semibold bg-gradient-to-r from-purple-50 to-pink-50 @error('status') border-red-500 @enderror"
                                required>
                            <option value="new" {{ old('status', 'new') === 'new' ? 'selected' : '' }}>🆕 New</option>
                            <option value="read" {{ old('status') === 'read' ? 'selected' : '' }}>👁️ Read</option>
                            <option value="replied" {{ old('status') === 'replied' ? 'selected' : '' }}>✅ Replied</option>
                            <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>📦 Archived</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-2 font-bold">❌ {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-8 border-t-3 border-purple-200">
                    <button type="submit" class="flex-1 px-8 py-5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white rounded-xl hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition font-black shadow-lg hover:shadow-2xl transform hover:scale-105 text-lg uppercase tracking-wider flex items-center justify-center gap-2">
                        <span class="text-2xl">✅</span> Create Contact
                    </button>
                    <a href="{{ route('admin.contacts.index') }}" class="flex-1 px-8 py-5 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition font-black shadow-lg hover:shadow-xl transform hover:scale-105 text-lg uppercase tracking-wider text-center flex items-center justify-center gap-2">
                        <span class="text-2xl">✕</span> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
