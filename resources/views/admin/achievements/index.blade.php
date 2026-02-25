@extends('admin.layout')

@section('title', 'Key Achievements Management')

@section('content')
<div class="container mt-5">
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <h1 class="title">Key Achievements (About Page)</h1>
            </div>
        </div>
        <div class="level-right">
            <div class="level-item">
                <a href="{{ route('admin.achievements.create') }}" class="button is-primary is-outlined">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span>Add Achievement</span>
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
                    <th>Number</th>
                    <th>Label</th>
                    <th>Icon</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($achievements as $achievement)
                    <tr>
                        <td><strong>{{ $achievement->number }}</strong></td>
                        <td>{{ $achievement->label }}</td>
                        <td>
                            @if($achievement->icon)
                                <span><i class="{{ $achievement->icon }}"></i> {{ $achievement->icon }}</span>
                            @else
                                <span style="color: #999;">None</span>
                            @endif
                        </td>
                        <td>{{ $achievement->order }}</td>
                        <td>
                            @if($achievement->is_active)
                                <span class="tag is-success">Active</span>
                            @else
                                <span class="tag is-light">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.achievements.edit', $achievement) }}" class="button is-small is-info is-outlined">
                                <span class="icon is-small"><i class="fas fa-edit"></i></span>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.achievements.destroy', $achievement) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
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
                        <td colspan="6" style="text-align: center; padding: 2rem; color: #999;">
                            No achievements found. <a href="{{ route('admin.achievements.create') }}">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <nav class="pagination is-centered mt-5" role="navigation" aria-label="pagination">
        {{ $achievements->links() }}
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
