@extends('layouts.bulma')

@section('title', 'Research & Reports - GAD Philippines')

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

<!-- ===== HERO SECTION ===== -->
<section class="hero hero-gradient is-fullheight-with-navbar" style="height: 500px;">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title is-1" style="color: white; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2); margin-bottom: 1.5rem; letter-spacing: -0.5px;">
                Research & Reports
            </h1>
            <p class="subtitle is-3" style="color: #f0f0f0; margin-bottom: 1.5rem; font-weight: 300;">
                Evidence-Based Knowledge for Gender Equality & Inclusion
            </p>
            <div style="margin-top: 2rem;">
                <a href="#reports-section" class="button is-white is-outlined is-medium" style="border-width: 2px;">
                    <span>Explore Research</span>
                    <span class="icon"><i class="fas fa-arrow-down"></i></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== BREADCRUMB ===== -->
<section class="section" style="padding: 1.5rem 1.5rem;">
    <div class="container">
        <nav class="breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
            <ul>
                <li><a href="{{ route('welcome') }}">Home</a></li>
                <li class="is-active"><a href="{{ route('reports') }}" aria-current="page">Reports</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- ===== REPORTS TABLE ===== -->
<section class="section" id="reports-section" style="padding: 4rem 1.5rem;">
    <div class="container">
        <h2 class="section-title">GAD Research Publications & Reports</h2>

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
                    <!-- Report 1 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">National Gender & Social Inclusion Survey (NGSInS) 2024</td>
                        <td style="padding: 1.25rem;">2024</td>
                        <td style="padding: 1.25rem;"><span class="tag is-info">Survey</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Comprehensive nationwide survey examining attitudes towards gender equality, discrimination experiences, and social inclusion across 15,000 households</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 2 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Women's Economic Participation & Labor Trends Report</td>
                        <td style="padding: 1.25rem;">2023</td>
                        <td style="padding: 1.25rem;"><span class="tag is-warning">Analysis</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Analysis of women's labor force participation, wage gaps, business ownership, and sectoral distribution using data from 2019-2023 Labor Force Survey</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 3 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Violence Against Women and Girls Prevalence Study</td>
                        <td style="padding: 1.25rem;">2023</td>
                        <td style="padding: 1.25rem;"><span class="tag is-danger">Research Study</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Multi-year study on prevalence, types, and impacts of VAWG in selected regions. Includes recommendations for prevention and response programs.</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 4 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Gender Mainstreaming Assessment: Government Agencies 2023</td>
                        <td style="padding: 1.25rem;">2023</td>
                        <td style="padding: 1.25rem;"><span class="tag is-success">Assessment</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Evaluation of 85 government agencies' capacity and commitment to gender mainstreaming based on mandates, budgets, programs, and GAD focal person effectiveness.</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 5 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Women's Access to Land & Agricultural Resources in Agrarian Reform Areas</td>
                        <td style="padding: 1.25rem;">2023</td>
                        <td style="padding: 1.25rem;"><span class="tag is-info">Baseline Study</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Baseline assessment of women's participation in and access to benefits from agricultural reform programs across 8 regions.</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 6 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Gender Audit of Education: Learning Materials & Curriculum Analysis</td>
                        <td style="padding: 1.25rem;">2022</td>
                        <td style="padding: 1.25rem;"><span class="tag is-warning">Audit</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Analysis of 500+ textbooks and learning materials to identify gender stereotypes and recommend curriculum revisions for schools.</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 7 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Gender-Responsive Budgeting: Tracking Public Spending on Gender Programs</td>
                        <td style="padding: 1.25rem;">2022</td>
                        <td style="padding: 1.25rem;"><span class="tag is-info">Budget Analysis</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Comprehensive tracking of national and local government expenditures on gender equality and women empowerment programs (2018-2022 trend analysis).</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 8 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">LGBTQ+ Health Needs Assessment & Recommendations</td>
                        <td style="padding: 1.25rem;">2022</td>
                        <td style="padding: 1.25rem;"><span class="tag is-danger">Health Study</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Study on health concerns, access barriers, and service needs of LGBTQ+ individuals in the Philippines with policy recommendations.</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 9 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Women Entrepreneurs: Impact Evaluation of Loan Programs 2019-2022</td>
                        <td style="padding: 1.25rem;">2022</td>
                        <td style="padding: 1.25rem;"><span class="tag is-success">Impact Study</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Rigorous evaluation of women entrepreneurs who received microloans, measuring business growth, income changes, and household impacts over 3 years.</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Report 10 -->
                    <tr>
                        <td style="padding: 1.25rem; font-weight: 600; color: #667eea;">Gender & Climate Change Vulnerability Assessment</td>
                        <td style="padding: 1.25rem;">2021</td>
                        <td style="padding: 1.25rem;"><span class="tag is-info">Assessment</span></td>
                        <td style="padding: 1.25rem; font-size: 0.95rem;">Analysis of differential impacts of climate change on women and men, with recommendations for climate adaptation with gender lens.</td>
                        <td style="padding: 1.25rem; text-align: center;">
                            <a href="#" class="button is-small" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                                <span class="icon"><i class="fas fa-download"></i></span>
                                <span>PDF</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ===== POLICY BRIEFS SECTION ===== -->
<section class="section" style="padding: 4rem 1.5rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0edff 100%);">
    <div class="container">
        <h2 class="section-title">Policy Briefs & Infographics</h2>

        <div class="columns is-multiline">
            <!-- Policy Brief 1 -->
            <div class="column is-4">
                <div class="card" style="height: 100%; display: flex; flex-direction: column; border-top: 4px solid #667eea;">
                    <div class="card-header">
                        <p class="card-header-title" style="align-items: flex-start;">
                            <span class="icon" style="color: #667eea;"><i class="fas fa-file-alt"></i></span>
                            <span style="color: #667eea; font-weight: 600; text-align: left;">Only 1 in 4 Women Agricultural Workers Earn Fair Wages</span>
                        </p>
                    </div>
                    <div class="card-content" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="content">
                            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                                Agricultural sector continues to pay women workers significantly less despite their critical role. Policy brief recommends wage standards and anti-discrimination enforcement.
                            </p>
                            <p style="font-size: 0.9rem; color: #999;"><strong>Pages:</strong> 4 | <strong>Year:</strong> 2024</p>
                        </div>
                        <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; margin-top: 1rem;">
                            <span class="icon"><i class="fas fa-download"></i></span>
                            <span>Download Brief</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Policy Brief 2 -->
            <div class="column is-4">
                <div class="card" style="height: 100%; display: flex; flex-direction: column; border-top: 4px solid #764ba2;">
                    <div class="card-header">
                        <p class="card-header-title" style="align-items: flex-start;">
                            <span class="icon" style="color: #764ba2;"><i class="fas fa-file-alt"></i></span>
                            <span style="color: #764ba2; font-weight: 600; text-align: left;">Girls' Out-of-School Rate: Data & Solutions</span>
                        </p>
                    </div>
                    <div class="card-content" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="content">
                            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                                1.2 million girls remain out of school. Brief outlines barriers (poverty, early marriage, VAWG) and proven interventions for inclusion.
                            </p>
                            <p style="font-size: 0.9rem; color: #999;"><strong>Pages:</strong> 6 | <strong>Year:</strong> 2023</p>
                        </div>
                        <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; margin-top: 1rem;">
                            <span class="icon"><i class="fas fa-download"></i></span>
                            <span>Download Brief</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Policy Brief 3 -->
            <div class="column is-4">
                <div class="card" style="height: 100%; display: flex; flex-direction: column; border-top: 4px solid #667eea;">
                    <div class="card-header">
                        <p class="card-header-title" style="align-items: flex-start;">
                            <span class="icon" style="color: #667eea;"><i class="fas fa-file-alt"></i></span>
                            <span style="color: #667eea; font-weight: 600; text-align: left;">Gender Budgeting: 5% Allocation Impact</span>
                        </p>
                    </div>
                    <div class="card-content" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="content">
                            <p style="color: #666; line-height: 1.6; margin-bottom: 1rem;">
                                Government mandate for 5% GAD budgets represents PHP 50 billion annually for gender programs. Brief tracks allocation and outcomes.
                            </p>
                            <p style="font-size: 0.9rem; color: #999;"><strong>Pages:</strong> 5 | <strong>Year:</strong> 2023</p>
                        </div>
                        <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; margin-top: 1rem;">
                            <span class="icon"><i class="fas fa-download"></i></span>
                            <span>Download Brief</span>
                        </a>
                    </div>
                </div>
            </div>
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
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 1rem;">GAD Philippines Statistical Yearbook 2024</h4>
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
                <div class="column is-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; padding: 2.5rem;">
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
            <div class="column is-6">
                <div class="resource-box">
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 1rem;">
                        <i class="fas fa-book" style="margin-right: 0.75rem;"></i>Gender-Responsive Research Toolkit
                    </h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                        Comprehensive guide for designing and implementing gender-responsive research projects. 
                        Includes methodologies, sampling strategies, ethical guidelines, and analysis frameworks.
                    </p>
                    <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                        <span class="icon"><i class="fas fa-download"></i></span>
                        <span>Download Toolkit</span>
                    </a>
                </div>
            </div>

            <div class="column is-6">
                <div class="resource-box alt">
                    <h4 class="title is-5" style="color: #764ba2; margin-bottom: 1rem;">
                        <i class="fas fa-database" style="margin-right: 0.75rem;"></i>Gender Indicators Database
                    </h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                        Interactive online database of gender indicators across provinces. Searchable by indicator type, 
                        year, and location. Useful for monitoring progress toward SDGs and gender equality targets.
                    </p>
                    <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, #764ba2, #667eea); color: white; border: none;">
                        <span class="icon"><i class="fas fa-external-link-alt"></i></span>
                        <span>Access Database</span>
                    </a>
                </div>
            </div>

            <div class="column is-6">
                <div class="resource-box">
                    <h4 class="title is-5" style="color: #667eea; margin-bottom: 1rem;">
                        <i class="fas fa-graduation-cap" style="margin-right: 0.75rem;"></i>GAD Training Resources
                    </h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                        Training modules and curricula on gender analysis, gender budgeting, gender mainstreaming, 
                        and LGBTQ+ rights. Available in PowerPoint, video, and manual formats.
                    </p>
                    <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none;">
                        <span class="icon"><i class="fas fa-play-circle"></i></span>
                        <span>View Training Materials</span>
                    </a>
                </div>
            </div>

            <div class="column is-6">
                <div class="resource-box alt">
                    <h4 class="title is-5" style="color: #764ba2; margin-bottom: 1rem;">
                        <i class="fas fa-globe" style="margin-right: 0.75rem;"></i>International Resources
                    </h4>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                        Curated links to UN Women, gender equality resources, international research networks, 
                        and databases on gender-responsive development from partner organizations worldwide.
                    </p>
                    <a href="#" class="button is-fullwidth" style="background: linear-gradient(135deg, #764ba2, #667eea); color: white; border: none;">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        <span>External Links</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== REPORT STATISTICS ===== -->
<section class="section" style="padding: 4rem 1.5rem;">
    <div class="container">
        <h2 class="section-title">Our Research Impact</h2>

        <div class="columns is-multiline">
            <div class="column is-6-tablet is-3-desktop">
                <div class="stat-box" style="background: linear-gradient(135deg, #3273dc 0%, #0162f0 100%); color: white; border-radius: 12px;">
                    <h3 class="stat-number">45+</h3>
                    <p class="stat-label">Research Reports Published</p>
                    <p style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.9;">Since 2015</p>
                </div>
            </div>

            <div class="column is-6-tablet is-3-desktop">
                <div class="stat-box" style="background: linear-gradient(135deg, #48c774 0%, #2eb869 100%); color: white; border-radius: 12px;">
                    <h3 class="stat-number">15K+</h3>
                    <p class="stat-label">Monthly Downloads</p>
                    <p style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.9;">Access to publications</p>
                </div>
            </div>

            <div class="column is-6-tablet is-3-desktop">
                <div class="stat-box" style="background: linear-gradient(135deg, #ffdd57 0%, #ffb81c 100%); color: white; border-radius: 12px;">
                    <h3 class="stat-number">120+</h3>
                    <p class="stat-label">Citations in Literature</p>
                    <p style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.9;">Academic & policy papers</p>
                </div>
            </div>

            <div class="column is-6-tablet is-3-desktop">
                <div class="stat-box" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px;">
                    <h3 class="stat-number">32</h3>
                    <p class="stat-label">Policy Briefs</p>
                    <p style="font-size: 0.85rem; margin-top: 0.5rem; opacity: 0.9;">Informing decision makers</p>
                </div>
            </div>
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
