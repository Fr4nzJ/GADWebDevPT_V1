@extends('admin.layout')

@section('title', 'Program Distribution Chart Data - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Program Distribution Chart Management</h1>
    <a href="{{ route('admin.program-distribution-charts.create') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
        <span class="icon"><i class="fas fa-plus"></i></span>
        <span>Add New Data Point</span>
    </a>
</div>

<!-- ===== SUCCESS MESSAGE ===== -->
@if (session('success'))
    <div class="notification is-success is-light" style="margin-bottom: 2rem;">
        <button class="delete"></button>
        {{ session('success') }}
    </div>
@endif

<!-- ===== CHART DATA TABLE ===== -->
<div class="admin-table" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    @if($chartData->count() > 0)
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead style="background-color: #f5f7fa;">
                <tr>
                    <th style="padding: 1.25rem; font-weight: 700; color: #2c3e50;">Program</th>
                    <th style="padding: 1.25rem; font-weight: 700; color: #2c3e50;">Value</th>
                    <th style="padding: 1.25rem; font-weight: 700; color: #2c3e50;">Color</th>
                    <th style="padding: 1.25rem; font-weight: 700; color: #2c3e50;">Order</th>
                    <th style="padding: 1.25rem; font-weight: 700; color: #2c3e50;">Status</th>
                    <th style="padding: 1.25rem; font-weight: 700; color: #2c3e50; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chartData as $item)
                    <tr>
                        <td style="padding: 1.25rem; border: none;"><strong>{{ $item->label }}</strong></td>
                        <td style="padding: 1.25rem; border: none;"><span style="color: #667eea; font-weight: 600;">{{ $item->value }}</span></td>
                        <td style="padding: 1.25rem; border: none;">
                            @if($item->color_hex)
                                <span style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                    <span style="width: 24px; height: 24px; background-color: {{ $item->color_hex }}; border-radius: 4px; border: 1px solid #ddd;"></span>
                                    <code>{{ $item->color_hex }}</code>
                                </span>
                            @endif
                        </td>
                        <td style="padding: 1.25rem; border: none; color: #999;">{{ $item->order }}</td>
                        <td style="padding: 1.25rem; border: none;">
                            @if($item->is_active)
                                <span style="background: #c8e6c9; color: #2e7d32; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">Active</span>
                            @else
                                <span style="background: #f5f5f5; color: #999; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding: 1.25rem; border: none; text-align: center;">
                            <a href="{{ route('admin.program-distribution-charts.edit', $item->id) }}" class="button is-small is-info is-light" style="margin-right: 0.5rem;">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.program-distribution-charts.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button is-small is-danger is-light">
                                    <span class="icon"><i class="fas fa-trash"></i></span>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ===== PAGINATION ===== -->
        <div style="padding: 1.5rem; background: #f5f7fa; border-top: 1px solid #ebebeb;">
            {{ $chartData->links() }}
        </div>
    @else
        <div style="padding: 3rem; text-align: center;">
            <p style="color: #999; margin-bottom: 1rem;">No chart data points yet.</p>
            <a href="{{ route('admin.program-distribution-charts.create') }}" class="button is-primary is-light">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Add the first data point</span>
            </a>
        </div>
    @endif
</div>
@endsection
