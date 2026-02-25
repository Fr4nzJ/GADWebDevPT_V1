@extends('layouts.bulma')

@section('title', 'Gender and Development - Infographic Dashboard')

@section('content')
<style>
    /* ===== GLOBAL INFOGRAPHIC STYLES ===== */
    .infographic-section {
        padding: 4rem 0;
        background: #f8f9fa;
    }
    
    .infographic-section.white-bg {
        background: white;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .section-header h2 {
        font-size: 2.2rem;
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .section-header p {
        color: #666;
        font-size: 1.1rem;
    }
    
    /* KPI Stats Grid */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .kpi-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 5px solid #667eea;
    }
    
    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
    
    .kpi-card.blue { border-left-color: #667eea; }
    .kpi-card.green { border-left-color: #48c774; }
    .kpi-card.orange { border-left-color: #f0ad4e; }
    .kpi-card.purple { border-left-color: #764ba2; }
    
    .kpi-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 1rem 0;
    }
    
    .kpi-label {
        color: #666;
        font-size: 0.95rem;
        font-weight: 500;
    }
    
    .kpi-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .kpi-card.blue .kpi-icon { color: #667eea; }
    .kpi-card.green .kpi-icon { color: #48c774; }
    .kpi-card.orange .kpi-icon { color: #f0ad4e; }
    .kpi-card.purple .kpi-icon { color: #764ba2; }
    
    /* Timeline Infographic */
    .timeline {
        position: relative;
        padding: 2rem 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, #667eea, #764ba2);
    }
    
    .timeline-items {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }
    
    .timeline-item {
        padding: 1.5rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        text-align: right;
        position: relative;
    }
    
    .timeline-item:nth-child(odd) {
        text-align: left;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: #667eea;
        border: 4px solid white;
        border-radius: 50%;
        top: 2rem;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 0 0 3px #667eea;
    }
    
    .timeline-item:nth-child(odd)::before {
        left: 50%;
    }
    
    .timeline-year {
        font-size: 1.5rem;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 0.5rem;
    }
    
    .timeline-text {
        color: #666;
        font-size: 0.95rem;
    }
    
    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 2rem;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    /* Process Flow */
    .process-flow {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        align-items: start;
    }
    
    .process-step {
        text-align: center;
        position: relative;
    }
    
    .process-step::after {
        content: '→';
        position: absolute;
        right: -1.5rem;
        top: 2rem;
        font-size: 1.5rem;
        color: #667eea;
        font-weight: 700;
    }
    
    .process-step:last-child::after {
        display: none;
    }
    
    .step-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }
    
    .step-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    
    .step-desc {
        color: #999;
        font-size: 0.85rem;
    }
    
    /* Distribution Charts */
    .distribution-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }
    
    .distribution-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .distribution-chart {
        position: relative;
        height: 150px;
        margin: 1rem 0;
    }
    
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
    
    @media (max-width: 768px) {
        /* Hide desktop timeline elements */
        .timeline::before {
            display: none;
        }
        
        .timeline-items {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        /* Mobile timeline card design */
        .timeline-item {
            text-align: left !important;
            padding: 1.5rem;
            padding-left: 1.5rem;
            background: white;
            border-left: 5px solid #667eea;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        /* Remove desktop ::before pseudo-element */
        .timeline-item::before {
            display: none;
        }
        
        /* Year badge styling */
        .timeline-year {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            align-self: flex-start;
            margin-bottom: 0.8rem;
        }
        
        .timeline-text {
            font-size: 0.9rem;
            color: #555;
            line-height: 1.5;
        }
        
        .section-header h2 {
            font-size: 1.5rem;
        }
        
        .kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .chart-container {
            height: 250px;
        }
        
        .process-flow {
            grid-template-columns: 1fr;
        }
        
        .process-step::after {
            content: '↓';
            right: auto;
            bottom: -1.5rem;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .distribution-grid {
            grid-template-columns: 1fr;
        }
        
        .step-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }
        
        .step-title {
            font-size: 0.9rem;
        }
    }
</style>

<!-- ===== HERO SECTION WITH BACKGROUND IMAGE ===== -->
<section class="hero-with-image">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Empowering Communities Through Gender Equality</h1>
        <p class="subtitle">Building Inclusive Communities for Sustainable Development</p>
        <div class="buttons is-centered mt-6">
            <a class="button is-white is-large" href="{{ route('programs') }}">
                <span class="icon"><i class="fas fa-chart-bar"></i></span>
                <span><strong>Our Programs</strong></span>
            </a>
            <a class="button is-light is-large" href="{{ route('contact') }}">
                <span class="icon"><i class="fas fa-paper-plane"></i></span>
                <span><strong>Get Involved</strong></span>
            </a>
        </div>
    </div>
</section>

<!-- ===== SECTION 1: KEY IMPACT STATISTICS ===== -->
<section class="section infographic-section white-bg">
    <div class="container">
        <div class="section-header">
            <h2>Key GAD Impact Statistics</h2>
            <p>Measurable outcomes from our 2024 initiatives</p>
        </div>

        <div class="kpi-grid">
            <div class="kpi-card blue">
                <div class="kpi-icon"><i class="fas fa-users"></i></div>
                <div class="kpi-number">250K+</div>
                <div class="kpi-label">Direct Beneficiaries</div>
            </div>
            <div class="kpi-card green">
                <div class="kpi-icon"><i class="fas fa-project-diagram"></i></div>
                <div class="kpi-number">6</div>
                <div class="kpi-label">Active Programs</div>
            </div>
            <div class="kpi-card orange">
                <div class="kpi-icon"><i class="fas fa-file-pdf"></i></div>
                <div class="kpi-number">45+</div>
                <div class="kpi-label">Research Reports</div>
            </div>
            <div class="kpi-card purple">
                <div class="kpi-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="kpi-number">17</div>
                <div class="kpi-label">Regions Covered</div>
            </div>
        </div>

        <div class="columns mt-6 is-multiline">
            <div class="column is-full-mobile is-6-tablet is-6-desktop">
                <div class="chart-container">
                    <h3 style="margin-bottom: 1rem; color: #2c3e50; font-weight: 600;">Annual Participation Growth</h3>
                    <canvas id="growthChart"></canvas>
                </div>
            </div>
            <div class="column is-full-mobile is-6-tablet is-6-desktop">
                <div class="chart-container">
                    <h3 style="margin-bottom: 1rem; color: #2c3e50; font-weight: 600;">Program Distribution by Category</h3>
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SECTION 2: HISTORICAL MILESTONES TIMELINE ===== -->
<section class="section infographic-section">
    <div class="container">
        <div class="section-header">
            <h2>GAD Milestones</h2>
            <p>Key achievements shaping our mission</p>
        </div>

        <div class="timeline">
            <div class="timeline-items">
                <div class="timeline-item">
                    <div class="timeline-year">2019</div>
                    <div class="timeline-text">CatSu GAD established with initial programs focusing on VAWG prevention and economic empowerment</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-text">Adapted programs during COVID-19, reaching 45,000 beneficiaries through virtual channels</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-text">Expanded to 12 regions, published first comprehensive GAD Statistical Report</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-text">Launched Women Entrepreneurship Fund with ₱150M budget allocation</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-text">Achieved 100K+ beneficiaries milestone, established LGBTQ+ rights advocacy alliance</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2024</div>
                    <div class="timeline-text">Expanded to 17 regions, reached 250K+ cumulative beneficiaries</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SECTION 3: HOW GAD WORKS - PROCESS FLOW ===== -->
<section class="section infographic-section white-bg">
    <div class="container">
        <div class="section-header">
            <h2>How GAD Initiatives Work</h2>
            <p>Our comprehensive approach to sustainable gender development</p>
        </div>

        <div class="process-flow">
            <div class="process-step">
                <div class="step-icon"><i class="fas fa-search"></i></div>
                <div class="step-title">Research & Assessment</div>
                <div class="step-desc">Identify community needs and gender gaps</div>
            </div>
            <div class="process-step">
                <div class="step-icon"><i class="fas fa-lightbulb"></i></div>
                <div class="step-title">Program Design</div>
                <div class="step-desc">Develop targeted interventions</div>
            </div>
            <div class="process-step">
                <div class="step-icon"><i class="fas fa-rocket"></i></div>
                <div class="step-title">Implementation</div>
                <div class="step-desc">Execute programs with stakeholders</div>
            </div>
            <div class="process-step">
                <div class="step-icon"><i class="fas fa-chart-line"></i></div>
                <div class="step-title">Monitor & Evaluate</div>
                <div class="step-desc">Measure impact and outcomes</div>
            </div>
        </div>

        <div class="box mt-5" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1)); border-left: 5px solid #667eea;">
            <h4 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem;">Results-Driven Approach</h4>
            <p style="color: #666; margin: 0;">Our methodology ensures sustainable impact through continuous feedback loops, data-driven decisions, and community-centered solutions that address root causes of gender inequality.</p>
        </div>
    </div>
</section>

<!-- ===== SECTION 4: PROGRAM IMPACT VISUALIZATION ===== -->
<section class="section infographic-section">
    <div class="container">
        <div class="section-header">
            <h2>Featured Programs Impact</h2>
            <p>Quick overview of our major initiatives</p>
        </div>

        <div class="distribution-grid">
            @forelse($featuredPrograms as $program)
                <div class="distribution-card">
                    @if($program->icon)
                        <div style="font-size: 2.5rem; margin-bottom: 1rem; color: {{ $program->color ?? '#667eea' }};"><i class="{{ $program->icon }}"></i></div>
                    @endif
                    <h4 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem;">{{ $program->title }}</h4>
                    <div style="font-size: 1.8rem; color: {{ $program->color ?? '#667eea' }}; font-weight: 700; margin: 1rem 0;">{{ $program->value }}</div>
                    <p style="color: #999; font-size: 0.9rem;">{{ $program->label }}</p>
                    @if($program->description)
                        <div style="height: 5px; background: #f0f0f0; border-radius: 3px; margin: 1rem 0;">
                            <div style="height: 100%; width: {{ $program->description }}%; background: linear-gradient(90deg, {{ $program->color ?? '#667eea' }}, {{ $program->color ?? '#667eea' }}); border-radius: 3px;"></div>
                        </div>
                        <p style="color: #999; font-size: 0.85rem;">{{ $program->description }}% completion</p>
                    @endif
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                    <p style="color: #999;">No featured programs data available. <a href="{{ route('admin.statistics.create') }}" style="color: #667eea;">Add featured programs</a></p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== CALL TO ACTION ===== -->
<section class="section white-bg">
    <div class="container">
        <div class="box" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; text-align: center; padding: 2rem 1.5rem;">
            <h2 style="color: white; font-size: clamp(1.5rem, 5vw, 2rem); margin-bottom: 1rem;">Join Our Mission</h2>
            <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: 2rem;">Become part of the movement for gender equality and sustainable development</p>
            <div class="buttons is-centered is-flex-wrap-wrap">
                <a href="{{ route('programs') }}" class="button is-light">
                    <span class="icon"><i class="fas fa-arrow-right"></i></span>
                    <span>Explore Programs</span>
                </a>
                <a href="{{ route('contact') }}" class="button is-light">
                    <span class="icon"><i class="fas fa-envelope"></i></span>
                    <span>Contact Us</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== CHART.JS INITIALIZATION ===== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Participation Growth Bar Chart
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    new Chart(growthCtx, {
        type: 'bar',
        data: {
            labels: ['2019', '2020', '2021', '2022', '2023', '2024'],
            datasets: [{
                label: 'Beneficiaries Reached',
                data: [15000, 45000, 85000, 130000, 180000, 250000],
                backgroundColor: [
                    '#667eea',
                    '#764ba2',
                    '#48c774',
                    '#f0ad4e',
                    '#e74c3c',
                    '#3273dc'
                ],
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: v => (v / 1000) + 'K' }
                }
            }
        }
    });

    // Program Category Distribution Pie Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['VAWG Prevention', 'Economic Empowerment', 'Education Access', 'LGBTQ+ Rights', 'Health & Wellness'],
            datasets: [{
                data: [75000, 50000, 120000, 25000, 18000],
                backgroundColor: [
                    '#667eea',
                    '#764ba2',
                    '#48c774',
                    '#f0ad4e',
                    '#e74c3c'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

@endsection
