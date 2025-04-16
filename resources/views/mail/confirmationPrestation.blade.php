@extends('layouts.app')

@section('title', 'Confirmation de réservation')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h2 class="mb-4 text-success">🎉 Réservation confirmée !</h2>

            <p class="lead">Merci <strong>{{ Auth::user()->name }}</strong> pour votre réservation.</p>

            <div class="mt-4 mb-3">
                <h4>Détails de la prestation :</h4>
                <ul class="list-group list-group-flush text-start mt-3">
                    <li class="list-group-item">
                        <strong>Prestation :</strong> {{ $prestation->prestation_type_id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Date et Heure :</strong> {{$prestation->date_debut}} - {{ $prestation->date_fin }}
                    </li>
                    <li class="list-group-item">
                        <strong>Dog Sitter :</strong> {{ $prestation->dogsitter_id}}
                    </li>
                </ul>
            </div>

            <div class="mt-4">
                <a href="{{ route('proprietaires.mesprestations') }}" class="btn btn-primary">Retour au tableau de bord</a>
            </div>
        </div>
    </div>
</div>
@endsection
