@extends('layouts.partials.default-layout')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Choisissez un abonnement</h2>

    <div class="row">
        @foreach($abonnements_types as $abonnement)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h3>{{ $abonnement->nom }}</h3>
                        <p>Prix : {{ $abonnement->prix }} €</p>
                        
                        <form method="POST" action="{{ route('abonnements.choose') }}">
                            @csrf
                            <input type="hidden" name="abonnements_types_id" value="{{ $abonnement->id }}">
                            <button type="submit" class="btn btn-primary">Choisir</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
