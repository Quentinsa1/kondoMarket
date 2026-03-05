@extends('admin.layouts.admin') <!-- ton layout que tu as fourni -->

@section('page-title', 'Liste des Vendeurs')

@section('admin-content')
    <h1 class="mb-4">Liste des Vendeurs</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td>{{ $vendor->display_name ?? $vendor->company_name }}</td>
                    <td>{{ $vendor->user->email }}</td>
                    <td>{{ ucfirst($vendor->status) }}</td>
                    <td>
                        <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="btn btn-sm btn-info">Voir</a>
                        <form action="{{ route('admin.vendors.status', $vendor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                {{ $vendor->status === 'approved' ? 'Désactiver' : 'Valider' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $vendors->links() }} <!-- Pagination -->
@endsection