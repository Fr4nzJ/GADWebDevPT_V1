@extends('admin.layout')

@section('title', 'Dashboard - GAD Admin Panel')

@section('content')
<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <div>
        <span style="color: #999; font-size: 0.9rem;">
            Last updated: {{ now()->format('F d, Y - H:i A') }}
        </span>
    </div>
</div>

<!-- ===== STATISTICS CARDS ===== -->
<div class="columns is-multiline">
    <div class="column is-6-tablet is-3-desktop">
        <div class="stat-card blue">
            <div class="stat-number">48</div>
            <div class="stat-label">Total News Posts</div>
            <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                <i class="fas fa-arrow-up" style="color: #48c774; margin-right: 0.25rem;"></i>
                12 this month
            </p>
        </div>
    </div>

    <div class="column is-6-tablet is-3-desktop">
        <div class="stat-card purple">
            <div class="stat-number">35</div>
            <div class="stat-label">Total Events</div>
            <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                <i class="fas fa-arrow-up" style="color: #48c774; margin-right: 0.25rem;"></i>
                8 this month
            </p>
        </div>
    </div>

    <div class="column is-6-tablet is-3-desktop">
        <div class="stat-card green">
            <div class="stat-number">26</div>
            <div class="stat-label">Total Programs</div>
            <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                <i class="fas fa-minus" style="color: #999; margin-right: 0.25rem;"></i>
                No changes
            </p>
        </div>
    </div>

    <div class="column is-6-tablet is-3-desktop">
        <div class="stat-card orange">
            <div class="stat-number">52</div>
            <div class="stat-label">Total Reports</div>
            <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                <i class="fas fa-arrow-up" style="color: #48c774; margin-right: 0.25rem;"></i>
                5 this month
            </p>
        </div>
    </div>

    <div class="column is-6-tablet is-3-desktop">
        <div class="stat-card red">
            <div class="stat-number">24</div>
            <div class="stat-label">Total Users</div>
            <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                <i class="fas fa-arrow-up" style="color: #48c774; margin-right: 0.25rem;"></i>
                3 new users
            </p>
        </div>
    </div>
</div>

<!-- ===== CHARTS ROW ===== -->
<div class="columns is-multiline" style="margin-top: 2rem;">
    <div class="column is-6-tablet is-6-desktop">
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1.5rem; font-size: 1rem;">
                <i class="fas fa-chart-line" style="color: #667eea; margin-right: 0.5rem;"></i>
                Monthly Events Overview
            </h4>
            <canvas id="eventsChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <div class="column is-6-tablet is-6-desktop">
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
            <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1.5rem; font-size: 1rem;">
                <i class="fas fa-chart-pie" style="color: #764ba2; margin-right: 0.5rem;"></i>
                Program Distribution Breakdown
            </h4>
            <canvas id="programsChart" style="max-height: 300px;"></canvas>
        </div>
    </div>
</div>

<!-- ===== RECENT ACTIVITY TABLE ===== -->
<div style="margin-top: 2rem;">
    <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
        <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1.5rem; font-size: 1rem;">
            <i class="fas fa-history" style="color: #667eea; margin-right: 0.5rem;"></i>
            Recent Activity
        </h4>

        <table class="table is-fullwidth">
            <thead>
                <tr style="background-color: #f5f7fa;">
                    <th style="color: #667eea; font-weight: 600; border: none; padding: 1.25rem;">Time</th>
                    <th style="color: #667eea; font-weight: 600; border: none; padding: 1.25rem;">User</th>
                    <th style="color: #667eea; font-weight: 600; border: none; padding: 1.25rem;">Action</th>
                    <th style="color: #667eea; font-weight: 600; border: none; padding: 1.25rem;">Module</th>
                    <th style="color: #667eea; font-weight: 600; border: none; padding: 1.25rem;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 1.25rem; border: none;">
                        <span style="font-size: 0.85rem; color: #999;">Today, 02:45 PM</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <strong>Maria Santos</strong>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span style="color: #667eea; font-weight: 500;">Created</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        News - "Women's Month Celebration 2024"
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span class="status-badge status-published">Published</span>
                    </td>
                </tr>

                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 1.25rem; border: none;">
                        <span style="font-size: 0.85rem; color: #999;">Today, 01:20 PM</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <strong>Jennifer Reyes</strong>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span style="color: #48c774; font-weight: 500;">Updated</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        Event - "Gender Mainstreaming Training"
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span class="status-badge status-pending">Pending Review</span>
                    </td>
                </tr>

                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 1.25rem; border: none;">
                        <span style="font-size: 0.85rem; color: #999;">Yesterday, 04:15 PM</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <strong>Clara Gonzales</strong>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span style="color: #667eea; font-weight: 500;">Created</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        Program - "VAWG Prevention Initiative"
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span class="status-badge status-active">Active</span>
                    </td>
                </tr>

                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 1.25rem; border: none;">
                        <span style="font-size: 0.85rem; color: #999;">Yesterday, 10:30 AM</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <strong>Rebecca Torres</strong>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span style="color: #667eea; font-weight: 500;">Created</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        Report - "NGSInS 2024 Survey"
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span class="status-badge status-published">Published</span>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 1.25rem; border: none;">
                        <span style="font-size: 0.85rem; color: #999;">Feb 15, 03:00 PM</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <strong>Ramon Cruz</strong>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span style="color: #e74c3c; font-weight: 500;">Deleted</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        News - "Outdated Article"
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span class="status-badge status-inactive">Archived</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Monthly Events Overview Chart
    const eventsCtx = document.getElementById('eventsChart').getContext('2d');
    new Chart(eventsCtx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Events Created',
                data: [4, 6, 5, 8, 7, 5],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Program Distribution Chart
    const programsCtx = document.getElementById('programsChart').getContext('2d');
    new Chart(programsCtx, {
        type: 'doughnut',
        data: {
            labels: [
                'VAWG Prevention',
                'Women Entrepreneurship',
                'Gender Mainstreaming',
                'Educational Access',
                'Health & Wellness'
            ],
            datasets: [{
                data: [8, 6, 5, 4, 3],
                backgroundColor: [
                    '#667eea',
                    '#764ba2',
                    '#48c774',
                    '#f0ad4e',
                    '#e74c3c'
                ],
                borderColor: '#fff',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
