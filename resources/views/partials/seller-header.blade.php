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