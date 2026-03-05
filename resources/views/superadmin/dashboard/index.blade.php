@extends('superadmin.layouts.admin')

@section('page-title', 'Dashboard - KondoMarket')

@section('admin-content')
<div class="container-fluid px-0">
    <h2 class="mb-4">Tableau de bord</h2>

    <!-- Cartes statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-primary text-uppercase fw-bold mb-1">Utilisateurs</div>
                            <div class="h3 mb-0">{{ number_format($stats['users_total']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-success text-uppercase fw-bold mb-1">Vendeurs actifs</div>
                            <div class="h3 mb-0">{{ number_format($stats['vendors_active']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-shop fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-left-info shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-info text-uppercase fw-bold mb-1">Produits</div>
                            <div class="h3 mb-0">{{ number_format($stats['products_total']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-left-danger shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-danger text-uppercase fw-bold mb-1">Revenus totaux</div>
                            <div class="h3 mb-0">12000 f</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>

    <!-- Graphiques -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold text-primary">Ventes mensuelles ({{ $currentYear }})</h6>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" style="width:100%; max-height:300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold text-primary">Inscriptions mensuelles ({{ $currentYear }})</h6>
                </div>
                <div class="card-body">
                    <canvas id="registrationsChart" style="width:100%; max-height:300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des derniers vendeurs (optionnel) -->
    @if($recentVendors->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Derniers vendeurs inscrits</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($recentVendors as $vendor)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $vendor->name }}</strong><br>
                                <small class="text-muted">{{ $vendor->created_at->diffForHumans() }}</small>
                            </div>
                            <span class="badge bg-{{ $vendor->status === 'approved' ? 'success' : ($vendor->status === 'pending_review' ? 'warning' : 'secondary') }}">
                                {{ $vendor->status }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.vendors.index') }}">Voir tous <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('admin-scripts')
<script>
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Ventes (€)',
                data: @json(15),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        }
    });

    // Registrations Chart
    const regCtx = document.getElementById('registrationsChart').getContext('2d');
    new Chart(regCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            datasets: [{
                label: 'Inscriptions',
                data: @json(
                10
                ),
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        }
    });
</script>
@endpush