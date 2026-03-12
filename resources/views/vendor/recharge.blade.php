@extends('template.template')

@section('content')

<div class="container py-5">

<h3>Recharger mon compte</h3>

<form action="{{ route('wallet.recharge') }}" method="POST">
@csrf

<div class="mb-3">
<label>Montant (FCFA)</label>
<input type="number" name="amount" class="form-control" required>
</div>

<button class="btn btn-primary">
Recharger maintenant
</button>

</form>

</div>

@endsection