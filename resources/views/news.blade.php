@extends('layouts.bulma')

@section('title', 'Latest News & Updates - CatSu GAD')

@section('content')
<!-- ===== HERO SECTION WITH BACKGROUND IMAGE ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>News & Updates</h1>
        <p class="subtitle">Stay Informed About Gender Equality Initiatives</p>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section section-purple-gradient">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: #e0aaff;">Home</a></li>
                <li class="is-active"><a href="{{ route('news-page') }}" style="color: #ffffff;" aria-current="page">News</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== NEWS FILTER ===== -->
<section class="section">
    <div class="container">
        <h2 class="section-title" style="font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem; color: #2c3e50; position: relative; padding-bottom: 1rem;">
            Latest News & Updates
            <span style="position: absolute; bottom: 0; left: 0; width: 60px; height: 4px; background: linear-gradient(90deg, #667eea, #764ba2); border-radius: 2px;"></span>
        </h2>

        <!-- Category Filter -->
        <div style="display: flex; gap: 1rem; margin-bottom: 3rem; flex-wrap: wrap;">
            <button onclick="filterNews('all')" class="category-btn" style="padding: 0.75rem 1.5rem; border-radius: 20px; border: 2px solid #667eea; background: #667eea; color: white; font-weight: 600; cursor: pointer;">
                All News
            </button>
            @php
                $categories = \App\Models\News::where('status', 'published')->distinct()->pluck('category');
            @endphp
            @foreach($categories as $cat)
            <button onclick="filterNews('{{ $cat }}')" class="category-btn" data-category="{{ $cat }}" style="padding: 0.75rem 1.5rem; border-radius: 20px; border: 2px solid #ddd; background: white; color: #666; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                {{ $cat }}
            </button>
            @endforeach
        </div>

        <!-- News Articles -->
        <div id="newsContainer">
            @forelse(\App\Models\News::where('status', 'published')->latest()->paginate(6) as $article)
            <article class="news-card" data-category="{{ $article->category }}" style="background: white; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1); overflow: hidden; transition: all 0.3s ease; display: flex;" onmouseenter="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 6px 20px rgba(0, 0, 0, 0.15)';" onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 12px rgba(0, 0, 0, 0.1)';">
                <!-- Featured Image -->
                @if($article->images && count($article->images) > 0)
                <div style="width: 350px; min-width: 350px; height: 280px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $article->images[0]) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $article->title }}">
                </div>
                @endif

                <!-- Article Content -->
                <div style="padding: 2rem; flex: 1; display: flex; flex-direction: column;">
                    <!-- Header with Category and Date -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span style="background: #e8f1ff; color: #667eea; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase;">
                            {{ $article->category }}
                        </span>
                        <span style="color: #999; font-size: 0.9rem;">
                            <i class="fas fa-calendar"></i> {{ $article->created_at->format('M d, Y') }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 style="color: #2c3e50; font-weight: 700; font-size: 1.5rem; margin: 0 0 1rem 0; line-height: 1.3;">
                        {{ $article->title }}
                    </h3>

                    <!-- Excerpt -->
                    <p style="color: #666; line-height: 1.6; margin: 0 0 1rem 0; flex: 1;">
                        {{ $article->excerpt ? Str::limit($article->excerpt, 200) : Str::limit($article->content, 200) }}
                    </p>

                    <!-- Footer with Author and CTA -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #f0f0f0;">
                        <span style="color: #999; font-size: 0.9rem;">
                            <i class="fas fa-user"></i> {{ $article->author }} | 
                            <i class="fas fa-eye"></i> {{ $article->views }}
                        </span>
                        <a href="{{ route('news.show', $article) }}" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; font-weight: 600;">
                            Read More
                            <span class="icon" style="margin-left: 0.5rem;"><i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div style="background: white; border-radius: 12px; padding: 3rem; text-align: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                <i class="fas fa-newspaper" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem;"></i>
                <h4 style="color: #999; font-size: 1.2rem; margin-bottom: 0.5rem;">No News Available</h4>
                <p style="color: #bbb;">Check back soon for the latest updates!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div style="margin-top: 3rem;">
            @if(method_exists($articles ?? collect(), 'links'))
                {{ $articles->links() }}
            @endif
        </div>
    </div>
</section>

<!-- ===== NEWSLETTER SIGNUP ===== -->
<section class="section has-background-light">
    <div class="container">
        <div class="box">
            <div class="content has-text-centered">
                <h2 class="title is-3">Stay Updated</h2>
                <p>Subscribe to our newsletter for monthly updates on gender equality initiatives and opportunities.</p>
                
                <form action="{{ route('contact.store') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="field is-grouped is-grouped-centered">
                        <div class="control is-expanded" style="max-width: 400px;">
                            <input class="input" type="email" name="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="control">
                            <button class="button is-primary" type="submit">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                <span>Subscribe</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
