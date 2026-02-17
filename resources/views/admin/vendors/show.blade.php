@extends('admin.layouts.admin')

@section('page-title', 'Détail du vendeur - KondoMarket')

@section('admin-content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Détail du vendeur #{{ $vendor->id }}</h2>
        <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Informations générales</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>ID :</th>
                            <td>{{ $vendor->id }}</td>
                        </tr>
                        <tr>
                            <th>Type :</th>
                            <td>{{ $vendor->vendor_type == 'individual' ? 'Individuel' : 'Entreprise' }}</td>
                        </tr>
                        @if($vendor->vendor_type == 'individual')
                        <tr>
                            <th>Nom affiché :</th>
                            <td>{{ $vendor->display_name }}</td>
                        </tr>
                        <tr>
                            <th>Type d'activité :</th>
                            <td>{{ $vendor->activity_type }}</td>
                        </tr>
                        @else
                        <tr>
                            <th>Nom de la société :</th>
                            <td>{{ $vendor->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Catégorie :</th>
                            <td>{{ $vendor->company_category }}</td>
                        </tr>
                        <tr>
                            <th>SIRET :</th>
                            <td>{{ $vendor->siret ?? 'Non renseigné' }}</td>
                        </tr>
                        <tr>
                            <th>Adresse :</th>
                            <td>{{ $vendor->address ?? 'Non renseignée' }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Description :</th>
                            <td>{{ $vendor->description ?? 'Aucune description' }}</td>
                        </tr>
                        <tr>
                            <th>Téléphone :</th>
                            <td>{{ $vendor->phone }}</td>
                        </tr>
                        <tr>
                            <th>Ville / Pays :</th>
                            <td>{{ $vendor->city }}, {{ $vendor->country }}</td>
                        </tr>
                        <tr>
                            <th>Statut :</th>
                            <td>
                                @switch($vendor->status)
                                    @case('approved') <span class="badge bg-success">Approuvé</span> @break
                                    @case('pending_review') <span class="badge bg-warning">En attente</span> @break
                                    @case('suspended') <span class="badge bg-danger">Suspendu</span> @break
                                    @case('rejected') <span class="badge bg-dark">Rejeté</span> @break
                                    default: <span class="badge bg-secondary">{{ $vendor->status }}</span>
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Date d'inscription :</th>
                            <td>{{ $vendor->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Dernière mise à jour :</th>
                            <td>{{ $vendor->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Utilisateur associé</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>ID :</th>
                            <td>{{ $vendor->user->id }}</td>
                        </tr>
                        <tr>
                            <th>Nom :</th>
                            <td>{{ $vendor->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td>{{ $vendor->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Rôle :</th>
                            <td>{{ $vendor->user->role }}</td>
                        </tr>
                        <tr>
                            <th>Date création :</th>
                            <td>{{ $vendor->user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Documents</h6>
                </div>
                <div class="card-body">
                    @if($vendor->id_document_path)
                        <p><i class="bi bi-file-pdf"></i> <a href="{{ Storage::url($vendor->id_document_path) }}" target="_blank">Pièce d'identité</a></p>
                    @else
                        <p>Aucun document d'identité fourni.</p>
                    @endif
                    @if($vendor->address_proof_path)
                        <p><i class="bi bi-file-pdf"></i> <a href="{{ Storage::url($vendor->address_proof_path) }}" target="_blank">Justificatif de domicile</a></p>
                    @else
                        <p>Aucun justificatif de domicile fourni.</p>
                    @endif
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 fw-bold">Changer le statut</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.vendors.status', $vendor->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="status" class="form-select">
                                <option value="pending_review" {{ $vendor->status == 'pending_review' ? 'selected' : '' }}>En attente</option>
                                <option value="approved" {{ $vendor->status == 'approved' ? 'selected' : '' }}>Approuvé</option>
                                <option value="suspended" {{ $vendor->status == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                                <option value="rejected" {{ $vendor->status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection