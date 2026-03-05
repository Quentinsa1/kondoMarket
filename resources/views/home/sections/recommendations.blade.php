<!-- ===== SECTION : RECOMMANDATIONS ===== -->
<section class="recommendations">
    <div class="container-xxl">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-hand-thumbs-up"></i> Recommandations pour vous
            </h2>
        </div>
        
        <div class="products-grid" id="recommendations">
            @forelse($recommendations ?? [] as $product)
                @include('components.products.card', ['product' => $product])
            @empty
                <!-- Fallback recommendations -->
                @for($i = 0; $i < 5; $i++)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Recommandation">
                        </div>
                        <div class="product-info">
                            <div class="product-name">Recommandation {{ $i+1 }}</div>
                            <div class="product-price">{{ rand(20, 200) }},99FCFA</div>
                            <div class="product-moq">MOQ: {{ rand(20, 200) }} pièces</div>
                            <div class="product-vendor">
                                Vendeur recommandé
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
                                <div class="rating-count">({{ rand(500, 2000) }})</div>
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