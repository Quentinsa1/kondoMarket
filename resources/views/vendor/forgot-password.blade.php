@extends('template.template')

@section('title', 'Mot de passe oublié - Kondo Market')

@section('navbar')
    @include('partials.public-header')
@endsection

@section('content')
<section class="forgot-password-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="password-reset-icon mb-3">
                                <i class="bi bi-key"></i>
                            </div>
                            <h2 class="h4 mb-2">Mot de passe oublié</h2>
                            <p class="text-muted">Entrez votre email pour recevoir un lien de réinitialisation</p>
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
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('seller.password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email vendeur *</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="vendeur@exemple.com" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-1"></i> Envoyer le lien
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('seller.login') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left me-1"></i> Retour à la connexion
                                </a>
                            </div>
                        </form>

                        <div class="mt-4">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Important :</strong> Le lien de réinitialisation est valable 1 heure.
                                Vérifiez également votre dossier spam.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .forgot-password-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
    }

    .password-reset-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary-color), #4bbfaa);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: white;
        font-size: 32px;
        box-shadow: 0 4px 12px rgba(47, 143, 131, 0.3);
    }

    .card {
        border-radius: var(--border-radius);
    }
</style>
@endsection