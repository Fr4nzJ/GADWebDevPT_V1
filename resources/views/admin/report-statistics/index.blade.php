@extends('admin.layout')

@section('title', 'Manage Report Statistics')

@section('content')
<div class="page-header">
    <h1 class="page-title">Report Statistics</h1>
    <a href="{{ route('admin.report-statistics.create') }}" class="button is-primary">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add Statistic</span>
    </a>
</div>

@if ($message = session('success'))
    <div class="notification is-success">
        <button class="delete"></button>
        {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="notification is-danger">
        <button class="delete"></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="admin-table">
    <table class="table is-fullwidth is-striped">
        <thead>
            <tr>
                <th>Label</th>
                <th>Number</th>
                <th>Subtitle</th>
                <th>Gradient Start</th>
                <th>Gradient End</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reportStatistics as $stat)
                <tr>
                    <td>{{ $stat->label }}</td>
                    <td><strong>{{ $stat->number }}</strong></td>
                    <td>{{ $stat->subtitle ?? '-' }}</td>
                    <td>
                        <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $stat->gradient_start }}; border-radius: 4px; border: 1px solid #ddd; vertical-align: middle;"></span>
                        {{ $stat->gradient_start }}
                    </td>
                    <td>
                        <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $stat->gradient_end }}; border-radius: 4px; border: 1px solid #ddd; vertical-align: middle;"></span>
                        {{ $stat->gradient_end }}
                    </td>
                    <td>{{ $stat->order }}</td>
                    <td>
                        <span class="tag @if ($stat->is_active) is-success @else is-light @endif">
                            @if ($stat->is_active) Active @else Inactive @endif
                        </span>
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.report-statistics.edit', $stat) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.report-statistics.destroy', $stat) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><br>
                        No statistics found. <a href="{{ route('admin.report-statistics.create') }}">Create one</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($reportStatistics->hasPages())
    <div style="margin-top: 2rem;">
        {{ $reportStatistics->links() }}
    </div>
@endif

<script>
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
</script>
@endsection
