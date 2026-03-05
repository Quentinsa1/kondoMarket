<!-- ===== SECTION : NOUVEAUTÉS ===== -->
<section class="new-arrivals">
    <div class="container-xxl">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-box-seam"></i> Nouveautés & arrivages
            </h2>
            <a href="{{ route('products.new-arrivals') }}" class="view-all-link">
                Voir les nouveautés <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="products-grid" id="newArrivals">
            @forelse($newArrivals ?? [] as $product)
                @include('components.products.card', ['product' => $product])
            @empty
                <!-- Fallback new arrivals -->
                @for($i = 0; $i < 5; $i++)
                    <div class="product-card">
                        <div class="product-badge">Nouveau</div>
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Nouveau produit">
                        </div>
                        <div class="product-info">
                            <div class="product-name">Nouveau produit {{ $i+1 }}</div>
                            <div class="product-price">{{ rand(50, 500) }},99FCFA</div>
                            <div class="product-moq">MOQ: {{ rand(10, 100) }} pièces</div>
                            <div class="product-vendor">
                                Nouveau vendeur
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
                                <div class="rating-count">({{ rand(100, 1000) }})</div>
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