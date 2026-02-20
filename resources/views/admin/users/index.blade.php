@extends('admin.layout')

@section('title', 'Manage Users - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Manage Users</h1>
    <a href="{{ route('admin.users.create') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New User</span>
    </a>
</div>

<!-- ===== FILTER BAR ===== -->
<div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <div class="columns">
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Users</label>
                <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Name or email...">
                    <span class="icon is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">User Role</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Roles</option>
                            <option>Administrator</option>
                            <option>Editor</option>
                            <option>Contributor</option>
                            <option>Viewer</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Status</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>Suspended</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== USERS TABLE ===== -->
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">User Name</th>
                <th style="padding: 1.25rem;">Email</th>
                <th style="padding: 1.25rem;">Role</th>
                <th style="padding: 1.25rem;">Department</th>
                <th style="padding: 1.25rem;">Status</th>
                <th style="padding: 1.25rem;">Last Login</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <div style="display: flex; align-items: center;">
                        @php
                            $initials = strtoupper(substr($user->name, 0, 1)) . strtoupper(substr(strrchr($user->name, ' '), 1, 1));
                            $colors = ['#667eea', '#48c774', '#f0ad4e', '#e74c3c', '#764ba2', '#3273dc'];
                            $colorIndex = abs(crc32($user->id)) % count($colors);
                            $bgColor = $colors[$colorIndex];
                        @endphp
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $bgColor }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 1rem; font-size: 0.9rem;">
                            {{ $initials }}
                        </div>
                        <strong style="color: #2c3e50;">{{ $user->name }}</strong>
                    </div>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">{{ $user->email }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f1ff; color: #667eea; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">User</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">General</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f5e9; color: #48c774; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">Active</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;">{{ $user->created_at->format('M d, Y') }}</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <a href="{{ route('admin.users.show', $user) }}" class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalUser{{ $user->id }}').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: 2rem; text-align: center; border: none;">
                    <p style="color: #999; font-size: 1.1rem;">No users found. <a href="{{ route('admin.users.create') }}" style="color: #667eea; font-weight: 600;">Create one now</a></p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- ===== PAGINATION ===== -->
<nav class="pagination is-centered" role="navigation" aria-label="pagination" style="margin-top: 2rem;">
    <a class="pagination-previous">Previous</a>
    <a class="pagination-next">Next page</a>
    <ul class="pagination-list">
        <li><a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a></li>
        <li><a class="pagination-link">2</a></li>
        <li><a class="pagination-link">3</a></li>
    </ul>
</nav>

<!-- ===== DELETE MODALS ===== -->
@foreach($users as $user)
<div class="modal" id="deleteModalUser{{ $user->id }}">
    <div class="modal-background" x-data @click="document.getElementById('deleteModalUser{{ $user->id }}').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm User Deletion
            </p>
            <button class="delete" x-data @click="document.getElementById('deleteModalUser{{ $user->id }}').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to delete <strong>{{ $user->name }}</strong>? This action cannot be undone.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Warning:</strong> The user will lose access immediately. All activities and assignments will be logged in the system archive.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" x-data @click="document.getElementById('deleteModalUser{{ $user->id }}').classList.remove('is-active')">
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
@endforeach

@endsection
