@extends('template.template')

@section('title', 'Réinitialisation mot de passe - Kondo Market')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Mot de passe oublié</h2>
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('seller.password.email') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            Envoyer le lien de réinitialisation
                        </button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('seller.login') }}">Retour à la connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection