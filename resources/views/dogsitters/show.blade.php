@extends('layouts.partials.defaultLayout')

@section('content')

    <div class="min-h-screen bg-gray-100 flex flex-col items-center">
        <!-- Bandeau supérieur -->
        <div class="bg-blue-600 text-white py-10 w-full flex items-center justify-center">
            <div class="text-center">
                <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}" class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-white">
                <h1 class="text-3xl font-bold">{{ $dogsitter->name }} {{ $dogsitter->prenom }}</h1>

                <p class="text-lg">Développeur Web | Passionné de technologie</p>
            </div>
        </div>
    
        <!-- Contenu en deux colonnes avec ligne de séparation -->
        <div class="flex flex-col md:flex-row w-full mt-8 px-8">
            <!-- Colonne de gauche -->
            <div class="w-full md:w-1/2 bg-gray-50 p-6 md:pr-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Informations personnelles</h2>
                <p class="text-gray-700 mb-2"><strong>Ville :</strong> {{ $dogsitter->ville }}</p>
                <p class="text-gray-700 mb-2"><strong>Disponibilité  :</strong> {{$dogsitter->disponibilite_jour }} </p>
                <p class="text-gray-700 mb-2"><strong>Contact :</strong> Envoyer un message </p>
                <p class="text-gray-700 mb-2"><strong> Nombre de notes :</strong> {{ $dogsitter->nb_notes }}</p>
                <p class="text-gray-700 mb-2"><strong> Note /5 :</strong> {{ $dogsitter->note_moyenne }}</p>
            </div>
    
            <!-- Ligne de séparation -->
            <div class="hidden md:block w-px bg-gray-300"></div>
    
            <!-- Colonne de droite -->
            <div class="w-full md:w-1/2 bg-white p-6 md:pl-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">À propos de moi</h2>
                <p class="text-gray-700 mb-4">
                    {{ $dogsitter->description }}
                </p>
                <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Expériences</h3>
                    <p class="text-gray-700 mb-4 ">{{ $dogsitter->experience }}</p>

                <h3 class="text-xl font-semibold mb-2 text-gray-800">Services</h3>
                <ul class="list-disc pl-6 text-gray-700 space-y-1">
                    <li>{{ $dogsitter->service }}</li>
                </ul>
                <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Prendre rendez-vous</h3>
                    <a href="{{ route('prestations.create', $dogsitter->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">cliquez ici</a>

                <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Avis clients</h3>
                @foreach ($prestations as $prestation)
                    @if($prestation->avis)
                    <h3>{{ $prestation->proprietaire->name.' '. $prestation->proprietaire->prenom.' '.$prestation->avis->created_at }}</h3>
                    <p class="text-gray-700 mb-4">{{ $prestation->avis->commentaire }}</p>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
    
@endsection