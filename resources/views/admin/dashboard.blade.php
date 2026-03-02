@extends('admin.layout')

@section('title', 'Dashboard - GAD Admin Panel')

@section('content')
<style>
    .stat-card {
        border-radius: 12px;
        padding: 1.5rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card.blue { background: linear-gradient(135deg, #667eea, #3273dc); }
    .stat-card.purple { background: linear-gradient(135deg, #764ba2, #667eea); }
    .stat-card.green { background: linear-gradient(135deg, #48c774, #2eb869); }
    .stat-card.orange { background: linear-gradient(135deg, #f0ad4e, #ffb81c); }
    .stat-card.red { background: linear-gradient(135deg, #e74c3c, #c0392b); }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }
    
    .stat-number {
       font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        
    }
    
    .stat-label {
        font-size: 0.95rem;
        opacity: 0.95;
        margin-bottom: 0.5rem;
        color: white;
    }
    
    .trend-indicator {
        font-size: 0.85rem;
        opacity: 0.9;
    }
</style>

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
    @forelse ($statistics as $stat)
    <div class="column is-6-tablet is-3-desktop">
        <div class="stat-card {{ $stat->color_class }}">
            <div class="stat-number" style="color: white;">{{ $stat->value }}</div>
            <div class="stat-label">{{ $stat->label }}</div>
            <p class="trend-indicator" >
                @if ($stat->trend_direction === 'up')
                    <i class="fas fa-arrow-up" style="color: #48c774; margin-right: 0.25rem;"></i>
                @elseif ($stat->trend_direction === 'down')
                    <i class="fas fa-arrow-down" style="color: #e74c3c; margin-right: 0.25rem;"></i>
                @else
                    <i class="fas fa-minus" style="margin-right: 0.25rem;"></i>
                @endif
                {{ $stat->trend_text ?? 'No change' }}
            </p>
        </div>
    </div>
    @empty
    <div class="column is-12">
        <div class="notification is-info is-light">
            <p>No statistics configured. <a href="{{ route('admin.dashboard-statistics.create') }}">Add statistics</a></p>
        </div>
    </div>
    @endforelse
</div>

<!-- ===== CHARTS ROW ===== -->
<div class="columns is-multiline" style="margin-top: 2rem;">
    <div class="column is-6-tablet is-6-desktop">
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
            <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1.5rem; font-size: 1rem;">
                <i class="fas fa-chart-line" style="color: #667eea; margin-right: 0.5rem;"></i>
                Monthly Events Overview
            </h4>
            <canvas id="eventsChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <div class="column is-6-tablet is-6-desktop">
        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
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
    <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08); color: #333;">
        <h4 style="font-weight: 600; color: #2c3e50; margin-bottom: 1.5rem; font-size: 1rem;">
            <i class="fas fa-history" style="color: #667eea; margin-right: 0.5rem;"></i>
            Recent Activity
            <a href="{{ route('admin.dashboard-activities.index') }}" style="float: right; font-size: 0.85rem; color: #667eea; text-decoration: none;">View All →</a>
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
                @forelse ($activities as $activity)
                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 1.25rem; border: none;">
                        <span style="font-size: 0.85rem; color: #999;">{{ $activity->action_time->format('M d, h:i A') }}</span>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <strong>{{ $activity->user_name }}</strong>
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        @if ($activity->action === 'created')
                            <span style="color: #667eea; font-weight: 500;">Created</span>
                        @elseif ($activity->action === 'updated')
                            <span style="color: #48c774; font-weight: 500;">Updated</span>
                        @else
                            <span style="color: #e74c3c; font-weight: 500;">Deleted</span>
                        @endif
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        {{ $activity->module }} - {{ $activity->description }}
                    </td>
                    <td style="padding: 1.25rem; border: none;">
                        <span class="status-badge status-{{ strtolower($activity->status) }}">
                            @if ($activity->status === 'published')
                                Published
                            @elseif ($activity->status === 'pending')
                                Pending Review
                            @elseif ($activity->status === 'active')
                                Active
                            @elseif ($activity->status === 'archived')
                                Archived
                            @else
                                {{ ucfirst($activity->status) }}
                            @endif
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 2rem; text-align: center; border: none; color: #999;">
                        <p>No activities logged yet. <a href="{{ route('admin.dashboard-activities.create') }}">Log an activity</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Monthly Events Overview Chart
    const eventsCtx = document.getElementById('eventsChart').getContext('2d');
    const monthlyChartData = @json($monthlyEventCharts ?? []);
    
    // Extract months and values from database
    const monthLabels = monthlyChartData.map(item => item.month) || ['January', 'February', 'March', 'April', 'May', 'June'];
    const monthValues = monthlyChartData.map(item => item.value) || [4, 6, 5, 8, 7, 5];
    
    new Chart(eventsCtx, {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Events Created',
                data: monthValues,
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
    const programChartData = @json($programDistributionCharts ?? []);
    
    // Extract labels, values, and colors from database
    const programLabels = programChartData.map(item => item.label) || ['VAWG Prevention', 'Women Entrepreneurship', 'Gender Mainstreaming', 'Educational Access', 'Health & Wellness'];
    const programValues = programChartData.map(item => item.value) || [8, 6, 5, 4, 3];
    const programColors = programChartData.map(item => item.color_hex || '#667eea') || ['#667eea', '#764ba2', '#48c774', '#f0ad4e', '#e74c3c'];
    
    new Chart(programsCtx, {
        type: 'doughnut',
        data: {
            labels: programLabels,
            datasets: [{
                data: programValues,
                backgroundColor: programColors,
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

