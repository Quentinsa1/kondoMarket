<!-- ===== SECTION : MEILLEURS VENDEURS ===== -->
<section class="top-vendors">
    <div class="container-xxl">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-award"></i> Meilleurs vendeurs
            </h2>
            <a href="{{ route('vendor.register.form') }}" class="view-all-link">
                Voir tous les vendeurs <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="vendors-grid" id="topVendors">
            @forelse($topVendors ?? [] as $vendor)
                <div class="vendor-card">
                    <div class="vendor-logo">
                        <img src="{{ $vendor['image'] }}" alt="{{ $vendor['name'] }}">
                    </div>
                    <div class="vendor-info">
                        <div class="vendor-name">{{ $vendor['name'] }}</div>
                        <div class="vendor-location">
                            <i class="bi bi-geo-alt"></i> {{ $vendor['location'] }}
                        </div>
                        <div class="vendor-products">{{ $vendor['products'] }}</div>
                        <div class="vendor-rating">
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($vendor['rating']))
                                        <i class="bi bi-star-fill"></i>
                                    @elseif($i == ceil($vendor['rating']) && $vendor['rating'] % 1 >= 0.5)
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="rating-count">{{ number_format($vendor['rating'], 1) }}/5</div>
                        </div>
                        <button class="btn-visit-store" onclick="window.location.href=''">
                            <i class="bi bi-shop"></i> Voir boutique
                        </button>
                    </div>
                </div>
            @empty
                <!-- Fallback vendors -->
                @for($i = 0; $i < 5; $i++)
                    <div class="vendor-card">
                        <div class="vendor-logo">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div class="vendor-info">
                            <div class="vendor-name">Vendeur {{ $i+1 }}</div>
                            <div class="vendor-location">
                                <i class="bi bi-geo-alt"></i> France
                            </div>
                            <div class="vendor-products">1,234 produits</div>
                            <div class="vendor-rating">
                                <div class="rating-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <div class="rating-count">4.5/5</div>
                            </div>
                            <button class="btn-visit-store">
                                <i class="bi bi-shop"></i> Voir boutique
                            </button>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>