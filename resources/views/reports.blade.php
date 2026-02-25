@extends('layouts.bulma')

@section('title', 'Research & Reports - CatSu GAD')

@section('content')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }
    
    .hero-gradient::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .hero-gradient::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    
    .hero-body {
        position: relative;
        z-index: 1;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 3rem;
        color: #2c3e50;
        position: relative;
        padding-bottom: 1rem;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    
    .card {
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-radius: 12px;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .table thead tr {
        background-color: #f5f7ff;
    }
    
    .table thead th {
        color: #667eea;
        font-weight: 600;
        border-color: #e8eaf6;
    }
    
    .table tbody tr:hover {
        background-color: #f9faff;
    }
    
    .table tbody td {
        border-color: #f0f0f0;
    }
    
    .tag {
        border-radius: 20px;
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
    }
    
    .tag.is-info {
        background-color: #e8f1ff;
        color: #667eea;
    }
    
    .tag.is-warning {
        background-color: #fff8e1;
        color: #f0ad4e;
    }
    
    .tag.is-danger {
        background-color: #ffe8e8;
        color: #e74c3c;
    }
    
    .tag.is-success {
        background-color: #e8f8f0;
        color: #48c774;
    }
    
    .stat-box {
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stat-box:hover {
        transform: scale(1.05);
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 1rem;
        font-weight: 600;
    }
    
    .divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, #667eea, transparent);
        margin: 2rem 0;
    }
    
    .resource-box {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        border-left: 4px solid #667eea;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .resource-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }
    
    .resource-box.alt {
        border-left-color: #764ba2;
    }
</style>

<!-- ===== HERO SECTION WITH BACKGROUND IMAGE ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Research & Reports</h1>
        <p class="subtitle">Evidence-Based Knowledge for Gender Equality & Inclusion</p>
        <div style="margin-top: 2rem;">
            <a href="#reports-section" class="button is-white is-outlined is-medium" style="border-width: 2px;">
                <span>Explore Research</span>
                <span class="icon"><i class="fas fa-arrow-down"></i></span>
            </a>
        </div>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section section-purple-gradient" style="padding: 1.5rem 1.5rem;">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}" style="color: #e0aaff;">Home</a></li>
                <li class="is-active"><a href="{{ route('reports') }}" style="color: #ffffff;" aria-current="page">Reports</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== REPORTS TABLE ===== -->
<section class="section" id="reports-section" style="padding: 4rem 1.5rem;">
    <div class="container">
        <h2 class="section-title">GAD Research Publications & Reports</h2>

        <!-- ===== FILTER BAR ===== -->
        @if($hasPublishedReports)
        <form method="GET" action="{{ route('reports') }}" id="filterForm">
            <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                <div class="columns">
                    <div class="column is-6-tablet is-3-desktop">
                        <div class="field">
                            <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Search Reports</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name="search" placeholder="Title or keyword..." value="{{ request('search', '') }}">
                                <span class="icon is-left">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6-tablet is-3-desktop">
                        <div class="field">
                            <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Year</label>
                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select name="year" onchange="document.getElementById('filterForm').submit();">
                                        <option value="all" {{ request('year', 'all') === 'all' ? 'selected' : '' }}>All Years</option>
                                        @for($year = date('Y'); $year >= 2020; $year--)
                                            <option value="{{ $year }}" {{ request('year') === (string)$year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6-tablet is-3-desktop">
                        <div class="field">
                            <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Type</label>
                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select name="type" onchange="document.getElementById('filterForm').submit();">
                                        <option value="all" {{ request('type', 'all') === 'all' ? 'selected' : '' }}>All Types</option>
                                        <option value="Survey" {{ request('type') === 'Survey' ? 'selected' : '' }}>Survey</option>
                                        <option value="Analysis" {{ request('type') === 'Analysis' ? 'selected' : '' }}>Analysis</option>
                                        <option value="Research Study" {{ request('type') === 'Research Study' ? 'selected' : '' }}>Research Study</option>
                                        <option value="Assessment" {{ request('type') === 'Assessment' ? 'selected' : '' }}>Assessment</option>
                                        <option value="Baseline Study" {{ request('type') === 'Baseline Study' ? 'selected' : '' }}>Baseline Study</option>
                                        <option value="Audit" {{ request('type') === 'Audit' ? 'selected' : '' }}>Audit</option>
                                        <option value="Budget Analysis" {{ request('type') === 'Budget Analysis' ? 'selected' : '' }}>Budget Analysis</option>
                                        <option value="Health Study" {{ request('type') === 'Health Study' ? 'selected' : '' }}>Health Study</option>
                                        <option value="Impact Study" {{ request('type') === 'Impact Study' ? 'selected' : '' }}>Impact Study</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6-tablet is-3-desktop">
                        <div class="field">
                            <label class="label" style="font-size: 0.9rem; color: #666; font-weight: 600;">Status</label>
                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select name="status" onchange="document.getElementById('filterForm').submit();">
                                        <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns" style="margin-top: 1rem;">
                    <div class="column">
                        <button type="submit" class="button" style="background: #667eea; color: white; border: none; font-weight: 600;">
                            <span class="icon"><i class="fas fa-search"></i></span>
                            <span>Search</span>
                        </button>
                        @if(request('search') || request('year', 'all') !== 'all' || request('type', 'all') !== 'all' || request('status', 'all') !== 'all')
                            <a href="{{ route('reports') }}" class="button" style="background: #f0f0f0; color: #666; border: none; font-weight: 600;">
                                <span class="icon"><i class="fas fa-times"></i></span>
                                <span>Clear Filters</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        <div class="table-container" style="overflow-x: auto; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <table class="table is-striped is-hoverable is-fullwidth" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th style="padding: 1.25rem;">Report Title</th>
                        <th style="padding: 1.25rem;">Year</th>
                        <th style="padding: 1.25rem;">Type</th>
                        <th style="padding: 1.25rem;">Description</th>
                        <th style="padding: 1.25rem; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">{{ $report->title }}</td>
                        <td style="padding: 1.25rem;">{{ $report->year }}</td>
                        <td style="padding: 1.25rem;">
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
                            <span style="background: {{ $typeColor['bg'] }}; color: {{ $typeColor['text'] }}; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">{{ $report->type }}</span>
                        </td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">{{ Str::limit($report->description, 150) }}</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            @if($report->file_path)
                                <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                    <span class="icon"><i class="fas fa-download"></i></span>
                                    <span>PDF</span>
                                </a>
                            @else
                                <span style="color: #999; font-size: 0.9rem;">N/A</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 2rem; text-align: center; border: none;">
                            <p style="color: #999; font-size: 1.1rem;">No reports found. <a href="{{ route('reports') }}" style="color: #667eea; font-weight: 600;">View all reports</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ===== PAGINATION ===== -->
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            <style>
                .pagination {
                    display: flex;
                    list-style: none;
                    gap: 0.5rem;
                    padding: 0;
                    margin: 0;
                    justify-content: center;
                    align-items: center;
                }
                .pagination li {
                    display: inline-block;
                }
                .pagination li a, .pagination li span {
                    display: inline-block;
                    padding: 0.75rem 1rem;
                    border-radius: 6px;
                    background: white;
                    border: 1px solid #e0e0e0;
                    color: #667eea;
                    text-decoration: none;
                    font-weight: 500;
                    transition: all 0.3s ease;
                    min-width: 3rem;
                    text-align: center;
                }
                .pagination li:first-child a,
                .pagination li:last-child a {
                    color: transparent;
                    pointer-events: none;
                }
                .pagination li:first-child,
                .pagination li:last-child {
                    display: none;
                }
                .pagination li a:hover {
                    background: #f0f0f0;
                    border-color: #667eea;
                }
                .pagination li.active span {
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    color: white;
                    border-color: #667eea;
                }
                .pagination li.disabled span {
                    color: #ccc;
                    cursor: not-allowed;
                    background: #f5f5f5;
                    border-color: #eee;
                }
                /* Hide "Showing X to Y of Z results" text */
                .hidden.sm\:flex-1.sm\:flex {
                    display: none !important;
                }
            </style>
            {{ $reports->links() }}
        </div>
        @else
        <div style="background: #f5f7ff; padding: 3rem; border-radius: 12px; margin-bottom: 2rem; text-align: center;">
            <p style="color: #667eea; font-size: 1.1rem; font-weight: 600; margin-bottom: 1.5rem;">
                📊 No Reports Available
            </p>
            <p style="color: #666; margin-bottom: 2rem;">No reports have been published yet. Check back soon for research and studies on gender and development.</p>
        </div>
        @endif
    </div>
</section>

<!-- ===== POLICY BRIEFS SECTION ===== -->
<section class="section" style="padding: 4rem 1.5rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <h2 class="section-title">Policy Briefs & Infographics</h2>

        <div class="columns is-multiline">
            @forelse ($policyBriefs as $brief)
            <div class="column is-4">
                <div class="card" style="height: 100%; display: flex; flex-direction: column; border-top: 4px solid {{ $brief->color ?? '#667eea' }};">
                    <div class="card-header">
                        <p class="card-header-title" style="align-items: flex-start;">
                            <span class="icon" style="color: {{ $brief->color ?? '#667eea' }};"><i class="{{ $brief->icon ?? 'fas fa-file-alt' }}"></i></span>
                            <span style="color: {{ $brief->color ?? '#667eea' }}; font-weight: 600; text-align: left;">{{ $brief->title }}</span>
                        </p>
                    </div>
                    <div class="card-content" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="content">
                            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                                {{ $brief->description }}
                            </p>
                            <p style="font-size: 0.9rem; color: #999;">
                                @if ($brief->pages) <strong>Pages:</strong> {{ $brief->pages }} @endif
                                @if ($brief->year) <strong>Year:</strong> {{ $brief->year }} @endif
                            </p>
                        </div>
                        <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, {{ $brief->color ?? '#667eea' }}, #764ba2); color: white; border: none; margin-top: 1rem;">
                            <span class="icon"><i class="fas fa-download"></i></span>
                            <span>Download Brief</span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="column is-12">
                <div style="text-align: center; padding: 2rem; color: #999;">
                    <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                    <p>Policy briefs coming soon. Check back later.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== STATISTICAL YEARBOOK ===== -->
<section class="section" style="padding: 4rem 1.5rem;">
    <div class="container">
        <h2 class="section-title">GAD Statistical Yearbook</h2>

        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08); overflow: hidden;">
            <div class="columns is-gapless">
                <div class="column is-7" style="padding: 2.5rem;">
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 1rem;">CatSu GAD Statistical Yearbook 2024</h4>
                    <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">
                        Comprehensive compilation of gender-related statistics covering population, health, 
                        education, employment, poverty, violence, and political participation. Includes trend 
                        analysis, gender indicators, and regional breakdowns.
                    </p>
                    <div style="margin: 1.5rem 0;">
                        <p style="margin-bottom: 0.75rem;"><strong style="color: #667eea;">Publication Details:</strong></p>
                        <ul style="font-size: 0.95rem; color: #666;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-calendar" style="color: #667eea; width: 1.5rem;"></i> <strong>Publication Date:</strong> January 2024</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-file" style="color: #667eea; width: 1.5rem;"></i> <strong>Pages:</strong> 180</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-file-pdf" style="color: #667eea; width: 1.5rem;"></i> <strong>Format:</strong> PDF + Excel Data Tables</li>
                            <li><i class="fas fa-globe" style="color: #667eea; width: 1.5rem;"></i> <strong>Languages:</strong> English & Filipino</li>
                        </ul>
                    </div>
                </div>
                <div class="column is-full-mobile is-full-tablet is-5-desktop" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; padding: 2.5rem;">
                    <div style="text-align: center; color: white;">
                        <p style="font-size: 4rem; font-weight: 800; line-height: 1;">180</p>
                        <p style="font-size: 1.2rem; margin-bottom: 2rem;">Pages of Data</p>
                        <i class="fas fa-chart-bar" style="font-size: 4rem; opacity: 0.3;"></i>
                        <div style="margin-top: 2.5rem;">
                            <a href="#" class="button" style="background: white; color: #667eea; border: none; font-weight: 600; width: 90%;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>Download (15 MB)</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== RESOURCES FOR RESEARCHERS ===== -->
<section class="section" style="padding: 4rem 1.5rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <h2 class="section-title">Resources for Researchers & Practitioners</h2>

        <div class="columns is-multiline">
            @forelse ($resources as $resource)
            <div class="column is-6">
                <div class="resource-box">
                    <h4 class="title is-5" style="color: {{ $resource->color ?? '#667eea' }}; margin-bottom: 1rem;">
                        <i class="{{ $resource->icon ?? 'fas fa-book' }}" style="margin-right: 0.75rem;"></i>{{ $resource->title }}
                    </h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                        {{ $resource->description }}
                    </p>
                    <a href="{{ $resource->button_url ?? '#' }}" class="button is-fullwidth" style="background: linear-gradient(135deg, {{ $resource->color ?? '#667eea' }}, #764ba2); color: white; border: none;">
                        <span class="icon">
                            @if ($resource->button_action === 'download')
                                <i class="fas fa-download"></i>
                            @elseif ($resource->button_action === 'access')
                                <i class="fas fa-external-link-alt"></i>
                            @elseif ($resource->button_action === 'view')
                                <i class="fas fa-play-circle"></i>
                            @else
                                <i class="fas fa-link"></i>
                            @endif
                        </span>
                        <span>{{ $resource->button_text }}</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="column is-12">
                <div style="text-align: center; padding: 2rem; color: #999;">
                    <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                    <p>Resources coming soon. Check back later.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== REPORT STATISTICS ===== -->
<section class="section" style="padding: 4rem 1.5rem;">
    <div class="container">
        <h2 class="section-title">Our Research Impact</h2>

        <div class="columns is-multiline">
            @forelse ($statistics as $stat)
            <div class="column is-6-tablet is-3-desktop">
                <div class="stat-box" style="background: linear-gradient(135deg, {{ $stat->gradient_start }} 0%, {{ $stat->gradient_end }} 100%); color: white; border-radius: 12px;">
                    @if ($stat->icon)
                    <p style="font-size: 2rem; margin-bottom: 0.5rem;">
                        <i class="{{ $stat->icon }}"></i>
                    </p>
                    @endif
                    <h3 class="stat-number">{{ $stat->number }}</h3>
                    <p class="stat-label">{{ $stat->label }}</p>
                    @if ($stat->subtitle)
                    <p style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.9;">{{ $stat->subtitle }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="column is-12">
                <div style="text-align: center; padding: 2rem; color: #999;">
                    <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                    <p>Research impact statistics coming soon. Check back later.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== CTA REQUEST ===== -->
<section class="section has-background-light" style="padding: 5rem 1.5rem;">
    <div class="container has-text-centered">
        <h2 class="title is-3" style="color: #2c3e50; margin-bottom: 1rem;">Need a Custom Research or Report?</h2>
        <p class="subtitle" style="color: #666; margin-bottom: 2rem; font-size: 1.1rem;">We conduct tailored research studies and gender audits for government agencies and organizations.</p>
        <a href="{{ route('contact') }}" class="button" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; padding: 1rem 2.5rem; font-size: 1.05rem; font-weight: 600; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <span class="icon"><i class="fas fa-envelope"></i></span>
            <span>Request a Study</span>
        </a>
    </div>
</section>
@endsection
