@extends('admin.layout')

@section('title', 'View User - GAD Admin Panel')

@section('content')
<div class="page-header" style="display: flex; align-items: center; gap: 1rem; justify-content: space-between;">
    <h1 class="page-title">User Profile</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('admin.users.edit', $user) }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
            <span class="icon"><i class="fas fa-edit"></i></span>
            <span>Edit</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="button is-light">
            <span class="icon"><i class="fas fa-arrow-left"></i></span>
            <span>Back</span>
        </a>
    </div>
</div>

<div class="columns">
    <!-- Main Info -->
    <div class="column is-8">
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h2 style="color: #2c3e50; font-size: 1.8rem; margin-bottom: 1.5rem; display: flex; align-items: center;">
                @php
                    $initials = strtoupper(substr($user->name, 0, 1)) . strtoupper(substr(strrchr($user->name, ' '), 1, 1));
                    $colors = ['#667eea', '#48c774', '#f0ad4e', '#e74c3c', '#764ba2', '#3273dc'];
                    $colorIndex = abs(crc32($user->id)) % count($colors);
                    $bgColor = $colors[$colorIndex];
                @endphp
                <div style="width: 60px; height: 60px; border-radius: 50%; background: {{ $bgColor }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1.5rem; font-size: 1.3rem;">
                    {{ $initials }}
                </div>
                {{ $user->name }}
            </h2>

            <div style="background: #f5f7ff; border-left: 4px solid #667eea; padding: 1.5rem; border-radius: 6px;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem;">
                    <div>
                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Email Address</strong></p>
                        <p style="color: #2c3e50; font-weight: 500;">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>Account Status</strong></p>
                        <p style="color: #2c3e50;">
                            <span style="background: #e8f5e9; color: #48c774; padding: 0.35rem 0.75rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem;">Active</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Timeline -->
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h3 style="color: #2c3e50; font-weight: bold; margin-bottom: 1.5rem;">Account Timeline</h3>
            
            <div style="border-left: 2px solid #667eea; padding-left: 2rem; position: relative;">
                <!-- Created -->
                <div style="margin-bottom: 2rem; position: relative;">
                    <div style="width: 14px; height: 14px; background: #667eea; border-radius: 50%; position: absolute; left: -2.4rem; top: 0.3rem;"></div>
                    <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.25rem;">Account Created</p>
                    <p style="color: #2c3e50; font-weight: 600;">{{ $user->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>

                @if($user->created_at->ne($user->updated_at))
                <!-- Last Updated -->
                <div style="position: relative;">
                    <div style="width: 14px; height: 14px; background: #48c774; border-radius: 50%; position: absolute; left: -2.4rem; top: 0.3rem;"></div>
                    <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.25rem;">Last Modified</p>
                    <p style="color: #2c3e50; font-weight: 600;">{{ $user->updated_at->format('F d, Y \a\t g:i A') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="column is-4">
        <!-- Quick Actions -->
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h4 style="color: #667eea; font-weight: bold; margin-bottom: 1rem;">Quick Actions</h4>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <a href="{{ route('admin.users.edit', $user) }}" class="button" style="background: #667eea; color: white; border: none; justify-content: center;">
                    <span class="icon"><i class="fas fa-edit"></i></span>
                    <span>Edit User</span>
                </a>
                <button class="button" style="background: #e74c3c; color: white; border: none; justify-content: center;" x-data @click="document.getElementById('deleteModal').classList.add('is-active')">
                    <span class="icon"><i class="fas fa-trash"></i></span>
                    <span>Delete User</span>
                </button>
            </div>
        </div>

        <!-- User ID -->
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h4 style="color: #667eea; font-weight: bold; margin-bottom: 1rem;">System Information</h4>
            <div>
                <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.5rem;"><strong>User ID</strong></p>
                <p style="color: #2c3e50; font-family: monospace; background: #f5f7ff; padding: 0.75rem; border-radius: 6px;">{{ $user->id }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-background" x-data @click="document.getElementById('deleteModal').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm User Deletion
            </p>
            <button class="delete" x-data @click="document.getElementById('deleteModal').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to permanently delete <strong>{{ $user->name }}</strong>? This action cannot be undone.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Warning:</strong> This user will lose access to the system immediately. All user data will be permanently removed.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" x-data @click="document.getElementById('deleteModal').classList.remove('is-active')">
                Cancel
            </button>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger" style="background: #e74c3c; color: white;">
                    <span class="icon"><i class="fas fa-trash"></i></span>
                    <span>Delete User</span>
                </button>
            </form>
        </footer>
    </div>
</div>

@endsection
