@php
    // Déterminer les valeurs par défaut
    $product = $product ?? [];
    $id = $product['id'] ?? $loop->index ?? 0;
    $name = $product['name'] ?? 'Produit sans nom';
    $price = $product['price'] ?? '0,00€';
    $originalPrice = $product['originalPrice'] ?? null;
    $vendor = $product['vendor'] ?? 'Vendeur';
    $rating = $product['rating'] ?? 4.0;
    $moq = $product['moq'] ?? '10 pièces';
    $badge = $product['badge'] ?? null;
    $image = $product['image'] ?? 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
    $reviewCount = $product['review_count'] ?? rand(100, 2000);
    
    // Générer les étoiles
    $fullStars = floor($rating);
    $hasHalfStar = $rating % 1 >= 0.5;
    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
@endphp

<div class="product-card" data-product-id="{{ $id }}">
    @if($badge)
        <div class="product-badge">{{ $badge }}</div>
    @endif
    
    <div class="product-image">
        <img src="{{ $image }}" alt="{{ $name }}" loading="lazy">
    </div>
    
    <div class="product-info">
        <div class="product-name" title="{{ $name }}">{{ Str::limit($name, 50) }}</div>
        
        <div class="product-price">
            {{ $price }}
            @if($originalPrice)
                <span class="product-original-price">{{ $originalPrice }}</span>
            @endif
        </div>
        
        <div class="product-moq">MOQ: {{ $moq }}</div>
        
        <div class="product-vendor">
            {{ $vendor }}
            <i class="bi bi-patch-check-fill vendor-verified" title="Vendeur vérifié"></i>
        </div>
        
        <div class="product-rating">
            <div class="rating-stars">
                @for($i = 0; $i < $fullStars; $i++)
                    <i class="bi bi-star-fill"></i>
                @endfor
                
                @if($hasHalfStar)
                    <i class="bi bi-star-half"></i>
                @endif
                
                @for($i = 0; $i < $emptyStars; $i++)
                    <i class="bi bi-star"></i>
                @endfor
            </div>
            <div class="rating-count">({{ $reviewCount }})</div>
        </div>
        
        <div class="product-actions">
            <button class="btn-quick-view" data-product-id="{{ $id }}">
                <i class="bi bi-eye"></i> Voir
            </button>
            <button class="btn-contact-seller" data-product-id="{{ $id }}">
                <i class="bi bi-chat-dots"></i> Contacter
            </button>
        </div>
    </div>
</div>