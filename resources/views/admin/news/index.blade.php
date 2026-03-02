@extends('admin.layout')

@section('title', 'Manage News - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Manage News</h1>
    <a href="{{ route('admin.news.create') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New News</span>
    </a>
</div>

<!-- ===== FILTER BAR ===== -->
<div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
    <div class="columns">
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search News</label>
                <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Enter keyword...">
                    <span class="icon is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Filter Status</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>All Status</option>
                            <option>Published</option>
                            <option>Draft</option>
                            <option>Archived</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-6-tablet is-4-desktop">
            <div class="field">
                <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Sort By</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select>
                            <option>Newest First</option>
                            <option>Oldest First</option>
                            <option>Title A-Z</option>
                            <option>Most Views</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== NEWS TABLE ===== -->
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">Title</th>
                <th style="padding: 1.25rem;">Author</th>
                <th style="padding: 1.25rem;">Date</th>
                <th style="padding: 1.25rem;">Category</th>
                <th style="padding: 1.25rem;">Views</th>
                <th style="padding: 1.25rem;">Status</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $article)
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">{{ Str::limit($article->title, 60) }}</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #667eea;">{{ $article->author }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="font-size: 0.9rem; color: #999;">{{ $article->created_at->format('M d, Y') }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="background: #e8f1ff; color: #667eea; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">{{ $article->category }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #999;"><i class="fas fa-eye"></i> {{ $article->views }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    @php
                        $statusClass = [
                            'published' => 'status-published',
                            'draft' => 'status-draft',
                            'pending' => 'status-pending',
                            'archived' => 'status-archived'
                        ][$article->status] ?? 'status-draft';
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ ucfirst($article->status) }}</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <a href="{{ route('admin.news.show', $article) }}" class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.news.edit', $article) }}" class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModal{{ $article->id }}').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: 2rem; text-align: center; border: none;">
                    <p style="color: #999; font-size: 1.1rem;">No news articles found. <a href="{{ route('admin.news.create') }}" style="color: #667eea; font-weight: 600;">Create one now</a></p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- ===== PAGINATION ===== -->
@if($news->count() > 0)
    <div style="display: flex; justify-content: center; margin-top: 2rem;">
        <style>
            .pagination {
                display: flex;
                list-style: none;
                gap: 0.5rem;
                padding: 0;
                margin: 0;
                justify-content: center;
                align-items: center;
            }
            .pagination li {
                display: inline-block;
            }
            .pagination li a, .pagination li span {
                display: inline-block;
                padding: 0.75rem 1rem;
                border-radius: 6px;
                background: white;
                border: 1px solid #e0e0e0;
                color: #667eea;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                min-width: 3rem;
                text-align: center;
            }
            .pagination li:first-child a,
            .pagination li:last-child a {
                color: transparent;
                pointer-events: none;
            }
            .pagination li:first-child,
            .pagination li:last-child {
                display: none;
            }
            .pagination li a:hover {
                background: #f0f0f0;
                border-color: #667eea;
            }
            .pagination li.active span {
                background: linear-gradient(135deg, #667eea, #764ba2);
                color: white;
                border-color: #667eea;
            }
            .pagination li.disabled span {
                color: #ccc;
                cursor: not-allowed;
                background: #f5f5f5;
                border-color: #eee;
            }
            /* Hide "Showing X to Y of Z results" text */
            .hidden.sm\:flex-1.sm\:flex {
                display: none !important;
            }
        </style>
        {{ $news->links() }}
    </div>
@endif

<!-- ===== DELETE MODALS ===== -->
@foreach($news as $article)
<div class="modal" id="deleteModal{{ $article->id }}">
    <div class="modal-background" x-data @click="document.getElementById('deleteModal{{ $article->id }}').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm Deletion
            </p>
            <button class="delete" x-data @click="document.getElementById('deleteModal{{ $article->id }}').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to delete <strong>{{ $article->title }}</strong>? This action cannot be undone.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Note:</strong> All associated data and comments will be permanently removed from the system.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" x-data @click="document.getElementById('deleteModal{{ $article->id }}').classList.remove('is-active')">
                Cancel
            </button>
            <form action="{{ route('admin.news.destroy', $article) }}" method="POST" style="display: inline;">
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
