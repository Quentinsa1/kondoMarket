<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title', 'Administration - KondoMarket')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fc;
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 20px 0;
            position: fixed;
            width: 250px;
        }
        .sidebar-heading {
            font-size: 1.5rem;
            font-weight: 700;
            padding: 20px 20px 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar-heading small {
            font-size: 0.8rem;
            font-weight: 400;
            opacity: 0.7;
            display: block;
        }
        .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 12px 20px;
            margin: 4px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .stat-card {
            border-left: 4px solid;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .border-left-primary { border-left-color: #4e73df; }
        .border-left-success { border-left-color: #1cc88a; }
        .border-left-info    { border-left-color: #36b9cc; }
        .border-left-warning { border-left-color: #f6c23e; }
        .border-left-danger  { border-left-color: #e74a3b; }
        .text-gray-300 { color: #dddfeb; }
    </style>
    @stack('admin-styles')
</head>
<body>
    <div class="sidebar shadow">
        <div class="sidebar-heading text-center">
            KondoMarket<br><small>Admin</small>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.vendors.*') ? 'active' : '' }}" href="{{ route('admin.vendors.index') }}">
                <i class="bi bi-shop"></i> Vendeurs
            </a>
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="bi bi-box"></i> Produits
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-credit-card"></i> Commandes
            </a>
            <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                <i class="bi bi-shield-exclamation"></i> Signalements
            </a>
            <a class="nav-link" href="#">
                <i class="bi bi-gear"></i> Paramètres
            </a>
        </nav>
    </div>

    <div class="main-content">
        @yield('admin-content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('admin-scripts')
</body>
</html>