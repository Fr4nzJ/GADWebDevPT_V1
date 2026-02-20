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
                <li class="is-active"><a href="{{ route('news') }}" style="color: #ffffff;" aria-current="page">News</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== NEWS FILTER ===== -->
<section class="section section-purple-gradient">
    <div class="container" x-data="{ activeCategory: 'all' }">
        <div class="content mb-4">
            <h2 class="section-title">News Categories</h2>
        </div>

        <div class="buttons mb-5" style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
            <button class="button" 
                    @click="activeCategory = 'all'" 
                    :class="activeCategory === 'all' ? 'is-primary' : 'is-light'">
                All News
            </button>
            <button class="button" 
                    @click="activeCategory = 'announcements'" 
                    :class="activeCategory === 'announcements' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-bell"></i></span>
                <span>Announcements</span>
            </button>
            <button class="button" 
                    @click="activeCategory = 'activities'" 
                    :class="activeCategory === 'activities' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                <span>Activities</span>
            </button>
            <button class="button" 
                    @click="activeCategory = 'policy'" 
                    :class="activeCategory === 'policy' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-gavel"></i></span>
                <span>Policy Updates</span>
            </button>
            <button class="button" 
                    @click="activeCategory = 'research'" 
                    :class="activeCategory === 'research' ? 'is-primary' : 'is-light'">
                <span class="icon"><i class="fas fa-microscope"></i></span>
                <span>Research</span>
            </button>
        </div>

        <!-- NEWS ITEM 1 -->
        <div class="news-article" x-show="activeCategory === 'all' || activeCategory === 'announcements'">
            <div class="news-item">
                <div class="box">
                    <div class="columns">
                        <div class="column is-4">
                            <figure class="image">
                                <img src="https://via.placeholder.com/400x300?text=Women+March" alt="International Women's Day">
                            </figure>
                        </div>
                        <div class="column is-8">
                            <span class="news-category">Announcements</span>
                            <h3 class="title is-4 mt-2">
                                <a href="#" style="color: #2c3e50;">International Women's Day Celebration 2024</a>
                            </h3>
                            <p class="news-date">
                                <i class="fas fa-calendar"></i> March 8, 2024 | 
                                <i class="fas fa-user"></i> By Maria Santos, Communications Unit
                            </p>
                            <div class="content">
                                <p>
                                    CatSu GAD hosted a nationwide celebration of International Women's Day with the theme 
                                    "Invest in Women: Accelerate Progress." The event featured keynote speeches from prominent women 
                                    leaders, interactive workshops, and recognition of outstanding women achievers across different sectors. 
                                    Over 5,000 participants from government agencies, NGOs, and communities attended the main event 
                                    in Manila, with simultaneous celebrations in 17 regions nationwide.
                                </p>
                                <a href="#" class="button is-dark is-small">
                                    <span>Read Full Article</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEWS ITEM 2 -->
        <div class="news-article" x-show="activeCategory === 'all' || activeCategory === 'policy'">
            <div class="news-item">
                <div class="box">
                    <div class="columns">
                        <div class="column is-4">
                            <figure class="image">
                                <img src="https://via.placeholder.com/400x300?text=Law+House" alt="Policy News">
                            </figure>
                        </div>
                        <div class="column is-8">
                            <span class="news-category" style="background-color: #3273dc;">Policy Updates</span>
                            <h3 class="title is-4 mt-2">
                                <a href="#" style="color: #2c3e50;">New Executive Order on Gender-Responsive Budgeting Signed</a>
                            </h3>
                            <p class="news-date">
                                <i class="fas fa-calendar"></i> February 15, 2024 | 
                                <i class="fas fa-user"></i> By Atty. Jennifer Reyes, Policy Division
                            </p>
                            <div class="content">
                                <p>
                                    President's office signed EO 2024-45 mandating all government agencies to integrate gender 
                                    analysis in budget planning and allocation. The order ensures that at least 5% of agency budgets 
                                    directly support gender equality initiatives. This landmark policy is expected to channel approximately 
                                    PHP 50 billion annually toward GAD programs, significantly accelerating progress toward gender equality 
                                    targets set in the National Development Plan.
                                </p>
                                <a href="#" class="button is-dark is-small">
                                    <span>Read Full Article</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEWS ITEM 3 -->
        <div class="news-article" x-show="activeCategory === 'all' || activeCategory === 'research'">
            <div class="news-item">
                <div class="box">
                    <div class="columns">
                        <div class="column is-4">
                            <figure class="image">
                                <img src="https://via.placeholder.com/400x300?text=Data+Analysis" alt="Research Study">
                            </figure>
                        </div>
                        <div class="column is-8">
                            <span class="news-category" style="background-color: #48c774;">Research</span>
                            <h3 class="title is-4 mt-2">
                                <a href="#" style="color: #2c3e50;">National Gender & Agrarian Reform Baseline Study Released</a>
                            </h3>
                            <p class="news-date">
                                <i class="fas fa-calendar"></i> January 30, 2024 | 
                                <i class="fas fa-user"></i> By Dr. Clara Gonzales, Research Unit
                            </p>
                            <div class="content">
                                <p>
                                    The highly-anticipated baseline study examining women's participation in agricultural reform 
                                    was released today. The study reveals that 35% of beneficiaries of agrarian reform programs are women, 
                                    up from 28% in 2019, showing significant progress. However, women continue to face barriers in accessing 
                                    extension services and market opportunities. The report provides 15 key recommendations for improving 
                                    women's agricultural productivity and income. <a href="#" style="color: #667eea;">Download full report</a>.
                                </p>
                                <a href="#" class="button is-dark is-small">
                                    <span>Read Full Article</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEWS ITEM 4 -->
        <div class="news-article" x-show="activeCategory === 'all' || activeCategory === 'activities'">
            <div class="news-item">
                <div class="box">
                    <div class="columns">
                        <div class="column is-4">
                            <figure class="image">
                                <img src="https://via.placeholder.com/400x300?text=Workshop" alt="Training Workshop">
                            </figure>
                        </div>
                        <div class="column is-8">
                            <span class="news-category" style="background-color: #ffdd57; color: #363636;">Activities</span>
                            <h3 class="title is-4 mt-2">
                                <a href="#" style="color: #2c3e50;">Gender-Sensitive School Program Teacher Training Conducted in Mindanao</a>
                            </h3>
                            <p class="news-date">
                                <i class="fas fa-calendar"></i> January 20, 2024 | 
                                <i class="fas fa-user"></i> By Engr. Rebecca Torres, Programs Unit
                            </p>
                            <div class="content">
                                <p>
                                    The Gender-Sensitive School Program successfully conducted a 5-day intensive training for 250 teachers 
                                    from public schools across Mindanao. Topics covered included identifying gender stereotypes in textbooks, 
                                    creating inclusive classroom environments, and establishing school-based mechanisms addressing sexual 
                                    harassment and bullying. Participants received certificates and gender-responsive teaching materials 
                                    to use in their classrooms.
                                </p>
                                <a href="#" class="button is-dark is-small">
                                    <span>Read Full Article</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEWS ITEM 5 -->
        <div class="news-article" x-show="activeCategory === 'all' || activeCategory === 'announcements'">
            <div class="news-item">
                <div class="box">
                    <div class="columns">
                        <div class="column is-4">
                            <figure class="image">
                                <img src="https://via.placeholder.com/400x300?text=Success+Stories" alt="Success Story">
                            </figure>
                        </div>
                        <div class="column is-8">
                            <span class="news-category">Announcements</span>
                            <h3 class="title is-4 mt-2">
                                <a href="#" style="color: #2c3e50;">Women Entrepreneurs Showcase Success Stories at Regional Summit</a>
                            </h3>
                            <p class="news-date">
                                <i class="fas fa-calendar"></i> December 15, 2023 | 
                                <i class="fas fa-user"></i> By Maria Santos, Communications Unit
                            </p>
                            <div class="content">
                                <p>
                                    Fifteen successful women entrepreneurs supported by the Women Empowerment & Economic Independence Program 
                                    shared their inspiring journey at the Southeast Asian Women Entrepreneurs Summit in December. Their businesses—ranging 
                                    from agricultural cooperatives to digital services—generated PHP 150 million in annual revenue collectively and 
                                    employ over 800 individuals. The showcased success stories demonstrate the transformative impact of targeted 
                                    economic support and business training for women.
                                </p>
                                <a href="#" class="button is-dark is-small">
                                    <span>Read Full Article</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
