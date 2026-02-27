@extends('superadmin.layouts.admin')

@section('page-title', 'Activités de ' . $admin->name)

@section('admin-content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Activités de {{ $admin->name }}</h2>
        <a href="{{ route('superadmin.admins.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h5>Dernières connexions</h5>
        </div>
        <div class="card-body">
            @if($admin->last_login_at)
                <p><strong>Dernière connexion :</strong> {{ $admin->last_login_at->format('d/m/Y H:i:s') }}</p>
                <p><strong>Adresse IP :</strong> {{ $admin->last_login_ip }}</p>
            @else
                <p>Cet administrateur ne s'est jamais connecté.</p>
            @endif

            <hr>
            <p class="text-muted">D'autres activités (modifications, actions) pourront être ajoutées ultérieurement.</p>
        </div>
    </div>
</div>
@endsection