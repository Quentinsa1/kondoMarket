@extends('template.template')

@section('title', 'Mes produits - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : LISTE PRODUITS ===== -->
<section class="products-section py-5">
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Mes produits</li>
                    </ol>
                </nav>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h2 mb-0">Mes produits</h1>
                        <p class="text-muted mb-0">Gérez tous vos produits en un seul endroit</p>
                    </div>
                    <div>
                        <a href="{{ route('seller.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Ajouter un produit
                        </a>
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exportModal">
                            <i class="bi bi-download"></i> Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres et recherche -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('seller.products.index') }}" method="GET" id="filterForm">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="search" class="form-label">Recherche</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search" 
                                       value="{{ request('search') }}" placeholder="Nom, SKU, description...">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Tous les statuts</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <div class="btn-group w-100">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="bi bi-filter"></i> Filtrer
                                </button>
                                <button type="button" class="btn btn-outline-secondary" id="resetFilters">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total produits</h6>
                                <h3 class="mb-0">{{ $products->total() }}</h3>
                            </div>
                            <i class="bi bi-box-seam display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Produits actifs</h6>
                                <h3 class="mb-0">{{ $activeCount ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-check-circle display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card bg-warning text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">En attente</h6>
                                <h3 class="mb-0">{{ $pendingCount ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-clock display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Stock faible</h6>
                                <h3 class="mb-0">{{ $lowStockCount ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-exclamation-triangle display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des produits -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des produits</h5>
                <div class="d-flex align-items-center">
                    <div class="form-check form-switch me-3">
                        <input class="form-check-input" type="checkbox" id="toggleView">
                        <label class="form-check-label" for="toggleView">Vue grille</label>
                    </div>
                    <span class="text-muted me-3">
                        {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} sur {{ $products->total() }}
                    </span>
                </div>
            </div>
            
            <div class="card-body p-0">
                <!-- Vue tableau (par défaut) -->
                <div class="table-responsive" id="tableView">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="60">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Statut</th>
                                <th>Vues</th>
                                <th>Ventes</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr class="{{ $product->stock_quantity <= $product->alert_quantity ? 'table-warning' : '' }}">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input product-checkbox" type="checkbox" 
                                               value="{{ $product->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="product-image me-3">
                                            <img src="{{ $product->main_image ? Storage::url($product->main_image) : asset('images/default-product.jpg') }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="rounded" width="40" height="40">
                                        </div>
                                        <div>
                                            <a href="{{ route('seller.products.show', $product) }}" 
                                               class="text-decoration-none fw-semibold text-dark">
                                                {{ Str::limit($product->name, 30) }}
                                            </a>
                                            <div class="text-muted small">
                                                {{ $product->sku ?? 'Pas de SKU' }}
                                            </div>
                                            <div class="mt-1">
                                                @if($product->is_featured)
                                                    <span class="badge bg-info me-1">Vedette</span>
                                                @endif
                                                @if($product->is_bestseller)
                                                    <span class="badge bg-success me-1">Best-seller</span>
                                                @endif
                                                @if($product->is_new)
                                                    <span class="badge bg-primary">Nouveau</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        {{ $product->category->name ?? 'N/A' }}
                                        @if($product->subcategory)
                                            <br><span class="text-muted">{{ $product->subcategory->name }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ number_format($product->price, 2) }} €</div>
                                    @if($product->compare_price)
                                        <div class="text-muted text-decoration-line-through small">
                                            {{ number_format($product->compare_price, 2) }} €
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            @if($product->stock_quantity > 10)
                                                <span class="badge bg-success">{{ $product->stock_quantity }}</span>
                                            @elseif($product->stock_quantity > 0)
                                                <span class="badge bg-warning">{{ $product->stock_quantity }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $product->stock_quantity }}</span>
                                            @endif
                                        </div>
                                        <div class="stock-progress" style="width: 60px;">
                                            @php
                                                $stockPercentage = min(100, ($product->stock_quantity / 50) * 100);
                                            @endphp
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar 
                                                    @if($product->stock_quantity > 10) bg-success
                                                    @elseif($product->stock_quantity > 0) bg-warning
                                                    @else bg-danger @endif" 
                                                    style="width: {{ $stockPercentage }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($product->stock_quantity <= $product->alert_quantity)
                                        <div class="text-danger small mt-1">
                                            <i class="bi bi-exclamation-triangle"></i> Stock faible
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge status-badge 
                                        @if($product->status == 'active') bg-success
                                        @elseif($product->status == 'pending') bg-warning text-dark
                                        @elseif($product->status == 'draft') bg-secondary
                                        @else bg-danger @endif">
                                        @if($product->status == 'active') Actif
                                        @elseif($product->status == 'pending') En attente
                                        @elseif($product->status == 'draft') Brouillon
                                        @else Inactif @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="small">
                                        <i class="bi bi-eye"></i> {{ $product->view_count ?? 0 }}
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <i class="bi bi-cart"></i> {{ $product->order_count ?? 0 }}
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        {{ $product->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('seller.products.show', $product) }}">
                                                    <i class="bi bi-eye"></i> Voir
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('seller.products.edit', $product) }}">
                                                    <i class="bi bi-pencil"></i> Modifier
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('seller.products.duplicate', $product) }}">
                                                    <i class="bi bi-files"></i> Dupliquer
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('seller.products.toggle-status', $product) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bi bi-power"></i> 
                                                        @if($product->status == 'active')
                                                            Désactiver
                                                        @else
                                                            Activer
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal{{ $product->id }}">
                                                    <i class="bi bi-trash"></i> Supprimer
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal de suppression -->
                            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmer la suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr de vouloir supprimer le produit <strong>"{{ $product->name }}"</strong> ?</p>
                                            <p class="text-danger">Cette action est irréversible !</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('seller.products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-box display-1 text-muted"></i>
                                        <h4 class="mt-3">Aucun produit trouvé</h4>
                                        <p class="text-muted">Commencez par ajouter votre premier produit</p>
                                        <a href="{{ route('seller.products.create') }}" class="btn btn-primary mt-2">
                                            <i class="bi bi-plus-circle"></i> Ajouter un produit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Vue grille (cachée par défaut) -->
                <div class="grid-view p-4" id="gridView" style="display: none;">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card product-card h-100">
                                <div class="position-relative">
                                    <img src="{{ $product->main_image ? Storage::url($product->main_image) : asset('images/default-product.jpg') }}" 
                                         class="card-img-top" alt="{{ $product->name }}">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge 
                                            @if($product->status == 'active') bg-success
                                            @elseif($product->status == 'pending') bg-warning text-dark
                                            @elseif($product->status == 'draft') bg-secondary
                                            @else bg-danger @endif">
                                            @if($product->status == 'active') Actif
                                            @elseif($product->status == 'pending') En attente
                                            @elseif($product->status == 'draft') Brouillon
                                            @else Inactif @endif
                                        </span>
                                    </div>
                                    @if($product->stock_quantity <= $product->alert_quantity)
                                    <div class="position-absolute top-0 start-0 p-2">
                                        <span class="badge bg-danger">Stock faible</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($product->name, 40) }}</h6>
                                    <div class="mb-2">
                                        <span class="fw-bold text-primary">{{ number_format($product->price, 2) }} €</span>
                                        @if($product->compare_price)
                                            <span class="text-muted text-decoration-line-through small ms-2">
                                                {{ number_format($product->compare_price, 2) }} €
                                            </span>
                                        @endif
                                    </div>
                                    <div class="small text-muted mb-2">
                                        <i class="bi bi-tag"></i> {{ $product->category->name ?? 'N/A' }}
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <span class="badge 
                                                @if($product->stock_quantity > 10) bg-success
                                                @elseif($product->stock_quantity > 0) bg-warning
                                                @else bg-danger @endif">
                                                Stock: {{ $product->stock_quantity }}
                                            </span>
                                        </div>
                                        <div class="small">
                                            <i class="bi bi-eye"></i> {{ $product->view_count ?? 0 }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('seller.products.edit', $product) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route('seller.products.show', $product) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('seller.products.toggle-status', $product) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm 
                                                @if($product->status == 'active') btn-outline-warning
                                                @else btn-outline-success @endif">
                                                <i class="bi bi-power"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $product->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Actions groupées -->
            @if($products->count() > 0)
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" id="selectAllFooter">
                            <label class="form-check-label" for="selectAllFooter">
                                Sélectionner tout
                            </label>
                        </div>
                        <select class="form-select form-select-sm w-auto" id="bulkAction">
                            <option value="">Actions groupées</option>
                            <option value="activate">Activer</option>
                            <option value="deactivate">Désactiver</option>
                            <option value="delete">Supprimer</option>
                            <option value="add_tags">Ajouter des tags</option>
                        </select>
                        <button class="btn btn-sm btn-outline-primary ms-2" id="applyBulkAction">
                            Appliquer
                        </button>
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Modal d'export -->
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Exporter les produits</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('seller.products.export') }}" method="GET" id="exportForm">
                    <div class="mb-3">
                        <label class="form-label">Format</label>
                        <select class="form-select" name="format" required>
                            <option value="csv">CSV (Excel)</option>
                            <option value="pdf">PDF</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Inclure les colonnes</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="name" checked>
                                    <label class="form-check-label">Nom</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="sku" checked>
                                    <label class="form-check-label">SKU</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="category" checked>
                                    <label class="form-check-label">Catégorie</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="price" checked>
                                    <label class="form-check-label">Prix</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="stock" checked>
                                    <label class="form-check-label">Stock</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="status" checked>
                                    <label class="form-check-label">Statut</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="created_at" checked>
                                    <label class="form-check-label">Date création</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="views" checked>
                                    <label class="form-check-label">Vues</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Période</label>
                        <select class="form-select" name="period">
                            <option value="all">Tous les produits</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                            <option value="year">Cette année</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Produits sélectionnés seulement</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="selected_only" id="selectedOnly">
                            <label class="form-check-label" for="selectedOnly">Exporter uniquement les produits sélectionnés</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="exportForm" class="btn btn-primary">Exporter</button>
            </div>
        </div>
    </div>
</div>

<style>
    .products-section {
        background-color: var(--light-color);
        min-height: calc(100vh - 200px);
    }

    .stat-card {
        border: none;
        border-radius: var(--border-radius);
        transition: var(--transition);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .product-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .product-card .card-img-top {
        height: 200px;
        object-fit: cover;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .product-image img {
        object-fit: cover;
        border: 1px solid var(--gray-light);
    }

    .status-badge {
        font-size: 0.75em;
        padding: 4px 8px;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state i {
        opacity: 0.5;
    }

    .table th {
        font-weight: 600;
        color: var(--secondary-color);
        border-bottom: 2px solid var(--gray-light);
    }

    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
    }

    .stock-progress .progress {
        background-color: var(--gray-light);
    }

    .pagination {
        margin-bottom: 0;
    }

    .pagination .page-link {
        color: var(--primary-color);
        border: 1px solid var(--gray-light);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }

    .card-header {
        background-color: var(--light-color);
        border-bottom: 1px solid var(--gray-light);
        padding: 1rem 1.5rem;
    }

    .card-footer {
        background-color: var(--light-color);
        border-top: 1px solid var(--gray-light);
        padding: 1rem 1.5rem;
    }

    @media (max-width: 768px) {
        .products-section {
            padding: 1rem 0;
        }
        
        .grid-view .col-md-6 {
            width: 100%;
        }
        
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .btn-group .dropdown-menu {
            position: absolute;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle entre vue tableau et vue grille
    const toggleView = document.getElementById('toggleView');
    const tableView = document.getElementById('tableView');
    const gridView = document.getElementById('gridView');
    
    toggleView.addEventListener('change', function() {
        if (this.checked) {
            tableView.style.display = 'none';
            gridView.style.display = 'block';
        } else {
            tableView.style.display = 'block';
            gridView.style.display = 'none';
        }
    });
    
    // Sélection multiple
    const selectAll = document.getElementById('selectAll');
    const selectAllFooter = document.getElementById('selectAllFooter');
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    
    function toggleSelectAll(checked) {
        productCheckboxes.forEach(checkbox => {
            checkbox.checked = checked;
        });
        selectAll.checked = checked;
        selectAllFooter.checked = checked;
    }
    
    selectAll.addEventListener('change', function() {
        toggleSelectAll(this.checked);
    });
    
    selectAllFooter.addEventListener('change', function() {
        toggleSelectAll(this.checked);
    });
    
    // Vérifier si tous les checkboxes sont cochés
    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(productCheckboxes).every(cb => cb.checked);
            selectAll.checked = allChecked;
            selectAllFooter.checked = allChecked;
        });
    });
    
    // Réinitialiser les filtres
    document.getElementById('resetFilters').addEventListener('click', function() {
        document.getElementById('search').value = '';
        document.getElementById('status').value = '';
        document.getElementById('category_id').value = '';
        document.getElementById('filterForm').submit();
    });
    
    // Effacer la recherche
    document.getElementById('clearSearch').addEventListener('click', function() {
        document.getElementById('search').value = '';
        document.getElementById('filterForm').submit();
    });
    
    // Actions groupées
    document.getElementById('applyBulkAction').addEventListener('click', function() {
        const action = document.getElementById('bulkAction').value;
        const selectedProducts = Array.from(document.querySelectorAll('.product-checkbox:checked'))
            .map(checkbox => checkbox.value);
        
        if (selectedProducts.length === 0) {
            alert('Veuillez sélectionner au moins un produit.');
            return;
        }
        
        if (!action) {
            alert('Veuillez sélectionner une action.');
            return;
        }
        
        if (action === 'delete') {
            if (!confirm(`Êtes-vous sûr de vouloir supprimer ${selectedProducts.length} produit(s) ?`)) {
                return;
            }
        }
        
        // Envoyer la requête AJAX pour l'action groupée
        
    
    // Afficher le stock faible en surbrillance
    const lowStockRows = document.querySelectorAll('tr.table-warning');
    lowStockRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(255, 193, 7, 0.1)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
    
    // Mettre à jour les statistiques en temps réel
    function updateStats() {
        const activeProducts = Array.from(document.querySelectorAll('.status-badge.bg-success')).length;
        const pendingProducts = Array.from(document.querySelectorAll('.status-badge.bg-warning')).length;
        const lowStockProducts = Array.from(document.querySelectorAll('tr.table-warning')).length;
        
        // Mettre à jour les compteurs si les éléments existent
        const activeCount = document.querySelector('.stat-card.bg-success h3');
        const pendingCount = document.querySelector('.stat-card.bg-warning h3');
        const lowStockCount = document.querySelector('.stat-card.bg-danger h3');
        
        if (activeCount) activeCount.textContent = activeProducts;
        if (pendingCount) pendingCount.textContent = pendingProducts;
        if (lowStockCount) lowStockCount.textContent = lowStockProducts;
    }
    
    // Mettre à jour les statistiques après les actions
    updateStats();
    
    // Filtre rapide par statut
    const statusBadges = document.querySelectorAll('.status-badge');
    statusBadges.forEach(badge => {
        badge.addEventListener('click', function(e) {
            e.stopPropagation();
            const status = this.textContent.trim().toLowerCase();
            let statusValue = '';
            
            switch(status) {
                case 'actif': statusValue = 'active'; break;
                case 'en attente': statusValue = 'pending'; break;
                case 'brouillon': statusValue = 'draft'; break;
                case 'inactif': statusValue = 'inactive'; break;
            }
            
            if (statusValue) {
                document.getElementById('status').value = statusValue;
                document.getElementById('filterForm').submit();
            }
        });
    });
    
    // Tri des colonnes du tableau
    const tableHeaders = document.querySelectorAll('table th[data-sort]');
    tableHeaders.forEach(header => {
        header.style.cursor = 'pointer';
        header.addEventListener('click', function() {
            const sortField = this.dataset.sort;
            const currentUrl = new URL(window.location.href);
            let sortDirection = 'asc';
            
            if (currentUrl.searchParams.get('sort') === sortField) {
                sortDirection = currentUrl.searchParams.get('direction') === 'asc' ? 'desc' : 'asc';
            }
            
            currentUrl.searchParams.set('sort', sortField);
            currentUrl.searchParams.set('direction', sortDirection);
            window.location.href = currentUrl.toString();
        });
    });
});
</script>
@endsection