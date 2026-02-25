@extends('admin.layout')

@section('title', 'Program Statistics Management')

@section('content')
<div class="container mt-5">
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <h1 class="title">Program Statistics (Programs Page)</h1>
            </div>
        </div>
        <div class="level-right">
            <div class="level-item">
                <a href="{{ route('admin.program-statistics.create') }}" class="button is-primary is-outlined">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span>Add Statistic</span>
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="notification is-success">
            <button class="delete"></button>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="notification is-danger">
            <button class="delete"></button>
            {{ session('error') }}
        </div>
    @endif

    <div class="table-container">
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr style="background-color: #f5f5f5;">
                    <th>Label</th>
                    <th>Value</th>
                    <th>Icon</th>
                    <th>Color</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statistics as $stat)
                    <tr>
                        <td><strong>{{ $stat->label }}</strong></td>
                        <td>{{ $stat->value }}</td>
                        <td>
                            @if($stat->icon)
                                <span><i class="{{ $stat->icon }}"></i></span>
                            @else
                                <span style="color: #999;">None</span>
                            @endif
                        </td>
                        <td>
                            @if($stat->color)
                                <span style="display: inline-block; width: 20px; height: 20px; background: {{ $stat->color }}; border-radius: 3px; border: 1px solid #ddd;"></span>
                                {{ $stat->color }}
                            @else
                                <span style="color: #999;">None</span>
                            @endif
                        </td>
                        <td>{{ $stat->order }}</td>
                        <td>
                            @if($stat->is_active)
                                <span class="tag is-success">Active</span>
                            @else
                                <span class="tag is-light">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.program-statistics.edit', $stat) }}" class="button is-small is-info is-outlined">
                                <span class="icon is-small"><i class="fas fa-edit"></i></span>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.program-statistics.destroy', $stat) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button is-small is-danger is-outlined">
                                    <span class="icon is-small"><i class="fas fa-trash"></i></span>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: #999;">
                            No statistics found. <a href="{{ route('admin.program-statistics.create') }}">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <nav class="pagination is-centered mt-5" role="navigation" aria-label="pagination">
        {{ $statistics->links() }}
    </nav>
</div>

<script>
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
</script>
@endsection
