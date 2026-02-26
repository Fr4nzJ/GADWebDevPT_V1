@extends('admin.layout')

@section('title', $statisticalYearbook->title . ' - GAD Admin Panel')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="title is-3">{{ $statisticalYearbook->title }}</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('admin.statistical-yearbooks.edit', $statisticalYearbook) }}" class="button is-warning">
                <span class="icon"><i class="fas fa-edit"></i></span>
                <span>Edit</span>
            </a>
            <a href="{{ route('admin.statistical-yearbooks.index') }}" class="button is-info">
                <span class="icon"><i class="fas fa-arrow-left"></i></span>
                <span>Back</span>
            </a>
        </div>
    </div>

    <div class="box">
        <div class="content">
            <!-- Description -->
            <div class="field">
                <label class="label">Description</label>
                <p>{{ $statisticalYearbook->description }}</p>
            </div>

            <!-- Details Grid -->
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Publication Date</label>
                        <p>{{ $statisticalYearbook->publication_date?->format('F d, Y') ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Number of Pages</label>
                        <p>{{ $statisticalYearbook->pages ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Format</label>
                        <p>{{ $statisticalYearbook->format ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Languages</label>
                        <p>{{ $statisticalYearbook->languages ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Download Size</label>
                        <p>{{ $statisticalYearbook->download_size ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Status</label>
                        <p>
                            @if ($statisticalYearbook->is_active)
                                <span class="tag is-success">Active</span>
                            @else
                                <span class="tag is-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- File Path -->
            @if ($statisticalYearbook->file_path)
                <div class="field">
                    <label class="label">File Path</label>
                    <p class="is-family-monospace">{{ $statisticalYearbook->file_path }}</p>
                </div>
            @endif

            <!-- Metadata -->
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Created</label>
                        <p>{{ $statisticalYearbook->created_at->format('F d, Y g:i A') }}</p>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="field">
                        <label class="label">Last Updated</label>
                        <p>{{ $statisticalYearbook->updated_at->format('F d, Y g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Button -->
    <div class="box is-danger">
        <form method="POST" action="{{ route('admin.statistical-yearbooks.destroy', $statisticalYearbook) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="button is-danger" onclick="return confirm('Are you sure you want to delete this yearbook? This action cannot be undone.')">
                <span class="icon"><i class="fas fa-trash"></i></span>
                <span>Delete Yearbook</span>
            </button>
        </form>
    </div>
</div>
@endsection
