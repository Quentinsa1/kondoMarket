@extends('template.template')

@section('title', 'Connexion Vendeur - Kondo Market')

@section('content')
<!-- ===== SECTION : CONNEXION VENDEUR ===== -->
<section class="seller-login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-card">
                    <div class="login-header text-center mb-4">
                        <div class="login-logo">
                            <i class="bi bi-shop-window"></i>
                        </div>
                        <h1 class="h3 mb-2">Connexion Vendeur</h1>
                        <p class="text-muted">Accédez à votre espace vendeur</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            {!! session('error') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('seller.login.submit') }}" id="sellerLoginForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope me-1"></i> Adresse email *
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="votre@email.com" 
                                           required
                                           autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-lock me-1"></i> Mot de passe *
                                        </label>
                                        <a href="{{ route('seller.password.request') }}" class="small text-decoration-none">
                                            Mot de passe oublié ?
                                        </a>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Votre mot de passe" 
                                               required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="remember" 
                                               id="remember" 
                                               {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Se souvenir de moi
                                        </label>
                                    </div>
                                </div>

                                <!-- Google reCAPTCHA (optionnel) -->
                                @if(config('services.recaptcha.site_key'))
                                    <div class="mb-3">
                                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                        @error('g-recaptcha-response')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg" id="loginButton">
                                        <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
                                    </button>
                                </div>

                                <div class="text-center">
                                    <div class="small mb-3">Ou connectez-vous avec</div>
                                    <div class="d-flex justify-content-center gap-3 mb-3">
                                        @if(config('services.google.client_id'))
                                            <a href="{{ route('seller.login.google') }}" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-google me-1"></i> Google
                                            </a>
                                        @endif
                                        @if(config('services.facebook.client_id'))
                                            <a href="{{ route('seller.login.facebook') }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-facebook me-1"></i> Facebook
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-2">Vous n'avez pas de compte vendeur ?</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('vendor.register.form') }}" class="btn btn-success">
                                <i class="bi bi-person-plus me-1"></i> S'inscrire comme vendeur
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-link text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Retour à l'accueil
                            </a>
                        </div>
                    </div>

                    <!-- Statistiques sécurité -->
                    <div class="security-info mt-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="bi bi-shield-check text-primary mb-2" style="font-size: 1.5rem;"></i>
                                <p class="small mb-0">
                                    <strong>Sécurité garantie</strong><br>
                                    Connexion chiffrée SSL • Authentification sécurisée
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .seller-login-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
    }

    .login-card {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), #4bbfaa);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 36px;
        box-shadow: 0 4px 15px rgba(47, 143, 131, 0.3);
    }

    .login-header h1 {
        color: var(--secondary-color);
        font-weight: 700;
    }

    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .form-control {
        padding: 12px 16px;
        border: 1px solid var(--gray-light);
        border-radius: var(--border-radius);
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(245, 158, 66, 0.1);
    }

    .btn-primary {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
        padding: 12px 24px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background-color: #e6892a;
        border-color: #e6892a;
        transform: translateY(-2px);
    }

    .btn-success {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-success:hover {
        background-color: #258f7f;
        border-color: #258f7f;
    }

    .input-group .btn-outline-secondary {
        border-color: var(--gray-light);
    }

    .input-group .btn-outline-secondary:hover {
        background-color: var(--light-color);
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .security-info .card {
        background-color: rgba(47, 143, 131, 0.05);
        border: 1px solid rgba(47, 143, 131, 0.1);
    }

    .alert {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--shadow-sm);
    }

    @media (max-width: 768px) {
        .seller-login-section {
            padding: 2rem 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        .login-logo {
            width: 60px;
            height: 60px;
            font-size: 28px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Changer l'icône
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    }

    // Form validation
    const loginForm = document.getElementById('sellerLoginForm');
    const loginButton = document.getElementById('loginButton');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            // Afficher le spinner
            const spinner = loginButton.querySelector('.spinner-border');
            const icon = loginButton.querySelector('.bi-box-arrow-in-right');
            
            if (spinner) spinner.classList.remove('d-none');
            if (icon) icon.classList.add('d-none');
            
            // Désactiver le bouton
            loginButton.disabled = true;
            loginButton.innerHTML = 'Connexion en cours...';
        });
    }

    // Auto-focus on email field
    const emailField = document.getElementById('email');
    if (emailField && !emailField.value) {
        emailField.focus();
    }

    // Clear errors on input
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }
        });
    });

    // Rate limiting warning
    const failedAttempts = localStorage.getItem('seller_login_attempts') || 0;
    if (failedAttempts > 2) {
        const warning = document.createElement('div');
        warning.className = 'alert alert-warning alert-dismissible fade show mt-3';
        warning.innerHTML = `
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Attention :</strong> Plusieurs tentatives de connexion ont échoué. 
            Vérifiez vos identifiants ou réinitialisez votre mot de passe.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.login-card').prepend(warning);
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + Enter pour soumettre le formulaire
        if (e.ctrlKey && e.key === 'Enter') {
            if (loginForm) loginForm.submit();
        }
        
        // Escape pour effacer le formulaire
        if (e.key === 'Escape') {
            loginForm.reset();
        }
    });

    // Analytics (optionnel)
    function trackLoginAttempt() {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'seller_login_attempt', {
                'event_category': 'Authentication',
                'event_label': 'Seller Login Form'
            });
        }
    }

    // Track on form submit
    if (loginForm) {
        loginForm.addEventListener('submit', trackLoginAttempt);
    }

    // Prevent form resubmission on refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
});
</script>

@if(config('services.recaptcha.site_key'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

@endsection