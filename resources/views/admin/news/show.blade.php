@extends('admin.layout')

@section('title', 'View News - GAD Admin Panel')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 class="page-title">{{ $news->title }}</h1>
    <div style="display: flex; gap: 1rem;">
        <a href="{{ route('admin.news.edit', $news) }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
            <span class="icon"><i class="fas fa-edit"></i></span>
            <span>Edit</span>
        </a>
        <a href="{{ route('admin.news.index') }}" class="button is-light">Back to List</a>
    </div>
</div>

<div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
    <!-- Article Info Bar -->
    <div style="background: #f5f7ff; border-radius: 8px; padding: 1.5rem; margin-bottom: 2rem; display: flex; gap: 2rem; flex-wrap: wrap;">
        <div>
            <p style="color: #999; font-size: 0.85rem; margin: 0;">Author</p>
            <p style="color: #2c3e50; font-weight: 600; margin: 0.5rem 0 0 0;">{{ $news->author }}</p>
        </div>
        <div>
            <p style="color: #999; font-size: 0.85rem; margin: 0;">Category</p>
            <p style="color: #2c3e50; font-weight: 600; margin: 0.5rem 0 0 0;">
                <span style="background: #e8f1ff; color: #667eea; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.9rem;">{{ $news->category }}</span>
            </p>
        </div>
        <div>
            <p style="color: #999; font-size: 0.85rem; margin: 0;">Status</p>
            @php
                $statusBg = [
                    'published' => '#d4edda',
                    'draft' => '#f5f5f5',
                    'pending' => '#fff3cd',
                    'archived' => '#f8f9fa'
                ][$news->status] ?? '#f5f5f5';
                $statusColor = [
                    'published' => '#155724',
                    'draft' => '#666',
                    'pending' => '#856404',
                    'archived' => '#999'
                ][$news->status] ?? '#666';
            @endphp
            <p style="color: #2c3e50; font-weight: 600; margin: 0.5rem 0 0 0;">
                <span style="background: {{ $statusBg }}; color: {{ $statusColor }}; padding: 0.35rem 0.75rem; border-radius: 6px; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">
                    {{ ucfirst($news->status) }}
                </span>
            </p>
        </div>
        <div>
            <p style="color: #999; font-size: 0.85rem; margin: 0;">Views</p>
            <p style="color: #2c3e50; font-weight: 600; margin: 0.5rem 0 0 0;"><i class="fas fa-eye" style="color: #667eea;"></i> {{ $news->views }}</p>
        </div>
    </div>

    <!-- Images Gallery -->
    @if($news->images && count($news->images) > 0)
    <div style="margin-bottom: 2rem;">
        <h3 style="color: #2c3e50; font-weight: 700; margin-bottom: 1.5rem;">Article Images</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem;">
            @foreach($news->images as $image)
            <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);">
                <img src="{{ asset('storage/' . $image) }}" style="width: 100%; height: 250px; object-fit: cover;" alt="{{ $news->title }}">
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Article Content -->
    <div style="margin-bottom: 2rem;">
        <h3 style="color: #2c3e50; font-weight: 700; margin-bottom: 1.5rem; border-bottom: 3px solid #667eea; padding-bottom: 1rem;">Article Content</h3>
        <div style="line-height: 1.8; color: #444; font-size: 1.05rem;">
            {!! nl2br(e($news->content)) !!}
        </div>
    </div>

    <!-- Excerpt -->
    @if($news->excerpt)
    <div style="background: #f9faff; border-left: 4px solid #667eea; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
        <p style="color: #999; font-size: 0.85rem; font-weight: 600; margin: 0 0 0.5rem 0;">EXCERPT</p>
        <p style="color: #666; line-height: 1.6; margin: 0;">{{ $news->excerpt }}</p>
    </div>
    @endif

    <!-- Metadata -->
    <div style="border-top: 2px solid #f0f0f0; padding-top: 1.5rem; margin-top: 2rem;">
        <p style="color: #999; font-size: 0.85rem;">
            <i class="fas fa-calendar"></i> Created: {{ $news->created_at->format('M d, Y H:i') }} | 
            Last Updated: {{ $news->updated_at->format('M d, Y H:i') }}
        </p>
    </div>
</div>
@endsection
