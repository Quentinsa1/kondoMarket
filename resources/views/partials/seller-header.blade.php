<!-- ===== TOP BAR UTILITAIRE ===== -->
<div class="top-bar">
    <div class="container-xxl">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-translate"></i> FR <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">EN - English</a></li>
                        <li><a class="dropdown-item" href="#">ES - Español</a></li>
                        <li><a class="dropdown-item" href="#">DE - Deutsch</a></li>
                        <li><a class="dropdown-item" href="#">ZH - 中文</a></li>
                    </ul>
                </div>
                <a href="{{ route('help') }}" class="top-bar-link ms-3"><i class="bi bi-question-circle"></i> Aide & Support Vendeur</a>
            </div>
            <div class="d-flex align-items-center">
                <div class="top-bar-link">
                    <i class="bi bi-person-check"></i> Espace Vendeur
                </div>
                <a href="{{ route('seller.dashboard') }}" class="top-bar-link ms-3">
                    <i class="bi bi-speedometer2"></i> Tableau de bord
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ===== HEADER PRINCIPAL ===== -->
<header class="main-header">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">
                        <i class="bi bi-shop"></i>
                    </div>
                    Kondo<span>Market</span>
                </a>
                <div class="seller-badge mt-2">
                    <span class="badge bg-accent-color text-white">
                        <i class="bi bi-shield-check"></i> Mode Vendeur
                    </span>
                </div>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-12 mt-sm-3 mt-md-0">
                <div class="search-container">
                    <form class="search-form" id="searchForm">
                        <div class="category-select-wrapper">
                            <select class="category-select" id="categorySelect">
                                <option value="all">Rechercher produits</option>
                                <option value="my-products">Mes produits</option>
                                <option value="competitors">Concurrents</option>
                                <option value="trends">Tendances marché</option>
                            </select>
                            <i class="bi bi-chevron-down category-select-icon"></i>
                        </div>
                        <div class="search-input-wrapper">
                            <input type="text" class="search-input" placeholder="Rechercher dans votre catalogue..." id="searchInput">
                            <div class="search-suggestions">
                                <div class="suggestion-item">Mes produits publiés</div>
                                <div class="suggestion-item">Produits en attente</div>
                                <div class="suggestion-item">Analyses de marché</div>
                            </div>
                        </div>
                        <button type="submit" class="search-btn">
                            <i class="bi bi-search"></i> Rechercher
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12 mt-sm-3 mt-md-0">
                <div class="header-actions">
                    <a href="{{ route('seller.dashboard') }}" class="action-item">
                        <i class="bi bi-speedometer2 action-icon"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="action-item">
                        <i class="bi bi-bell action-icon"></i>
                        <span>Notifications</span>
                        <span class="action-badge">3</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- ===== NAVIGATION VENDEUR ===== -->
<nav class="main-nav seller-nav">
    <div class="container-xxl">
        <div class="nav-container">
            <button class="all-categories-btn" id="sellerDashboardBtn">
                <i class="bi bi-speedometer2"></i> Tableau de bord
            </button>
            <ul class="nav-menu">
                <li class="{{ request()->routeIs('seller.create-store') ? 'highlight' : '' }}">
                    <a href="{{ route('seller.create-store') }}"><i class="bi bi-plus-circle"></i> Créer boutique</a>
                </li>
                <li><a href="#"><i class="bi bi-box"></i> Produits</a></li>
                <li><a href="#"><i class="bi bi-cart-check"></i> Commandes</a></li>
                <li><a href="#"><i class="bi bi-bar-chart"></i> Analytics</a></li>
                <li><a href="#"><i class="bi bi-credit-card"></i> Paiements</a></li>
                <li><a href="#"><i class="bi bi-chat-dots"></i> Messages</a></li>
                <li><a href="#"><i class="bi bi-gear"></i> Paramètres</a></li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .seller-nav {
        background-color: #1F2933; /* Couleur différente pour distinguer */
    }
    
    .seller-nav .all-categories-btn {
        background-color: var(--accent-color);
    }
    
    .seller-nav .nav-menu > li.highlight {
        background-color: rgba(245, 158, 66, 0.2);
    }
    
    .seller-badge .badge {
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .seller-nav .nav-menu {
            overflow-x: auto;
            flex-wrap: nowrap;
        }
        
        .seller-nav .nav-menu > li {
            flex-shrink: 0;
        }
    }
</style>