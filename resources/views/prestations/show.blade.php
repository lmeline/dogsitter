@extends('layouts.partials.default-layout')

@section('content')
    <div class="container">
        <h1>Détails de la Prestation</h1>
        
        <p><strong>ID:</strong> {{ $prestation->id }}</p>
        <p><strong>Propriétaire:</strong> {{ $prestation->proprietaire->name }}</p>
        <p><strong>Dogsitter:</strong> {{ $prestation->dogsitter->name }}</p>
        {{-- <p><strong>Chien:</strong> {{ $prestation->dog->nom }}</p> --}}
        <p><strong>Service:</strong> {{ $prestation->service ? $prestation->service->nom : 'N/A' }}</p>
        <p><strong>Date de début:</strong> {{ $prestation->date_debut }}</p>
        <p><strong>Date de fin:</strong> {{ $prestation->date_fin }}</p>
        <p><strong>Statut:</strong> {{ $prestation->statut }}</p>
        <p><strong>Prix:</strong> {{ $prestation->prix }} €</p>

        <!-- Ajoutez ici d'autres informations ou des actions supplémentaires -->
        <a href="{{ route('prestations.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
@endsection
