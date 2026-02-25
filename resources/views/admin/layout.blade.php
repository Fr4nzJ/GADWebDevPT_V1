<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GAD Admin Panel')</title>
    
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .user-role {
            background: rgba(255, 255, 255, 0.3);
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
            background: white;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            min-width: 250px;
            padding: 2rem 0;
            border-right: 1px solid #ebebeb;
        }
        
        .admin-sidebar .menu {
            padding: 0 1rem;
        }
        
        .menu-list a {
            color: #666;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .menu-list a:hover {
            background-color: #f5f7fa;
            color: #667eea;
            padding-left: 1.25rem;
        }
        
        .menu-list a.is-active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
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
            color: #2c3e50;
            margin: 0;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-top: 4px solid #667eea;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card.blue {
            border-top-color: #667eea;
        }
        
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
                </ul>
                
                <p class="menu-label" style="color: #999; padding: 0 1rem; margin-top: 2rem; margin-bottom: 1rem;">
                    System
                </p>
                <ul class="menu-list">
                    <li>
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
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
</body>
</html>
