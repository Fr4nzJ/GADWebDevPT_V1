@extends('admin.layout')

@section('title', 'Dashboard Activities Management - GAD Admin Panel')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="title is-3">Recent Activities</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.dashboard-activities.create') }}" class="button is-primary">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Log Activity</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="notification is-success is-light">
            <button class="delete"></button>
            {{ session('success') }}
        </div>
    @endif

    @if ($activities->count())
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td><small style="color: #999;">{{ $activity->action_time->format('M d, Y - H:i A') }}</small></td>
                            <td><strong>{{ $activity->user_name }}</strong></td>
                            <td>
                                @if ($activity->action === 'created')
                                    <span style="color: #667eea; font-weight: 500;">Created</span>
                                @elseif ($activity->action === 'updated')
                                    <span style="color: #48c774; font-weight: 500;">Updated</span>
                                @else
                                    <span style="color: #e74c3c; font-weight: 500;">Deleted</span>
                                @endif
                            </td>
                            <td>{{ $activity->module }}</td>
                            <td><small>{{ Str::limit($activity->description, 40) }}</small></td>
                            <td>
                                <span class="tag" style="background: 
                                    {{ $activity->status === 'published' ? '#48c774' : 
                                       ($activity->status === 'pending' ? '#f0ad4e' : 
                                       ($activity->status === 'active' ? '#667eea' : 
                                       ($activity->status === 'archived' ? '#999' : '#e74c3c'))) }}; color: white;">
                                    {{ ucfirst($activity->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.dashboard-activities.edit', $activity) }}" class="button is-small is-warning is-outlined">
                                    <span class="icon is-small"><i class="fas fa-edit"></i></span>
                                </a>
                                <form method="POST" action="{{ route('admin.dashboard-activities.destroy', $activity) }}" style="display:inline;">
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
            {{ $activities->links() }}
        </nav>
    @else
        <div class="notification is-info is-light">
            <p><strong>No activities found.</strong></p>
            <p>Start by <a href="{{ route('admin.dashboard-activities.create') }}">logging a new activity</a>.</p>
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
