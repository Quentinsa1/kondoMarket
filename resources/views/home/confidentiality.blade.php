@extends('template.template')

@section('title', 'Politique de confidentialité - aslazmarket')

@section('content')
<div class="privacy-page">
    <!-- En-tête de la page -->
    <section class="hero-transactional py-4">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-5 fw-bold text-primary mb-3">Politique de confidentialité</h1>
                    <p class="lead text-muted">Nous prenons la protection de vos données personnelles très au sérieux.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="py-5">
        <div class="container-xxl">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card border-0 shadow-sm p-4 p-lg-5">
                        <div class="card-body">
                            <!-- Introduction -->
                            <h2 class="h4 fw-bold text-primary mb-3">1. Introduction</h2>
                            <p class="text-muted mb-4">
                                La présente politique de confidentialité décrit comment aslazmarket (ci-après « nous », « notre » ou « nos ») collecte, utilise et protège les informations que vous nous fournissez lorsque vous utilisez notre site web et nos services. Nous nous engageons à garantir que votre vie privée est protégée.
                            </p>

                            <!-- Données collectées -->
                            <h2 class="h4 fw-bold text-primary mb-3">2. Données que nous collectons</h2>
                            <p class="text-muted mb-3">Nous pouvons collecter les informations suivantes :</p>
                            <ul class="text-muted mb-4">
                                <li>Nom et prénom</li>
                                <li>Adresse email</li>
                                <li>Numéro de téléphone</li>
                                <li>Adresse de livraison et de facturation</li>
                                <li>Informations de paiement (traitées par des prestataires sécurisés)</li>
                                <li>Données de navigation (cookies, adresse IP, type d’appareil)</li>
                            </ul>

                            <!-- Utilisation des données -->
                            <h2 class="h4 fw-bold text-primary mb-3">3. Utilisation de vos données</h2>
                            <p class="text-muted mb-3">Nous utilisons vos informations pour :</p>
                            <ul class="text-muted mb-4">
                                <li>Fournir et gérer nos services (inscription, achats, messagerie)</li>
                                <li>Personnaliser votre expérience sur le site</li>
                                <li>Vous contacter concernant vos commandes ou demandes</li>
                                <li>Améliorer notre site et nos offres</li>
                                <li>Respecter nos obligations légales</li>
                            </ul>

                            <!-- Cookies -->
                            <h2 class="h4 fw-bold text-primary mb-3">4. Cookies</h2>
                            <p class="text-muted mb-4">
                                Notre site utilise des cookies pour améliorer votre expérience de navigation. Les cookies sont de petits fichiers texte stockés sur votre appareil. Vous pouvez configurer votre navigateur pour refuser les cookies, mais cela peut limiter certaines fonctionnalités du site.
                            </p>

                            <!-- Partage des données -->
                            <h2 class="h4 fw-bold text-primary mb-3">5. Partage de vos données</h2>
                            <p class="text-muted mb-4">
                                Nous ne vendons, n’échangeons ni ne transférons vos données personnelles à des tiers sans votre consentement, sauf dans les cas suivants : prestataires de services (paiement, livraison, analyse) qui nous aident à exploiter notre site, ou lorsque la loi l’exige.
                            </p>

                            <!-- Sécurité -->
                            <h2 class="h4 fw-bold text-primary mb-3">6. Sécurité</h2>
                            <p class="text-muted mb-4">
                                Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles pour protéger vos données contre tout accès non autorisé, modification, divulgation ou destruction. Cependant, aucune transmission de données sur Internet n’est totalement sécurisée.
                            </p>

                            <!-- Vos droits -->
                            <h2 class="h4 fw-bold text-primary mb-3">7. Vos droits</h2>
                            <p class="text-muted mb-3">
                                Conformément à la réglementation applicable (notamment le RGPD), vous disposez des droits suivants :
                            </p>
                            <ul class="text-muted mb-4">
                                <li>Droit d’accès, de rectification et d’effacement de vos données</li>
                                <li>Droit à la limitation du traitement</li>
                                <li>Droit d’opposition au traitement</li>
                                <li>Droit à la portabilité de vos données</li>
                                <li>Droit de retirer votre consentement à tout moment</li>
                            </ul>
                            <p class="text-muted mb-4">
                                Pour exercer ces droits, contactez-nous à l’adresse : <a href="mailto:privacy@aslazmarket.com" class="text-primary">privacy@aslazmarket.com</a>.
                            </p>

                            <!-- Modifications -->
                            <h2 class="h4 fw-bold text-primary mb-3">8. Modifications de cette politique</h2>
                            <p class="text-muted mb-4">
                                Nous pouvons mettre à jour cette politique de confidentialité de temps à autre. Nous vous invitons à consulter régulièrement cette page pour prendre connaissance des éventuelles modifications.
                            </p>

                            <!-- Contact -->
                            <h2 class="h4 fw-bold text-primary mb-3">9. Contact</h2>
                            <p class="text-muted">
                                Si vous avez des questions concernant cette politique, vous pouvez nous écrire à :<br>
                                <strong>aslazmarket</strong><br>
                                <br>
                                Contact: <a href="tel:+2290154936191">+2290154936191</a><br>
                                Email : <a href="mailto:support@aslazmarket.com" class="text-primary">support@aslazmarket.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Badges de confiance (optionnel) -->
    <section class="pb-5">
        <div class="container-xxl">
            <div class="trust-badges justify-content-center">
                <span class="trust-badge"><i class="bi bi-shield-check"></i> Données protégées</span>
                <span class="trust-badge"><i class="bi bi-lock-fill"></i> Chiffrement SSL</span>
                <span class="trust-badge"><i class="bi bi-file-earmark-lock-fill"></i> Conforme RGPD</span>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- Aucun script spécifique requis pour cette page -->
@endpush