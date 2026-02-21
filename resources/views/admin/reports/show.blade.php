@extends('admin.layout')

@section('title', 'View Report - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">{{ $report->title }}</h1>
    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('admin.reports.edit', $report) }}" class="button" style="background: #667eea; color: white; border: none; font-weight: 600;">
            <span class="icon"><i class="fas fa-edit"></i></span>
            <span>Edit</span>
        </a>
        <a href="{{ route('admin.reports.index') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
            <span class="icon"><i class="fas fa-arrow-left"></i></span>
            <span>Back</span>
        </a>
    </div>
</div>

<!-- ===== REPORT DETAILS ===== -->
<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
    <div class="columns is-multiline">
        <div class="column is-6">
            <div style="margin-bottom: 2rem;">
                <label style="font-weight: 600; color: #666; font-size: 0.9rem;">Report Title</label>
                <p style="color: #2c3e50; font-size: 1.1rem; margin-top: 0.5rem;">{{ $report->title }}</p>
            </div>
        </div>
        <div class="column is-6">
            <div style="margin-bottom: 2rem;">
                <label style="font-weight: 600; color: #666; font-size: 0.9rem;">Publication Year</label>
                <p style="color: #2c3e50; font-size: 1.1rem; margin-top: 0.5rem;">{{ $report->year }}</p>
            </div>
        </div>
        <div class="column is-6">
            <div style="margin-bottom: 2rem;">
                <label style="font-weight: 600; color: #666; font-size: 0.9rem;">Report Type</label>
                @php
                    $typeColors = [
                        'Survey' => ['bg' => '#e8f1ff', 'text' => '#667eea'],
                        'Analysis' => ['bg' => '#fff8e1', 'text' => '#f0ad4e'],
                        'Research Study' => ['bg' => '#ffe8e8', 'text' => '#e74c3c'],
                        'Assessment' => ['bg' => '#e8f8f0', 'text' => '#48c774'],
                        'Baseline Study' => ['bg' => '#e8f1ff', 'text' => '#667eea'],
                        'Audit' => ['bg' => '#fff8e1', 'text' => '#f0ad4e'],
                        'Budget Analysis' => ['bg' => '#e8f1ff', 'text' => '#667eea'],
                        'Health Study' => ['bg' => '#ffe8e8', 'text' => '#e74c3c'],
                        'Impact Study' => ['bg' => '#e8f8f0', 'text' => '#48c774'],
                    ];
                    $typeColor = $typeColors[$report->type] ?? ['bg' => '#f5f5f5', 'text' => '#999'];
                @endphp
                <p style="margin-top: 0.5rem;"><span style="background: {{ $typeColor['bg'] }}; color: {{ $typeColor['text'] }}; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">{{ $report->type }}</span></p>
            </div>
        </div>
        <div class="column is-6">
            <div style="margin-bottom: 2rem;">
                <label style="font-weight: 600; color: #666; font-size: 0.9rem;">Status</label>
                @php
                    $statusColors = [
                        'draft' => ['bg' => '#f5f5f5', 'text' => '#999'],
                        'published' => ['bg' => '#e8f5e9', 'text' => '#48c774'],
                        'archived' => ['bg' => '#fff8e1', 'text' => '#f0ad4e'],
                    ];
                    $statusColor = $statusColors[$report->status] ?? ['bg' => '#f5f5f5', 'text' => '#999'];
                @endphp
                <p style="margin-top: 0.5rem;"><span style="background: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }}; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">{{ ucfirst($report->status) }}</span></p>
            </div>
        </div>
        <div class="column is-12">
            <div style="margin-bottom: 2rem;">
                <label style="font-weight: 600; color: #666; font-size: 0.9rem;">Description</label>
                <p style="color: #666; line-height: 1.6; margin-top: 0.5rem;">{{ $report->description }}</p>
            </div>
        </div>
        <div class="column is-12">
            <div>
                <label style="font-weight: 600; color: #666; font-size: 0.9rem;">PDF File</label>
                @if($report->file_path)
                    <p style="margin-top: 0.5rem;">
                        <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                            <span class="icon"><i class="fas fa-download"></i></span>
                            <span>Download PDF</span>
                        </a>
                    </p>
                @else
                    <p style="color: #999; margin-top: 0.5rem;">No file uploaded</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ===== CREATED/UPDATED INFO ===== -->
<div style="background: #f5f5f5; border-radius: 12px; padding: 1.5rem; margin-top: 2rem;">
    <div class="columns">
        <div class="column is-6">
            <p style="color: #999; font-size: 0.9rem;"><strong>Created:</strong> {{ $report->created_at->format('F d, Y H:i') }}</p>
        </div>
        <div class="column is-6">
            <p style="color: #999; font-size: 0.9rem;"><strong>Last Updated:</strong> {{ $report->updated_at->format('F d, Y H:i') }}</p>
        </div>
    </div>
</div>

@endsection
