<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GAD Admin Panel')</title>
    
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])
    
    <style>
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        body {
            background: linear-gradient(
                135deg,
                #0c0c0c 0%,
                #1a1a2e 15%,
                #16213e 35%,
                #0f3460 50%,
                #533a7d 70%,
                #8b5a8c 85%,
                #a0616a 100%
            );
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
        }
        
        .admin-navbar {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand .navbar-item {
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
        }
        
        .navbar-end .navbar-item {
            color: white;
        }
        
        .user-badge {
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .user-role {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .admin-wrapper {
            display: flex;
            min-height: calc(100vh - 61px);
        }
        
        .admin-sidebar {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            min-width: 250px;
            padding: 2rem 0;
        }
        
        .admin-sidebar .menu {
            padding: 0 1rem;
        }
        
        .menu-list a {
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .menu-list a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 1.25rem;
        }
        
        .menu-list a.is-active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
            border-left: 4px solid rgba(255, 200, 100, 0.8);
        }
        
        .menu-list a i {
            width: 20px;
            text-align: center;
        }
        
        .admin-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
        }
        
        .stat-card.blue {
            border-top: 3px solid rgba(255, 200, 100, 0.8);
        }
        
        .stat-card.purple {
            border-top: 3px solid rgba(255, 150, 150, 0.8);
        }
        
        .stat-card.green {
            border-top: 3px solid rgba(150, 200, 100, 0.8);
        }
        
        .stat-card.orange {
            border-top: 3px solid rgba(255, 180, 100, 0.8);
        }
        
        .stat-card.red {
            border-top: 3px solid rgba(255, 100, 100, 0.8);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: rgba(255, 200, 100, 0.9);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .admin-table {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
        }
        
        .admin-table table {
            margin-bottom: 0;
        }
        
        .admin-table thead {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .admin-table thead th {
            color: white;
            font-weight: 600;
            border: none;
            padding: 1.25rem;
        }
        
        .admin-table tbody td {
            border: none;
            padding: 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            vertical-align: middle;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .admin-table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-action {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            backdrop-filter: blur(10px);
        }
        
        .btn-edit {
            background-color: rgba(120, 150, 255, 0.2);
            color: rgba(200, 220, 255, 0.9);
            border-color: rgba(120, 150, 255, 0.4);
        }
        
        .btn-edit:hover {
            background-color: rgba(120, 150, 255, 0.3);
            border-color: rgba(120, 150, 255, 0.6);
        }
        
        .btn-delete {
            background-color: rgba(255, 100, 100, 0.2);
            color: rgba(255, 150, 150, 0.9);
            border-color: rgba(255, 100, 100, 0.4);
        }
        
        .btn-delete:hover {
            background-color: rgba(255, 100, 100, 0.3);
            border-color: rgba(255, 100, 100, 0.6);
        }
        
        .btn-view {
            background-color: rgba(100, 200, 100, 0.2);
            color: rgba(150, 255, 150, 0.9);
            border-color: rgba(100, 200, 100, 0.4);
        }
        
        .btn-view:hover {
            background-color: rgba(100, 200, 100, 0.3);
            border-color: rgba(100, 200, 100, 0.6);
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .status-active {
            background-color: rgba(100, 200, 100, 0.2);
            color: rgba(150, 255, 150, 0.9);
            border-color: rgba(100, 200, 100, 0.4);
        }
        
        .status-inactive {
            background-color: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
            border-color: rgba(255, 255, 255, 0.2);
        }
        
        .status-pending {
            background-color: rgba(255, 180, 100, 0.2);
            color: rgba(255, 220, 150, 0.9);
            border-color: rgba(255, 180, 100, 0.4);
        }
        
        .status-published {
            background-color: rgba(120, 150, 255, 0.2);
            color: rgba(200, 220, 255, 0.9);
            border-color: rgba(120, 150, 255, 0.4);
        }
        
        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .admin-wrapper {
                flex-direction: column;
                min-height: auto;
            }
            
            .admin-sidebar {
                display: none;
                width: 100%;
                min-width: 100%;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                padding: 1rem 0;
            }
            
            .admin-sidebar.is-open {
                display: block;
            }
            
            .admin-content {
                padding: 1.5rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .stat-card {
                margin-bottom: 1rem;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: white;
        }
    </style>
</head>
<body>
        
        .stat-card.purple {
            border-top-color: #764ba2;
        }
        
        .stat-card.green {
            border-top-color: #48c774;
        }
        
        .stat-card.orange {
            border-top-color: #f0ad4e;
        }
        
        .stat-card.red {
            border-top-color: #e74c3c;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #999;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-card.purple .stat-number {
            color: #764ba2;
        }
        
        .stat-card.green .stat-number {
            color: #48c774;
        }
        
        .stat-card.orange .stat-number {
            color: #f0ad4e;
        }
        
        .stat-card.red .stat-number {
            color: #e74c3c;
        }
        
        .admin-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .admin-table table {
            margin-bottom: 0;
        }
        
        .admin-table thead {
            background-color: #f5f7fa;
        }
        
        .admin-table thead th {
            color: #667eea;
            font-weight: 600;
            border: none;
            padding: 1.25rem;
        }
        
        .admin-table tbody td {
            border: none;
            padding: 1.25rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }
        
        .admin-table tbody tr:hover {
            background-color: #f9faff;
        }
        
        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-action {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .btn-edit {
            background-color: #e8f1ff;
            color: #667eea;
        }
        
        .btn-edit:hover {
            background-color: #d0e1ff;
        }
        
        .btn-delete {
            background-color: #ffe8e8;
            color: #e74c3c;
        }
        
        .btn-delete:hover {
            background-color: #ffd0d0;
        }
        
        .btn-view {
            background-color: #e8f5e9;
            color: #48c774;
        }
        
        .btn-view:hover {
            background-color: #d0f0d0;
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .status-active {
            background-color: #e8f5e9;
            color: #48c774;
        }
        
        .status-inactive {
            background-color: #f5f5f5;
            color: #999;
        }
        
        .status-pending {
            background-color: #fff8e1;
            color: #f0ad4e;
        }
        
        .status-published {
            background-color: #e8f1ff;
            color: #667eea;
        }
        
        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .admin-wrapper {
                flex-direction: column;
                min-height: auto;
            }
            
            .admin-sidebar {
                display: none;
                width: 100%;
                min-width: 100%;
                border-right: none;
                border-bottom: 1px solid #ebebeb;
                padding: 1rem 0;
            }
            
            .admin-sidebar.is-open {
                display: block;
            }
            
            .admin-content {
                padding: 1.5rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .stat-card {
                margin-bottom: 1rem;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .logout-btn:hover {
            background: white;
            color: #667eea;
        }
    </style>
</head>
<body>
    <!-- ===== TOP NAVBAR ===== -->
    <nav class="navbar admin-navbar is-fixed-top">
        <div class="navbar-brand">
            <div class="navbar-item">
                <i class="fas fa-chart-line" style="margin-right: 0.5rem;"></i>
                GAD Admin Panel
            </div>
            <a role="button" class="navbar-burger" x-data @click="document.getElementById('sidebar').classList.toggle('is-open')" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="user-badge">
                    <i class="fas fa-user-circle fa-lg"></i>
                    <span>Admin User</span>
                    <span class="user-role">Administrator</span>
                </div>
            </div>
            <div class="navbar-item">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="admin-wrapper" style="margin-top: 61px;">
        <!-- ===== SIDEBAR NAVIGATION ===== -->
        <aside class="admin-sidebar" id="sidebar">
            <div class="menu">
                <p class="menu-label" style="color: #999; padding: 0 1rem; margin-bottom: 1rem;">
                    Main Navigation
                </p>
                <ul class="menu-list">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" @class(['is-active' => request()->routeIs('admin.dashboard')])>
                            <i class="fas fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.index') }}" @class(['is-active' => request()->routeIs('admin.news.*')])>
                            <i class="fas fa-newspaper"></i>
                            <span>Manage News</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.index') }}" @class(['is-active' => request()->routeIs('admin.events.*')])>
                            <i class="fas fa-calendar"></i>
                            <span>Manage Events</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.programs.index') }}" @class(['is-active' => request()->routeIs('admin.programs.*')])>
                            <i class="fas fa-tasks"></i>
                            <span>Manage Programs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" @class(['is-active' => request()->routeIs('admin.reports.*')])>
                            <i class="fas fa-file-pdf"></i>
                            <span>Manage Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" @class(['is-active' => request()->routeIs('admin.users.*')])>
                            <i class="fas fa-users"></i>
                            <span>Manage Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.index') }}" @class(['is-active' => request()->routeIs('admin.contacts.*')])>
                            <i class="fas fa-envelope"></i>
                            <span>Contact Messages</span>
                        </a>
                    </li>
                </ul>

                <p class="menu-label" style="color: #999; padding: 0 1rem; margin-top: 2rem; margin-bottom: 1rem;">
                    Page Content Management
                </p>
                <ul class="menu-list">
                    <li>
                        <a href="{{ route('admin.statistics.index') }}" @class(['is-active' => request()->routeIs('admin.statistics.*')])>
                            <i class="fas fa-chart-bar"></i>
                            <span>Featured Programs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.milestones.index') }}" @class(['is-active' => request()->routeIs('admin.milestones.*')])>
                            <i class="fas fa-timeline"></i>
                            <span>Milestones</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.process-steps.index') }}" @class(['is-active' => request()->routeIs('admin.process-steps.*')])>
                            <i class="fas fa-tasks"></i>
                            <span>Process Steps</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-values.index') }}" @class(['is-active' => request()->routeIs('admin.page-values.*')])>
                            <i class="fas fa-feather"></i>
                            <span>Page Values</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page-sections.index') }}" @class(['is-active' => request()->routeIs('admin.page-sections.*')])>
                            <i class="fas fa-window-maximize"></i>
                            <span>Page Sections</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.chart-data.index') }}" @class(['is-active' => request()->routeIs('admin.chart-data.*')])>
                            <i class="fas fa-chart-column"></i>
                            <span>Chart Data</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.achievements.index') }}" @class(['is-active' => request()->routeIs('admin.achievements.*')])>
                            <i class="fas fa-trophy"></i>
                            <span>Key Achievements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.program-statistics.index') }}" @class(['is-active' => request()->routeIs('admin.program-statistics.*')])>
                            <i class="fas fa-chart-pie"></i>
                            <span>Program Statistics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.event-statistics.index') }}" @class(['is-active' => request()->routeIs('admin.event-statistics.*')])>
                            <i class="fas fa-chart-line"></i>
                            <span>Event Statistics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.policy-briefs.index') }}" @class(['is-active' => request()->routeIs('admin.policy-briefs.*')])>
                            <i class="fas fa-file-alt"></i>
                            <span>Policy Briefs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.resources.index') }}" @class(['is-active' => request()->routeIs('admin.resources.*')])>
                            <i class="fas fa-book"></i>
                            <span>Resources</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.report-statistics.index') }}" @class(['is-active' => request()->routeIs('admin.report-statistics.*')])>
                            <i class="fas fa-chart-bar"></i>
                            <span>Report Statistics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.statistical-yearbooks.index') }}" @class(['is-active' => request()->routeIs('admin.statistical-yearbooks.*')])>
                            <i class="fas fa-book"></i>
                            <span>Statistical Yearbooks</span>
                        </a>
                    </li>
                </ul>
                
                <p class="menu-label" style="color: #999; padding: 0 1rem; margin-top: 2rem; margin-bottom: 1rem;">
                    Dashboard Management
                </p>
                <ul class="menu-list">
                    <li>
                        <a href="{{ route('admin.dashboard-statistics.index') }}" @class(['is-active' => request()->routeIs('admin.dashboard-statistics.*')])>
                            <i class="fas fa-chart-column"></i>
                            <span>Dashboard Statistics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard-activities.index') }}" @class(['is-active' => request()->routeIs('admin.dashboard-activities.*')])>
                            <i class="fas fa-history"></i>
                            <span>Dashboard Activities</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.monthly-event-charts.index') }}" @class(['is-active' => request()->routeIs('admin.monthly-event-charts.*')])>
                            <i class="fas fa-chart-line"></i>
                            <span>Monthly Events Chart</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.program-distribution-charts.index') }}" @class(['is-active' => request()->routeIs('admin.program-distribution-charts.*')])>
                            <i class="fas fa-chart-pie"></i>
                            <span>Program Distribution Chart</span>
                        </a>
                    </li>
                
                <p class="menu-label" style="color: #999; padding: 0 1rem; margin-top: 2rem; margin-bottom: 1rem;">
                    System
                </p>
                <ul class="menu-list">
                    <li>
                        <a href="{{ route('admin.database-management.index') }}" @class(['is-active' => request()->routeIs('admin.database-management.*')])>
                            <i class="fas fa-database"></i>
                            <span>Database Management</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- ===== MAIN CONTENT ===== -->
        <main class="admin-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bulma@0.9.4/js/bulma-modal-fx.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap 4 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
