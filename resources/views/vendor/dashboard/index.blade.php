@extends('template.template')

@section('title', 'Tableau de bord Vendeur - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : TABLEAU DE BORD VENDEUR ===== -->
<section class="seller-dashboard py-4">
    <div class="container-xxl">
        <!-- En-tête du dashboard -->
        <div class="dashboard-header mb-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="h2 mb-1">Tableau de bord</h1>
                    <p class="text-muted mb-0">Bienvenue, {{ $vendor->display_name ?? $vendor->company_name ?? 'Vendeur' }}</p>
                </div>
                <div class="dashboard-actions">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('seller.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Ajouter un produit
                        </a>
                        <!-- Bouton Recharger mon compte -->
                        <a href="{{ route('wallet.recharge.form') }}" class="btn btn-warning">
    <i class="bi bi-wallet2 me-1"></i> Recharger mon compte
</a>
                        <a href="#contact-admin" class="btn btn-outline-secondary">
                            <i class="bi bi-headset me-1"></i> Contacter l'admin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques principales -->
        <div class="row g-4 mb-5">
            <!-- Nombre de produits -->
            <div class="col-md-3 col-sm-6">
                <div class="stats-card bg-primary bg-gradient text-white">
                    <div class="stats-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="mb-1">24</h3>
                        <p class="mb-0 fw-light">Produits actifs</p>
                    </div>
                    <div class="stats-trend">
                        <span class="badge bg-white text-primary">+3 cette semaine</span>
                    </div>
                </div>
            </div>
            
            <!-- Mon stock total -->
            <div class="col-md-3 col-sm-6">
                <div class="stats-card bg-success bg-gradient text-white">
                    <div class="stats-icon">
                        <i class="bi bi-archive"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="mb-1">1,247</h3>
                        <p class="mb-0 fw-light">Articles en stock</p>
                    </div>
                    <div class="stats-trend">
                        <span class="badge bg-white text-success">Stock suffisant</span>
                    </div>
                </div>
            </div>
            
            <!-- Nombre de clics -->
            <div class="col-md-3 col-sm-6">
                <div class="stats-card bg-info bg-gradient text-white">
                    <div class="stats-icon">
                        <i class="bi bi-mouse"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="mb-1">3,456</h3>
                        <p class="mb-0 fw-light">Clics sur produits</p>
                    </div>
                    <div class="stats-trend">
                        <span class="badge bg-white text-info">+12%</span>
                    </div>
                </div>
            </div>
            
            <!-- Mon solde -->
            <div class="col-md-3 col-sm-6">
                <div class="stats-card bg-warning bg-gradient text-white">
                    <div class="stats-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="mb-1">15250 FCFA</h3>
                        <p class="mb-0 fw-light">Solde disponible</p>
                    </div>
                    <div class="stats-trend">
                        <button class="badge bg-white text-warning text-decoration-none border-0" data-bs-toggle="modal" data-bs-target="#rechargeModal">
                            <i class="bi bi-plus-circle me-1"></i>Recharger
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="row g-4">
            <!-- Section de gauche -->
            <div class="col-lg-8">
                <!-- Tableau du stock -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-boxes me-2 text-primary"></i> Mon stock détaillé
                            </h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                        data-bs-toggle="dropdown">
                                    <i class="bi bi-filter me-1"></i> Filtres
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Tous les produits</a></li>
                                    <li><a class="dropdown-item" href="#">Stock faible (< 10)</a></li>
                                    <li><a class="dropdown-item" href="#">En rupture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Produit</th>
                                        <th>Référence</th>
                                        <th>Stock actuel</th>
                                        <th>Statut</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $stocks = [45, 8, 120, 0, 23];
                                            $status = [
                                                ['text' => 'En stock', 'class' => 'success'],
                                                ['text' => 'Stock faible', 'class' => 'warning'],
                                                ['text' => 'Bon stock', 'class' => 'success'],
                                                ['text' => 'Rupture', 'class' => 'danger'],
                                                ['text' => 'En stock', 'class' => 'success']
                                            ];
                                        @endphp
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="product-thumb me-3">
                                                        <div class="bg-light rounded" style="width: 40px; height: 40px;"></div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Produit {{ $i }}</h6>
                                                        <small class="text-muted">Catégorie {{ $i }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>REF-00{{ $i }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="fw-semibold">{{ $stocks[$i-1] }}</span>
                                                    <div class="progress ms-2" style="width: 60px; height: 6px;">
                                                        <div class="progress-bar bg-{{ $status[$i-1]['class'] }}" 
                                                             style="width: {{ min(100, ($stocks[$i-1]/150)*100) }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $status[$i-1]['class'] }}-subtle text-{{ $status[$i-1]['class'] }}">
                                                    {{ $status[$i-1]['text'] }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary ms-1">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted">5 produits sur 24 affichés</span>
                            </div>
                            <a href="#voir-tout" class="btn btn-sm btn-outline-primary">
                                Voir tout le stock <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ajouter un produit (Section statique) -->
                <div class="card mb-4 border-0 shadow-sm" id="ajouter-produit">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-plus-circle me-2 text-success"></i> Ajouter un nouveau produit
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info border-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Remplissez ce formulaire pour ajouter un nouveau produit à votre boutique.
                        </div>
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom du produit</label>
                                <input type="text" class="form-control" placeholder="Ex: Smartphone XYZ">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Catégorie</label>
                                <select class="form-select">
                                    <option selected>Sélectionner une catégorie</option>
                                    <option value="1">Électronique</option>
                                    <option value="2">Mode</option>
                                    <option value="3">Maison</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Prix ()</label>
                                <input type="number" class="form-control" placeholder="99.99">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantité en stock</label>
                                <input type="number" class="form-control" placeholder="100">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Statut</label>
                                <select class="form-select">
                                    <option value="active" selected>Actif</option>
                                    <option value="inactive">Inactif</option>
                                    <option value="draft">Brouillon</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" placeholder="Description détaillée du produit..."></textarea>
                            </div>
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-1"></i> Enregistrer le produit
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle me-1"></i> Annuler
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Section de droite -->
            <div class="col-lg-4">
                <!-- Mon profil -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-person-circle me-2 text-primary"></i> Mon profil
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            @if($vendor->avatar_path)
                                <img src="{{ Storage::url($vendor->avatar_path) }}" 
                                     alt="Avatar" 
                                     class="rounded-circle mb-3 border" 
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="avatar-placeholder mb-3">
                                    <i class="bi bi-person-circle text-primary" style="font-size: 80px;"></i>
                                </div>
                            @endif
                            <h5 class="mb-1">{{ $vendor->display_name ?? $vendor->company_name ?? 'Vendeur' }}</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt me-1"></i> {{ $vendor->city }}, {{ $vendor->country }}
                            </p>
                            <div class="vendor-status-badge mb-3">
                                @if($vendor->status === 'approved')
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> Vérifié
                                    </span>
                                @elseif($vendor->status === 'pending')
                                    <span class="badge bg-warning rounded-pill">
                                        <i class="bi bi-clock me-1"></i> En attente
                                    </span>
                                @else
                                    <span class="badge bg-secondary rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i> Non vérifié
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="vendor-info">
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Email :</span>
                                <span class="fw-semibold">{{ $vendor->email ?? 'non défini' }}</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Téléphone :</span>
                                <span class="fw-semibold">{{ $vendor->phone ?? 'non défini' }}</span>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span class="text-muted">Inscrit depuis :</span>
                                <span class="fw-semibold">15/01/2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contacter l'admin -->
                <div class="card mb-4 border-0 shadow-sm" id="contact-admin">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-headset me-2 text-info"></i> Support & Contact
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light border">
                            <i class="bi bi-info-circle text-info me-2"></i>
                            <small>Contactez notre équipe d'administration pour toute question.</small>
                        </div>
                        <div class="support-options">
                            <div class="support-item d-flex align-items-center p-3 mb-2 bg-light rounded">
                                <div class="support-icon me-3">
                                    <i class="bi bi-envelope fs-4 text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email support</h6>
                                    <p class="mb-0 text-muted small">admin@kondomarket.com</p>
                                </div>
                            </div>
                            <div class="support-item d-flex align-items-center p-3 mb-2 bg-light rounded">
                                <div class="support-icon me-3">
                                    <i class="bi bi-telephone fs-4 text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Téléphone</h6>
                                    <p class="mb-0 text-muted small">+33 1 23 45 67 89</p>
                                </div>
                            </div>
                            <div class="support-item d-flex align-items-center p-3 bg-light rounded">
                                <div class="support-icon me-3">
                                    <i class="bi bi-clock fs-4 text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Horaires</h6>
                                    <p class="mb-0 text-muted small">Lun-Ven : 9h-18h</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-info">
                                <i class="bi bi-chat-left-text me-1"></i> Nouveau message
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recharger mon compte (Section simplifiée) -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-credit-card me-2 text-warning"></i> Recharger mon compte
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-4">
                            Rechargez votre solde pour faciliter vos transactions et paiements.
                        </p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#rechargeModal">
                                <i class="bi bi-lightning-charge me-1"></i> Recharger maintenant
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-clock-history me-1"></i> Historique des recharges
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de recharge -->
<div class="modal fade" id="rechargeModal" tabindex="-1" aria-labelledby="rechargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rechargeModalLabel">
                    <i class="bi bi-credit-card me-2"></i>Recharger mon compte
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <!-- Onglets de paiement -->
                <ul class="nav nav-tabs nav-fill" id="paymentTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="momo-tab" data-bs-toggle="tab" data-bs-target="#momo-tab-pane" type="button" role="tab">
                            <i class="bi bi-phone me-2"></i>Mobile Money (Momo)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="visa-tab" data-bs-toggle="tab" data-bs-target="#visa-tab-pane" type="button" role="tab">
                            <i class="bi bi-credit-card me-2"></i>Carte Visa
                        </button>
                    </li>
                </ul>

                <!-- Contenu des onglets -->
                <div class="tab-content p-4" id="paymentTabsContent">
                    <!-- Formulaire Mobile Money -->
                    <div class="tab-pane fade show active" id="momo-tab-pane" role="tabpanel" tabindex="0">
                        <div class="payment-method-icon text-center mb-4">
                            <div class="momo-icon d-inline-flex align-items-center justify-content-center rounded-circle bg-purple" style="width: 80px; height: 80px;">
                                <i class="bi bi-phone fs-1 text-white"></i>
                            </div>
                            <h5 class="mt-3">Paiement par Mobile Money</h5>
                            <p class="text-muted">Entrez vos informations pour recharger via Momo</p>
                        </div>

                        <!-- Formulaire Momo -->
                        <form id="momoForm" class="needs-validation" novalidate>
                            <!-- Montant de recharge -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Montant de recharge (FCFA)</label>
                                <div class="recharge-amounts mb-3">
                                    <div class="row g-2">
                                        @php $amounts = [5000, 10000, 20000, 50000, 100000, 200000]; @endphp
                                        @foreach($amounts as $amount)
                                            <div class="col-4">
                                                <div class="amount-option border rounded p-3 text-center cursor-pointer hover-shadow" data-amount="{{ $amount }}">
                                                    <div class="fs-6 fw-bold text-primary">{{ number_format($amount) }} FCFA</div>
                                                    <small class="text-muted">+{{ number_format($amount) }} FCFA</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="custom-amount">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="momoAmount" placeholder="Montant personnalisé" min="1000" step="1000" required>
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                    <div class="invalid-feedback">Montant minimum : 1 000 FCFA</div>
                                    <div class="form-text">Montant minimum : 1 000 FCFA</div>
                                </div>
                            </div>

                            <!-- Informations téléphone -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="momoPhone" class="form-label fw-semibold">Numéro de téléphone</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+225</span>
                                        <input type="tel" class="form-control" id="momoPhone" placeholder="07 00 00 00 00" pattern="[0-9]{8,10}" required>
                                        <div class="invalid-feedback">Veuillez entrer un numéro valide (8-10 chiffres)</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="momoOperator" class="form-label fw-semibold">Opérateur</label>
                                    <select class="form-select" id="momoOperator" required>
                                        <option value="" selected disabled>Sélectionnez votre opérateur</option>
                                        <option value="orange">Orange Money</option>
                                        <option value="mtn">MTN Mobile Money</option>
                                        <option value="moov">Moov Money</option>
                                    </select>
                                    <div class="invalid-feedback">Veuillez sélectionner un opérateur</div>
                                </div>
                            </div>

                            <!-- Code PIN -->
                            <div class="mb-4">
                                <label for="momoPin" class="form-label fw-semibold">Code PIN (4 chiffres)</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="momoPin" placeholder="••••" pattern="[0-9]{4}" maxlength="4" required>
                                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y" id="toggleMomoPin">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">Veuillez entrer votre code PIN (4 chiffres)</div>
                                </div>
                                <div class="form-text">Le code PIN de votre compte Mobile Money</div>
                            </div>

                            <!-- Récapitulatif -->
                            <div class="alert alert-light border rounded-3 mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Montant à recharger :</span>
                                    <span class="fw-bold" id="momoSummaryAmount">0 FCFA</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Frais de service :</span>
                                    <span class="fw-bold">Gratuit</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-semibold">Total à débiter :</span>
                                    <span class="fw-bold text-primary" id="momoTotalAmount">0 FCFA</span>
                                </div>
                            </div>

                            <!-- Conditions -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="momoTerms" required>
                                <label class="form-check-label small" for="momoTerms">
                                    J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation</a> et confirme que je suis le propriétaire du compte Mobile Money
                                </label>
                                <div class="invalid-feedback">Vous devez accepter les conditions</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-purple btn-lg">
                                    <i class="bi bi-send-check me-2"></i>Confirmer la recharge via Momo
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Formulaire Visa -->
                    <div class="tab-pane fade" id="visa-tab-pane" role="tabpanel" tabindex="0">
                        <div class="payment-method-icon text-center mb-4">
                            <div class="visa-icon d-inline-flex align-items-center justify-content-center rounded-circle bg-primary" style="width: 80px; height: 80px;">
                                <i class="bi bi-credit-card fs-1 text-white"></i>
                            </div>
                            <h5 class="mt-3">Paiement par Carte Visa</h5>
                            <p class="text-muted">Entrez les informations de votre carte bancaire</p>
                        </div>

                        <!-- Formulaire Visa -->
                        <form id="visaForm" class="needs-validation" novalidate>
                            <!-- Montant de recharge -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Montant de recharge (FCFA)</label>
                                <div class="recharge-amounts mb-3">
                                    <div class="row g-2">
                                        @foreach($amounts as $amount)
                                            <div class="col-4">
                                                <div class="amount-option border rounded p-3 text-center cursor-pointer hover-shadow" data-amount="{{ $amount }}">
                                                    <div class="fs-6 fw-bold text-primary">{{ number_format($amount) }} FCFA</div>
                                                    <small class="text-muted">+{{ number_format($amount) }} FCFA</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="custom-amount">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="visaAmount" placeholder="Montant personnalisé" min="1000" step="1000" required>
                                        <span class="input-group-text">FCFA</span>
                                    </div>
                                    <div class="invalid-feedback">Montant minimum : 1 000 FCFA</div>
                                    <div class="form-text">Montant minimum : 1 000 FCFA</div>
                                </div>
                            </div>

                            <!-- Informations carte -->
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label fw-semibold">Numéro de carte</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" pattern="[0-9]{16}" required>
                                    <span class="input-group-text">
                                        <i class="bi bi-credit-card-2-front"></i>
                                    </span>
                                    <div class="invalid-feedback">Veuillez entrer un numéro de carte valide (16 chiffres)</div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="expiryDate" class="form-label fw-semibold">Date d'expiration</label>
                                    <div class="input-group">
                                        <input type="month" class="form-control" id="expiryDate" required>
                                    </div>
                                    <div class="invalid-feedback">Veuillez sélectionner une date d'expiration</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv" class="form-label fw-semibold">CVV</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="cvv" placeholder="123" pattern="[0-9]{3}" maxlength="3" required>
                                        <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y" id="toggleCvv">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <div class="invalid-feedback">Veuillez entrer le code CVV (3 chiffres)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations titulaire -->
                            <div class="mb-4">
                                <label for="cardHolder" class="form-label fw-semibold">Nom du titulaire</label>
                                <input type="text" class="form-control" id="cardHolder" placeholder="Nom tel qu'il apparaît sur la carte" required>
                                <div class="invalid-feedback">Veuillez entrer le nom du titulaire</div>
                            </div>

                            <!-- Récapitulatif -->
                            <div class="alert alert-light border rounded-3 mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Montant à recharger :</span>
                                    <span class="fw-bold" id="visaSummaryAmount">0 FCFA</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Frais de transaction :</span>
                                    <span class="fw-bold">150 FCFA</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-semibold">Total à débiter :</span>
                                    <span class="fw-bold text-primary" id="visaTotalAmount">0 FCFA</span>
                                </div>
                            </div>

                            <!-- Sécurité et conditions -->
                            <div class="alert alert-info border-0 small d-flex align-items-center mb-4">
                                <i class="bi bi-shield-check fs-5 me-3"></i>
                                <div>
                                    <strong>Paiement sécurisé</strong>
                                    <p class="mb-0">Vos informations bancaires sont cryptées et sécurisées.</p>
                                </div>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="visaTerms" required>
                                <label class="form-check-label small" for="visaTerms">
                                    J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation</a> et autorise le débit de ma carte
                                </label>
                                <div class="invalid-feedback">Vous devez accepter les conditions</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-lock-fill me-2"></i>Payer avec ma carte Visa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="savePaymentMethod">
                    <label class="form-check-label small" for="savePaymentMethod">
                        Enregistrer cette méthode pour plus tard
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .seller-dashboard {
        min-height: calc(100vh - 200px);
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .dashboard-header {
        background: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
    }
    
    .stats-card {
        padding: 24px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: rgba(255,255,255,0.5);
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    
    .stats-icon {
        width: 64px;
        height: 64px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-right: 20px;
        flex-shrink: 0;
    }
    
    .stats-info h3 {
        font-size: 2rem;
        margin-bottom: 4px;
        font-weight: 800;
    }
    
    .stats-info p {
        opacity: 0.9;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }
    
    .stats-trend {
        position: absolute;
        top: 16px;
        right: 16px;
    }
    
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        background-color: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #0d6efd;
        border: 3px solid #e9ecef;
    }
    
    .vendor-info {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 16px;
    }
    
    .support-item {
        transition: all 0.3s ease;
    }
    
    .support-item:hover {
        background: #e9ecef !important;
        transform: translateX(5px);
    }
    
    .amount-option {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent !important;
    }
    
    .amount-option:hover {
        border-color: #0d6efd !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
    }
    
    .amount-option.selected {
        border-color: #0d6efd !important;
        background-color: #f0f7ff;
    }
    
    .hover-shadow {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .cursor-pointer {
        cursor: pointer;
    }
    
    .card {
        border-radius: 16px;
        border: 1px solid #e9ecef;
    }
    
    /* Styles pour la modal */
    #rechargeModal .modal-content {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    
    #rechargeModal .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom: none;
        padding: 1.5rem 2rem;
    }
    
    #rechargeModal .modal-title {
        font-weight: 600;
    }
    
    #rechargeModal .nav-tabs {
        border-bottom: 1px solid #e9ecef;
        background-color: #f8f9fa;
        padding: 0 2rem;
    }
    
    #rechargeModal .nav-link {
        padding: 1rem 1.5rem;
        color: #6c757d;
        font-weight: 500;
        border: none;
        border-bottom: 3px solid transparent;
    }
    
    #rechargeModal .nav-link.active {
        color: #667eea;
        background-color: transparent;
        border-bottom: 3px solid #667eea;
    }
    
    #rechargeModal .nav-link:hover {
        color: #764ba2;
    }
    
    .bg-purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .btn-purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 0.75rem 2rem;
    }
    
    .btn-purple:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        color: white;
    }
    
    .payment-method-icon {
        padding: 1.5rem 0;
    }
    
    #rechargeModal .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
    
    #rechargeModal .form-label {
        color: #495057;
        font-size: 0.9rem;
    }
    
    #rechargeModal .alert-light {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    
    @media (max-width: 768px) {
        .dashboard-header .d-flex {
            text-align: center;
        }
        
        .stats-card {
            margin-bottom: 16px;
        }
        
        .stats-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
            margin-right: 12px;
        }
        
        .stats-info h3 {
            font-size: 1.5rem;
        }
        
        #rechargeModal .modal-dialog {
            margin: 0.5rem;
        }
        
        #rechargeModal .nav-tabs {
            padding: 0 1rem;
        }
        
        .recharge-amounts .col-4 {
            width: 50%;
        }
    }
    
    @media (max-width: 576px) {
        .recharge-amounts .col-4 {
            width: 100%;
        }
        
        .amount-option {
            padding: 1rem !important;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== GESTION DES MONTANTS =====
    const amountOptions = document.querySelectorAll('.amount-option');
    const momoAmountInput = document.getElementById('momoAmount');
    const visaAmountInput = document.getElementById('visaAmount');
    
    // Fonction pour formater les nombres
    function formatNumber(number) {
        return new Intl.NumberFormat('fr-FR').format(number);
    }
    
    // Fonction pour mettre à jour les résumés
    function updateSummary(inputId, summaryId, totalId, hasFees = false) {
        const amount = parseInt(document.getElementById(inputId).value) || 0;
        const fees = hasFees ? 150 : 0;
        const total = amount + fees;
        
        document.getElementById(summaryId).textContent = formatNumber(amount) + ' FCFA';
        document.getElementById(totalId).textContent = formatNumber(total) + ' FCFA';
    }
    
    // Sélection des montants
    amountOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Retirer la sélection précédente
            amountOptions.forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Appliquer la sélection
            this.classList.add('selected');
            
            const amount = this.getAttribute('data-amount');
            
            // Mettre à jour les champs correspondants selon l'onglet actif
            const activeTab = document.querySelector('#paymentTabs .nav-link.active');
            if (activeTab.id === 'momo-tab') {
                momoAmountInput.value = amount;
                updateSummary('momoAmount', 'momoSummaryAmount', 'momoTotalAmount', false);
            } else {
                visaAmountInput.value = amount;
                updateSummary('visaAmount', 'visaSummaryAmount', 'visaTotalAmount', true);
            }
        });
    });
    
    // Écouteurs pour les champs de montant personnalisé
    momoAmountInput.addEventListener('input', function() {
        updateSummary('momoAmount', 'momoSummaryAmount', 'momoTotalAmount', false);
    });
    
    visaAmountInput.addEventListener('input', function() {
        updateSummary('visaAmount', 'visaSummaryAmount', 'visaTotalAmount', true);
    });
    
    // ===== BASCULEMENT VISIBILITÉ DES MOTS DE PASSE =====
    const toggleMomoPin = document.getElementById('toggleMomoPin');
    const toggleCvv = document.getElementById('toggleCvv');
    const momoPin = document.getElementById('momoPin');
    const cvv = document.getElementById('cvv');
    
    if (toggleMomoPin) {
        toggleMomoPin.addEventListener('click', function() {
            const type = momoPin.getAttribute('type') === 'password' ? 'text' : 'password';
            momoPin.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });
    }
    
    if (toggleCvv) {
        toggleCvv.addEventListener('click', function() {
            const type = cvv.getAttribute('type') === 'password' ? 'text' : 'password';
            cvv.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });
    }
    
    // ===== VALIDATION DES FORMULAIRES =====
    // Formulaires Bootstrap validation
    (function () {
        'use strict'
        
        const forms = document.querySelectorAll('.needs-validation')
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    event.preventDefault();
                    
                    // Récupération des données selon le formulaire
                    if (form.id === 'momoForm') {
                        const amount = parseInt(momoAmountInput.value) || 0;
                        const phone = document.getElementById('momoPhone').value;
                        const operator = document.getElementById('momoOperator').value;
                        const operatorName = operator === 'orange' ? 'Orange Money' : operator === 'mtn' ? 'MTN Mobile Money' : 'Moov Money';
                        
                        // Simulation de rechargement
                        const modal = bootstrap.Modal.getInstance(document.getElementById('rechargeModal'));
                        modal.hide();
                        
                        // Notification de succès
                        alert(`✅ Rechargement de ${formatNumber(amount)} FCFA effectué avec succès via ${operatorName} !\n\n📱 Un SMS de confirmation a été envoyé au +225 ${phone}.`);
                        
                    } else if (form.id === 'visaForm') {
                        const amount = parseInt(visaAmountInput.value) || 0;
                        const cardNumber = document.getElementById('cardNumber').value;
                        const last4 = cardNumber.slice(-4);
                        
                        // Simulation de rechargement
                        const modal = bootstrap.Modal.getInstance(document.getElementById('rechargeModal'));
                        modal.hide();
                        
                        // Notification de succès
fetch('/wallet/recharge', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
        amount: amount,
        phone: phone
    })
})
.then(res => res.json())
.then(data => {
    window.location.href = data.url;
});                    }
                    
                    // Réinitialiser le formulaire
                    form.reset();
                    form.classList.remove('was-validated');
                    
                    // Réinitialiser les sélections de montant
                    amountOptions.forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    
                    // Réinitialiser les résumés
                    updateSummary('momoAmount', 'momoSummaryAmount', 'momoTotalAmount', false);
                    updateSummary('visaAmount', 'visaSummaryAmount', 'visaTotalAmount', true);
                }
                
                form.classList.add('was-validated')
            }, false)
        })
    })()
    
    // ===== ANIMATION DES CARTES DE STATISTIQUES =====
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // ===== RÉINITIALISATION DES FORMULAIRES À LA FERMETURE =====
    document.getElementById('rechargeModal').addEventListener('hidden.bs.modal', function() {
        // Réinitialiser la validation
        const forms = document.querySelectorAll('.needs-validation');
        forms.forEach(form => {
            form.classList.remove('was-validated');
        });
        
        // Réinitialiser les sélections de montant
        amountOptions.forEach(opt => {
            opt.classList.remove('selected');
        });
        
        // Remettre les champs password en type password
        if (momoPin) momoPin.setAttribute('type', 'password');
        if (cvv) cvv.setAttribute('type', 'password');
        if (toggleMomoPin) toggleMomoPin.innerHTML = '<i class="bi bi-eye"></i>';
        if (toggleCvv) toggleCvv.innerHTML = '<i class="bi bi-eye"></i>';
    });
});
</script>
@endsection