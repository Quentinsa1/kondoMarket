@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="container-xxl py-4">
    <!-- Fil d'ariane -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Catégories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category['name'] }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar avec sous-catégories -->
        <div class="col-lg-3 col-md-4 d-none d-md-block">
            <div class="category-sidebar-sticky">
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <i class="bi {{ $category['icon'] }}"></i> {{ $category['name'] }}
                    </div>
                    <div class="sidebar-card-body">
                        <p>{{ $category['description'] }}</p>
                        <div class="category-stats">
                            <div class="stat-item">
                                <i class="bi bi-box"></i>
                                <span>{{ number_format($category['product_count'], 0, ',', ' ') }} produits</span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-shop"></i>
                                <span>{{ rand(100, 1000) }} vendeurs</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($subcategories) > 0)
                <div class="sidebar-card mt-4">
                    <div class="sidebar-card-header">
                        <i class="bi bi-list-nested"></i> Sous-catégories
                    </div>
                    <div class="sidebar-card-body p-0">
                        <div class="subcategory-list">
                            @foreach($subcategories as $subcategory)
                            <a href="{{ route('categories.subcategory', [$category['id'], $subcategory['id']]) }}" 
                               class="subcategory-item">
                                <span>{{ $subcategory['name'] }}</span>
                                <span class="subcategory-count">{{ number_format($subcategory['product_count'], 0, ',', ' ') }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Catégories connexes -->
                @if(isset($relatedCategories) && count($relatedCategories) > 0)
                <div class="sidebar-card mt-4">
                    <div class="sidebar-card-header">
                        <i class="bi bi-arrow-left-right"></i> Catégories connexes
                    </div>
                    <div class="sidebar-card-body">
                        <div class="related-categories">
                            @foreach($relatedCategories as $related)
                            <a href="{{ route('categories.show', $related['id']) }}" class="related-category">
                                <i class="bi {{ $related['icon'] }}"></i>
                                <span>{{ $related['name'] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="col-lg-9 col-md-8">
            <!-- En-tête de catégorie -->
            <div class="category-header mb-5">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="category-icon-large">
                        <i class="bi {{ $category['icon'] }}"></i>
                    </div>
                    <div>
                        <h1 class="mb-2" style="color: var(--primary-color);">{{ $category['name'] }}</h1>
                        <p class="text-muted mb-0">{{ $category['description'] }}</p>
                    </div>
                </div>
                
                <!-- Filtres -->
                <div class="category-filters mt-4">
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <select class="form-select filter-select">
                                <option>Trier par : Pertinence</option>
                                <option>Prix croissant</option>
                                <option>Prix décroissant</option>
                                <option>Meilleures ventes</option>
                                <option>Nouveautés</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <select class="form-select filter-select">
                                <option>MOQ : Tous</option>
                                <option>1-50 pièces</option>
                                <option>51-100 pièces</option>
                                <option>101-500 pièces</option>
                                <option>500+ pièces</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <select class="form-select filter-select">
                                <option>Prix : Tous</option>
                                <option>Moins de 100€</option>
                                <option>100-500€</option>
                                <option>500-1000€</option>
                                <option>Plus de 1000€</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <select class="form-select filter-select">
                                <option>Note : Toutes</option>
                                <option>4 étoiles et +</option>
                                <option>3 étoiles et +</option>
                                <option>2 étoiles et +</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produits -->
            @if(isset($products) && count($products) > 0)
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        @if($product['badge'])
                        <div class="product-badge">{{ $product['badge'] }}</div>
                        @endif
                        <div class="product-image">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" loading="lazy">
                        </div>
                        <div class="product-info">
                            <div class="product-name">{{ $product['name'] }}</div>
                            <div class="product-price">
                                {{ $product['price'] }}
                                @if($product['originalPrice'])
                                <span class="product-original-price">{{ $product['originalPrice'] }}</span>
                                @endif
                            </div>
                            <div class="product-moq">MOQ: {{ $product['moq'] }}</div>
                            <div class="product-vendor">
                                {{ $product['vendor'] }}
                                <i class="bi bi-patch-check-fill vendor-verified"></i>
                            </div>
                            <div class="product-rating">
                                <div class="rating-stars">
                                    @php
                                        $rating = $product['rating'];
                                        $fullStars = floor($rating);
                                        $hasHalfStar = $rating - $fullStars >= 0.5;
                                    @endphp
                                    
                                    @for($i = 0; $i < $fullStars; $i++)
                                    <i class="bi bi-star-fill"></i>
                                    @endfor
                                    
                                    @if($hasHalfStar)
                                    <i class="bi bi-star-half"></i>
                                    @endif
                                    
                                    @php $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0); @endphp
                                    @for($i = 0; $i < $emptyStars; $i++)
                                    <i class="bi bi-star"></i>
                                    @endfor
                                </div>
                                <div class="rating-count">({{ $product['review_count'] }})</div>
                            </div>
                            <div class="product-actions">
                                <button class="btn-quick-view"><i class="bi bi-eye"></i> Voir</button>
                                <button class="btn-contact-seller"><i class="bi bi-chat-dots"></i> Contacter</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Précédent</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Suivant</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="bi bi-box-seam" style="font-size: 4rem; color: var(--gray-light);"></i>
                    <h3 class="mt-3">Aucun produit disponible</h3>
                    <p class="text-muted">Aucun produit n'est disponible dans cette catégorie pour le moment.</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-left"></i> Voir toutes les catégories
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.category-sidebar-sticky {
    position: sticky;
    top: 100px;
}

.category-icon-large {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
}

.category-stats {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 15px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--gray-dark);
    font-size: 14px;
}

.stat-item i {
    color: var(--accent-color);
}

.subcategory-list {
    max-height: 400px;
    overflow-y: auto;
}

.subcategory-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    border-bottom: 1px solid var(--gray-light);
    color: var(--secondary-color);
    transition: var(--transition);
    text-decoration: none;
}

.subcategory-item:last-child {
    border-bottom: none;
}

.subcategory-item:hover {
    background-color: var(--light-color);
    color: var(--accent-color);
    padding-left: 25px;
}

.subcategory-count {
    background-color: var(--light-color);
    color: var(--gray-medium);
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 12px;
}

.related-categories {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.related-category {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    border: 1px solid var(--gray-light);
    border-radius: var(--border-radius);
    color: var(--secondary-color);
    transition: var(--transition);
    text-decoration: none;
}

.related-category:hover {
    border-color: var(--accent-color);
    background-color: rgba(245, 158, 66, 0.1);
    transform: translateX(5px);
}

.related-category i {
    color: var(--primary-color);
    font-size: 18px;
}

.filter-select {
    border: 1px solid var(--gray-light);
    border-radius: var(--border-radius);
    padding: 10px 15px;
    font-size: 14px;
    color: var(--secondary-color);
    background-color: white;
}

.filter-select:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 66, 0.1);
}

.empty-state {
    padding: 60px 20px;
}

/* Produit card styles (identique au template) */
.product-card {
    background-color: white;
    border: 1px solid var(--gray-light);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    position: relative;
    height: 100%;
}

.product-card:hover {
    border-color: var(--accent-color);
    box-shadow: var(--shadow-md);
    transform: translateY(-5px);
}

.product-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background-color: var(--accent-color);
    color: white;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 4px;
    z-index: 1;
}

.product-image {
    height: 160px;
    background-color: var(--light-color);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-info {
    padding: 16px;
}

.product-name {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 10px;
    height: 40px;
    overflow: hidden;
    line-height: 1.3;
    color: var(--secondary-color);
}

.product-price {
    font-weight: 700;
    color: var(--accent-color);
    font-size: 16px;
    margin-bottom: 8px;
}

.product-original-price {
    font-size: 13px;
    color: var(--gray-medium);
    text-decoration: line-through;
    margin-left: 8px;
}

.product-moq {
    font-size: 13px;
    color: var(--gray-dark);
    margin-bottom: 8px;
}

.product-vendor {
    font-size: 13px;
    color: var(--gray-medium);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.vendor-verified {
    color: var(--success-color);
    font-size: 12px;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 15px;
}

.rating-stars {
    color: #ffb400;
    font-size: 13px;
}

.rating-count {
    font-size: 12px;
    color: var(--gray-medium);
}

.product-actions {
    display: flex;
    gap: 8px;
}

.btn-quick-view, .btn-contact-seller {
    flex: 1;
    padding: 10px;
    font-size: 13px;
    font-weight: 600;
    border-radius: var(--border-radius);
    border: none;
    cursor: pointer;
    transition: var(--transition);
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.btn-quick-view {
    background-color: var(--light-color);
    color: var(--secondary-color);
    border: 1px solid var(--gray-light);
}

.btn-quick-view:hover {
    background-color: var(--gray-light);
    transform: translateY(-2px);
}

.btn-contact-seller {
    background-color: var(--accent-color);
    color: white;
}

.btn-contact-seller:hover {
    background-color: #e6892a;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 991px) {
    .category-icon-large {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
}

@media (max-width: 768px) {
    .category-filters .col-md-3 {
        margin-bottom: 10px;
    }
    
    .category-icon-large {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}
</style>
@endsection