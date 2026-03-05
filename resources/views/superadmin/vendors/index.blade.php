@extends('superadmin.layouts.admin')

@section('page-title', 'Gestion des vendeurs - KondoMarket')

@section('admin-content')
<div class="container-fluid px-0">
    <h2 class="mb-4">Gestion des vendeurs</h2>

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
                            <i class="bi bi-shop fs-1 text-gray-300"></i>
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
                            <div class="text-xs text-success text-uppercase fw-bold mb-1">Approuvés</div>
                            <div class="h5 mb-0">{{ $stats['approved'] }}</div>
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
                            <div class="text-xs text-warning text-uppercase fw-bold mb-1">En attente</div>
                            <div class="h5 mb-0">{{ $stats['pending'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-hourglass-split fs-1 text-gray-300"></i>
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
                            <div class="text-xs text-info text-uppercase fw-bold mb-1">Individuels</div>
                            <div class="h5 mb-0">{{ $stats['individual'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person fs-1 text-gray-300"></i>
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
                            <div class="text-xs text-secondary text-uppercase fw-bold mb-1">Entreprises</div>
                            <div class="h5 mb-0">{{ $stats['company'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-building fs-1 text-gray-300"></i>
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
                            <div class="text-xs text-danger text-uppercase fw-bold mb-1">Suspendus</div>
                            <div class="h5 mb-0">{{ $stats['suspended'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-exclamation-triangle fs-1 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('superadmin.vendors.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nom, email, téléphone...">
                </div>
                <div class="col-md-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">Tous</option>
                        <option value="individual" {{ request('type') == 'individual' ? 'selected' : '' }}>Individuel</option>
                        <option value="company" {{ request('type') == 'company' ? 'selected' : '' }}>Entreprise</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Tous</option>
                        <option value="pending_review" {{ request('status') == 'pending_review' ? 'selected' : '' }}>En attente</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approuvé</option>
                        <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau des vendeurs -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Nom / Société</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Ville / Pays</th>
                            <th>Statut</th>
                            <th>Inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->id }}</td>
                            <td>
                                @if($vendor->vendor_type == 'individual')
                                    <span class="badge bg-info">Individuel</span>
                                @else
                                    <span class="badge bg-secondary">Entreprise</span>
                                @endif
                            </td>
                            <td>
                                @if($vendor->vendor_type == 'individual')
                                    {{ $vendor->display_name ?? $vendor->user->name }}
                                @else
                                    {{ $vendor->company_name }}
                                @endif
                            </td>
                            <td>{{ $vendor->user->email }}</td>
                            <td>{{ $vendor->phone }}</td>
                            <td>{{ $vendor->city }}, {{ $vendor->country }}</td>
                            <td>
                                @switch($vendor->status)
                                    @case('approved')
                                        <span class="badge bg-success">Approuvé</span>
                                        @break
                                    @case('pending_review')
                                        <span class="badge bg-warning text-dark">En attente</span>
                                        @break
                                    @case('suspended')
                                        <span class="badge bg-danger">Suspendu</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-dark">Rejeté</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $vendor->status }}</span>
                                @endswitch
                            </td>
                            <td>{{ $vendor->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('superadmin.vendors.show', $vendor->id) }}" class="btn btn-sm btn-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('superadmin.vendors.destroy', $vendor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce vendeur ?');">
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
                            <td colspan="9" class="text-center py-4">Aucun vendeur trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $vendors->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection