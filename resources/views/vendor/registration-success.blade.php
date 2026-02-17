@extends('template.template')

@section('title', 'Inscription réussie - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : INSCRIPTION RÉUSSIE ===== -->
<section class="registration-success-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-card text-center">
                    <div class="success-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    
                    <h1 class="success-title">Félicitations !</h1>
                    <p class="success-subtitle">Votre inscription en tant que vendeur a été soumise avec succès</p>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="vendor-summary">
                                @if($vendor)
                                    <div class="vendor-avatar mb-3">
                                        @if($vendor->avatar_path)
                                            <img src="{{ asset('storage/' . $vendor->avatar_path) }}" 
                                                 alt="{{ $vendor->display_name }}" 
                                                 class="rounded-circle" width="80" height="80">
                                        @elseif($vendor->logo_path)
                                            <img src="{{ asset('storage/' . $vendor->logo_path) }}" 
                                                 alt="{{ $vendor->company_name }}" 
                                                 class="rounded-circle" width="80" height="80">
                                        @else
                                            <div class="avatar-placeholder rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <h4>{{ $vendor->display_name }}</h4>
                                    
                                    <div class="vendor-type-badge mb-3">
                                        @if($vendor->vendor_type === 'individual')
                                            <span class="badge bg-info">Particulier</span>
                                        @else
                                            <span class="badge bg-success">Entreprise</span>
                                        @endif
                                    </div>
                                    
                                    <div class="vendor-info">
                                        <div class="info-item">
                                            <i class="bi bi-envelope"></i>
                                            <span>{{ Auth::user()->email }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="bi bi-telephone"></i>
                                            <span>{{ $vendor->phone }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>{{ $vendor->city }}, {{ $vendor->country }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="bi bi-shield-check"></i>
                                            <span>Statut: <strong class="text-warning">En attente de vérification</strong></span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Prochaines étapes -->
                    <div class="next-steps mt-5">
                        <h3 class="mb-4">Prochaines étapes</h3>
                        
                        <div class="steps-timeline">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Vérification du compte</h5>
                                    <p>Notre équipe va vérifier vos informations sous 24-48h. Vous recevrez un email de confirmation une fois votre compte approuvé.</p>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h5>Compléter votre profil</h5>
                                    <p>Ajoutez une description détaillée, vos conditions de vente et configurez vos méthodes de paiement.</p>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h5>Ajouter vos produits/services</h5>
                                    <p>Commencez à ajouter vos produits ou services avec des photos de qualité et des descriptions complètes.</p>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h5>Recevoir vos premières commandes</h5>
                                    <p>Une fois votre boutique en ligne, les acheteurs pourront découvrir vos offres et passer commande.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Conseils pour les nouveaux vendeurs -->
                    <div class="seller-tips mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">
                                    <i class="bi bi-lightbulb"></i> Conseils pour bien démarrer
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="tip-card">
                                            <div class="tip-icon">
                                                <i class="bi bi-images"></i>
                                            </div>
                                            <div class="tip-text">
                                                <h6>Photos de qualité</h6>
                                                <p class="small mb-0">Utilisez des photos nettes et bien éclairées pour vos produits</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="tip-card">
                                            <div class="tip-icon">
                                                <i class="bi bi-file-text"></i>
                                            </div>
                                            <div class="tip-text">
                                                <h6>Descriptions détaillées</h6>
                                                <p class="small mb-0">Décrivez précisément vos produits et services</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="tip-card">
                                            <div class="tip-icon">
                                                <i class="bi bi-truck"></i>
                                            </div>
                                            <div class="tip-text">
                                                <h6>Livraison rapide</h6>
                                                <p class="small mb-0">Définissez des délais de livraison réalistes</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="tip-card">
                                            <div class="tip-icon">
                                                <i class="bi bi-chat-left-text"></i>
                                            </div>
                                            <div class="tip-text">
                                                <h6>Réponse rapide</h6>
                                                <p class="small mb-0">Répondez rapidement aux questions des acheteurs</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="action-buttons mt-5">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="" class="btn btn-primary w-100">
                                    <i class="bi bi-file-earmark-text"></i> Vérifier mes documents
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-speedometer2"></i> Tableau de bord
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-person-circle"></i> Compléter mon profil
                                </a>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="" class="btn btn-link">
                                <i class="bi bi-arrow-left"></i> Retour à l'accueil
                            </a>
                        </div>
                    </div>
                    
                    <!-- FAQ -->
                    <div class="faq-section mt-5">
                        <h4 class="mb-4">Questions fréquentes</h4>
                        
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        Combien de temps prend la vérification ?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        La vérification de votre compte prend généralement <strong>24 à 48 heures</strong>. Vous recevrez un email de confirmation une fois la vérification terminée.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        Quand puis-je commencer à vendre ?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Vous pouvez commencer à ajouter vos produits immédiatement, mais ils ne seront visibles par les acheteurs qu'après l'approbation de votre compte.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        Quels documents dois-je fournir ?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Pour les <strong>particuliers</strong> : une pièce d'identité. Pour les <strong>entreprises</strong> : SIRET, KBIS et pièce d'identité du représentant légal.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        Comment sont gérés les paiements ?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Les paiements sont sécurisés via notre plateforme. Les fonds sont versés sur votre compte bancaire sous 2-3 jours ouvrables après chaque livraison confirmée.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact support -->
                    <div class="support-card mt-5">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-headset support-icon"></i>
                                <h5 class="mt-3">Besoin d'aide ?</h5>
                                <p class="text-muted">Notre équipe support est disponible pour vous aider</p>
                                <div class="support-contact">
                                    <a href="mailto:support@kondomarket.com" class="btn btn-outline-primary">
                                        <i class="bi bi-envelope"></i> support@kondomarket.com
                                    </a>
                                    <a href="" class="btn btn-link ms-2">
                                        <i class="bi bi-chat-left-text"></i> Formulaire de contact
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .registration-success-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }
    
    .success-card {
        background-color: white;
        border-radius: var(--border-radius);
        padding: 40px;
        box-shadow: var(--shadow-lg);
    }
    
    .success-icon {
        font-size: 80px;
        color: var(--success-color);
        margin-bottom: 20px;
        animation: bounceIn 1s ease;
    }
    
    @keyframes bounceIn {
        0% {
            transform: scale(0.3);
            opacity: 0;
        }
        50% {
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .success-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .success-subtitle {
        font-size: 18px;
        color: var(--gray-dark);
        margin-bottom: 30px;
    }
    
    .vendor-summary {
        padding: 20px;
    }
    
    .vendor-avatar img {
        border: 3px solid var(--primary-color);
        object-fit: cover;
    }
    
    .avatar-placeholder {
        width: 80px;
        height: 80px;
        background-color: var(--light-color);
        color: var(--primary-color);
        font-size: 32px;
    }
    
    .vendor-type-badge .badge {
        font-size: 14px;
        padding: 6px 12px;
    }
    
    .vendor-info {
        max-width: 400px;
        margin: 20px auto 0;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        color: var(--gray-dark);
    }
    
    .info-item i {
        width: 24px;
        margin-right: 10px;
        color: var(--primary-color);
    }
    
    /* Timeline des étapes */
    .steps-timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .steps-timeline:before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: var(--primary-color);
        opacity: 0.2;
    }
    
    .step-item {
        position: relative;
        margin-bottom: 30px;
        display: flex;
        align-items: flex-start;
    }
    
    .step-number {
        width: 32px;
        height: 32px;
        background-color: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 20px;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
    }
    
    .step-content {
        flex: 1;
        text-align: left;
        background-color: var(--light-color);
        padding: 20px;
        border-radius: var(--border-radius);
        border-left: 4px solid var(--primary-color);
    }
    
    .step-content h5 {
        color: var(--primary-color);
        margin-bottom: 10px;
    }
    
    .step-content p {
        color: var(--gray-dark);
        margin-bottom: 0;
    }
    
    /* Conseils */
    .tip-card {
        display: flex;
        align-items: flex-start;
        padding: 15px;
        background-color: white;
        border: 1px solid var(--gray-light);
        border-radius: var(--border-radius);
        height: 100%;
        transition: var(--transition);
    }
    
    .tip-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--primary-color);
    }
    
    .tip-icon {
        width: 40px;
        height: 40px;
        background-color: var(--light-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: var(--primary-color);
        flex-shrink: 0;
    }
    
    .tip-text h6 {
        color: var(--secondary-color);
        margin-bottom: 5px;
    }
    
    /* Boutons d'action */
    .action-buttons .btn {
        padding: 12px;
        font-weight: 600;
    }
    
    .btn-primary {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }
    
    .btn-primary:hover {
        background-color: #e6892a;
        border-color: #e6892a;
    }
    
    /* FAQ */
    .faq-section .accordion-button {
        background-color: var(--light-color);
        color: var(--secondary-color);
        font-weight: 600;
        padding: 15px 20px;
    }
    
    .faq-section .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }
    
    .faq-section .accordion-body {
        background-color: white;
        border: 1px solid var(--gray-light);
        border-top: none;
    }
    
    /* Support */
    .support-card .card {
        border: 2px solid var(--primary-color);
        background-color: rgba(47, 143, 131, 0.05);
    }
    
    .support-icon {
        font-size: 48px;
        color: var(--primary-color);
    }
    
    .support-contact .btn {
        padding: 8px 20px;
    }
    
    @media (max-width: 768px) {
        .success-card {
            padding: 20px;
        }
        
        .success-icon {
            font-size: 60px;
        }
        
        .steps-timeline {
            padding-left: 20px;
        }
        
        .step-item {
            flex-direction: column;
        }
        
        .step-number {
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .step-content {
            width: 100%;
        }
        
        .action-buttons .btn {
            margin-bottom: 10px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation pour les étapes
    const stepItems = document.querySelectorAll('.step-item');
    
    stepItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 300 * (index + 1));
    });
    
    // Animation pour les cartes de conseils
    const tipCards = document.querySelectorAll('.tip-card');
    
    tipCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
        }, 500 + (200 * index));
    });
    
    // Bouton pour télécharger les documents d'aide
    const downloadGuideBtn = document.createElement('a');
    downloadGuideBtn.href = '#';
    downloadGuideBtn.className = 'btn btn-outline-success mt-3';
    downloadGuideBtn.innerHTML = '<i class="bi bi-download"></i> Télécharger le guide du vendeur';
    downloadGuideBtn.onclick = function(e) {
        e.preventDefault();
        alert('Le guide du vendeur sera bientôt disponible !');
    };
    
    // Ajouter le bouton dans la section des actions
    const actionButtons = document.querySelector('.action-buttons .row');
    if (actionButtons) {
        const col = document.createElement('div');
        col.className = 'col-12 mt-3';
        col.appendChild(downloadGuideBtn);
        actionButtons.parentNode.insertBefore(col, actionButtons.nextSibling);
    }
    
    // Compte à rebours pour la vérification (simulation)
    function startVerificationCountdown() {
        const statusElement = document.querySelector('.vendor-info .text-warning strong');
        if (!statusElement) return;
        
        const startTime = new Date();
        const endTime = new Date(startTime.getTime() + 48 * 60 * 60 * 1000); // 48 heures
        
        function updateCountdown() {
            const now = new Date();
            const remaining = endTime - now;
            
            if (remaining <= 0) {
                statusElement.textContent = 'En attente';
                return;
            }
            
            const hours = Math.floor(remaining / (1000 * 60 * 60));
            const minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            
            if (hours > 0) {
                statusElement.textContent = `Vérification dans ${hours}h`;
            } else if (minutes > 0) {
                statusElement.textContent = `Vérification dans ${minutes}min`;
            } else {
                statusElement.textContent = 'Vérification en cours...';
            }
        }
        
        updateCountdown();
        setInterval(updateCountdown, 60000); // Mise à jour toutes les minutes
    }
    
    // Démarrer le compte à rebours
    startVerificationCountdown();
    
    // Ajouter un effet de confetti au chargement
    function createConfetti() {
        const confettiCount = 50;
        const colors = ['#2f8f83', '#f59e42', '#6c757d', '#28a745', '#dc3545'];
        
        for (let i = 0; i < confettiCount; i++) {
            const confetti = document.createElement('div');
            confetti.style.position = 'fixed';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.borderRadius = '50%';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = '-20px';
            confetti.style.zIndex = '9999';
            confetti.style.pointerEvents = 'none';
            
            document.body.appendChild(confetti);
            
            // Animation
            const animation = confetti.animate([
                { transform: 'translateY(0) rotate(0deg)', opacity: 1 },
                { transform: `translateY(${window.innerHeight + 20}px) rotate(${Math.random() * 360}deg)`, opacity: 0 }
            ], {
                duration: 1000 + Math.random() * 2000,
                easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)'
            });
            
            animation.onfinish = () => confetti.remove();
        }
    }
    
    // Lancer les confettis après un délai
    setTimeout(createConfetti, 500);
});
</script>
@endsection