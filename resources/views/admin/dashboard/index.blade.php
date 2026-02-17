@extends('admin.layouts.admin')

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
                            <div class="h3 mb-0">12 345</div>
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
                            <div class="h3 mb-0">234</div>
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
                            <div class="h3 mb-0">5 678</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-warning text-uppercase fw-bold mb-1">Commandes aujourd'hui</div>
                            <div class="h3 mb-0">45</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cart-check fs-1 text-gray-300"></i>
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
                            <div class="h3 mb-0">45 678 €</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-left-secondary shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-secondary text-uppercase fw-bold mb-1">Commandes totales</div>
                            <div class="h3 mb-0">3 456</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-bag-check fs-1 text-gray-300"></i>
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
                    <h6 class="m-0 fw-bold text-primary">Ventes mensuelles (2025)</h6>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" style="width:100%; max-height:300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold text-primary">Inscriptions mensuelles (2025)</h6>
                </div>
                <div class="card-body">
                    <canvas id="registrationsChart" style="width:100%; max-height:300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
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
                data: [12000, 15000, 18000, 22000, 25000, 28000, 30000, 32000, 35000, 38000, 40000, 45000],
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
                data: [150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700],
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        }
    });
</script>
@endpush