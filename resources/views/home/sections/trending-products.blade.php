<!-- ===== SECTION : PRODUITS TENDANCE ===== -->
<section class="trending-products">
    <div class="container-xxl">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-fire"></i> Produits tendance
            </h2>
            <a href="{{ route('products.trending') }}" class="view-all-link">
                Voir tous les produits <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="products-grid" id="trendingProducts">
            @forelse($trendingProducts ?? [] as $product)
                @include('components.products.card', ['product' => $product])
            @empty
                <!-- Fallback products -->
                @for($i = 0; $i < 5; $i++)
                    <div class="product-card">
                        <div class="product-badge">Nouveau</div>
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Produit">
                        </div>
                        <div class="product-info">
                            <div class="product-name">Produit tendance {{ $i+1 }}</div>
                            <div class="product-price">99,99FCFA</div>
                            <div class="product-moq">MOQ: 50 pièces</div>
                            <div class="product-vendor">
                                Vendeur vérifié
                                <i class="bi bi-patch-check-fill vendor-verified"></i>
                            </div>
                            <div class="product-rating">
                                <div class="rating-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <div class="rating-count">(1.2k)</div>
                            </div>
                            <div class="product-actions">
                                <button class="btn-quick-view"><i class="bi bi-eye"></i> Voir</button>
                                <button class="btn-contact-seller"><i class="bi bi-chat-dots"></i> Contacter</button>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>