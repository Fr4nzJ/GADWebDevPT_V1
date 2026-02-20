@extends('layouts.bulma')

@section('content')
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem 0; margin-bottom: 2rem;">
    <div class="container">
        <nav class="breadcrumb" style="background-color: transparent;">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: white;">Home</a></li>
                <li><a href="{{ route('news-page') }}" style="color: white;">News</a></li>
                <li class="is-active"><a href="#" style="color: white;" aria-current="page">{{ $news->title }}</a></li>
            </ul>
        </nav>
    </div>
</div>

<div class="container mb-6">
    <div class="columns">
        <!-- Main Content -->
        <div class="column is-8">
            <!-- Info Bar -->
            <div style="background: #f8f9fa; border-left: 4px solid #667eea; padding: 1.5rem; margin-bottom: 2rem; border-radius: 12px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <p style="color: #666; margin: 0.25rem 0; font-size: 0.9rem;">
                            <i class="fas fa-user" style="margin-right: 0.5rem;"></i>
                            <strong>Author:</strong> {{ $news->author }}
                        </p>
                        <p style="color: #666; margin: 0.25rem 0; font-size: 0.9rem;">
                            <i class="fas fa-calendar" style="margin-right: 0.5rem;"></i>
                            <strong>Published:</strong> {{ $news->created_at->format('F d, Y') }}
                        </p>
                        <p style="color: #666; margin: 0.25rem 0; font-size: 0.9rem;">
                            <i class="fas fa-eye" style="margin-right: 0.5rem;"></i>
                            <strong>Views:</strong> {{ $news->views }}
                        </p>
                    </div>
                    <div>
                        <span style="display: inline-block; padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.85rem; font-weight: bold; background: {{ $news->status_color }}; color: white;">
                            {{ ucfirst($news->status) }}
                        </span>
                        <span style="display: inline-block; padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.85rem; font-weight: bold; background: #667eea; color: white; margin-left: 0.5rem;">
                            {{ $news->category }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Article Title -->
            <h1 class="title is-2" style="color: #2c3e50; margin-bottom: 1.5rem; line-height: 1.3;">
                {{ $news->title }}
            </h1>

            <!-- Featured Image Gallery -->
            @if($news->images && count($news->images) > 0)
                <div style="margin-bottom: 2rem; border-radius: 12px; overflow: hidden;">
                    <!-- Main Image -->
                    <div style="margin-bottom: 1rem;">
                        <img id="mainImage" src="{{ asset('storage/' . $news->images[0]) }}" alt="{{ $news->title }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px;">
                    </div>
                    
                    <!-- Image Thumbnails -->
                    @if(count($news->images) > 1)
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 0.75rem;">
                            @foreach($news->images as $index => $image)
                                <img 
                                    src="{{ asset('storage/' . $image) }}" 
                                    alt="Image {{ $index + 1 }}" 
                                    style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 3px solid {{ $index === 0 ? '#667eea' : 'transparent' }}; transition: all 0.3s;"
                                    onclick="document.getElementById('mainImage').src = this.src; document.querySelectorAll('[onclick*=mainImage]').forEach(el => el.style.borderColor = 'transparent'); this.style.borderColor = '#667eea';"
                                >
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Excerpt -->
            @if($news->excerpt)
                <div style="background: #f0f4ff; padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem; border-left: 4px solid #667eea;">
                    <p style="color: #555; font-size: 1.05rem; line-height: 1.6; margin: 0;">
                        {{ $news->excerpt }}
                    </p>
                </div>
            @endif

            <!-- Article Content -->
            <div class="content" style="font-size: 1.1rem; line-height: 1.8; color: #2c3e50;">
                {!! nl2br(e($news->content)) !!}
            </div>

            <!-- Share Section -->
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 12px; margin-top: 2rem;">
                <p style="margin-bottom: 1rem; color: #666;"><strong>Share this article:</strong></p>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news)) }}" target="_blank" class="button" style="background: #3b5998; color: white; border: none;">
                        <span class="icon"><i class="fab fa-facebook"></i></span>
                        <span>Facebook</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('news.show', $news)) }}&text={{ urlencode($news->title) }}" target="_blank" class="button" style="background: #1da1f2; color: white; border: none;">
                        <span class="icon"><i class="fab fa-twitter"></i></span>
                        <span>Twitter</span>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('news.show', $news)) }}" target="_blank" class="button" style="background: #0077b5; color: white; border: none;">
                        <span class="icon"><i class="fab fa-linkedin"></i></span>
                        <span>LinkedIn</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="column is-4">
            <!-- Article Info Card -->
            <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e8e8e8; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h4 style="color: #667eea; font-weight: bold; margin-bottom: 1rem;">Article Details</h4>
                <div style="font-size: 0.95rem;">
                    <p style="margin-bottom: 0.75rem;">
                        <strong style="color: #666;">Category:</strong><br>
                        <span style="color: #667eea;">{{ $news->category }}</span>
                    </p>
                    <p style="margin-bottom: 0.75rem;">
                        <strong style="color: #666;">Author:</strong><br>
                        <span>{{ $news->author }}</span>
                    </p>
                    <p style="margin-bottom: 0.75rem;">
                        <strong style="color: #666;">Published:</strong><br>
                        <span>{{ $news->created_at->format('F d, Y \a\t g:i A') }}</span>
                    </p>
                    <p style="margin-bottom: 0;">
                        <strong style="color: #666;">Last Updated:</strong><br>
                        <span>{{ $news->updated_at->diffForHumans() }}</span>
                    </p>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedNews && count($relatedNews) > 0)
                <div style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e8e8e8; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <h4 style="color: #667eea; font-weight: bold; margin-bottom: 1rem;">Related Articles</h4>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($relatedNews as $article)
                            <a href="{{ route('news.show', $article) }}" style="text-decoration: none; padding: 1rem; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea; transition: all 0.3s; display: block;">
                                <p style="color: #667eea; font-size: 0.85rem; font-weight: bold; margin: 0 0 0.25rem 0; text-transform: uppercase;">
                                    {{ $article->category }}
                                </p>
                                <h5 style="color: #2c3e50; font-weight: bold; margin: 0.25rem 0; line-height: 1.4; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $article->title }}
                                </h5>
                                <p style="color: #999; font-size: 0.85rem; margin: 0.5rem 0 0 0;">
                                    {{ $article->created_at->format('M d, Y') }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Back to News -->
<div class="container mb-6">
    <a href="{{ route('news-page') }}" class="button" style="background: #667eea; color: white; border: none;">
        <span class="icon"><i class="fas fa-arrow-left"></i></span>
        <span>Back to News</span>
    </a>
</div>

@endsection
