@extends('template.template')

@section('title', 'Centre d\'aide - aslazmarket')

@section('content')
<div class="help-page">
    <!-- En-tête simple -->
    <section class="hero-transactional py-4">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-5 fw-bold text-primary mb-3">Comment pouvons-nous vous aider ?</h1>
                    <p class="lead text-muted">Retrouvez toutes les réponses à vos questions ou contactez directement un vendeur.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cartes de contact (Mail, WhatsApp, Appel) -->
    <section class="py-5">
        <div class="container-xxl">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <div class="display-4 text-primary mb-3">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <h3 class="h5 fw-bold">Email</h3>
                            <p class="text-muted small">Posez votre question par écrit, réponse sous 24h.</p>
                            <a href="mailto:support@aslazmarket.com" class="btn btn-outline-primary rounded-pill px-4">Envoyer un mail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <div class="display-4 text-success mb-3">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <h3 class="h5 fw-bold">WhatsApp</h3>
                            <p class="text-muted small">Discutez instantanément avec un conseiller.</p>
                            <a href="https://wa.me/1234567890" class="btn btn-outline-success rounded-pill px-4" target="_blank">Démarrer la discussion</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <div class="display-4 text-warning mb-3">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <h3 class="h5 fw-bold">Appel direct</h3>
                            <p class="text-muted small">Parlez à un conseiller du lundi au vendredi, 9h-18h.</p>
                            <a href="tel:+33123456789" class="btn btn-outline-warning rounded-pill px-4">Appeler maintenant</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ (accordéon) -->
    <section class="py-5 bg-light">
        <div class="container-xxl">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="bi bi-question-circle"></i> Questions fréquentes
                </h2>
                <a href="#" class="view-all-link">Voir tout <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <!-- Question 1 -->
                        <div class="accordion-item border-0 mb-3 shadow-sm">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed bg-white text-dark fw-bold rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Comment contacter un vendeur ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sur chaque fiche produit, cliquez sur le bouton <strong>« Contacter le vendeur »</strong>. Vous pourrez ensuite échanger par message interne, WhatsApp ou téléphone selon les coordonnées partagées par le vendeur.
                                </div>
                            </div>
                        </div>
                        <!-- Question 2 -->
                        <div class="accordion-item border-0 mb-3 shadow-sm">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed bg-white text-dark fw-bold rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Quels sont les profils de vendeurs ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Trois types de vendeurs coexistent : <strong>particuliers</strong> (vente occasionnelle), <strong>services</strong> (prestations, artisanat) et <strong>boutiques</strong> (professionnels, revendeurs). Chaque profil est clairement identifié sur les annonces.
                                </div>
                            </div>
                        </div>
                        <!-- Question 3 -->
                        <div class="accordion-item border-0 mb-3 shadow-sm">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed bg-white text-dark fw-bold rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Les tarifs affichés sont-ils négociables ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Oui, la plupart des vendeurs acceptent la négociation. Utilisez la messagerie pour discuter du prix directement avec le vendeur.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulaire de contact support -->
    <section class="py-5">
        <div class="container-xxl">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm p-4">
                        <div class="card-body">
                            <h3 class="h4 fw-bold mb-4">Envoyer un message à l'équipe support</h3>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nom complet</label>
                                        <input type="text" class="form-control" id="name" placeholder="Votre nom">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="vous@exemple.com">
                                    </div>
                                    <div class="col-12">
                                        <label for="subject" class="form-label">Sujet</label>
                                        <input type="text" class="form-control" id="subject" placeholder="Objet de votre demande">
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" rows="5" placeholder="Décrivez votre problème..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-5 py-2">Envoyer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Badges de confiance -->
    <section class="pb-5">
        <div class="container-xxl">
            <div class="trust-badges justify-content-center">
                <span class="trust-badge"><i class="bi bi-shield-check"></i> Paiement sécurisé</span>
                <span class="trust-badge"><i class="bi bi-truck"></i> Livraison suivie</span>
                <span class="trust-badge"><i class="bi bi-chat-dots"></i> Support 24/7</span>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@endpush