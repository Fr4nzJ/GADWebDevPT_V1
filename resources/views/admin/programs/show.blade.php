@extends('admin.layout')

@section('title', 'View Program - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">{{ $program->title }}</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('admin.programs.edit', $program) }}" class="button" style="background: #fff8e1; color: #f0ad4e; border: none; font-weight: 600;">
            <span class="icon"><i class="fas fa-edit"></i></span>
            <span>Edit</span>
        </a>
        <a href="{{ route('admin.programs.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
            <span class="icon"><i class="fas fa-arrow-left"></i></span>
            <span>Back to Programs</span>
        </a>
    </div>
</div>

<!-- ===== PROGRAM DETAILS ===== -->
<div class="columns is-multiline">
    <!-- Main Content -->
    <div class="column is-8">
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h3 class="title is-5" style="color: #667eea; border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">Program Overview</h3>
            <p style="color: #666; line-height: 1.8;">{{ $program->description }}</p>
        </div>

        @if($program->objectives && count($program->objectives) > 0)
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h3 class="title is-5" style="color: #667eea; border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">Objectives</h3>
            <ul style="margin-left: 1.5rem; color: #666; line-height: 1.8;">
                @foreach($program->objectives as $objective)
                <li style="margin-bottom: 0.75rem;">{{ $objective }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($program->target_group)
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h3 class="title is-5" style="color: #667eea; border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">Target Beneficiaries</h3>
            <p style="color: #666; line-height: 1.8;">{{ $program->target_group }}</p>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="column is-4">
        <!-- Program Info Card -->
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h3 class="title is-6" style="color: #667eea; margin-bottom: 1.5rem;">Program Information</h3>

            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">Category</p>
                <p style="color: #2c3e50; font-weight: 500;">{{ $program->category_display }}</p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">Status</p>
                <span style="background: {{ $program->status_bg }}; color: {{ $program->status_color }}; padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; text-transform: capitalize;">
                    {{ $program->status }}
                </span>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">Start Date</p>
                <p style="color: #2c3e50; font-weight: 500;">{{ $program->start_date->format('F d, Y') }}</p>
            </div>

            @if($program->end_date)
            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">End Date</p>
                <p style="color: #2c3e50; font-weight: 500;">{{ $program->end_date->format('F d, Y') }}</p>
            </div>
            @endif
        </div>

        <!-- Financial Info Card -->
        <div style="background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%); border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h3 class="title is-6" style="color: #667eea; margin-bottom: 1.5rem;">Financial Information</h3>

            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">Total Budget</p>
                <p style="color: #2c3e50; font-weight: 700; font-size: 1.5rem;">₱{{ number_format($program->budget) }}</p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <p style="font-size: 0.85rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">Number of Beneficiaries</p>
                <p style="color: #2c3e50; font-weight: 700; font-size: 1.5rem;">{{ number_format($program->beneficiaries) }}</p>
            </div>

            @if($program->budget > 0 && $program->beneficiaries > 0)
            <div style="border-top: 1px solid rgba(102, 126, 234, 0.2); padding-top: 1rem;margin-top: 1rem;">
                <p style="font-size: 0.85rem; color: #999; margin-bottom: 0.25rem; font-weight: 600;">Per Beneficiary</p>
                <p style="color: #667eea; font-weight: 600;">₱{{ number_format($program->budget / $program->beneficiaries, 2) }}</p>
            </div>
            @endif
        </div>

        <!-- Location Card -->
        @if($program->location)
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;">
            <h3 class="title is-6" style="color: #667eea; margin-bottom: 1rem;">
                <i class="fas fa-map-marker-alt"></i> Location
            </h3>
            <p style="color: #2c3e50; font-weight: 500;">{{ $program->location }}</p>
        </div>
        @endif

        <!-- Metadata Card -->
        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h3 class="title is-6" style="color: #999; margin-bottom: 1.5rem; font-size: 0.85rem;">Metadata</h3>

            <div style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #f0f0f0;">
                <p style="font-size: 0.8rem; color: #999; margin-bottom: 0.25rem;">Created</p>
                <p style="color: #2c3e50; font-weight: 500; font-size: 0.9rem;">{{ $program->created_at->format('F d, Y H:i') }}</p>
            </div>

            <div>
                <p style="font-size: 0.8rem; color: #999; margin-bottom: 0.25rem;">Last Updated</p>
                <p style="color: #2c3e50; font-weight: 500; font-size: 0.9rem;">{{ $program->updated_at->format('F d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div style="display: flex; gap: 1rem; margin-top: 2rem;">
    <a href="{{ route('admin.programs.edit', $program) }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600; padding: 0.75rem 2rem;">
        <span class="icon"><i class="fas fa-edit"></i></span>
        <span>Edit Program</span>
    </a>
    <button onclick="document.getElementById('deleteModal').classList.add('is-active')" class="button is-danger" style="background: #e74c3c; color: white; font-weight: 600; padding: 0.75rem 2rem;">
        <span class="icon"><i class="fas fa-trash"></i></span>
        <span>Delete</span>
    </button>
</div>

<!-- Delete Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-background" onclick="document.getElementById('deleteModal').classList.remove('is-active')"></div>
    <div class="modal-card">
        <header class="modal-card-head" style="border-bottom: 2px solid #f0f0f0;">
            <p class="modal-card-title" style="color: #2c3e50; font-weight: 700;">
                <i class="fas fa-exclamation-circle" style="color: #e74c3c; margin-right: 0.5rem;"></i>
                Confirm Deletion
            </p>
            <button class="delete" onclick="document.getElementById('deleteModal').classList.remove('is-active')"></button>
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
            <button class="button" onclick="document.getElementById('deleteModal').classList.remove('is-active')">
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

@endsection
