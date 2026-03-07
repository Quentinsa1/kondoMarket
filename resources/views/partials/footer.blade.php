<!-- ===== FOOTER MASSIF ===== -->
<footer class="footer">
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <h4 class="footer-section-title">À propos de aslazmarket</h4>
                <p class="footer-about">
                    aslazmarket est la marketplace B2B & B2C leader pour le commerce international. 
                    Nous connectons les acheteurs avec des fournisseurs vérifiés à travers le monde.
                </p>
                <div class="trust-badges">
                    <div class="trust-badge">
                        <i class="bi bi-shield-check"></i> Paiement sécurisé
                    </div>
                    <div class="trust-badge">
                        <i class="bi bi-truck"></i> Livraison mondiale
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h4 class="footer-section-title">Acheteurs</h4>
                <ul class="footer-links">
                    <li><a href="#">Rechercher des produits</a></li>
                    <li><a href="#">Trouver des fournisseurs</a></li>
                    <li><a href="#">Protection acheteur</a></li>
                    <li><a href="#">Comment acheter</a></li>
                    <li><a href="{{ route('help') }}">Centre d'aide</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h4 class="footer-section-title">Vendeurs</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('vendor.register') }}">Devenir vendeur</a></li>
                   
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h4 class="footer-section-title">Newsletter</h4>
                <p class="footer-about">
                    Recevez les dernières offres, nouveautés et conseils d'achat.
                </p>
                <div class="footer-newsletter">
                    <input type="email" class="newsletter-input" placeholder="Votre adresse email">
                    <button class="btn-newsletter">S'abonner</button>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="mb-3 mb-md-0">
                        &copy; 2024 aslazmarket. Tous droits réservés.
                        <a href="{{ route('confidentiality') }}" class="text-white ms-3">Confidentialité</a> | 
                        <a href="#" class="text-white">Conditions</a>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="payment-methods">
                        <div class="payment-method">Visa</div>
                        <div class="payment-method">MoMo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>