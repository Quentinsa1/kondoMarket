@extends('template.template')

@section('title', 'Signaler un abus - Kondo Market')

@section('navbar')
    @include('partials.navbar') {{-- Utilisez la navbar standard --}}
@endsection

@section('content')
<!-- ===== SECTION : SIGNALER UN ABUS ===== -->
<section class="report-abuse-section py-5">
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- En-tête -->
                <div class="report-header text-center mb-5">
                    <div class="report-icon">
                        <i class="bi bi-shield-exclamation"></i>
                    </div>
                    <h1 class="report-title">Signaler un abus</h1>
                    <p class="report-subtitle">
                        Aidez-nous à maintenir Kondo Market sécurisé en signalant tout contenu ou comportement inapproprié
                    </p>
                </div>
                
                <!-- Carte de formulaire -->
                <div class="report-card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form id="reportForm" action="{{ route('report.abuse.store') }}" method="POST">
                            @csrf
                            
                            <!-- Cible du signalement -->
                            <div class="mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="bi bi-bullseye"></i> Que souhaitez-vous signaler ?
                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="target-card">
                                            <input type="radio" name="target_type" value="product" 
                                                   {{ (old('target_type', $prefilled['type']) == 'product') ? 'checked' : '' }}>
                                            <div class="target-content">
                                                <div class="target-icon">
                                                    <i class="bi bi-box"></i>
                                                </div>
                                                <div class="target-info">
                                                    <h5>Un produit</h5>
                                                    <p>Produit contrefait, description trompeuse, photo inappropriée</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="target-card">
                                            <input type="radio" name="target_type" value="vendor" 
                                                   {{ (old('target_type', $prefilled['type']) == 'vendor') ? 'checked' : '' }}>
                                            <div class="target-content">
                                                <div class="target-icon">
                                                    <i class="bi bi-shop"></i>
                                                </div>
                                                <div class="target-info">
                                                    <h5>Un vendeur</h5>
                                                    <p>Vendeur non fiable, fraude, comportement inapproprié</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="target-card">
                                            <input type="radio" name="target_type" value="user" 
                                                   {{ (old('target_type', $prefilled['type']) == 'user') ? 'checked' : '' }}>
                                            <div class="target-content">
                                                <div class="target-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                <div class="target-info">
                                                    <h5>Un utilisateur</h5>
                                                    <p>Harcèlement, spam, messages inappropriés</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="target-card">
                                            <input type="radio" name="target_type" value="general" 
                                                   {{ (old('target_type', $prefilled['type']) == 'general') ? 'checked' : '' }}>
                                            <div class="target-content">
                                                <div class="target-icon">
                                                    <i class="bi bi-exclamation-triangle"></i>
                                                </div>
                                                <div class="target-info">
                                                    <h5>Problème général</h5>
                                                    <p>Bug du site, problème technique, suggestion</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Informations sur la cible -->
                                <div class="target-details mt-4" id="targetDetails">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="target_name" class="form-label">
                                                Nom de la cible <span class="text-muted">(optionnel)</span>
                                            </label>
                                            <input type="text" class="form-control" id="target_name" 
                                                   name="target_name" value="{{ old('target_name', $prefilled['target_name']) }}"
                                                   placeholder="Ex: iPhone 13, Vendeur TechWorld...">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="target_id" class="form-label">
                                                ID ou lien <span class="text-muted">(optionnel)</span>
                                            </label>
                                            <input type="text" class="form-control" id="target_id" 
                                                   name="target_id" value="{{ old('target_id', $prefilled['target_id']) }}"
                                                   placeholder="Ex: #12345, URL...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Type de problème -->
                            <div class="mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="bi bi-exclamation-octagon"></i> Type de problème
                                </h3>
                                
                                <div class="row">
                                    @php
                                        $reportTypes = [
                                            'fraud' => ['label' => 'Fraude ou escroquerie', 'icon' => 'bi-shield-exclamation'],
                                            'spam' => ['label' => 'Spam', 'icon' => 'bi-envelope-exclamation'],
                                            'inappropriate' => ['label' => 'Contenu inapproprié', 'icon' => 'bi-ban'],
                                            'counterfeit' => ['label' => 'Produit contrefait', 'icon' => 'bi-tags'],
                                            'harassment' => ['label' => 'Harcèlement', 'icon' => 'bi-person-x'],
                                            'other' => ['label' => 'Autre problème', 'icon' => 'bi-question-circle'],
                                        ];
                                    @endphp
                                    
                                    @foreach($reportTypes as $key => $type)
                                    <div class="col-md-4 mb-3">
                                        <label class="problem-card">
                                            <input type="radio" name="report_type" value="{{ $key }}" 
                                                   {{ old('report_type') == $key ? 'checked' : '' }}>
                                            <div class="problem-content">
                                                <div class="problem-icon">
                                                    <i class="bi {{ $type['icon'] }}"></i>
                                                </div>
                                                <div class="problem-info">
                                                    <h6>{{ $type['label'] }}</h6>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Description détaillée -->
                            <div class="mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="bi bi-chat-text"></i> Description détaillée
                                </h3>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">
                                        <strong>Décrivez le problème *</strong>
                                    </label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="6" placeholder="Décrivez en détail le problème rencontré, ce qui s'est passé, quand..." 
                                              required>{{ old('description') }}</textarea>
                                    <div class="form-text">
                                        Soyez aussi précis que possible. Incluez les dates, heures, et toute information utile.
                                    </div>
                                    <div class="char-count text-end">
                                        <span id="descCount">0</span>/1000 caractères
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="evidence" class="form-label">
                                        <strong>Preuves ou liens vers des preuves</strong>
                                        <span class="text-muted">(optionnel)</span>
                                    </label>
                                    <textarea class="form-control" id="evidence" name="evidence" 
                                              rows="3" placeholder="Liens vers des captures d'écran, messages, emails...">{{ old('evidence') }}</textarea>
                                    <div class="form-text">
                                        Vous pouvez partager des liens vers des images hébergées (Imgur, Google Drive...)
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Urgence et contact -->
                            <div class="mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="bi bi-clock"></i> Niveau d'urgence et contact
                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">
                                            <strong>Niveau d'urgence *</strong>
                                        </label>
                                        <div class="urgency-levels">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="urgency" 
                                                       value="low" id="urgencyLow" {{ old('urgency') == 'low' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="urgencyLow">
                                                    <span class="urgency-badge low">Basse</span>
                                                    <small class="text-muted d-block">Problème mineur, pas d'impact immédiat</small>
                                                </label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" name="urgency" 
                                                       value="medium" id="urgencyMedium" {{ old('urgency') == 'medium' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="urgencyMedium">
                                                    <span class="urgency-badge medium">Moyenne</span>
                                                    <small class="text-muted d-block">Problème sérieux nécessitant une attention</small>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="urgency" 
                                                       value="high" id="urgencyHigh" {{ old('urgency') == 'high' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="urgencyHigh">
                                                    <span class="urgency-badge high">Haute</span>
                                                    <small class="text-muted d-block">Urgent - fraude active, danger immédiat</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label for="contact_email" class="form-label">
                                            <strong>Email de contact</strong>
                                            <span class="text-muted">(optionnel)</span>
                                        </label>
                                        <input type="email" class="form-control" id="contact_email" 
                                               name="contact_email" value="{{ old('contact_email', Auth::check() ? Auth::user()->email : '') }}"
                                               placeholder="votre@email.com">
                                        <div class="form-text">
                                            Pour vous contacter si nous avons besoin de plus d'informations
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Consentement et envoi -->
                            <div class="mb-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="consent" 
                                           id="consent" required {{ old('consent') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="consent">
                                        <strong>Je confirme que les informations fournies sont exactes à ma connaissance *</strong><br>
                                        <small class="text-muted">
                                            Les signalements abusifs peuvent entraîner la suspension de votre compte.
                                        </small>
                                    </label>
                                </div>
                                
                                <div class="privacy-notice">
                                    <i class="bi bi-shield-check"></i>
                                    <small>
                                        Vos informations sont traitées confidentiellement. 
                                        <a href="" class="text-decoration-none">Politique de confidentialité</a>
                                    </small>
                                </div>
                            </div>
                            
                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-between mt-5">
                                <a href="" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-arrow-left"></i> Retour
                                </a>
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="bi bi-send"></i> Envoyer le signalement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Informations importantes -->
                <div class="info-card mt-4">
                    <div class="card-body">
                        <h5><i class="bi bi-info-circle"></i> Informations importantes</h5>
                        <ul class="info-list">
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Traitement rapide :</strong> Notre équipe examine les signalements sous 24-48h
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Confidentialité :</strong> Votre identité n'est pas révélée au signalé
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Conséquences :</strong> Les abus confirmés peuvent entraîner des suspensions
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <strong>Contact :</strong> En cas d'urgence, contactez-nous à 
                                <a href="mailto:security@kondomarket.com">security@kondomarket.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .report-abuse-section {
        background-color: var(--light-color);
        min-height: calc(100vh - 200px);
    }
    
    .report-header {
        padding: 40px 0;
    }
    
    .report-icon {
        width: 80px;
        height: 80px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 32px;
    }
    
    .report-title {
        color: #dc3545;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .report-subtitle {
        font-size: 18px;
        color: var(--gray-dark);
        max-width: 600px;
        margin: 0 auto;
    }
    
    .report-card {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .report-card .card-body {
        padding: 40px;
    }
    
    .section-title {
        font-size: 20px;
        color: var(--primary-color);
        border-bottom: 2px solid var(--light-color);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    
    .section-title i {
        color: #dc3545;
        margin-right: 10px;
    }
    
    /* Cartes de sélection */
    .target-card, .problem-card {
        cursor: pointer;
    }
    
    .target-card input[type="radio"], .problem-card input[type="radio"] {
        display: none;
    }
    
    .target-content, .problem-content {
        border: 2px solid var(--gray-light);
        border-radius: var(--border-radius);
        padding: 20px;
        transition: var(--transition);
        height: 100%;
    }
    
    .target-card:hover .target-content,
    .problem-card:hover .problem-content {
        border-color: var(--accent-color);
        transform: translateY(-2px);
    }
    
    .target-card input[type="radio"]:checked + .target-content,
    .problem-card input[type="radio"]:checked + .problem-content {
        border-color: #dc3545;
        background-color: rgba(220, 53, 69, 0.05);
    }
    
    .target-icon, .problem-icon {
        width: 50px;
        height: 50px;
        background-color: var(--light-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        font-size: 20px;
        color: var(--primary-color);
    }
    
    .target-card input[type="radio"]:checked + .target-content .target-icon,
    .problem-card input[type="radio"]:checked + .problem-content .problem-icon {
        background-color: #dc3545;
        color: white;
    }
    
    .target-info h5, .problem-info h6 {
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--secondary-color);
    }
    
    .target-info p, .problem-info p {
        font-size: 14px;
        color: var(--gray-medium);
        margin: 0;
    }
    
    /* Niveaux d'urgence */
    .urgency-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-right: 10px;
    }
    
    .urgency-badge.low {
        background-color: #d4edda;
        color: #155724;
    }
    
    .urgency-badge.medium {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .urgency-badge.high {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    /* Compteur de caractères */
    .char-count {
        font-size: 14px;
        color: var(--gray-medium);
        margin-top: 5px;
    }
    
    /* Bouton d'envoi */
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        padding: 12px 30px;
        font-weight: 600;
        transition: var(--transition);
    }
    
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-2px);
    }
    
    /* Notice de confidentialité */
    .privacy-notice {
        background-color: var(--light-color);
        padding: 15px;
        border-radius: var(--border-radius);
        border-left: 4px solid var(--primary-color);
        margin-top: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    
    .privacy-notice i {
        color: var(--primary-color);
        font-size: 18px;
        margin-top: 2px;
    }
    
    /* Carte d'informations */
    .info-card {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        border-left: 4px solid var(--primary-color);
    }
    
    .info-card .card-body {
        padding: 25px;
    }
    
    .info-card h5 {
        color: var(--primary-color);
        margin-bottom: 15px;
    }
    
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .info-list li {
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
    }
    
    .info-list li i {
        margin-right: 10px;
        margin-top: 2px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .report-card .card-body {
            padding: 20px;
        }
        
        .report-title {
            font-size: 24px;
        }
        
        .report-subtitle {
            font-size: 16px;
        }
        
        .target-content, .problem-content {
            padding: 15px;
        }
        
        .d-flex {
            flex-direction: column;
            gap: 15px;
        }
        
        .btn-danger, .btn-outline-secondary {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Compteur de caractères pour la description
    const description = document.getElementById('description');
    const descCount = document.getElementById('descCount');
    
    description.addEventListener('input', function() {
        const count = this.value.length;
        descCount.textContent = count;
        
        if (count > 1000) {
            this.value = this.value.substring(0, 1000);
            descCount.textContent = 1000;
        }
    });
    
    // Initialiser le compteur
    descCount.textContent = description.value.length;
    
    // Afficher/masquer les détails de la cible
    const targetTypeRadios = document.querySelectorAll('input[name="target_type"]');
    const targetDetails = document.getElementById('targetDetails');
    
    function updateTargetDetails() {
        const selectedValue = document.querySelector('input[name="target_type"]:checked')?.value;
        const targetNameInput = document.getElementById('target_name');
        
        // Mettre à jour le placeholder
        switch(selectedValue) {
            case 'product':
                targetNameInput.placeholder = 'Ex: iPhone 13, Ordinateur portable...';
                break;
            case 'vendor':
                targetNameInput.placeholder = 'Ex: TechWorld Suppliers, FashionHub...';
                break;
            case 'user':
                targetNameInput.placeholder = 'Ex: Nom d\'utilisateur, Email...';
                break;
            default:
                targetNameInput.placeholder = 'Ex: Problème technique, Bug...';
        }
    }
    
    targetTypeRadios.forEach(radio => {
        radio.addEventListener('change', updateTargetDetails);
    });
    
    // Initialiser
    updateTargetDetails();
    
    // Validation du formulaire
    const form = document.getElementById('reportForm');
    form.addEventListener('submit', function(e) {
        const description = document.getElementById('description').value.trim();
        const consent = document.getElementById('consent').checked;
        const urgency = document.querySelector('input[name="urgency"]:checked');
        
        if (!description || description.length < 20) {
            e.preventDefault();
            alert('Veuillez fournir une description détaillée d\'au moins 20 caractères.');
            return false;
        }
        
        if (!consent) {
            e.preventDefault();
            alert('Vous devez confirmer l\'exactitude des informations.');
            return false;
        }
        
        if (!urgency) {
            e.preventDefault();
            alert('Veuillez sélectionner un niveau d\'urgence.');
            return false;
        }
        
        // Confirmation avant envoi
        if (!confirm('Êtes-vous sûr de vouloir envoyer ce signalement ?')) {
            e.preventDefault();
            return false;
        }
        
        return true;
    });
});
</script>
@endsection