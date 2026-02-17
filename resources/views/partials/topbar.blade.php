<!-- ===== TOP BAR UTILITAIRE ===== -->
<div class="top-bar">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe"></i> Français
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Français</a></li>
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Español</a></li>
                            <li><a class="dropdown-item" href="#">中文</a></li>
                        </ul>
                    </div>
                  
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex justify-content-md-end align-items-center gap-3">
                    <a href="#" class="top-bar-link"><i class="bi bi-headset"></i> Support</a>
                    <a href="{{ route('help') }}" class="top-bar-link"><i class="bi bi-question-circle"></i> Aide</a>
                    <a href="#" class="top-bar-link"><i class="bi bi-truck"></i> Suivi commande</a>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i> Mon compte
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-in-right"></i> Connexion</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-plus"></i> Inscription</a></li>
                            <li><hr class="dropdown-divider"></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>