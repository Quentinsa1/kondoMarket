@extends('admin.layouts.admin')

@section('page-title', 'Détail du produit - KondoMarket')

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
                    <h6 class="m-0 fw-bold">Informations générales</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>ID :</th><td>{{ $product->id }}</td></tr>
                        <tr><th>Nom :</th><td>{{ $product->name }}</td></tr>
                        <tr><th>Slug :</th><td>{{ $product->slug }}</td></tr>
                        <tr><th>SKU :</th><td>{{ $product->sku }}</td></tr>
                        <tr><th>Barcode :</th><td>{{ $product->barcode ?? '—' }}</td></tr>
                        <tr><th>Description courte :</th><td>{{ $product->short_description ?? '—' }}</td></tr>
                        <tr><th>Description :</th><td>{{ $product->description ?? '—' }}</td></tr>
                        <tr><th>Prix :</th><td>{{ number_format($product->price, 2) }} €</td></tr>
                        @if($product->compare_price)<tr><th>Prix de comparaison :</th><td>{{ number_format($product->compare_price, 2) }} €</td></tr>@endif
                        @if($product->cost_price)<tr><th>Prix de revient :</th><td>{{ number_format($product->cost_price, 2) }} €</td></tr>@endif
                        @if($product->wholesale_price)<tr><th>Prix de gros :</th><td>{{ number_format($product->wholesale_price, 2) }} €</td></tr>@endif
                        <tr><th>Quantité min :</th><td>{{ $product->min_quantity ?? 1 }}</td></tr>
                        <tr><th>Stock :</th><td>
                            @if($product->manage_stock)
                                {{ $product->stock_quantity ?? 0 }} unités
                                @if($product->low_stock_notification) <span class="badge bg-info">Alerte bas stock</span> @endif
                                @if($product->allow_backorder) <span class="badge bg-warning text-dark">Backorder autorisé</span> @endif
                            @else
                                <span class="badge bg-secondary">Stock non géré</span>
                            @endif
                        </td></tr>
                        <tr><th>Seuil d'alerte :</th><td>{{ $product->alert_quantity ?? '—' }}</td></tr>
                        <tr><th>Catégorie :</th><td>{{ $product->category->name ?? '—' }}</td></tr>
                        <tr><th>Sous-catégorie :</th><td>{{ $product->subcategory->name ?? '—' }}</td></tr>
                        <tr><th>Marque :</th><td>{{ $product->brand ?? '—' }}</td></tr>
                        <tr><th>Modèle :</th><td>{{ $product->model ?? '—' }}</td></tr>
                        <tr><th>État / Condition :</th><td>{{ $product->condition ?? '—' }}</td></tr>
                        <tr><th>Couleur :</th><td>{{ $product->color ?? '—' }}</td></tr>
                        <tr><th>Taille :</th><td>{{ $product->size ?? '—' }}</td></tr>
                        <tr><th>Matériau :</th><td>{{ $product->material ?? '—' }}</td></tr>
                        <tr><th>Garantie :</th><td>{{ $product->warranty_period ?? '—' }} {{ $product->warranty_terms ? '('.$product->warranty_terms.')' : '' }}</td></tr>
                        <tr><th>Poids :</th><td>{{ $product->weight ? $product->weight.' kg' : '—' }}</td></tr>
                        <tr><th>Dimensions :</th><td>
                            @if($product->length || $product->width || $product->height)
                                L:{{ $product->length ?? '?' }} x l:{{ $product->width ?? '?' }} x H:{{ $product->height ?? '?' }} cm
                            @else — @endif
                        </td></tr>
                        <tr><th>Classe d'expédition :</th><td>{{ $product->shipping_class ?? '—' }}</td></tr>
                        <tr><th>Frais d'expédition :</th><td>{{ $product->shipping_cost ? number_format($product->shipping_cost, 2).' €' : '—' }}</td></tr>
                        <tr><th>Livraison estimée :</th><td>{{ $product->estimated_delivery ?? '—' }}</td></tr>
                        <tr><th>Taux de taxe :</th><td>{{ $product->tax_rate ? $product->tax_rate.'%' : '—' }}</td></tr>
                        <tr><th>Taxe incluse :</th><td>{{ $product->tax_included ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>Produit digital :</th><td>{{ $product->is_digital ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>Nécessite expédition :</th><td>{{ $product->requires_shipping ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>A des variantes :</th><td>{{ $product->has_variants ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>En vedette :</th><td>{{ $product->is_featured ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>Tendance :</th><td>{{ $product->is_trending ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>Meilleure vente :</th><td>{{ $product->is_bestseller ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>Nouveau :</th><td>{{ $product->is_new ? 'Oui' : 'Non' }}</td></tr>
                        <tr><th>Statut :</th><td>
                            @switch($product->status)
                                @case('active') <span class="badge bg-success">Actif</span> @break
                                @case('inactive') <span class="badge bg-secondary">Inactif</span> @break
                                @case('draft') <span class="badge bg-warning text-dark">Brouillon</span> @break
                                default: <span class="badge bg-info">{{ $product->status }}</span>
                            @endswitch
                        </td></tr>
                        <tr><th>Date de création :</th><td>{{ $product->created_at->format('d/m/Y H:i') }}</td></tr>
                        <tr><th>Date de publication :</th><td>{{ $product->published_at ? $product->published_at->format('d/m/Y H:i') : '—' }}</td></tr>
                        <tr><th>Vues :</th><td>{{ $product->view_count }}</td></tr>
                        <tr><th>Commandes :</th><td>{{ $product->order_count }}</td></tr>
                        <tr><th>Avis :</th><td>{{ $product->review_count }} ({{ number_format($product->rating, 1) }} ★)</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Vendeur -->
            <div class="card shadow mb-4">
                <div class="card-header"><h6 class="m-0 fw-bold">Vendeur</h6></div>
                <div class="card-body">
                    @if($product->vendor)
                        <table class="table table-borderless">
                            <tr><th>ID :</th><td>{{ $product->vendor->id }}</td></tr>
                            <tr><th>Nom :</th><td><a href="{{ route('admin.vendors.show', $product->vendor->id) }}">{{ $product->vendor->vendor_type == 'individual' ? $product->vendor->display_name : $product->vendor->company_name }}</a></td></tr>
                            <tr><th>Email :</th><td>{{ $product->vendor->user->email ?? 'Non disponible' }}</td></tr>
                            <tr><th>Téléphone :</th><td>{{ $product->vendor->phone }}</td></tr>
                        </table>
                    @else <p>Aucun vendeur associé.</p> @endif
                </div>
            </div>

            <!-- Images -->
            @if($product->main_image || ($product->images && count($product->images) > 0))
            <div class="card shadow mb-4">
                <div class="card-header"><h6 class="m-0 fw-bold">Images</h6></div>
                <div class="card-body">
                    <div class="row">
                        @foreach($product->images_urls as $image)
                        <div class="col-4 mb-2">
                            <a href="{{ $image }}" target="_blank"><img src="{{ $image }}" alt="Image" class="img-fluid rounded" style="max-height: 100px; object-fit: cover;"></a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Spécifications -->
            @if($product->specifications && is_array($product->specifications))
            <div class="card shadow mb-4">
                <div class="card-header"><h6 class="m-0 fw-bold">Spécifications</h6></div>
                <div class="card-body">
                    <ul> @foreach($product->specifications as $key => $value) <li><strong>{{ $key }} :</strong> {{ $value }}</li> @endforeach </ul>
                </div>
            </div>
            @endif

            <!-- SEO -->
            <div class="card shadow mb-4">
                <div class="card-header"><h6 class="m-0 fw-bold">SEO</h6></div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>Titre :</th><td>{{ $product->meta_title ?? $product->name }}</td></tr>
                        <tr><th>Description :</th><td>{{ $product->meta_description ?? '—' }}</td></tr>
                        <tr><th>Mots-clés :</th><td>{{ $product->meta_keywords ?? '—' }}</td></tr>
                    </table>
                </div>
            </div>

            <!-- Changement de statut -->
            <div class="card shadow">
                <div class="card-header"><h6 class="m-0 fw-bold">Changer le statut</h6></div>
                <div class="card-body">
                    <form action="{{ route('admin.products.status', $product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactif</option>
                                <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Brouillon</option>
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