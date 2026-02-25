@extends('admin.layout')

@section('title', 'Manage Policy Briefs')

@section('content')
<div class="page-header">
    <h1 class="page-title">Policy Briefs & Infographics</h1>
    <a href="{{ route('admin.policy-briefs.create') }}" class="button is-primary">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add Policy Brief</span>
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
                <th>Title</th>
                <th>Pages</th>
                <th>Year</th>
                <th>Color</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($policyBriefs as $brief)
                <tr>
                    <td>{{ $brief->title }}</td>
                    <td>{{ $brief->pages ?? '-' }}</td>
                    <td>{{ $brief->year ?? '-' }}</td>
                    <td>
                        @if ($brief->color)
                            <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $brief->color }}; border-radius: 4px; border: 1px solid #ddd;"></span>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $brief->order }}</td>
                    <td>
                        <span class="tag @if ($brief->is_active) is-success @else is-light @endif">
                            @if ($brief->is_active) Active @else Inactive @endif
                        </span>
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.policy-briefs.edit', $brief) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.policy-briefs.destroy', $brief) }}" method="POST" style="display: inline;">
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
                    <td colspan="7" style="text-align: center; padding: 2rem; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 1.5rem; margin-bottom: 0.5rem;"></i><br>
                        No policy briefs found. <a href="{{ route('admin.policy-briefs.create') }}">Create one</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($policyBriefs->hasPages())
    <div style="margin-top: 2rem;">
        {{ $policyBriefs->links() }}
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
