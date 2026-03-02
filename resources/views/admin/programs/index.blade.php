@extends('admin.layout')

@section('title', 'Manage Programs - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Manage Programs</h1>
    <a href="{{ route('admin.programs.create') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New Program</span>
    </a>
</div>

<!-- ===== SUCCESS MESSAGE ===== -->
@if(session('success'))
<div class="notification is-success" style="background: #e8f8f0; border-left: 4px solid #48c774; color: #2c3e50;">
    <button class="delete"></button>
    {{ session('success') }}
</div>
@endif

<!-- ===== FILTER BAR ===== -->
<div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
    <form method="GET" action="{{ route('admin.programs.index') }}">
        <div class="columns">
            <div class="column is-6-tablet is-4-desktop">
                <div class="field">
                    <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Programs</label>
                    <div class="control has-icons-left">
                        <input class="input" type="text" placeholder="Enter program name..." name="search" value="{{ request('search') }}">
                        <span class="icon is-left">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="column is-6-tablet is-4-desktop">
                <div class="field">
                    <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Category</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="category">
                                <option value="">All Categories</option>
                                <option value="women_empowerment" {{ request('category') === 'women_empowerment' ? 'selected' : '' }}>Women Empowerment</option>
                                <option value="education" {{ request('category') === 'education' ? 'selected' : '' }}>Education & Skills</option>
                                <option value="safety" {{ request('category') === 'safety' ? 'selected' : '' }}>Safety & Protection</option>
                                <option value="leadership" {{ request('category') === 'leadership' ? 'selected' : '' }}>Leadership</option>
                                <option value="lgbtq" {{ request('category') === 'lgbtq' ? 'selected' : '' }}>LGBTQ+ Rights</option>
                                <option value="mainstreaming" {{ request('category') === 'mainstreaming' ? 'selected' : '' }}>Mainstreaming</option>
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
                            <select name="status">
                                <option value="">All Status</option>
                                <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns mt-2">
            <div class="column">
                <button type="submit" class="button" style="background: #667eea; color: white; border: none; font-weight: 600;">
                    <span class="icon"><i class="fas fa-search"></i></span>
                    <span>Search</span>
                </button>
                @if(request('search') || request('category') || request('status'))
                    <a href="{{ route('admin.programs.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
                        <span class="icon"><i class="fas fa-times"></i></span>
                        <span>Clear Filters</span>
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<!-- ===== PROGRAMS TABLE ===== -->
@if($programs->count() > 0)
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">Program Name</th>
                <th style="padding: 1.25rem;">Category</th>
                <th style="padding: 1.25rem;">Duration</th>
                <th style="padding: 1.25rem;">Beneficiaries</th>
                <th style="padding: 1.25rem;">Budget (PHP)</th>
                <th style="padding: 1.25rem;">Status</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">{{ $program->title }}</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f1ff; color: #667eea; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                        {{ $program->category_display }}
                    </span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666; font-size: 0.9rem;">
                        {{ $program->start_date->format('M d, Y') }}
                        @if($program->end_date)
                            - {{ $program->end_date->format('M d, Y') }}
                        @else
                            - Ongoing
                        @endif
                    </span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea; font-weight: 500;">{{ number_format($program->beneficiaries) }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="font-weight: 600; color: #2c3e50;">₱{{ number_format($program->budget) }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span class="status-badge" style="background: {{ $program->status_bg }}; color: {{ $program->status_color }}; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; text-transform: capitalize;">
                        {{ $program->status }}
                    </span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons" style="display: flex; gap: 0.5rem; justify-content: center;">
                        <a href="{{ route('admin.programs.show', $program) }}" class="btn-action btn-view" title="View" style="background: #e8f1ff; color: #667eea; padding: 0.5rem 0.75rem; border-radius: 6px; border: none; cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.programs.edit', $program) }}" class="btn-action btn-edit" title="Edit" style="background: #fff8e1; color: #f0ad4e; padding: 0.5rem 0.75rem; border-radius: 6px; border: none; cursor: pointer;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-action btn-delete" onclick="document.getElementById('deleteModal{{ $program->id }}').classList.add('is-active')" title="Delete" style="background: #ffe8e8; color: #e74c3c; padding: 0.5rem 0.75rem; border-radius: 6px; border: none; cursor: pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ===== PAGINATION ===== -->
<div style="margin-top: 2rem; display: flex; justify-content: center;">
    {{ $programs->links() }}
</div>
@else
<div style="background: #f5f7ff; padding: 3rem; border-radius: 12px; text-align: center;">
    <p style="color: #667eea; font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem;">
        <i class="fas fa-inbox"></i> No Programs Found
    </p>
    <p style="color: #666; margin-bottom: 2rem;">Start by adding your first program to get started.</p>
    <a href="{{ route('admin.programs.create') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Create First Program</span>
    </a>
</div>
@endif

<!-- ===== DELETE MODALS ===== -->
@foreach($programs as $program)
<div class="modal" id="deleteModal{{ $program->id }}">
    <div class="modal-background" onclick="document.getElementById('deleteModal{{ $program->id }}').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm Deletion
            </p>
            <button class="delete" onclick="document.getElementById('deleteModal{{ $program->id }}').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to delete <strong>{{ $program->title }}</strong>? All associated data will be permanently removed.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Warning:</strong> This action cannot be undone. All program records will be deleted.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" onclick="document.getElementById('deleteModal{{ $program->id }}').classList.remove('is-active')">
                Cancel
            </button>
            <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger" style="background: #e74c3c; color: white;">
                    <span class="icon"><i class="fas fa-trash"></i></span>
                    <span>Delete</span>
                </button>
            </form>
        </footer>
    </div>
</div>
@endforeach

@endsection
