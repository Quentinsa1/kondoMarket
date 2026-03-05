@extends('template.template')

@section('title', 'Ajouter un produit - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : AJOUT PRODUIT ===== -->
<section class="add-product-section py-5">
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seller.products.index') }}">Produits</a></li>
                        <li class="breadcrumb-item active">Ajouter un produit</li>
                    </ol>
                </nav>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2">Ajouter un nouveau produit</h1>
                    <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            
            <div class="row">
                <!-- Colonne gauche : Informations de base -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informations de base</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <strong>Nom du produit *</strong>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="{{ old('name') }}" required 
                                       placeholder="Ex: iPhone 13 Pro Max 256GB">
                                <div class="form-text">Donnez un nom clair et descriptif à votre produit</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">
                                        <strong>Catégorie *</strong>
                                    </label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="subcategory_id" class="form-label">
                                        <strong>Sous-catégorie</strong>
                                    </label>
                                    <select class="form-select" id="subcategory_id" name="subcategory_id">
                                        <option value="">Sélectionnez une sous-catégorie</option>
                                        <!-- Les sous-catégories seront chargées via AJAX -->
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="short_description" class="form-label">
                                    <strong>Description courte</strong>
                                </label>
                                <textarea class="form-control" id="short_description" name="short_description" 
                                          rows="2" maxlength="200" 
                                          placeholder="Une brève description (max 200 caractères)">{{ old('short_description') }}</textarea>
                                <div class="form-text d-flex justify-content-between">
                                    <span>Maximum 200 caractères</span>
                                    <span id="shortDescCount">0/200</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    <strong>Description détaillée *</strong>
                                </label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="8" required 
                                          placeholder="Décrivez votre produit en détail (max 500 mots)...">{{ old('description') }}</textarea>
                                <div class="form-text">
                                    <div class="d-flex justify-content-between">
                                        <span>Utilisez des mots-clés pertinents</span>
                                        <span id="wordCount">0 / 500 mots</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Images du produit -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-images"></i> Images du produit</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">
                                        <strong>Image principale *</strong>
                                    </label>
                                    <div class="upload-card">
                                        <div class="upload-area" id="mainImageUpload">
                                            <i class="bi bi-cloud-upload"></i>
                                            <p>Glissez-déposez l'image principale</p>
                                            <p class="text-muted">ou <span class="text-primary">parcourir</span></p>
                                            <input type="file" id="main_image" name="main_image" 
                                                   accept="image/*" hidden required>
                                        </div>
                                        <div class="form-text">Format recommandé: 800x800px, JPG ou PNG</div>
                                        <div class="preview-container mt-3" id="mainImagePreview"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">
                                        <strong>Images supplémentaires</strong>
                                    </label>
                                    <div class="upload-card">
                                        <div class="upload-area" id="galleryUpload">
                                            <i class="bi bi-cloud-upload"></i>
                                            <p>Glissez-déposez jusqu'à 5 images</p>
                                            <p class="text-muted">ou <span class="text-primary">parcourir</span></p>
                                            <input type="file" id="images" name="images[]" 
                                                   accept="image/*" multiple hidden>
                                        </div>
                                        <div class="form-text">Format recommandé: 800x800px, JPG ou PNG</div>
                                        <div class="preview-gallery mt-3" id="galleryPreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prix et stock -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-currency-exchange"></i> Prix et stock (FCFA)</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label">
                                        <strong>Prix de vente *</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="price" name="price" 
                                               step="0.01" min="0" value="{{ old('price') }}" required 
                                               placeholder="9900">
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="compare_price" class="form-label">
                                        <strong>Ancien prix (optionnel)</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="compare_price" 
                                               name="compare_price" step="0.01" min="0" 
                                               value="{{ old('compare_price') }}" placeholder="14900">
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                    <div class="form-text">Pour afficher un prix barré</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="wholesale_price" class="form-label">
                                        <strong>Prix en gros</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="wholesale_price" 
                                               name="wholesale_price" step="0.01" min="0" 
                                               value="{{ old('wholesale_price') }}" placeholder="8500">
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                    <div class="form-text">Prix pour commande en gros</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="stock_quantity" class="form-label">
                                        <strong>Quantité en stock *</strong>
                                    </label>
                                    <input type="number" class="form-control" id="stock_quantity" 
                                           name="stock_quantity" min="0" value="{{ old('stock_quantity', 0) }}" required>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label for="min_quantity" class="form-label">
                                        <strong>Quantité minimum *</strong>
                                    </label>
                                    <input type="number" class="form-control" id="min_quantity" 
                                           name="min_quantity" min="1" value="{{ old('min_quantity', 1) }}" required>
                                    <div class="form-text">Quantité minimum par commande</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite : Options et publication -->
                <div class="col-lg-4">
                    <!-- Statut et publication -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-megaphone"></i> Publication</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="status" class="form-label">
                                    <strong>Statut</strong>
                                </label>
                                <select class="form-select" id="status" name="status">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                        Brouillon
                                    </option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                        En attente de validation
                                    </option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                        Actif
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_featured" 
                                           id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Produit en vedette
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_trending" 
                                           id="is_trending" value="1" {{ old('is_trending') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_trending">
                                        Produit tendance
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_bestseller" 
                                           id="is_bestseller" value="1" {{ old('is_bestseller') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_bestseller">
                                        Meilleure vente
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_new" id="is_new" 
                                           value="1" {{ old('is_new', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_new">
                                        Nouveau produit
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catégorie et tags -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-tags"></i> Tags</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">
                                    <strong>Tags du produit</strong>
                                </label>
                                <select class="form-select select2-tags" name="tags[]" multiple data-placeholder="Sélectionnez des tags">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" 
                                                {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">Ajoutez des mots-clés pour faciliter la recherche</div>
                            </div>
                        </div>
                    </div>

                    <!-- Caractéristiques du produit -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-gear"></i> Caractéristiques</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="brand" class="form-label">
                                    <strong>Marque</strong>
                                </label>
                                <input type="text" class="form-control" id="brand" name="brand" 
                                       value="{{ old('brand') }}" placeholder="Ex: Apple">
                            </div>

                            <div class="mb-3">
                                <label for="model" class="form-label">
                                    <strong>Modèle</strong>
                                </label>
                                <input type="text" class="form-control" id="model" name="model" 
                                       value="{{ old('model') }}" placeholder="Ex: iPhone 13 Pro Max">
                            </div>

                            <div class="mb-3">
                                <label for="condition" class="form-label">
                                    <strong>État *</strong>
                                </label>
                                <select class="form-select" id="condition" name="condition" required>
                                    <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>Neuf</option>
                                    <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>Occasion</option>
                                    <option value="refurbished" {{ old('condition') == 'refurbished' ? 'selected' : '' }}>Reconditionné</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="material" class="form-label">
                                    <strong>Matériau</strong>
                                </label>
                                <input type="text" class="form-control" id="material" name="material" 
                                       value="{{ old('material') }}" placeholder="Ex: Acier inoxydable, Cuir">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="color" class="form-label">
                                        <strong>Couleur</strong>
                                    </label>
                                    <input type="text" class="form-control" id="color" name="color" 
                                           value="{{ old('color') }}" placeholder="Ex: Noir">
                                </div>
                                <div class="col-md-6">
                                    <label for="size" class="form-label">
                                        <strong>Taille</strong>
                                    </label>
                                    <input type="text" class="form-control" id="size" name="size" 
                                           value="{{ old('size') }}" placeholder="Ex: M, 42">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Livraison -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-truck"></i> Livraison</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="requires_shipping" 
                                           id="requires_shipping" value="1" checked>
                                    <label class="form-check-label" for="requires_shipping">
                                        Nécessite une livraison
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="shipping_cost" class="form-label">
                                    <strong>Frais de port</strong>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="shipping_cost" 
                                           name="shipping_cost" step="0.01" min="0" 
                                           value="{{ old('shipping_cost') }}" placeholder="599">
                                    <span class="input-group-text">FCFA</span>
                                </div>
                                <div class="form-text">Laissez vide pour les frais standard</div>
                            </div>

                            <div class="mb-3">
                                <label for="estimated_delivery" class="form-label">
                                    <strong>Délai de livraison</strong>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="estimated_delivery" 
                                           name="estimated_delivery" min="0" 
                                           value="{{ old('estimated_delivery') }}" placeholder="3">
                                    <span class="input-group-text">jours</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="weight" class="form-label">
                                        <strong>Poids (kg)</strong>
                                    </label>
                                    <input type="number" class="form-control" id="weight" name="weight" 
                                           step="0.01" min="0" value="{{ old('weight') }}" placeholder="0.5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="length" class="form-label">
                                        <strong>Longueur (cm)</strong>
                                    </label>
                                    <input type="number" class="form-control" id="length" name="length" 
                                           step="0.01" min="0" value="{{ old('length') }}" placeholder="15">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="width" class="form-label">
                                        <strong>Largeur (cm)</strong>
                                    </label>
                                    <input type="number" class="form-control" id="width" name="width" 
                                           step="0.01" min="0" value="{{ old('width') }}" placeholder="10">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="height" class="form-label">
                                        <strong>Hauteur (cm)</strong>
                                    </label>
                                    <input type="number" class="form-control" id="height" name="height" 
                                           step="0.01" min="0" value="{{ old('height') }}" placeholder="5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="sticky-bottom">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle"></i> Enregistrer le produit
                                    </button>
                                    <button type="submit" name="save_and_new" value="1" class="btn btn-outline-primary">
                                        <i class="bi bi-plus-circle"></i> Enregistrer et ajouter un autre
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Variantes (Section cachée par défaut) -->
            <div class="card mb-4" id="variantsSection" style="display: none;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-layers"></i> Variantes du produit</h5>
                </div>
                <div class="card-body">
                    <div id="variantsContainer">
                        <!-- Les variantes seront ajoutées dynamiquement ici -->
                    </div>
                    <button type="button" class="btn btn-outline-primary mt-3" id="addVariantBtn">
                        <i class="bi bi-plus"></i> Ajouter une variante
                    </button>
                </div>
            </div>

            <!-- Spécifications techniques -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-list-check"></i> Spécifications techniques</h5>
                </div>
                <div class="card-body">
                    <div id="specificationsContainer">
                        <div class="specification-item row mb-3">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="specs_key[]" 
                                       placeholder="Ex: Processeur">
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="specs_value[]" 
                                       placeholder="Ex: Apple A15 Bionic">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-danger remove-spec-btn">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary mt-3" id="addSpecBtn">
                        <i class="bi bi-plus"></i> Ajouter une spécification
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<style>
    .add-product-section {
        background-color: var(--light-color);
        min-height: calc(100vh - 200px);
    }

    .upload-card {
        background-color: white;
        border: 2px dashed var(--gray-light);
        border-radius: var(--border-radius);
        padding: 20px;
        text-align: center;
        transition: var(--transition);
    }

    .upload-card:hover {
        border-color: var(--accent-color);
        background-color: rgba(245, 158, 66, 0.05);
    }

    .upload-area {
        cursor: pointer;
        padding: 30px 20px;
    }

    .upload-area i {
        font-size: 48px;
        color: var(--gray-medium);
        margin-bottom: 15px;
    }

    .preview-container img {
        max-width: 200px;
        max-height: 200px;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
    }

    .preview-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .preview-gallery img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: var(--border-radius);
        border: 1px solid var(--gray-light);
    }

    .sticky-bottom {
        position: sticky;
        bottom: 20px;
        z-index: 1000;
    }

    .specification-item {
        background-color: rgba(0, 0, 0, 0.02);
        padding: 10px;
        border-radius: var(--border-radius);
    }

    .select2-tags {
        width: 100% !important;
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

    .form-label {
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 1px solid var(--gray-light);
        border-radius: var(--border-radius);
        padding: 10px 14px;
        font-size: 14px;
    }

    .btn-primary {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        font-weight: 600;
        padding: 12px 24px;
    }

    .btn-primary:hover {
        background-color: #e6892a;
        border-color: #e6892a;
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

    @media (max-width: 768px) {
        .add-product-section {
            padding: 1rem 0;
        }

        .card-body {
            padding: 1rem;
        }

        .preview-container img {
            max-width: 150px;
            max-height: 150px;
        }
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser Select2 pour les tags
    $('.select2-tags').select2({
        tags: true,
        tokenSeparators: [',', ' '],
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === '') return null;
            return {
                id: term,
                text: term,
                newTag: true
            };
        }
    });

    // Charger les sous-catégories en fonction de la catégorie sélectionnée
    $('#category_id').change(function() {
        const categoryId = $(this).val();
        const subcategorySelect = $('#subcategory_id');
        
        if (!categoryId) {
            subcategorySelect.html('<option value="">Sélectionnez une sous-catégorie</option>');
            return;
        }

        // Afficher un indicateur de chargement
        subcategorySelect.html('<option value="">Chargement...</option>');

        // Requête AJAX pour récupérer les sous-catégories
        fetch(`/seller/categories/${categoryId}/subcategories`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Sélectionnez une sous-catégorie</option>';
                
                data.forEach(subcategory => {
                    options += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                });
                
                subcategorySelect.html(options);
            })
            .catch(error => {
                console.error('Erreur:', error);
                subcategorySelect.html('<option value="">Erreur de chargement</option>');
            });
    });

    // Gestion de l'upload d'image principale
    const mainImageUpload = document.getElementById('mainImageUpload');
    const mainImageInput = document.getElementById('main_image');
    const mainImagePreview = document.getElementById('mainImagePreview');

    mainImageUpload.addEventListener('click', () => mainImageInput.click());
    mainImageUpload.addEventListener('dragover', (e) => {
        e.preventDefault();
        mainImageUpload.style.borderColor = 'var(--accent-color)';
    });
    mainImageUpload.addEventListener('dragleave', () => {
        mainImageUpload.style.borderColor = 'var(--gray-light)';
    });
    mainImageUpload.addEventListener('drop', (e) => {
        e.preventDefault();
        mainImageUpload.style.borderColor = 'var(--gray-light)';
        
        if (e.dataTransfer.files[0]) {
            mainImageInput.files = e.dataTransfer.files;
            previewMainImage(e.dataTransfer.files[0]);
        }
    });

    mainImageInput.addEventListener('change', (e) => {
        if (e.target.files[0]) {
            previewMainImage(e.target.files[0]);
        }
    });

    function previewMainImage(file) {
        if (!file.type.match('image.*')) {
            alert('Veuillez sélectionner une image valide');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            mainImagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid">`;
        };
        reader.readAsDataURL(file);
    }

    // Gestion de l'upload de galerie
    const galleryUpload = document.getElementById('galleryUpload');
    const galleryInput = document.getElementById('images');
    const galleryPreview = document.getElementById('galleryPreview');

    galleryUpload.addEventListener('click', () => galleryInput.click());
    galleryUpload.addEventListener('dragover', (e) => {
        e.preventDefault();
        galleryUpload.style.borderColor = 'var(--accent-color)';
    });
    galleryUpload.addEventListener('dragleave', () => {
        galleryUpload.style.borderColor = 'var(--gray-light)';
    });
    galleryUpload.addEventListener('drop', (e) => {
        e.preventDefault();
        galleryUpload.style.borderColor = 'var(--gray-light)';
        
        if (e.dataTransfer.files) {
            galleryInput.files = e.dataTransfer.files;
            previewGallery(Array.from(e.dataTransfer.files));
        }
    });

    galleryInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            previewGallery(Array.from(e.target.files));
        }
    });

    function previewGallery(files) {
        // Limiter à 5 images
        if (files.length > 5) {
            alert('Maximum 5 images autorisées');
            files = files.slice(0, 5);
        }

        galleryPreview.innerHTML = '';
        
        files.forEach((file, index) => {
            if (!file.type.match('image.*')) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = `Image ${index + 1}`;
                img.classList.add('img-thumbnail');
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0';
                removeBtn.style.transform = 'translate(30%, -30%)';
                removeBtn.innerHTML = '<i class="bi bi-x"></i>';
                removeBtn.onclick = function() {
                    removeImageFromGallery(index);
                };

                const container = document.createElement('div');
                container.className = 'position-relative d-inline-block';
                container.appendChild(img);
                container.appendChild(removeBtn);
                
                galleryPreview.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeImageFromGallery(index) {
        // Créer un nouveau DataTransfer
        const dt = new DataTransfer();
        const files = Array.from(galleryInput.files);
        
        // Supprimer le fichier à l'index spécifié
        files.splice(index, 1);
        
        // Ajouter les fichiers restants au DataTransfer
        files.forEach(file => {
            dt.items.add(file);
        });
        
        // Mettre à jour l'input file
        galleryInput.files = dt.files;
        
        // Recréer la prévisualisation
        previewGallery(files);
    }

    // Compteur de caractères pour la description courte (200 max)
    const shortDescTextarea = document.getElementById('short_description');
    const shortDescCount = document.getElementById('shortDescCount');

    shortDescTextarea.addEventListener('input', function() {
        const count = this.value.length;
        shortDescCount.textContent = `${count}/200`;
        
        if (count > 200) {
            this.value = this.value.substring(0, 200);
            shortDescCount.textContent = '200/200';
            shortDescCount.classList.add('text-danger');
        } else {
            shortDescCount.classList.remove('text-danger');
        }
    });

    // Compteur de mots pour la description détaillée (500 mots max)
    const descTextarea = document.getElementById('description');
    const wordCountSpan = document.getElementById('wordCount');

    function countWords(text) {
        return text.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    descTextarea.addEventListener('input', function() {
        const text = this.value;
        const wordCount = countWords(text);
        wordCountSpan.textContent = `${wordCount} / 500 mots`;

        if (wordCount > 500) {
            // Trouver l'index où dépasse 500 mots
            const words = text.trim().split(/\s+/);
            if (words.length > 500) {
                const truncated = words.slice(0, 500).join(' ');
                this.value = truncated;
                wordCountSpan.textContent = '500 / 500 mots';
            }
            wordCountSpan.classList.add('text-danger');
        } else {
            wordCountSpan.classList.remove('text-danger');
        }
    });

    // Gestion des spécifications techniques
    const specsContainer = document.getElementById('specificationsContainer');
    const addSpecBtn = document.getElementById('addSpecBtn');

    addSpecBtn.addEventListener('click', function() {
        const newSpec = document.createElement('div');
        newSpec.className = 'specification-item row mb-3';
        newSpec.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="specs_key[]" placeholder="Ex: Processeur">
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="specs_value[]" placeholder="Ex: Apple A15 Bionic">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger remove-spec-btn">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        
        specsContainer.appendChild(newSpec);
        
        // Ajouter l'événement de suppression
        newSpec.querySelector('.remove-spec-btn').addEventListener('click', function() {
            if (specsContainer.children.length > 1) {
                newSpec.remove();
            }
        });
    });

    // Ajouter les événements de suppression aux spécifications existantes
    document.querySelectorAll('.remove-spec-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (specsContainer.children.length > 1) {
                this.closest('.specification-item').remove();
            }
        });
    });

    // Gestion des variantes (section avancée)
    const hasVariantsCheckbox = document.getElementById('has_variants');
    const variantsSection = document.getElementById('variantsSection');
    const variantsContainer = document.getElementById('variantsContainer');
    const addVariantBtn = document.getElementById('addVariantBtn');

    if (hasVariantsCheckbox) {
        hasVariantsCheckbox.addEventListener('change', function() {
            if (this.checked) {
                variantsSection.style.display = 'block';
            } else {
                variantsSection.style.display = 'none';
            }
        });
    }

    addVariantBtn.addEventListener('click', function() {
        const variantCount = variantsContainer.children.length;
        const newVariant = document.createElement('div');
        newVariant.className = 'variant-item card mb-3';
        newVariant.innerHTML = `
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom de la variante *</label>
                        <input type="text" class="form-control" name="variants[${variantCount}][name]" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" name="variants[${variantCount}][sku]">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Prix *</label>
                        <input type="number" class="form-control" name="variants[${variantCount}][price]" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ancien prix</label>
                        <input type="number" class="form-control" name="variants[${variantCount}][compare_price]" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="variants[${variantCount}][stock_quantity]" min="0" value="0">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Image de la variante</label>
                        <input type="file" class="form-control" name="variants[${variantCount}][image]" accept="image/*">
                    </div>
                </div>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="variants[${variantCount}][is_default]" value="1">
                    <label class="form-check-label">Variante par défaut</label>
                </div>
                
                <button type="button" class="btn btn-outline-danger remove-variant-btn">
                    <i class="bi bi-trash"></i> Supprimer cette variante
                </button>
            </div>
        `;
        
        variantsContainer.appendChild(newVariant);
        
        // Ajouter l'événement de suppression
        newVariant.querySelector('.remove-variant-btn').addEventListener('click', function() {
            newVariant.remove();
        });
    });

    // Validation du formulaire
    const productForm = document.getElementById('productForm');
    
    productForm.addEventListener('submit', function(e) {
        // Validation basique
        const price = parseFloat(document.getElementById('price').value);
        const comparePrice = parseFloat(document.getElementById('compare_price').value) || 0;
        
        if (comparePrice > 0 && comparePrice <= price) {
            e.preventDefault();
            alert('Le prix de comparaison doit être supérieur au prix de vente.');
            return false;
        }
        
        // Vérifier les variantes si activées
        if (hasVariantsCheckbox && hasVariantsCheckbox.checked) {
            const variantItems = variantsContainer.querySelectorAll('.variant-item');
            if (variantItems.length === 0) {
                e.preventDefault();
                alert('Veuillez ajouter au moins une variante lorsque l\'option "Produit avec variantes" est activée.');
                return false;
            }
        }
        
        // Afficher un indicateur de chargement
        const submitButtons = productForm.querySelectorAll('button[type="submit"]');
        submitButtons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Enregistrement en cours...';
        });
        
        return true;
    });

    // Calculer automatiquement le prix de gros (80% du prix de vente)
    const priceInput = document.getElementById('price');
    const wholesalePriceInput = document.getElementById('wholesale_price');
    
    priceInput.addEventListener('blur', function() {
        if (!wholesalePriceInput.value && priceInput.value) {
            const price = parseFloat(priceInput.value);
            if (!isNaN(price) && price > 0) {
                wholesalePriceInput.value = (price * 0.8).toFixed(2);
            }
        }
    });

    // Générer automatiquement un SKU basé sur le nom
    const nameInput = document.getElementById('name');
    const skuInput = document.getElementById('sku');
    
    nameInput.addEventListener('blur', function() {
        if (!skuInput.value && nameInput.value) {
            const name = nameInput.value;
            // Générer un SKU simplifié
            let sku = name
                .toUpperCase()
                .replace(/[^A-Z0-9\s]/g, '')
                .replace(/\s+/g, '-')
                .substring(0, 20);
                
            // Ajouter un suffixe aléatoire pour l'unicité
            const suffix = Math.random().toString(36).substring(2, 6).toUpperCase();
            skuInput.value = sku + '-' + suffix;
        }
    });
});
</script>
@endsection