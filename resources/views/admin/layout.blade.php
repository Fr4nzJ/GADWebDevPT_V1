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
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #2d2d2d;
        }
        
        .admin-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 15px 30px;
        }
        
        .navbar-brand .navbar-item {
            font-weight: 700;
            font-size: 1.2rem;
            color: #ff6b6b;
        }
        
        .navbar-end .navbar-item {
            color: #2d2d2d;
        }
        
        .user-badge {
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #e0e0e0;
        }
        
        .user-role {
            background: #ff6b6b;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .admin-wrapper {
            display: flex;
            min-height: calc(100vh - 61px);
        }
        
        .admin-sidebar {
            background: #ffffff;
            border-right: 1px solid #e0e0e0;
            min-width: 250px;
            padding: 2rem 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }
        
        .admin-sidebar .menu {
            padding: 0 1rem;
        }
        
        .menu-list a {
            color: #2d2d2d;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .menu-list a:hover {
            background-color: #f8f9fa;
            color: #ff6b6b;
            padding-left: 1.25rem;
        }
        
        .menu-list a.is-active {
            background: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
            font-weight: 700;
            border-left: 4px solid #ff6b6b;
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
            color: #2d2d2d;
            margin: 0;
        }
        
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card.blue {
            border-top: 3px solid #4e73df;
        }
        
        .stat-card.purple {
            border-top: 3px solid #764ba2;
        }
        
        .stat-card.green {
            border-top: 3px solid #48c774;
        }
        
        .stat-card.orange {
            border-top: 3px solid #f0ad4e;
        }
        
        .stat-card.red {
            border-top: 3px solid #ff6b6b;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ff6b6b;
            margin-bottom: 0.5rem;
        }
        
        .stat-card.blue .stat-number {
            color: #4e73df;
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
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .admin-table {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: none;
        }
        
        .admin-table table {
            margin-bottom: 0;
        }
        
        .admin-table thead {
            background-color: #f8f9fa;
        }
        
        .admin-table thead th {
            color: #2d2d2d;
            font-weight: 700;
            border: none;
            padding: 1.25rem;
            background: #f8f9fa;
        }
        
        .admin-table tbody td {
            border: none;
            padding: 1.25rem;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: middle;
            color: #2d2d2d;
        }
        
        .admin-table tbody tr:hover {
            background-color: #f8f9fa;
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
            font-weight: 600;
        }
        
        .btn-edit {
            background-color: #e8f1ff;
            color: #4e73df;
        }
        
        .btn-edit:hover {
            background-color: #d0e1ff;
        }
        
        .btn-delete {
            background-color: #ffe8e8;
            color: #ff6b6b;
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
            font-weight: 700;
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
            color: #4e73df;
        }
        
        .logout-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 700;
            font-size: 0.9rem;
        }
        
        .logout-btn:hover {
            background: #ff5252;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
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
                border-bottom: 1px solid #e0e0e0;
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
