<!-- ===== HERO TRANSACTIONNEL REDESIGN ===== -->
<section class="hero-transactional">
    <div class="container-xxl">
        <div class="row g-3">
            <div class="col-lg-3 d-none d-lg-block">
                <div class="category-sidebar">
                    <div class="category-sidebar-header">
                        <i class="bi bi-grid-3x3-gap"></i> Catégories principales
                    </div>
                    <div class="category-sidebar-list" id="sidebarCategories">
                        <!-- Catégories chargées par JavaScript -->
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-8">
                <div class="hero-carousel">
                    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" class="d-block w-100" alt="Promotions en gros">
                                <div class="carousel-caption">
                                    <h3>Commandes en gros - Économisez jusqu'à 60%</h3>
                                    <p>Accédez aux prix des fabricants pour vos commandes en volume</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" class="d-block w-100" alt="Nouveaux vendeurs">
                                <div class="carousel-caption">
                                    <h3>Nouveaux vendeurs certifiés</h3>
                                    <p>Découvrez les nouveaux fournisseurs vérifiés avec produits de qualité</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" class="d-block w-100" alt="Sécurité des paiements">
                                <div class="carousel-caption">
                                    <h3>Paiements sécurisés</h3>
                                    <p>Transaction protégée et garantie de remboursement sous 30 jours</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                        
                        <!-- Statistiques overlay -->
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number">50K+</div>
                                <div class="stat-label">Produits</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">2K+</div>
                                <div class="stat-label">Fournisseurs</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">120+</div>
                                <div class="stat-label">Pays</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">99%</div>
                                <div class="stat-label">Satisfaits</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4">
                <div class="hero-sidebar">
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            <i class="bi bi-lightning-charge"></i> Achat rapide
                        </div>
   <div class="sidebar-card-body">
    <p>Signalez un vendeur, un produit ou tout comportement abusif sur aslazmarket.</p>
    
    @auth
        <!-- Utilisateur connecté -->
      <div class="d-flex flex-column gap-2">
    <button class="btn-auth"
        onclick="window.location.href='{{ route('report.abuse') }}'">
        <i class="bi bi-flag"></i> Signaler un abus
    </button>

    <button class="btn-account"
        onclick="alert('click ok')"
>
        <i class="bi bi-person-circle"></i> Mon compte
    </button>
</div>
    @else
        <!-- Utilisateur non connecté -->
        <button class="btn-auth" onclick="window.location.href='{{ route('report.abuse') }}'">
            <i class="bi bi-flag"></i> Signaler un abus
        </button>
        <p class="mt-2 mb-0 text-center small">
            <a href="{{ route('seller.login') }}" class="text-decoration-none">
                <i class="bi bi-box-arrow-in-right"></i> Se connecter
            </a>
        </p>
    @endauth
</div>
                    </div>
                    
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            <i class="bi bi-rocket-takeoff"></i> Devenir vendeur
                        </div>
                        <div class="sidebar-card-body">
                            <p>Vendez vos produits à des millions d'acheteurs internationaux. Configuration rapide et outils de gestion complets.</p>
                            <button class="btn-vendor" onclick="window.location.href='{{ route('vendor.register.form') }}?type=vendor'">
                                <i class="bi bi-shop-window"></i> Ouvrir une boutique
                            </button>
                        </div>
                    </div>
                    
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            <i class="bi bi-shield-check"></i> Sécurité garantie
                        </div>
                        <div class="sidebar-card-body">
                            <p>Toutes les transactions sont protégées par notre système de garantie. Paiement sécurisé par cryptage SSL 256 bits.</p>
                            <button class="btn-auth" onclick="window.location.href='{{ route('help') }}'">
                                <i class="bi bi-info-circle"></i> En savoir plus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>