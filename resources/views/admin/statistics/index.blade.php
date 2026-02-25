@extends('admin.layout')

@section('title', 'Manage Statistics - Admin Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Statistics/KPIs</h1>
    <a href="{{ route('admin.statistics.create') }}" class="button is-primary">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New Statistic</span>
    </a>
</div>

@if(session('success'))
    <div class="notification is-success is-light">
        <button class="delete"></button>
        {{ session('success') }}
    </div>
@endif

@if($statistics->count())
    <div class="admin-table">
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Value</th>
                    <th>Page</th>
                    <th>Color</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statistics as $stat)
                    <tr>
                        <td><strong>{{ $stat->title }}</strong></td>
                        <td>{{ $stat->value }}</td>
                        <td>
                            <span class="tag is-light">{{ $stat->page }}</span>
                        </td>
                        <td>
                            <span class="tag" style="background-color: 
                                @if($stat->color == 'blue') #667eea @elseif($stat->color == 'green') #48c774 @elseif($stat->color == 'orange') #f0ad4e @elseif($stat->color == '#667eea') #667eea @elseif($stat->color == '#48c774') #48c774 @elseif($stat->color == '#f0ad4e') #f0ad4e @else #764ba2 @endif; color: white;">
                                {{ $stat->color }}
                            </span>
                        </td>
                        <td>{{ $stat->order }}</td>
                        <td>
                            @if($stat->is_active)
                                <span class="status-badge status-active">Active</span>
                            @else
                                <span class="status-badge status-inactive">Inactive</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div class="action-buttons">
                                <a href="{{ route('admin.statistics.edit', $stat) }}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.statistics.destroy', $stat) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $statistics->links() }}
    </div>
@else
    <div class="notification is-info is-light">
        <p>No statistics found. <a href="{{ route('admin.statistics.create') }}" class="has-text-link">Create one</a></p>
    </div>
@endif
@endsection
