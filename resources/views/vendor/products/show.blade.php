@extends('template.template')

@section('title', $product->name . ' - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : DÉTAIL PRODUIT ===== -->
<section class="product-detail-section py-5">
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seller.products.index') }}">Produits</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </nav>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2">{{ $product->name }}</h1>
                    <div class="btn-group">
                        <a href="{{ route('seller.products.edit', $product) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('seller.products.duplicate', $product) }}" onclick="return confirm('Dupliquer ce produit ?')">
                                    <i class="bi bi-files"></i> Dupliquer
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('seller.products.toggle-status', $product) }}">
                                    @if($product->status === 'active')
                                        <i class="bi bi-eye-slash"></i> Désactiver
                                    @else
                                        <i class="bi bi-eye"></i> Activer
                                    @endif
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('seller.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alertes de statut -->
        @if($product->status === 'draft')
            <div class="alert alert-warning d-flex align-items-center mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                <div>
                    <strong>Brouillon</strong> – Ce produit n'est pas visible sur la boutique.
                </div>
            </div>
        @elseif($product->status === 'pending')
            <div class="alert alert-info d-flex align-items-center mb-4">
                <i class="bi bi-hourglass-split me-2 fs-4"></i>
                <div>
                    <strong>En attente de validation</strong> – Un administrateur examinera bientôt ce produit.
                </div>
            </div>
        @elseif($product->status === 'inactive')
            <div class="alert alert-secondary d-flex align-items-center mb-4">
                <i class="bi bi-eye-slash me-2 fs-4"></i>
                <div>
                    <strong>Inactif</strong> – Ce produit a été désactivé et n'est pas visible.
                </div>
            </div>
        @endif

        <!-- Alerte stock bas -->
        @if($product->isLowStock())
            <div class="alert alert-danger d-flex align-items-center mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                <div>
                    <strong>Stock bas</strong> – Il ne reste que {{ $product->stock_quantity }} unité(s) en stock.
                </div>
            </div>
        @endif

        <div class="row">
            <!-- Colonne de gauche : Images -->
            <div class="col-lg-5 mb-4">
                <div class="card sticky-top" style="top: 20px; z-index: 99;">
                    <div class="card-body">
                        <!-- Image principale -->
                        <div class="main-image-container mb-3 text-center">
                            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="img-fluid rounded" id="mainProductImage" style="max-height: 400px;">
                        </div>

                        <!-- Galerie d'images -->
                        @if(count($product->images_urls) > 1)
                            <div class="gallery-thumbnails d-flex flex-wrap gap-2 mt-3">
                                @foreach($product->images_urls as $index => $imageUrl)
                                    <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" style="cursor: pointer;" onclick="document.getElementById('mainProductImage').src='{{ $imageUrl }}'">
                                        <img src="{{ $imageUrl }}" alt="Miniature {{ $index+1 }}" class="img-thumbnail" style="width: 70px; height: 70px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Informations complémentaires sous les images -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Vues</span>
                                <strong>{{ $product->view_count }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Commandes</span>
                                <strong>{{ $product->order_count }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Avis</span>
                                <strong>{{ $product->review_count }} ({{ number_format($product->rating, 1) }} ⭐)</strong>
                            </div>
                            @if($product->published_at)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Publié le</span>
                                    <strong>{{ $product->published_at->format('d/m/Y') }}</strong>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Créé le</span>
                                <strong>{{ $product->created_at->format('d/m/Y H:i') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Dernière modif.</span>
                                <strong>{{ $product->updated_at->format('d/m/Y H:i') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Détails -->
            <div class="col-lg-7">
                <!-- Prix et stock -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-currency-exchange me-2"></i> Prix et stock</h5>
                        <span class="badge bg-{{ $product->status === 'active' ? 'success' : ($product->status === 'pending' ? 'info' : 'secondary') }} fs-6">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="text-muted">Prix de vente</td>
                                        <td class="text-end"><strong>{{ number_format($product->price, 2, ',', ' ') }} FCFA</strong></td>
                                    </tr>
                                    @if($product->compare_price)
                                    <tr>
                                        <td class="text-muted">Ancien prix</td>
                                        <td class="text-end"><del>{{ number_format($product->compare_price, 2, ',', ' ') }} FCFA</del></td>
                                    </tr>
                                    @endif
                                    @if($product->cost_price)
                                    <tr>
                                        <td class="text-muted">Prix de revient</td>
                                        <td class="text-end">{{ number_format($product->cost_price, 2, ',', ' ') }} FCFA</td>
                                    </tr>
                                    @endif
                                    @if($product->wholesale_price)
                                    <tr>
                                        <td class="text-muted">Prix en gros</td>
                                        <td class="text-end">{{ number_format($product->wholesale_price, 2, ',', ' ') }} FCFA</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted">Quantité minimum</td>
                                        <td class="text-end">{{ $product->min_quantity }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="text-muted">Stock</td>
                                        <td class="text-end">
                                            @if(!$product->manage_stock)
                                                <span class="badge bg-info">Non géré</span>
                                            @else
                                                <span class="badge bg-{{ $product->isInStock() ? ($product->isLowStock() ? 'warning' : 'success') : 'danger' }}">
                                                    {{ $product->stock_quantity }} unités
                                                    @if($product->allow_backorder) (backorder) @endif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($product->manage_stock && $product->alert_quantity)
                                    <tr>
                                        <td class="text-muted">Alerte stock bas</td>
                                        <td class="text-end">{{ $product->alert_quantity }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted">SKU</td>
                                        <td class="text-end"><code>{{ $product->sku ?? 'N/A' }}</code></td>
                                    </tr>
                                    @if($product->barcode)
                                    <tr>
                                        <td class="text-muted">Code-barres</td>
                                        <td class="text-end"><code>{{ $product->barcode }}</code></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted">Gestion stock</td>
                                        <td class="text-end">{{ $product->manage_stock ? 'Oui' : 'Non' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Commande en attente</td>
                                        <td class="text-end">{{ $product->allow_backorder ? 'Autorisé' : 'Non autorisé' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Description</h5>
                    </div>
                    <div class="card-body">
                        @if($product->short_description)
                            <h6>Description courte</h6>
                            <p class="text-muted">{{ $product->short_description }}</p>
                            <hr>
                        @endif
                        <h6>Description détaillée</h6>
                        <div class="description-content">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>

                <!-- Caractéristiques techniques -->
                @if($product->brand || $product->model || $product->condition || $product->material || $product->color || $product->size || $product->warranty_period)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-gear me-2"></i> Caractéristiques</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($product->brand)
                            <div class="col-md-6 mb-2">
                                <span class="text-muted">Marque :</span> <strong>{{ $product->brand }}</strong>
                            </div>
                            @endif
                            @if($product->model)
                            <div class="col-md-6 mb-2">
                                <span class="text-muted">Modèle :</span> <strong>{{ $product->model }}</strong>
                            </div>
                            @endif
                            @if($product->condition)
                            <div class="col-md-6 mb-2">
                                <span class="text-muted">État :</span> 
                                <strong>
                                    @if($product->condition === 'new') Neuf
                                    @elseif($product->condition === 'used') Occasion
                                    @else Reconditionné
                                    @endif
                                </strong>
                            </div>
                            @endif
                            @if($product->material)
                            <div class="col-md-6 mb-2">
                                <span class="text-muted">Matériau :</span> <strong>{{ $product->material }}</strong>
                            </div>
                            @endif
                            @if($product->color)
                            <div class="col-md-6 mb-2">
                                <span class="text-muted">Couleur :</span> <strong>{{ $product->color }}</strong>
                            </div>
                            @endif
                            @if($product->size)
                            <div class="col-md-6 mb-2">
                                <span class="text-muted">Taille :</span> <strong>{{ $product->size }}</strong>
                            </div>
                            @endif
                            @if($product->warranty_period)
                            <div class="col-md-6 mb-2">
                                <span class="text-muted">Garantie :</span> <strong>{{ $product->warranty_period }}</strong>
                            </div>
                            @endif
                        </div>
                        @if($product->warranty_terms)
                            <div class="mt-3">
                                <span class="text-muted">Conditions de garantie :</span>
                                <p class="mb-0">{{ $product->warranty_terms }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Spécifications techniques personnalisées -->
                @if($product->specifications && count($product->specifications) > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-list-check me-2"></i> Spécifications techniques</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            @foreach($product->specifications as $spec)
                            <tr>
                                <td class="text-muted" style="width: 40%;">{{ $spec['key'] }}</td>
                                <td><strong>{{ $spec['value'] }}</strong></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @endif

                <!-- Tags et attributs -->
                <div class="row">
                    @if($product->tags->count() > 0)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-tags me-2"></i> Tags</h5>
                            </div>
                            <div class="card-body">
                                @foreach($product->tags as $tag)
                                    <span class="badge bg-secondary me-1 mb-1 p-2">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($product->attributes->count() > 0)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-diagram-3 me-2"></i> Attributs</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    @foreach($product->attributes as $attribute)
                                        <tr>
                                            <td class="text-muted">{{ $attribute->name }}</td>
                                            <td>
                                                @if($attribute->pivot->value)
                                                    {{ $attribute->pivot->value }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Livraison -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-truck me-2"></i> Livraison</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="text-muted">Nécessite livraison</td>
                                        <td class="text-end">{{ $product->requires_shipping ? 'Oui' : 'Non' }}</td>
                                    </tr>
                                    @if($product->requires_shipping)
                                    <tr>
                                        <td class="text-muted">Frais de port</td>
                                        <td class="text-end">{{ $product->shipping_cost ? number_format($product->shipping_cost, 2, ',', ' ') . ' FCFA' : 'Standard' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Délai estimé</td>
                                        <td class="text-end">{{ $product->estimated_delivery ? $product->estimated_delivery . ' jours' : 'Non défini' }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                @if($product->weight || $product->length || $product->width || $product->height)
                                <h6>Dimensions / Poids</h6>
                                <table class="table table-sm table-borderless">
                                    @if($product->weight)
                                    <tr><td class="text-muted">Poids</td><td class="text-end">{{ $product->weight }} kg</td></tr>
                                    @endif
                                    @if($product->length)
                                    <tr><td class="text-muted">Longueur</td><td class="text-end">{{ $product->length }} cm</td></tr>
                                    @endif
                                    @if($product->width)
                                    <tr><td class="text-muted">Largeur</td><td class="text-end">{{ $product->width }} cm</td></tr>
                                    @endif
                                    @if($product->height)
                                    <tr><td class="text-muted">Hauteur</td><td class="text-end">{{ $product->height }} cm</td></tr>
                                    @endif
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Variantes -->
                @if($product->variants && $product->variants->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-layers me-2"></i> Variantes ({{ $product->variants->count() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Nom</th>
                                        <th>SKU</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                        <th>Par défaut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->variants as $variant)
                                    <tr>
                                        <td>
                                            @if($variant->image)
                                                <img src="{{ asset('storage/'.$variant->image) }}" alt="{{ $variant->name }}" style="width: 40px; height: 40px; object-fit: cover;" class="rounded">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $variant->name }}</td>
                                        <td><code>{{ $variant->sku ?? '-' }}</code></td>
                                        <td>{{ number_format($variant->price, 2, ',', ' ') }} FCFA</td>
                                        <td>
                                            @if($variant->manage_stock ?? true)
                                                {{ $variant->stock_quantity ?? 0 }}
                                            @else
                                                <span class="badge bg-info">Non géré</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($variant->is_default)
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- SEO -->
                @if($product->meta_title || $product->meta_description || $product->meta_keywords)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-search me-2"></i> SEO</h5>
                    </div>
                    <div class="card-body">
                        @if($product->meta_title)
                        <div class="mb-2">
                            <span class="text-muted">Meta title :</span>
                            <code>{{ $product->meta_title }}</code>
                        </div>
                        @endif
                        @if($product->meta_description)
                        <div class="mb-2">
                            <span class="text-muted">Meta description :</span>
                            <code>{{ $product->meta_description }}</code>
                        </div>
                        @endif
                        @if($product->meta_keywords)
                        <div class="mb-2">
                            <span class="text-muted">Meta keywords :</span>
                            <code>{{ $product->meta_keywords }}</code>
                        </div>
                        @endif
                        <div class="mt-2">
                            <span class="text-muted">URL du produit :</span>
                            <a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Boutons d'action en bas -->
                <div class="d-flex justify-content-end gap-2 mb-5">
                    <a href="{{ route('seller.products.edit', $product) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="{{ route('seller.products.duplicate', $product) }}" class="btn btn-outline-secondary" onclick="return confirm('Dupliquer ce produit ?')">
                        <i class="bi bi-files"></i> Dupliquer
                    </a>
                    <a href="{{ route('seller.products.toggle-status', $product) }}" class="btn btn-outline-warning">
                        @if($product->status === 'active')
                            <i class="bi bi-eye-slash"></i> Désactiver
                        @else
                            <i class="bi bi-eye"></i> Activer
                        @endif
                    </a>
                    <form action="{{ route('seller.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .product-detail-section {
        background-color: var(--light-color);
        min-height: calc(100vh - 200px);
    }

    .card {
        border: none;
        box-shadow: var(--shadow-md);
        border-radius: var(--border-radius);
    }

    .card-header {
        background-color: var(--light-color);
        border-bottom: 1px solid var(--gray-light);
        padding: 1rem 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 1.5rem;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .gallery-thumbnails .thumbnail-item {
        border: 2px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        transition: var(--transition);
    }

    .gallery-thumbnails .thumbnail-item.active,
    .gallery-thumbnails .thumbnail-item:hover {
        border-color: var(--accent-color);
    }

    .description-content {
        line-height: 1.8;
        white-space: pre-wrap;
    }

    .table-sm td {
        padding: 0.3rem 0.5rem;
    }

    .sticky-top {
        z-index: 99;
    }
</style>

<script>
    // Optionnel : synchroniser l'image principale avec la miniature active
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.thumbnail-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endsection