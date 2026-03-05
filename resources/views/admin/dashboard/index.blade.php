@extends('admin.layouts.admin')

@section('page-title', 'Dashboard Administrateur - KondoMarket')

@section('admin-content')
<div class="container-fluid px-0">
    <h2 class="mb-4">Tableau de bord</h2>

    <!-- Cartes statistiques (données statiques) -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-primary text-uppercase fw-bold mb-1">Vendeurs</div>
                            <div class="h3 mb-0">12</div>
                            <small>2 en attente</small>
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
                            <div class="h3 mb-0">5</div>
                            <small>3 actifs</small>
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
                            <div class="h3 mb-0">15</div>
                            <small>2 aujourd'hui</small>
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
                            <div class="h3 mb-0">1 250 €</div>
                            <small>3 signalements</small>
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
                        <i class="bi bi-shield-exclamation"></i> Signalements (3)
                    </a>
                    <a href="{{ route('admin.vendors.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-shop"></i> Tous les vendeurs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Activités récentes (exemple statique) -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Nouveaux vendeurs</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>SARL Dubois</strong><br>
                                <small class="text-muted">il y a 2 heures</small>
                            </div>
                            <span class="badge bg-warning">en attente</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Jean Martin</strong><br>
                                <small class="text-muted">il y a 1 jour</small>
                            </div>
                            <span class="badge bg-success">approuvé</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Sophie Lambert</strong><br>
                                <small class="text-muted">il y a 3 jours</small>
                            </div>
                            <span class="badge bg-success">approuvé</span>
                        </li>
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
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Produit contrefait</strong><br>
                                <small class="text-muted">il y a 30 minutes</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Arnaque</strong><br>
                                <small class="text-muted">il y a 5 heures</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Mauvaise catégorie</strong><br>
                                <small class="text-muted">hier</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        </li>
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
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Commande #1024</strong><br>
                                <small class="text-muted">il y a 15 minutes</small>
                            </div>
                            <span class="badge bg-info">89,90 €</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Commande #1023</strong><br>
                                <small class="text-muted">il y a 1 heure</small>
                            </div>
                            <span class="badge bg-info">145,00 €</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Commande #1022</strong><br>
                                <small class="text-muted">il y a 3 heures</small>
                            </div>
                            <span class="badge bg-info">32,50 €</span>
                        </li>
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