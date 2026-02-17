@extends('template.template')

@section('title', 'Centre d\'aide - Kondo Market')

@section('navbar')
    @include('partials.seller-header')
@endsection

@section('content')
<!-- ===== SECTION : CENTRE D'AIDE ===== -->
<section class="help-center-section py-5">
    <div class="container-xxl">
        <!-- En-tête de la page -->
        <div class="page-header text-center mb-5">
            <h1 class="page-title">Centre d'Aide Kondo Market</h1>
            <p class="page-subtitle">Besoin d'aide ? Trouvez rapidement des réponses à vos questions</p>
            
            <!-- Barre de recherche -->
            <div class="search-box mx-auto mt-4" style="max-width: 600px;">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Recherchez une question, un sujet...">
                    <button class="btn btn-primary" type="button">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </div>
        </div>

        <!-- Guide rapide -->
        <div class="quick-guide mb-5">
            <h2 class="section-title mb-4">Comment fonctionne Kondo Market ?</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="guide-step text-center">
                        <div class="step-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4 class="step-title">1. Recherchez</h4>
                        <p class="step-description">
                            Parcourez les produits publiés par nos vendeurs vérifiés
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guide-step text-center">
                        <div class="step-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h4 class="step-title">2. Découvrez</h4>
                        <p class="step-description">
                            Consultez les détails, photos et informations du produit
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guide-step text-center">
                        <div class="step-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h4 class="step-title">3. Contactez</h4>
                        <p class="step-description">
                            Cliquez sur "Contacter" pour discuter directement avec le vendeur
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="guide-step text-center">
                        <div class="step-icon">
                            <i class="bi bi-handshake"></i>
                        </div>
                        <h4 class="step-title">4. Finalisez</h4>
                        <p class="step-description">
                            Négociez et finalisez la transaction avec le vendeur
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catégories d'aide -->
        <div class="help-categories mb-5">
            <div class="row g-4">
                <!-- Acheteurs -->
                <div class="col-md-6">
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="bi bi-cart"></i>
                            </div>
                            <h3>Je suis acheteur</h3>
                        </div>
                        <div class="category-links">
                            <a href="#acheter" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Comment acheter sur Kondo ?</strong>
                                    <small>Guide complet pour vos premiers achats</small>
                                </div>
                            </a>
                            <a href="#contact-vendeur" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Comment contacter un vendeur ?</strong>
                                    <small>Via WhatsApp, téléphone ou message</small>
                                </div>
                            </a>
                            <a href="#securite" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Conseils de sécurité</strong>
                                    <small>Acheter en toute confiance</small>
                                </div>
                            </a>
                            <a href="#paiement" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Méthodes de paiement</strong>
                                    <small>Comment payer en toute sécurité</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vendeurs -->
                <div class="col-md-6">
                    <div class="category-card">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="bi bi-shop"></i>
                            </div>
                            <h3>Je suis vendeur</h3>
                        </div>
                        <div class="category-links">
                            <a href="{{ route('vendors.index') }}" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Devenir vendeur</strong>
                                    <small>Créer ma boutique en ligne</small>
                                </div>
                            </a>
                            <a href="#publier-produit" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Publier un produit</strong>
                                    <small>Vendre efficacement vos produits</small>
                                </div>
                            </a>
                            <a href="#gestion" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Gérer ma boutique</strong>
                                    <small>Outils et conseils pour vendeurs</small>
                                </div>
                            </a>
                            <a href="#commission" class="help-link">
                                <i class="bi bi-chevron-right"></i>
                                <div>
                                    <strong>Commissions et frais</strong>
                                    <small>Tarifs et conditions</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section mb-5" id="faq">
            <h2 class="section-title mb-4">Questions fréquentes</h2>
            
            <div class="accordion" id="faqAccordion">
                <!-- Acheteurs FAQ -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqAcheteurs">
                            <i class="bi bi-cart me-2"></i> Questions des acheteurs
                        </button>
                    </h2>
                    <div id="faqAcheteurs" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <div class="faq-item">
                                <h5>Comment acheter sur Kondo Market ?</h5>
                                <p>Kondo Market fonctionne sur un modèle de contact direct :</p>
                                <ol>
                                    <li>Parcourez les produits ou catégories</li>
                                    <li>Cliquez sur un produit qui vous intéresse</li>
                                    <li>Cliquez sur "Contacter le vendeur"</li>
                                    <li>Vous serez redirigé vers WhatsApp ou pourrez appeler le vendeur</li>
                                    <li>Finalisez la transaction directement avec le vendeur</li>
                                </ol>
                            </div>
                            
                            <div class="faq-item">
                                <h5>Est-ce que Kondo Market est sécurisé ?</h5>
                                <p>Oui, nous prenons plusieurs mesures de sécurité :</p>
                                <ul>
                                    <li>Tous les vendeurs sont vérifiés</li>
                                    <li>Système d'évaluation des vendeurs</li>
                                    <li>Signalement d'abus facile</li>
                                    <li>Support disponible pour les litiges</li>
                                </ul>
                            </div>
                            
                            <div class="faq-item">
                                <h5>Comment contacter un vendeur ?</h5>
                                <p>Plusieurs options :</p>
                                <ul>
                                    <li><strong>WhatsApp :</strong> Cliquez sur l'icône WhatsApp sur la fiche produit</li>
                                    <li><strong>Téléphone :</strong> Appelez directement le vendeur</li>
                                    <li><strong>Message :</strong> Envoyez un message via le formulaire de contact</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vendeurs FAQ -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqVendeurs">
                            <i class="bi bi-shop me-2"></i> Questions des vendeurs
                        </button>
                    </h2>
                    <div id="faqVendeurs" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <div class="faq-item">
                                <h5>Comment devenir vendeur sur Kondo ?</h5>
                                <p>Pour devenir vendeur :</p>
                                <ol>
                                    <li>Créez un compte sur Kondo Market</li>
                                    <li>Cliquez sur "Devenir vendeur" dans votre espace</li>
                                    <li>Complétez le formulaire de création de boutique</li>
                                    <li>Fournissez les documents requis (selon le type de vendeur)</li>
                                    <li>Commencez à publier vos produits !</li>
                                </ol>
                            </div>
                            
                            <div class="faq-item">
                                <h5>Quels sont les frais pour les vendeurs ?</h5>
                                <p>Notre modèle est transparent :</p>
                                <ul>
                                    <li><strong>Inscription :</strong> Gratuite</li>
                                    <li><strong>Publication :</strong> Gratuite pour les 50 premiers produits</li>
                                    <li><strong>Commission :</strong> 3-5% selon votre niveau de vendeur</li>
                                    <li><strong>Frais de retrait :</strong> Selon votre méthode de paiement</li>
                                </ul>
                            </div>
                            
                            <div class="faq-item">
                                <h5>Comment gérer mes contacts acheteurs ?</h5>
                                <p>Dans votre espace vendeur :</p>
                                <ul>
                                    <li>Consultez vos messages depuis la plateforme</li>
                                    <li>Gérez vos réponses via WhatsApp Business</li>
                                    <li>Utilisez notre système de suivi des contacts</li>
                                    <li>Exportez vos contacts pour votre CRM</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sécurité FAQ -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqSecurite">
                            <i class="bi bi-shield-check me-2"></i> Sécurité et confiance
                        </button>
                    </h2>
                    <div id="faqSecurite" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <div class="faq-item">
                                <h5>Comment signaler un problème ?</h5>
                                <p>Si vous rencontrez un problème :</p>
                                <ol>
                                    <li>Cliquez sur "Signaler" sur la fiche du vendeur ou du produit</li>
                                    <li>Remplissez le formulaire de signalement</li>
                                    <li>Notre équipe examinera le cas sous 24h</li>
                                    <li>Nous prendrons les mesures nécessaires</li>
                                </ol>
                            </div>
                            
                            <div class="faq-item">
                                <h5>Comment vérifier la fiabilité d'un vendeur ?</h5>
                                <p>Vérifiez ces éléments :</p>
                                <ul>
                                    <li><strong>Badge "Vérifié"</strong> sur le profil du vendeur</li>
                                    <li><strong>Évaluations</strong> et commentaires des acheteurs</li>
                                    <li><strong>Ancienneté</strong> sur la plateforme</li>
                                    <li><strong>Temps de réponse</strong> moyen</li>
                                    <li><strong>Produits publiés</strong> et qualité des descriptions</li>
                                </ul>
                            </div>
                            
                            <div class="faq-item">
                                <h5>Conseils pour des transactions sécurisées</h5>
                                <p>Pour votre sécurité :</p>
                                <ul>
                                    <li>Toujours communiquer via Kondo Market</li>
                                    <li>Demander des photos supplémentaires si besoin</li>
                                    <li>Utiliser des méthodes de paiement sécurisées</li>
                                    <li>Garder une trace des conversations</li>
                                    <li>Signaler tout comportement suspect</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="contact-support-section">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-3">Vous n'avez pas trouvé de réponse ?</h3>
                            <p class="mb-0">Notre équipe de support est là pour vous aider. Contactez-nous via les canaux suivants :</p>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-3 justify-content-md-end">
                                <a href="https://wa.me/2290161924532" class="btn btn-success btn-lg">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                                <a href="mailto:support@kondomarket.com" class="btn btn-primary btn-lg">
                                    <i class="bi bi-envelope"></i> Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ressources utiles -->
        <div class="resources-section mt-5">
            <h2 class="section-title mb-4">Ressources utiles</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <h4>Guide de l'acheteur</h4>
                        <p>Tout ce que vous devez savoir pour acheter en toute sécurité sur Kondo Market</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Consulter le guide</a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>
                        <h4>Guide du vendeur</h4>
                        <p>Conseils et bonnes pratiques pour vendre efficacement sur notre plateforme</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Consulter le guide</a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="resource-card">
                        <div class="resource-icon">
                            <i class="bi bi-shield"></i>
                        </div>
                        <h4>Centre de sécurité</h4>
                        <p>Protégez-vous et apprenez à reconnaître les comportements suspects</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .help-center-section {
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px);
    }
    
    .page-title {
        color: var(--primary-color);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .page-subtitle {
        color: var(--gray-dark);
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .section-title {
        color: var(--primary-color);
        font-size: 1.75rem;
        font-weight: 600;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--light-color);
    }
    
    .guide-step {
        background: white;
        padding: 2rem 1rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
    }
    
    .guide-step:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .step-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary-color), #4bbfaa);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }
    
    .step-title {
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 0.75rem;
    }
    
    .step-description {
        color: var(--gray-dark);
        font-size: 0.9rem;
    }
    
    .category-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        height: 100%;
    }
    
    .category-header {
        background: linear-gradient(135deg, var(--primary-color), #4bbfaa);
        color: white;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .category-header h3 {
        margin: 0;
        font-size: 1.5rem;
    }
    
    .category-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .category-links {
        padding: 1.5rem;
    }
    
    .help-link {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid var(--gray-light);
        transition: var(--transition);
    }
    
    .help-link:last-child {
        border-bottom: none;
    }
    
    .help-link:hover {
        background-color: var(--light-color);
        padding-left: 0.5rem;
        text-decoration: none;
    }
    
    .help-link i {
        color: var(--primary-color);
        margin-top: 0.25rem;
        margin-right: 1rem;
        font-size: 1.2rem;
    }
    
    .help-link strong {
        color: var(--secondary-color);
        display: block;
        margin-bottom: 0.25rem;
    }
    
    .help-link small {
        color: var(--gray-medium);
        font-size: 0.85rem;
    }
    
    .faq-section .accordion-button {
        background-color: var(--light-color);
        color: var(--primary-color);
        font-weight: 600;
        padding: 1.25rem 1.5rem;
        border: none;
        box-shadow: none;
    }
    
    .faq-section .accordion-button:not(.collapsed) {
        background-color: var(--primary-color);
        color: white;
    }
    
    .faq-section .accordion-item {
        border: 1px solid var(--gray-light);
        border-radius: var(--border-radius) !important;
        margin-bottom: 1rem;
        overflow: hidden;
    }
    
    .faq-section .faq-item {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--gray-light);
    }
    
    .faq-section .faq-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .faq-section .faq-item h5 {
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .faq-section .faq-item p {
        color: var(--gray-dark);
        margin-bottom: 1rem;
    }
    
    .faq-section .faq-item ol,
    .faq-section .faq-item ul {
        color: var(--gray-dark);
        padding-left: 1.5rem;
    }
    
    .faq-section .faq-item li {
        margin-bottom: 0.5rem;
    }
    
    .contact-support-section .card {
        border: none;
        background: linear-gradient(135deg, var(--light-color), #e8f4f1);
        box-shadow: var(--shadow-md);
    }
    
    .resources-section .resource-card {
        background: white;
        padding: 2rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        text-align: center;
        height: 100%;
        transition: var(--transition);
    }
    
    .resources-section .resource-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .resources-section .resource-icon {
        width: 60px;
        height: 60px;
        background: var(--light-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--primary-color);
        font-size: 1.5rem;
    }
    
    .resources-section .resource-card h4 {
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .resources-section .resource-card p {
        color: var(--gray-dark);
        margin-bottom: 1.5rem;
    }
    
    .search-box .input-group {
        box-shadow: var(--shadow-md);
        border-radius: var(--border-radius);
        overflow: hidden;
    }
    
    .search-box .form-control {
        border: none;
        padding: 1rem 1.5rem;
        font-size: 1rem;
    }
    
    .search-box .btn-primary {
        padding: 1rem 2rem;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .guide-step {
            margin-bottom: 1.5rem;
        }
        
        .contact-support-section .row {
            text-align: center;
        }
        
        .contact-support-section .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Recherche dans la FAQ
    const searchInput = document.querySelector('.search-box input');
    const faqItems = document.querySelectorAll('.faq-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        faqItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            const parentAccordion = item.closest('.accordion-collapse');
            const accordionButton = parentAccordion ? 
                document.querySelector(`[data-bs-target="#${parentAccordion.id}"]`) : null;
            
            if (text.includes(searchTerm)) {
                item.style.display = 'block';
                // Ouvrir l'accordion si c'est fermé
                if (accordionButton && accordionButton.classList.contains('collapsed')) {
                    accordionButton.click();
                }
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Animation des éléments au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    // Observer les éléments
    document.querySelectorAll('.guide-step, .category-card, .resource-card').forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(element);
    });
    
    // Auto-expand FAQ si hash dans l'URL
    const hash = window.location.hash;
    if (hash) {
        const targetElement = document.querySelector(hash);
        if (targetElement && targetElement.classList.contains('accordion-collapse')) {
            const button = document.querySelector(`[data-bs-target="${hash}"]`);
            if (button && button.classList.contains('collapsed')) {
                setTimeout(() => button.click(), 300);
            }
        }
    }
    
    // Ajout de smooth scroll pour les liens internes
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
@endsection