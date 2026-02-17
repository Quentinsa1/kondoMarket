<!-- ===== SECTION : CATÉGORIES VEDETTES ===== -->
<section class="featured-categories">
    <div class="container-xxl">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-star-fill"></i> Catégories vedettes
            </h2>
            <a href="{{ route('categories.index') }}" class="view-all-link">
                Voir toutes les catégories <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        
        <div class="categories-grid" id="featuredCategories">
            @forelse($featuredCategories ?? [] as $category)
                <a href="{{ route('categories.show', ['id' => $category['id'] ?? $loop->index]) }}" class="category-card">
                    <div class="category-image">
                        <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}">
                    </div>
                    <div class="category-info">
                        <div class="category-name">{{ $category['name'] }}</div>
                        <div class="category-count">{{ $category['count'] ?? '0 produits' }}</div>
                    </div>
                </a>
            @empty
                <!-- Fallback categories -->
                @for($i = 0; $i < 5; $i++)
                    <div class="category-card">
                        <div class="category-image">
                            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Catégorie">
                        </div>
                        <div class="category-info">
                            <div class="category-name">Catégorie {{ $i+1 }}</div>
                            <div class="category-count">0 produits</div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>