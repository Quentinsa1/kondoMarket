@extends('admin.layouts.admin')

@section('page-title', 'Dashboard Administrateur - KondoMarket')

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
                            <div class="text-xs text-primary text-uppercase fw-bold mb-1">Vendeurs</div>
                            <div class="h3 mb-0">{{ $stats['total_vendors'] }}</div>
                            <small>{{ $stats['pending_vendors'] }} en attente</small>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-shop fs-1 text-gray-300"></i>
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
                            <div class="text-xs text-success text-uppercase fw-bold mb-1">Produits</div>
                            <div class="h3 mb-0">{{ $stats['total_products'] }}</div>
                            <small>{{ $stats['active_products'] }} actifs</small>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fs-1 text-gray-300"></i>
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
                            <div class="text-xs text-info text-uppercase fw-bold mb-1">Commandes</div>
                            <div class="h3 mb-0">{{ $stats['total_orders'] }}</div>
                            <small>{{ $stats['orders_today'] }} aujourd'hui</small>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cart-check fs-1 text-gray-300"></i>
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
                            <div class="text-xs text-warning text-uppercase fw-bold mb-1">Revenus</div>
                            <div class="h3 mb-0">{{ number_format($stats['total_revenue'], 0, ',', ' ') }} €</div>
                            <small>{{ $stats['pending_reports'] }} signalements</small>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Actions rapides</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.vendors.index', ['status' => 'pending_review']) }}" class="btn btn-sm btn-outline-primary me-2">
                        <i class="bi bi-clock"></i> Vendeurs en attente
                    </a>
                    <a href="{{ route('admin.products.index', ['status' => 'inactive']) }}" class="btn btn-sm btn-outline-success me-2">
                        <i class="bi bi-eye-slash"></i> Produits inactifs
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-outline-warning me-2">
                        <i class="bi bi-shield-exclamation"></i> Signalements ({{ $stats['pending_reports'] }})
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-shop"></i> Tous les vendeurs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Activités récentes -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Nouveaux vendeurs</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($recent_vendors as $vendor)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $vendor->vendor_type == 'individual' ? $vendor->display_name : $vendor->company_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $vendor->created_at->diffForHumans() }}</small>
                                </div>
                                <span class="badge bg-{{ $vendor->status == 'approved' ? 'success' : ($vendor->status == 'pending_review' ? 'warning' : 'secondary') }}">
                                    {{ $vendor->status }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item">Aucun vendeur récent</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.vendors.index') }}">Voir tous <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Derniers signalements</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($recent_reports as $report)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $report->report_type }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $report->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item">Aucun signalement récent</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.reports.index') }}">Voir tous <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Dernières commandes</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($recent_orders as $order)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Commande #{{ $order->id }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                </div>
                                <span class="badge bg-info">{{ number_format($order->total_amount, 2) }} €</span>
                            </li>
                        @empty
                            <li class="list-group-item">Aucune commande récente</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="#">Voir toutes <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection