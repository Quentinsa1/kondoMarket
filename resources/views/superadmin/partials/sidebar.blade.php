<div class="sidebar shadow">
    <div class="sidebar-heading text-center">
        KondoMarket<br><small>Super Admin</small>
    </div>
    <nav class="nav flex-column mt-3">
        <a class="nav-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}" href="{{ route('superadmin.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('superadmin.admins.*') ? 'active' : '' }}" href="{{ route('superadmin.admins.index') }}">
            <i class="bi bi-people"></i> Utilisateurs
        </a>
        <a class="nav-link {{ request()->routeIs('superadmin.vendors.*') ? 'active' : '' }}" href="{{ route('superadmin.vendors.index') }}">
            <i class="bi bi-shop"></i> Vendeurs
        </a>
        <a class="nav-link {{ request()->routeIs('superadmin.products.*') ? 'active' : '' }}" href="{{ route('superadmin.products.index') }}">
            <i class="bi bi-box"></i> Produits
        </a>
       
        <a class="nav-link" href="#">
            <i class="bi bi-credit-card"></i> Paiements
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-graph-up"></i> Rapports & Analytics
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-star"></i> Avis & Signalements
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-bell"></i> Notifications
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-gear"></i> Paramètres
        </a>
    </nav>
</div>