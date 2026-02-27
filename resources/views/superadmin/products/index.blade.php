@extends('admin.layouts.admin')

@section('page-title', 'Gestion des produits - KondoMarket')

@section('admin-content')
<div class="container-fluid px-0">
    <h2 class="mb-4">Gestion des produits</h2>

    <!-- Cartes statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card stat-card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-primary text-uppercase fw-bold mb-1">Total</div>
                            <div class="h5 mb-0">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box-seam fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card stat-card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-success text-uppercase fw-bold mb-1">Actifs</div>
                            <div class="h5 mb-0">{{ $stats['active'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card stat-card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-warning text-uppercase fw-bold mb-1">Inactifs</div>
                            <div class="h5 mb-0">{{ $stats['inactive'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-x-circle fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card stat-card border-left-info shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-info text-uppercase fw-bold mb-1">Brouillons</div>
                            <div class="h5 mb-0">{{ $stats['draft'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-pencil-square fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card stat-card border-left-danger shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-danger text-uppercase fw-bold mb-1">Rupture stock</div>
                            <div class="h5 mb-0">{{ $stats['out_of_stock'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-exclamation-triangle fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card stat-card border-left-secondary shadow h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs text-secondary text-uppercase fw-bold mb-1">En vedette</div>
                            <div class="h5 mb-0">{{ $stats['featured'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-star fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('superadmin.products.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nom, SKU, vendeur...">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Tous</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="vendor_id" class="form-label">Vendeur</label>
                    <select class="form-select" id="vendor_id" name="vendor_id">
                        <option value="">Tous</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ request('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->vendor_type == 'individual' ? $vendor->display_name : $vendor->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Toutes</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="stock_status" class="form-label">Stock</label>
                    <select class="form-select" id="stock_status" name="stock_status">
                        <option value="">Tous</option>
                        <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>En stock</option>
                        <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Stock bas</option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Rupture</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des produits -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Vendeur</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Statut</th>
                            <th>Catégorie</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->main_image)
                                    <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" width="50" height="50" style="object-fit: cover;" class="rounded">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                {{ $product->name }}
                                @if($product->is_featured)
                                    <span class="badge bg-warning text-dark ms-1"><i class="bi bi-star-fill"></i></span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('superadmin.vendors.show', $product->vendor->id) }}">
                                    {{ $product->vendor->vendor_type == 'individual' ? $product->vendor->display_name : $product->vendor->company_name }}
                                </a>
                            </td>
                            <td>{{ number_format($product->price, 2) }} €</td>
                            <td>
                                @php
                                    $stockStatus = $product->stock_status;
                                @endphp
                                @if($stockStatus == 'available')
                                    <span class="badge bg-success">{{ $product->stock_quantity ?? '∞' }}</span>
                                @elseif($stockStatus == 'low')
                                    <span class="badge bg-warning text-dark">{{ $product->stock_quantity }}</span>
                                @elseif($stockStatus == 'out_of_stock')
                                    <span class="badge bg-danger">Rupture</span>
                                @elseif($stockStatus == 'backorder')
                                    <span class="badge bg-info">Sur commande</span>
                                @else
                                    <span class="badge bg-secondary">{{ $product->stock_quantity ?? '?' }}</span>
                                @endif
                            </td>
                            <td>
                                @switch($product->status)
                                    @case('active')
                                        <span class="badge bg-success">Actif</span>
                                        @break
                                    @case('inactive')
                                        <span class="badge bg-secondary">Inactif</span>
                                        @break
                                    @case('draft')
                                        <span class="badge bg-warning text-dark">Brouillon</span>
                                        @break
                                    @default
                                        <span class="badge bg-info">{{ $product->status }}</span>
                                @endswitch
                            </td>
                            <td>{{ $product->category->name ?? '—' }}</td>
                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">Aucun produit trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection