@extends('admin.layouts.admin')

@section('title', 'Détail du produit #' . $product->id)

@section('admin-content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Détail du produit #{{ $product->id }}</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Informations produit</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>ID :</th><td>{{ $product->id }}</td></tr>
                        <tr><th>Nom :</th><td>{{ $product->name }}</td></tr>
                        <tr><th>Description :</th><td>{{ $product->description ?? 'Aucune description' }}</td></tr>
                        <tr><th>Prix :</th><td>{{ number_format($product->price, 2) }} €</td></tr>
                        <tr><th>Stock :</th><td>{{ $product->stock ?? 'Non renseigné' }}</td></tr>
                        <tr><th>Catégorie :</th><td>{{ $product->category->name ?? 'Non catégorisé' }}</td></tr>
                        <tr><th>Sous-catégorie :</th><td>{{ $product->subcategory->name ?? 'Aucune' }}</td></tr>
                        <tr>
                            <th>Statut :</th>
                            <td>
                                @switch($product->status)
                                    @case('approved') <span class="badge bg-success">Approuvé</span> @break
                                    @case('pending') <span class="badge bg-warning">En attente</span> @break
                                    @case('rejected') <span class="badge bg-danger">Rejeté</span> @break
                                    default: <span class="badge bg-secondary">{{ $product->status }}</span>
                                @endswitch
                            </td>
                        </tr>
                        <tr><th>Date création :</th><td>{{ $product->created_at->format('d/m/Y H:i') }}</td></tr>
                        <tr><th>Dernière MAJ :</th><td>{{ $product->updated_at->format('d/m/Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Vendeur associé</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>ID Vendeur :</th><td>{{ $product->vendor->id }}</td></tr>
                        <tr><th>Nom :</th><td>{{ $product->vendor->display_name ?? $product->vendor->company_name }}</td></tr>
                        <tr><th>Email :</th><td>{{ $product->vendor->user->email }}</td></tr>
                        <tr><th>Téléphone :</th><td>{{ $product->vendor->phone }}</td></tr>
                        <tr>
                            <th>Statut vendeur :</th>
                            <td>
                                @switch($product->vendor->status)
                                    @case('approved') <span class="badge bg-success">Approuvé</span> @break
                                    @case('pending_review') <span class="badge bg-warning">En attente</span> @break
                                    @case('suspended') <span class="badge bg-danger">Suspendu</span> @break
                                    @case('rejected') <span class="badge bg-dark">Rejeté</span> @break
                                    default: <span class="badge bg-secondary">{{ $product->vendor->status }}</span>
                                @endswitch
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.vendors.show', $product->vendor->id) }}" class="btn btn-sm btn-primary">
                        Voir le vendeur
                    </a>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Changer le statut</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.status', $product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="approved" {{ $product->status == 'approved' ? 'selected' : '' }}>Approuvé</option>
                                <option value="rejected" {{ $product->status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection