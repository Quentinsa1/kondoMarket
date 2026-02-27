@extends('template.template')

@section('title')
    @yield('page-title', 'Super Admin - KondoMarket')
@endsection

@section('navbar')
    @include('superadmin.partials.admin-header')
@endsection

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex">
        <!-- Sidebar -->
        @include('superadmin.partials.sidebar')

        <!-- Main Content Area -->
        <main class="flex-grow-1 p-4" style="background-color: var(--light-color); min-height: calc(100vh - 80px);">
            @yield('admin-content')
        </main>
    </div>
</div>
@endsection

@push('styles')
    <!-- DataTables and Select2 (already in template, but ensure they are loaded) -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <!-- Chart.js (optional) -->
    <style>
        /* Ajustements supplémentaires si nécessaire */
        .sidebar {
            width: 260px;
            background-color: white;
            border-right: 1px solid var(--gray-light);
            box-shadow: var(--shadow-sm);
        }
        .sidebar .nav-link {
            color: var(--secondary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0;
            transition: var(--transition);
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(245, 158, 66, 0.1);
            color: var(--accent-color);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .sidebar-heading {
            padding: 1.5rem 1.5rem 1rem;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            border-bottom: 1px solid var(--gray-light);
        }
        .stat-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }
        .stat-card .card-body {
            padding: 1.5rem;
        }
        .border-left-primary { border-left: 4px solid var(--primary-color); }
        .border-left-success { border-left: 4px solid #28a745; }
        .border-left-info    { border-left: 4px solid #17a2b8; }
        .border-left-warning { border-left: 4px solid #ffc107; }
        .border-left-danger  { border-left: 4px solid #dc3545; }
        .border-left-secondary { border-left: 4px solid #6c757d; }
    </style>
@endpush

@push('scripts')
    <!-- jQuery, Bootstrap, DataTables, Chart.js, Select2 (already in template, but ensure order) -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('admin-scripts')
@endpush