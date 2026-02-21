@extends('admin.layout')

@section('title', 'Manage Reports - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Manage Reports</h1>
    <a href="{{ route('admin.reports.create') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New Report</span>
    </a>
</div>

<!-- ===== FILTER BAR ===== -->
<form method="GET" action="{{ route('admin.reports.index') }}" id="filterForm">
    <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
        <div class="columns">
            <div class="column is-6-tablet is-3-desktop">
                <div class="field">
                    <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Reports</label>
                    <div class="control has-icons-left">
                        <input class="input" type="text" name="search" placeholder="Title or keyword..." value="{{ request('search', '') }}">
                        <span class="icon is-left">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="column is-6-tablet is-3-desktop">
                <div class="field">
                    <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Year</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="year" onchange="document.getElementById('filterForm').submit();">
                                <option value="all" {{ request('year', 'all') === 'all' ? 'selected' : '' }}>All Years</option>
                                @for($year = date('Y'); $year >= 2020; $year--)
                                    <option value="{{ $year }}" {{ request('year') === (string)$year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-6-tablet is-3-desktop">
                <div class="field">
                    <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Type</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="type" onchange="document.getElementById('filterForm').submit();">
                                <option value="all" {{ request('type', 'all') === 'all' ? 'selected' : '' }}>All Types</option>
                                <option value="Survey" {{ request('type') === 'Survey' ? 'selected' : '' }}>Survey</option>
                                <option value="Analysis" {{ request('type') === 'Analysis' ? 'selected' : '' }}>Analysis</option>
                                <option value="Research Study" {{ request('type') === 'Research Study' ? 'selected' : '' }}>Research Study</option>
                                <option value="Assessment" {{ request('type') === 'Assessment' ? 'selected' : '' }}>Assessment</option>
                                <option value="Baseline Study" {{ request('type') === 'Baseline Study' ? 'selected' : '' }}>Baseline Study</option>
                                <option value="Audit" {{ request('type') === 'Audit' ? 'selected' : '' }}>Audit</option>
                                <option value="Budget Analysis" {{ request('type') === 'Budget Analysis' ? 'selected' : '' }}>Budget Analysis</option>
                                <option value="Health Study" {{ request('type') === 'Health Study' ? 'selected' : '' }}>Health Study</option>
                                <option value="Impact Study" {{ request('type') === 'Impact Study' ? 'selected' : '' }}>Impact Study</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-6-tablet is-3-desktop">
                <div class="field">
                    <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Status</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="status" onchange="document.getElementById('filterForm').submit();">
                                <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns" style="margin-top: 1rem;">
            <div class="column">
                <button type="submit" class="button" style="background: #667eea; color: white; border: none; font-weight: 600;">
                    <span class="icon"><i class="fas fa-search"></i></span>
                    <span>Search</span>
                </button>
                @if(request('search') || request('year', 'all') !== 'all' || request('type', 'all') !== 'all' || request('status', 'all') !== 'all')
                    <a href="{{ route('admin.reports.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
                        <span class="icon"><i class="fas fa-times"></i></span>
                        <span>Clear Filters</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</form>

<!-- ===== REPORTS TABLE ===== -->
<div class="admin-table">
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th style="padding: 1.25rem;">Report Title</th>
                <th style="padding: 1.25rem;">Year</th>
                <th style="padding: 1.25rem;">Type</th>
                <th style="padding: 1.25rem;">Description</th>
                <th style="padding: 1.25rem;">Status</th>
                <th style="padding: 1.25rem; text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
            <tr>
                <td style="padding: 1.25rem; border: none;">
                    <strong style="color: #2c3e50;">{{ $report->title }}</strong>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">{{ $report->year }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    @php
                        $typeColors = [
                            'Survey' => ['bg' => '#e8f1ff', 'text' => '#667eea'],
                            'Analysis' => ['bg' => '#fff8e1', 'text' => '#f0ad4e'],
                            'Research Study' => ['bg' => '#ffe8e8', 'text' => '#e74c3c'],
                            'Assessment' => ['bg' => '#e8f8f0', 'text' => '#48c774'],
                            'Baseline Study' => ['bg' => '#e8f1ff', 'text' => '#667eea'],
                            'Audit' => ['bg' => '#fff8e1', 'text' => '#f0ad4e'],
                            'Budget Analysis' => ['bg' => '#e8f1ff', 'text' => '#667eea'],
                            'Health Study' => ['bg' => '#ffe8e8', 'text' => '#e74c3c'],
                            'Impact Study' => ['bg' => '#e8f8f0', 'text' => '#48c774'],
                        ];
                        $typeColor = $typeColors[$report->type] ?? ['bg' => '#f5f5f5', 'text' => '#999'];
                    @endphp
                    <span style="background: {{ $typeColor['bg'] }}; color: {{ $typeColor['text'] }}; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">{{ $report->type }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    <span style="color: #666;">{{ \Illuminate\Support\Str::limit($report->description, 80) }}</span>
                </td>
                <td style="padding: 1.25rem; border: none;">
                    @php
                        $statusColors = [
                            'draft' => ['bg' => '#f5f5f5', 'text' => '#999'],
                            'published' => ['bg' => '#e8f5e9', 'text' => '#48c774'],
                            'archived' => ['bg' => '#fff8e1', 'text' => '#f0ad4e'],
                        ];
                        $statusColor = $statusColors[$report->status] ?? ['bg' => '#f5f5f5', 'text' => '#999'];
                    @endphp
                    <span style="background: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }}; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">{{ ucfirst($report->status) }}</span>
                </td>
                <td style="padding: 1.25rem; border: none; text-align: center;">
                    <div class="action-buttons">
                        <a href="{{ route('admin.reports.show', $report) }}" class="btn-action btn-view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.reports.edit', $report) }}" class="btn-action btn-edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-action btn-delete" x-data @click="document.getElementById('deleteModalReport{{ $report->id }}').classList.add('is-active')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 2rem; text-align: center; border: none;">
                    <p style="color: #999; font-size: 1.1rem;">No reports found. <a href="{{ route('admin.reports.create') }}" style="color: #667eea; font-weight: 600;">Create one now</a></p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- ===== PAGINATION ===== -->
<div style="margin-top: 2rem; display: flex; justify-content: center;">
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
    {{ $reports->links() }}
</div>

<!-- ===== DELETE MODALS ===== -->
@foreach($reports as $report)
<div class="modal" id="deleteModalReport{{ $report->id }}">
    <div class="modal-background" x-data @click="document.getElementById('deleteModalReport{{ $report->id }}').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm Report Deletion
            </p>
            <button class="delete" x-data @click="document.getElementById('deleteModalReport{{ $report->id }}').classList.remove('is-active')"></button>
        </header>
        <section class="modal-card-body" style="padding: 2rem;">
            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                Are you sure you want to delete <strong>{{ $report->title }}</strong>? This action cannot be undone.
            </p>
            <p style="background: #fff8e1; border-left: 4px solid #f0ad4e; padding: 1rem; border-radius: 6px; color: #666; font-size: 0.9rem;">
                <strong>Warning:</strong> The report will be permanently deleted from the system.
            </p>
        </section>
        <footer class="modal-card-foot" style="border-top: 2px solid #f0f0f0; padding: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
            <button class="button" x-data @click="document.getElementById('deleteModalReport{{ $report->id }}').classList.remove('is-active')">
                Cancel
            </button>
            <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger" style="background: #e74c3c; color: white;">
                    <span class="icon"><i class="fas fa-trash"></i></span>
                    <span>Delete Report</span>
                </button>
            </form>
        </footer>
    </div>
</div>
@endforeach

@endsection
