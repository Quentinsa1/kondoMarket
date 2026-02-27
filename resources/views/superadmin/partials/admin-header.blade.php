<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-3" style="height: 60px;">
    <div class="container-fluid">
        <button class="btn btn-outline-secondary" id="sidebarToggle" type="button">
            <i class="bi bi-list"></i>
        </button>

        <form class="d-flex mx-auto w-50" action="#" method="GET">
            <input class="form-control me-2" type="search" name="q" placeholder="Rechercher (utilisateurs, vendeurs, commandes...)">
            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
        </form>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-danger">3</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Nouveau vendeur en attente</a></li>
                <li><a class="dropdown-item" href="#">Produit signalé</a></li>
                <li><a class="dropdown-item" href="#">Paiement échoué</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Voir toutes les notifications</a></li>
            </ul>
        </div>

        <div class="dropdown ms-3">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                <img src="https://via.placeholder.com/32" alt="Avatar" class="rounded-circle" width="32" height="32">
                <span class="ms-2">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Mon profil</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Paramètres</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>