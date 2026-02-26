@extends('layouts.app')

@section('title', 'Statistical Yearbooks Management')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="title is-3">Statistical Yearbooks</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.statistical-yearbooks.create') }}" class="button is-primary">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Add New Yearbook</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="notification is-success is-light">
            <button class="delete"></button>
            {{ session('success') }}
        </div>
    @endif

    @if ($yearbooks->count())
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Publication Date</th>
                        <th>Pages</th>
                        <th>Format</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($yearbooks as $yearbook)
                        <tr>
                            <td><strong>{{ $yearbook->title }}</strong></td>
                            <td>{{ $yearbook->publication_date?->format('M d, Y') ?? '-' }}</td>
                            <td>{{ $yearbook->pages ?? '-' }}</td>
                            <td>{{ $yearbook->format ?? '-' }}</td>
                            <td>
                                @if ($yearbook->is_active)
                                    <span class="tag is-success">Active</span>
                                @else
                                    <span class="tag is-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.statistical-yearbooks.show', $yearbook) }}" class="button is-small is-info is-outlined">
                                    <span class="icon is-small"><i class="fas fa-eye"></i></span>
                                </a>
                                <a href="{{ route('admin.statistical-yearbooks.edit', $yearbook) }}" class="button is-small is-warning is-outlined">
                                    <span class="icon is-small"><i class="fas fa-edit"></i></span>
                                </a>
                                <form method="POST" action="{{ route('admin.statistical-yearbooks.destroy', $yearbook) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-small is-danger is-outlined" onclick="return confirm('Are you sure?')">
                                        <span class="icon is-small"><i class="fas fa-trash"></i></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav class="pagination is-centered mt-4" role="navigation">
            {{ $yearbooks->links() }}
        </nav>
    @else
        <div class="notification is-info is-light">
            <p><strong>No yearbooks found.</strong></p>
            <p>Start by <a href="{{ route('admin.statistical-yearbooks.create') }}">creating a new statistical yearbook</a>.</p>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        (document.querySelectorAll('.notification .delete') || []).forEach(function($delete) {
            var $notification = $delete.parentNode;
            $delete.addEventListener('click', function() {
                $notification.parentNode.removeChild($notification);
            });
        });
    });
</script>
@endsection
