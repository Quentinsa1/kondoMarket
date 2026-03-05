<!-- ===== SECTION : PRODUITS PAR CATÉGORIE ===== -->
<section class="products-by-category">
    <div class="container-xxl">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-grid-3x3-gap"></i> Produits par catégorie
            </h2>
        </div>
        
        <div class="category-blocks" id="categoryBlocks">
            @forelse($categoryBlocks ?? [] as $block)
                <div class="category-block">
                    <div class="category-block-header">
                        <div class="category-block-title">
                            <i class="bi {{ $block['icon'] ?? 'bi-grid' }}"></i> {{ $block['title'] }}
                        </div>
                        <div class="category-block-subcategories">
                            @foreach($block['subcategories'] ?? [] as $subcategory)
                                <a href="#" class="subcategory-link">{{ $subcategory }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="category-block-products">
                        @foreach($block['products'] ?? [] as $product)
                            @include('components.products.card', ['product' => $product])
                        @endforeach
                    </div>
                </div>
            @empty
                <!-- Fallback category blocks -->
                @for($j = 0; $j < 2; $j++)
                    <div class="category-block">
                        <div class="category-block-header">
                            <div class="category-block-title">
                                <i class="bi bi-cpu"></i> Catégorie {{ $j+1 }}
                            </div>
                            <div class="category-block-subcategories">
                                <a href="#" class="subcategory-link">Sous-catégorie 1</a>
                                <a href="#" class="subcategory-link">Sous-catégorie 2</a>
                                <a href="#" class="subcategory-link">Sous-catégorie 3</a>
                            </div>
                        </div>
                        <div class="category-block-products">
                            @for($i = 0; $i < 5; $i++)
                                <div class="product-card">
                                    <div class="product-badge">Promo</div>
                                    <div class="product-image">
                                        <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Produit">
                                    </div>
                                    <div class="product-info">
                                        <div class="product-name">Produit dans catégorie {{ $j+1 }}</div>
                                        <div class="product-price">149,99FCFA <span class="product-original-price">199,99FCFA</span></div>
                                        <div class="product-moq">MOQ: 100 pièces</div>
                                        <div class="product-vendor">
                                            Fournisseur vérifié
                                            <i class="bi bi-patch-check-fill vendor-verified"></i>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rating-stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star"></i>
                                            </div>
                                            <div class="rating-count">(856)</div>
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn-quick-view"><i class="bi bi-eye"></i> Voir</button>
                                            <button class="btn-contact-seller"><i class="bi bi-chat-dots"></i> Contacter</button>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>