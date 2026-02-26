@extends('admin.layout')

@section('title', 'Dashboard Statistics Management - GAD Admin Panel')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="title is-3">Dashboard Statistics</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.dashboard-statistics.create') }}" class="button is-primary">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Add Statistic Card</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="notification is-success is-light">
            <button class="delete"></button>
            {{ session('success') }}
        </div>
    @endif

    @if ($statistics->count())
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Value</th>
                        <th>Color</th>
                        <th>Trend</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statistics as $stat)
                        <tr>
                            <td><strong>{{ $stat->label }}</strong></td>
                            <td><span class="tag is-info is-light">{{ $stat->value }}</span></td>
                            <td>
                                <span class="tag" style="background: {{ $stat->color_class === 'blue' ? '#667eea' : ($stat->color_class === 'green' ? '#48c774' : ($stat->color_class === 'orange' ? '#f0ad4e' : ($stat->color_class === 'red' ? '#e74c3c' : '#764ba2'))) }}; color: white;">
                                    {{ ucfirst($stat->color_class) }}
                                </span>
                            </td>
                            <td>
                                @if ($stat->trend_direction === 'up')
                                    <i class="fas fa-arrow-up" style="color: #48c774;"></i> {{ $stat->trend_value ?? '-' }}
                                @elseif ($stat->trend_direction === 'down')
                                    <i class="fas fa-arrow-down" style="color: #e74c3c;"></i> {{ $stat->trend_value ?? '-' }}
                                @else
                                    <i class="fas fa-minus"></i> -
                                @endif
                            </td>
                            <td>
                                @if ($stat->is_active)
                                    <span class="tag is-success">Active</span>
                                @else
                                    <span class="tag is-danger">Inactive</span>
                                @endif
                            </td>
                            <td><span class="tag">{{ $stat->order }}</span></td>
                            <td>
                                <a href="{{ route('admin.dashboard-statistics.edit', $stat) }}" class="button is-small is-warning is-outlined">
                                    <span class="icon is-small"><i class="fas fa-edit"></i></span>
                                </a>
                                <form method="POST" action="{{ route('admin.dashboard-statistics.destroy', $stat) }}" style="display:inline;">
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

        <nav class="pagination is-centered mt-4">
            {{ $statistics->links() }}
        </nav>
    @else
        <div class="notification is-info is-light">
            <p><strong>No statistics found.</strong></p>
            <p>Start by <a href="{{ route('admin.dashboard-statistics.create') }}">creating a new statistic card</a>.</p>
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
