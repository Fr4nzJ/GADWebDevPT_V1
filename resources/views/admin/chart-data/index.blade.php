@extends('admin.layout')

@section('title', 'Manage Chart Data - Admin Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Chart Data</h1>
    <a href="{{ route('admin.chart-data.create') }}" class="button is-primary">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New Chart Data</span>
    </a>
</div>

@if(session('success'))
    <div class="notification is-success is-light">
        <button class="delete"></button>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="notification is-danger is-light">
        <button class="delete"></button>
        {{ session('error') }}
    </div>
@endif

@if($chartData->count())
    <div class="admin-table">
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>Chart Type</th>
                    <th>Label</th>
                    <th>Value</th>
                    <th>Page</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chartData as $data)
                    <tr>
                        <td>
                            <span class="tag {{ $data->chart_type == 'growth' ? 'is-info' : 'is-success' }}">
                                {{ ucfirst($data->chart_type) }}
                            </span>
                        </td>
                        <td><strong>{{ $data->label }}</strong></td>
                        <td>{{ $data->value }}</td>
                        <td>
                            <span class="tag is-light">{{ $data->page }}</span>
                        </td>
                        <td>{{ $data->order }}</td>
                        <td>
                            @if($data->is_active)
                                <span class="status-badge status-active">Active</span>
                            @else
                                <span class="status-badge status-inactive">Inactive</span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div class="action-buttons">
                                <a href="{{ route('admin.chart-data.edit', $data) }}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.chart-data.destroy', $data) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
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
        {{ $chartData->links() }}
    </div>
@else
    <div class="notification is-info is-light">
        <p>No chart data found. <a href="{{ route('admin.chart-data.create') }}" class="has-text-link">Create one</a></p>
    </div>
@endif
@endsection
