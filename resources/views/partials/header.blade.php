<!-- ===== HEADER PRINCIPAL REDESIGN ===== -->
<header class="main-header">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col-lg-2 col-md-3">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">
                        <i class="bi bi-shop"></i>
                    </div>
                    Kondo<span>Market</span>
                </a>
            </div>
            
            <div class="col-lg-7 col-md-6">
                <div class="search-container">
                    <form id="searchForm" class="search-form">
                        <div class="category-select-wrapper">
                            <select class="category-select" id="searchCategory">
                                <option value="">Toutes catégories</option>
                                <option value="electronics">Électronique</option>
                                <option value="fashion">Mode & Vêtements</option>
                                <option value="home">Maison & Jardin</option>
                                <option value="beauty">Beauté & Santé</option>
                                <option value="food">Alimentation</option>
                                <option value="tools">Outils & Matériel</option>
                            </select>
                            <i class="bi bi-chevron-down category-select-icon"></i>
                        </div>
                        <div class="search-input-wrapper">
                            <input type="text" class="search-input" id="searchInput" 
                                   placeholder="Rechercher des produits, fournisseurs, catégories...">
                            <div class="search-suggestions" id="searchSuggestions">
                                <!-- Suggestions dynamiques -->
                                <div class="suggestion-item" data-type="product">
                                    <i class="bi bi-box suggestion-icon"></i>
                                    <span class="suggestion-text">Smartphone iPhone 14 Pro Max</span>
                                    <span class="suggestion-category">Électronique</span>
                                </div>
                                <div class="suggestion-item" data-type="category">
                                    <i class="bi bi-tags suggestion-icon"></i>
                                    <span class="suggestion-text">Vêtements de sport</span>
                                    <span class="suggestion-category">Mode</span>
                                </div>
                                <div class="suggestion-item" data-type="vendor">
                                    <i class="bi bi-shop suggestion-icon"></i>
                                    <span class="suggestion-text">Fournisseur TechPro Inc.</span>
                                    <span class="suggestion-category">Entreprise</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="search-btn">
                            <i class="bi bi-search"></i> Rechercher
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</header>