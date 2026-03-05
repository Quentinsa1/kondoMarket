@extends('template.template')

@section('title', 'Modifier ' . $product->name . ' - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : MODIFICATION PRODUIT ===== -->
<section class="edit-product-section py-5">
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seller.products.index') }}">Produits</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seller.products.show', $product) }}">{{ $product->name }}</a></li>
                        <li class="breadcrumb-item active">Modifier</li>
                    </ol>
                </nav>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2">Modifier le produit</h1>
                    <a href="{{ route('seller.products.show', $product) }}" class="btn btn-outline-secondary">
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

        <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            @method('PUT')
            
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" 
                                       value="{{ old('name', $product->name) }}" required 
                                       placeholder="Ex: iPhone 13 Pro Max 256GB">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Donnez un nom clair et descriptif à votre produit</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">
                                        <strong>Catégorie *</strong>
                                    </label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                        <option value="">Sélectionnez une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="subcategory_id" class="form-label">
                                        <strong>Sous-catégorie</strong>
                                    </label>
                                    <select class="form-select @error('subcategory_id') is-invalid @enderror" id="subcategory_id" name="subcategory_id">
                                        <option value="">Sélectionnez une sous-catégorie</option>
                                        @foreach($categories->firstWhere('id', old('category_id', $product->category_id))?->subcategories ?? [] as $subcategory)
                                            <option value="{{ $subcategory->id }}" 
                                                    {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="short_description" class="form-label">
                                    <strong>Description courte</strong>
                                </label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" 
                                          rows="2" maxlength="200" 
                                          placeholder="Une brève description (max 200 caractères)">{{ old('short_description', $product->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text d-flex justify-content-between">
                                    <span>Maximum 200 caractères</span>
                                    <span id="shortDescCount">{{ strlen(old('short_description', $product->short_description ?? '')) }}/200</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    <strong>Description détaillée *</strong>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" 
                                          rows="8" required 
                                          placeholder="Décrivez votre produit en détail (max 500 mots)...">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <div class="d-flex justify-content-between">
                                        <span>Utilisez des mots-clés pertinents</span>
                                        <span id="wordCount">
                                            {{-- Comptage approximatif de mots --}}
                                            {{ str_word_count(old('description', $product->description)) }} / 500 mots
                                        </span>
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
                                                   accept="image/*" hidden>
                                        </div>
                                        <div class="form-text">Format recommandé: 800x800px, JPG ou PNG</div>
                                        <div class="preview-container mt-3" id="mainImagePreview">
                                            @if($product->main_image)
                                                <img src="{{ $product->main_image_url }}" alt="Image principale" class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                    @if($product->main_image)
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_main_image" id="remove_main_image" value="1">
                                            <label class="form-check-label text-danger" for="remove_main_image">
                                                <i class="bi bi-trash"></i> Supprimer l'image principale actuelle
                                            </label>
                                        </div>
                                    @endif
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
                                        <div class="preview-gallery mt-3" id="galleryPreview">
                                            @if($product->images && count($product->images) > 0)
                                                @foreach($product->images_urls as $index => $url)
                                                    @if($index > 0) {{-- On ignore l'image principale --}}
                                                        <div class="position-relative d-inline-block m-1">
                                                            <img src="{{ $url }}" alt="Image {{ $index }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                                            <div class="form-check position-absolute top-0 end-0 bg-white rounded p-1" style="transform: translate(30%, -30%);">
                                                                <input class="form-check-input" type="checkbox" name="remove_images[]" value="{{ $index - 1 }}" id="remove_img_{{ $index }}">
                                                                <label class="form-check-label small" for="remove_img_{{ $index }}" title="Supprimer">🗑️</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
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
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" 
                                               step="0.01" min="0" value="{{ old('price', $product->price) }}" required 
                                               placeholder="9900">
                                        <span class="input-group-text">FCFA</span>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="compare_price" class="form-label">
                                        <strong>Ancien prix (optionnel)</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('compare_price') is-invalid @enderror" id="compare_price" 
                                               name="compare_price" step="0.01" min="0" 
                                               value="{{ old('compare_price', $product->compare_price) }}" placeholder="14900">
                                        <span class="input-group-text">FCFA</span>
                                        @error('compare_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">Pour afficher un prix barré</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="cost_price" class="form-label">
                                        <strong>Prix de revient</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('cost_price') is-invalid @enderror" id="cost_price" 
                                               name="cost_price" step="0.01" min="0" 
                                               value="{{ old('cost_price', $product->cost_price) }}" placeholder="7000">
                                        <span class="input-group-text">FCFA</span>
                                        @error('cost_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="wholesale_price" class="form-label">
                                        <strong>Prix en gros</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('wholesale_price') is-invalid @enderror" id="wholesale_price" 
                                               name="wholesale_price" step="0.01" min="0" 
                                               value="{{ old('wholesale_price', $product->wholesale_price) }}" placeholder="8500">
                                        <span class="input-group-text">FCFA</span>
                                        @error('wholesale_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">Prix pour commande en gros</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="stock_quantity" class="form-label">
                                        <strong>Quantité en stock *</strong>
                                    </label>
                                    <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" 
                                           name="stock_quantity" min="0" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                    @error('stock_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="alert_quantity" class="form-label">
                                        <strong>Alerte de stock bas</strong>
                                    </label>
                                    <input type="number" class="form-control @error('alert_quantity') is-invalid @enderror" id="alert_quantity" 
                                           name="alert_quantity" min="0" value="{{ old('alert_quantity', $product->alert_quantity) }}">
                                    @error('alert_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Recevez une alerte quand le stock atteint ce niveau</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="sku" class="form-label">
                                        <strong>SKU (Référence)</strong>
                                    </label>
                                    <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" 
                                           value="{{ old('sku', $product->sku) }}" placeholder="IPHONE-13-PRO-256">
                                    @error('sku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Stock Keeping Unit - Identifiant unique</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="barcode" class="form-label">
                                        <strong>Code-barres</strong>
                                    </label>
                                    <input type="text" class="form-control @error('barcode') is-invalid @enderror" id="barcode" name="barcode" 
                                           value="{{ old('barcode', $product->barcode) }}" placeholder="123456789012">
                                    @error('barcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="min_quantity" class="form-label">
                                        <strong>Quantité minimum *</strong>
                                    </label>
                                    <input type="number" class="form-control @error('min_quantity') is-invalid @enderror" id="min_quantity" 
                                           name="min_quantity" min="1" value="{{ old('min_quantity', $product->min_quantity) }}" required>
                                    @error('min_quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Quantité minimum par commande</div>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="manage_stock" id="manage_stock" value="1" {{ old('manage_stock', $product->manage_stock) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="manage_stock">
                                                    Gérer le stock
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="allow_backorder" id="allow_backorder" value="1" {{ old('allow_backorder', $product->allow_backorder) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="allow_backorder">
                                                    Autoriser les commandes en attente
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="low_stock_notification" id="low_stock_notification" value="1" {{ old('low_stock_notification', $product->low_stock_notification) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="low_stock_notification">
                                                    Notification stock bas
                                                </label>
                                            </div>
                                        </div>
                                    </div>
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
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="pending" {{ old('status', $product->status) == 'pending' ? 'selected' : '' }}>En attente de validation</option>
                                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Actif</option>
                                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_featured" 
                                           id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Produit en vedette
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_trending" 
                                           id="is_trending" value="1" {{ old('is_trending', $product->is_trending) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_trending">
                                        Produit tendance
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_bestseller" 
                                           id="is_bestseller" value="1" {{ old('is_bestseller', $product->is_bestseller) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_bestseller">
                                        Meilleure vente
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_new" id="is_new" 
                                           value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_new">
                                        Nouveau produit
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
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
                                                {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
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
                                <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" 
                                       value="{{ old('brand', $product->brand) }}" placeholder="Ex: Apple">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="model" class="form-label">
                                    <strong>Modèle</strong>
                                </label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" 
                                       value="{{ old('model', $product->model) }}" placeholder="Ex: iPhone 13 Pro Max">
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="condition" class="form-label">
                                    <strong>État *</strong>
                                </label>
                                <select class="form-select @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                                    <option value="new" {{ old('condition', $product->condition) == 'new' ? 'selected' : '' }}>Neuf</option>
                                    <option value="used" {{ old('condition', $product->condition) == 'used' ? 'selected' : '' }}>Occasion</option>
                                    <option value="refurbished" {{ old('condition', $product->condition) == 'refurbished' ? 'selected' : '' }}>Reconditionné</option>
                                </select>
                                @error('condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="material" class="form-label">
                                    <strong>Matériau</strong>
                                </label>
                                <input type="text" class="form-control @error('material') is-invalid @enderror" id="material" name="material" 
                                       value="{{ old('material', $product->material) }}" placeholder="Ex: Acier inoxydable, Cuir">
                                @error('material')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="color" class="form-label">
                                        <strong>Couleur</strong>
                                    </label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" 
                                           value="{{ old('color', $product->color) }}" placeholder="Ex: Noir">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="size" class="form-label">
                                        <strong>Taille</strong>
                                    </label>
                                    <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size" 
                                           value="{{ old('size', $product->size) }}" placeholder="Ex: M, 42">
                                    @error('size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="warranty_period" class="form-label">
                                    <strong>Période de garantie</strong>
                                </label>
                                <input type="text" class="form-control @error('warranty_period') is-invalid @enderror" id="warranty_period" name="warranty_period" 
                                       value="{{ old('warranty_period', $product->warranty_period) }}" placeholder="Ex: 2 ans">
                                @error('warranty_period')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="warranty_terms" class="form-label">
                                    <strong>Conditions de garantie</strong>
                                </label>
                                <textarea class="form-control @error('warranty_terms') is-invalid @enderror" id="warranty_terms" name="warranty_terms" 
                                          rows="2" placeholder="Détaillez les conditions de garantie">{{ old('warranty_terms', $product->warranty_terms) }}</textarea>
                                @error('warranty_terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                           id="requires_shipping" value="1" {{ old('requires_shipping', $product->requires_shipping) ? 'checked' : '' }}>
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
                                    <input type="number" class="form-control @error('shipping_cost') is-invalid @enderror" id="shipping_cost" 
                                           name="shipping_cost" step="0.01" min="0" 
                                           value="{{ old('shipping_cost', $product->shipping_cost) }}" placeholder="599">
                                    <span class="input-group-text">FCFA</span>
                                    @error('shipping_cost')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Laissez vide pour les frais standard</div>
                            </div>

                            <div class="mb-3">
                                <label for="estimated_delivery" class="form-label">
                                    <strong>Délai de livraison</strong>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('estimated_delivery') is-invalid @enderror" id="estimated_delivery" 
                                           name="estimated_delivery" min="0" 
                                           value="{{ old('estimated_delivery', $product->estimated_delivery) }}" placeholder="3">
                                    <span class="input-group-text">jours</span>
                                    @error('estimated_delivery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="weight" class="form-label">
                                        <strong>Poids (kg)</strong>
                                    </label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" 
                                           step="0.01" min="0" value="{{ old('weight', $product->weight) }}" placeholder="0.5">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="length" class="form-label">
                                        <strong>Longueur (cm)</strong>
                                    </label>
                                    <input type="number" class="form-control @error('length') is-invalid @enderror" id="length" name="length" 
                                           step="0.01" min="0" value="{{ old('length', $product->length) }}" placeholder="15">
                                    @error('length')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="width" class="form-label">
                                        <strong>Largeur (cm)</strong>
                                    </label>
                                    <input type="number" class="form-control @error('width') is-invalid @enderror" id="width" name="width" 
                                           step="0.01" min="0" value="{{ old('width', $product->width) }}" placeholder="10">
                                    @error('width')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="height" class="form-label">
                                        <strong>Hauteur (cm)</strong>
                                    </label>
                                    <input type="number" class="form-control @error('height') is-invalid @enderror" id="height" name="height" 
                                           step="0.01" min="0" value="{{ old('height', $product->height) }}" placeholder="5">
                                    @error('height')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                        <i class="bi bi-check-circle"></i> Mettre à jour
                                    </button>
                                    <a href="{{ route('seller.products.show', $product) }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle"></i> Annuler
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Variantes -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-layers"></i> Variantes</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="has_variants" id="has_variants" value="1" {{ old('has_variants', $product->has_variants) ? 'checked' : '' }}>
                        <label class="form-check-label" for="has_variants">
                            Ce produit a des variantes
                        </label>
                    </div>
                </div>
                <div class="card-body" id="variantsSection" style="{{ old('has_variants', $product->has_variants) ? '' : 'display: none;' }}">
                    <div id="variantsContainer">
                        @if($product->variants && $product->variants->count() > 0)
                            @foreach($product->variants as $index => $variant)
                                <div class="variant-item card mb-3">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nom de la variante *</label>
                                                <input type="text" class="form-control" name="variants[{{ $index }}][name]" value="{{ $variant->name }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">SKU</label>
                                                <input type="text" class="form-control" name="variants[{{ $index }}][sku]" value="{{ $variant->sku }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Prix *</label>
                                                <input type="number" class="form-control" name="variants[{{ $index }}][price]" step="0.01" min="0" value="{{ $variant->price }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Ancien prix</label>
                                                <input type="number" class="form-control" name="variants[{{ $index }}][compare_price]" step="0.01" min="0" value="{{ $variant->compare_price }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Stock</label>
                                                <input type="number" class="form-control" name="variants[{{ $index }}][stock_quantity]" min="0" value="{{ $variant->stock_quantity ?? 0 }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Image de la variante</label>
                                                @if($variant->image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/'.$variant->image) }}" alt="{{ $variant->name }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="variants[{{ $index }}][remove_image]" value="1" id="remove_var_img_{{ $index }}">
                                                            <label class="form-check-label text-danger" for="remove_var_img_{{ $index }}">Supprimer l'image</label>
                                                        </div>
                                                    </div>
                                                @endif
                                                <input type="file" class="form-control" name="variants[{{ $index }}][image]" accept="image/*">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Attributs (JSON)</label>
                                                <input type="text" class="form-control" name="variants[{{ $index }}][attributes]" value="{{ json_encode($variant->attributes) }}" placeholder='{"couleur":"rouge","taille":"M"}'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="variants[{{ $index }}][is_default]" value="1" {{ $variant->is_default ? 'checked' : '' }}>
                                            <label class="form-check-label">Variante par défaut</label>
                                        </div>
                                        
                                        <button type="button" class="btn btn-outline-danger remove-variant-btn">
                                            <i class="bi bi-trash"></i> Supprimer cette variante
                                        </button>
                                        
                                        <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
                        @if($product->specifications && count($product->specifications) > 0)
                            @foreach($product->specifications as $index => $spec)
                                <div class="specification-item row mb-3">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="specs_key[]" value="{{ $spec['key'] }}" placeholder="Ex: Processeur">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="specs_value[]" value="{{ $spec['value'] }}" placeholder="Ex: Apple A15 Bionic">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-danger remove-spec-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="specification-item row mb-3">
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
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-outline-primary mt-3" id="addSpecBtn">
                        <i class="bi bi-plus"></i> Ajouter une spécification
                    </button>
                </div>
            </div>

            <!-- Champs cachés pour les attributs (si nécessaire) -->
            {{-- <input type="hidden" name="attributes" value=""> --}}
        </form>
    </div>
</section>

<style>
    .edit-product-section {
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
        .edit-product-section {
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

        subcategorySelect.html('<option value="">Chargement...</option>');

        fetch(`/seller/categories/${categoryId}/subcategories`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Sélectionnez une sous-catégorie</option>';
                data.forEach(subcategory => {
                    options += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                });
                subcategorySelect.html(options);
                
                // Ré-sélectionner l'ancienne valeur si elle existe
                const oldSubcat = '{{ old('subcategory_id', $product->subcategory_id) }}';
                if (oldSubcat) {
                    subcategorySelect.val(oldSubcat);
                }
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

        // On conserve les images existantes + les nouvelles
        // Pour simplifier, on remplace la prévisualisation par les nouvelles seulement
        // Les anciennes sont gérées via les checkboxes
        galleryPreview.innerHTML = '';
        
        files.forEach((file, index) => {
            if (!file.type.match('image.*')) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = `Nouvelle image ${index + 1}`;
                img.classList.add('img-thumbnail');
                
                const container = document.createElement('div');
                container.className = 'position-relative d-inline-block m-1';
                container.appendChild(img);
                
                galleryPreview.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    }

    // Compteur de caractères pour la description courte
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

    // Compteur de mots pour la description détaillée
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
            const words = text.trim().split(/\s+/);
            const truncated = words.slice(0, 500).join(' ');
            this.value = truncated;
            wordCountSpan.textContent = '500 / 500 mots';
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
        
        newSpec.querySelector('.remove-spec-btn').addEventListener('click', function() {
            if (specsContainer.children.length > 1) {
                newSpec.remove();
            }
        });
    });

    document.querySelectorAll('.remove-spec-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (specsContainer.children.length > 1) {
                this.closest('.specification-item').remove();
            }
        });
    });

    // Gestion des variantes
    const hasVariantsCheckbox = document.getElementById('has_variants');
    const variantsSection = document.getElementById('variantsSection');
    const variantsContainer = document.getElementById('variantsContainer');
    const addVariantBtn = document.getElementById('addVariantBtn');

    hasVariantsCheckbox.addEventListener('change', function() {
        variantsSection.style.display = this.checked ? 'block' : 'none';
    });

    let variantIndex = {{ $product->variants ? $product->variants->count() : 0 }};

    addVariantBtn.addEventListener('click', function() {
        const newVariant = document.createElement('div');
        newVariant.className = 'variant-item card mb-3';
        newVariant.innerHTML = `
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom de la variante *</label>
                        <input type="text" class="form-control" name="variants[${variantIndex}][name]" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" name="variants[${variantIndex}][sku]">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Prix *</label>
                        <input type="number" class="form-control" name="variants[${variantIndex}][price]" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ancien prix</label>
                        <input type="number" class="form-control" name="variants[${variantIndex}][compare_price]" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="variants[${variantIndex}][stock_quantity]" min="0" value="0">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Image de la variante</label>
                        <input type="file" class="form-control" name="variants[${variantIndex}][image]" accept="image/*">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Attributs (JSON)</label>
                        <input type="text" class="form-control" name="variants[${variantIndex}][attributes]" placeholder='{"couleur":"rouge","taille":"M"}'>
                    </div>
                </div>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="variants[${variantIndex}][is_default]" value="1">
                    <label class="form-check-label">Variante par défaut</label>
                </div>
                
                <button type="button" class="btn btn-outline-danger remove-variant-btn">
                    <i class="bi bi-trash"></i> Supprimer cette variante
                </button>
            </div>
        `;
        
        variantsContainer.appendChild(newVariant);
        
        newVariant.querySelector('.remove-variant-btn').addEventListener('click', function() {
            newVariant.remove();
        });

        variantIndex++;
    });

    // Supprimer les variantes existantes
    document.querySelectorAll('.remove-variant-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.variant-item').remove();
        });
    });

    // Validation du formulaire
    const productForm = document.getElementById('productForm');
    
    productForm.addEventListener('submit', function(e) {
        const price = parseFloat(document.getElementById('price').value);
        const comparePrice = parseFloat(document.getElementById('compare_price').value) || 0;
        
        if (comparePrice > 0 && comparePrice <= price) {
            e.preventDefault();
            alert('Le prix de comparaison doit être supérieur au prix de vente.');
            return false;
        }
        
        // Afficher un indicateur de chargement
        const submitButtons = productForm.querySelectorAll('button[type="submit"]');
        submitButtons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Mise à jour en cours...';
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

    // Générer automatiquement un SKU basé sur le nom (si vide)
    const nameInput = document.getElementById('name');
    const skuInput = document.getElementById('sku');
    
    nameInput.addEventListener('blur', function() {
        if (!skuInput.value && nameInput.value) {
            const name = nameInput.value;
            let sku = name
                .toUpperCase()
                .replace(/[^A-Z0-9\s]/g, '')
                .replace(/\s+/g, '-')
                .substring(0, 20);
                
            const suffix = Math.random().toString(36).substring(2, 6).toUpperCase();
            skuInput.value = sku + '-' + suffix;
        }
    });

    // Initialiser l'affichage des sous-catégories si une catégorie est déjà sélectionnée
    if ($('#category_id').val()) {
        $('#category_id').trigger('change');
    }
});
</script>
@endsection