<!-- ===== SECTION : OFFRES DU JOUR ===== -->
<section class="daily-deals">
    <div class="container-xxl">
        <div class="deals-header">
            <div class="deals-badge">
                <i class="bi bi-clock"></i> OFFRES DU JOUR
            </div>
            <div class="countdown">
                <span>Fin dans :</span>
                <div class="countdown-box" id="countdown-hours">12</div>h
                <div class="countdown-box" id="countdown-minutes">45</div>m
                <div class="countdown-box" id="countdown-seconds">33</div>s
            </div>
        </div>
        
        <div class="products-grid" id="dailyDeals">
            @forelse($dailyDeals ?? [] as $product)
                @include('components.products.card', ['product' => $product])
            @empty
                <!-- Fallback daily deals -->
                @for($i = 0; $i < 5; $i++)
                    <div class="product-card">
                        <div class="product-badge">-30%</div>
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Offre du jour">
                        </div>
                        <div class="product-info">
                            <div class="product-name">Offre spéciale {{ $i+1 }}</div>
                            <div class="product-price">79,99€ <span class="product-original-price">114,99€</span></div>
                            <div class="product-moq">MOQ: 25 pièces</div>
                            <div class="product-vendor">
                                Vendeur certifié
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
                                <div class="rating-count">(2.3k)</div>
                            </div>
                            <div class="product-actions">
                                <button class="btn-quick-view"><i class="bi bi-eye"></i> Voir</button>
                                <button class="btn-contact-seller"><i class="bi bi-chat-dots"></i> Acheter</button>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>