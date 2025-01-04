@extends('layouts.partials.default-layout')

@section('content')
<div class="flex flex-col items-center bg-gradient-to-br from-yellow-50 via-pink-50 to-green-50">

    <!-- Bandeau supérieur avec photo et nom -->
    <div class="bg-gradient-to-r from-yellow-200 to-pink-300 w-full py-12 flex items-center justify-center flex-col">
        <div class="flex-shrink-0 mb-6">
            <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}" class="w-40 h-40 rounded-full border-4 border-white">
        </div>
        <h1 class="text-4xl font-semibold text-gray-800">{{ $dogsitter->name }} {{ $dogsitter->prenom }}</h1>
        <p class="mt-2 text-lg text-gray-700">{{ $dogsitter->role }}</p>
    </div>

    <!-- Contenu du profil (informations personnelles à gauche, à propos à droite) -->
    <div class="flex flex-col md:flex-row w-full max-w-6xl mx-auto mt-12 px-6">

        <!-- Colonne de gauche : Informations personnelles -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg mb-6 md:mb-0 md:mr-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informations personnelles</h2>
            <p class="text-gray-700 mb-2"><strong>Ville :</strong> {{ $dogsitter->ville }}</p>
            <p class="text-gray-700 mb-2"><strong>Disponibilité :</strong> {{ $dogsitter->disponibilite_jour }}</p>
            <p class="text-gray-700 mb-2"><strong>Nombre de notes :</strong> {{ $dogsitter->nb_notes }}</p>
            <p class="text-gray-700 mb-4"><strong>Note moyenne :</strong> {{ $dogsitter->note_moyenne }} / 5</p>

            <!-- Formulaire de contact -->
            <form action="{{ route('messages.create', $dogsitter->id) }}" method="GET">
                @csrf
                <button type="submit" class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-white px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                    Me contacter
                </button>
            </form>
        </div>

        <!-- Colonne de droite : À propos et services -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">À propos de moi</h2>
            <p class="text-gray-700 mb-6">{{ $dogsitter->description }}</p>

            <h3 class="text-xl font-semibold text-gray-800 mb-4">Expériences</h3>
            <p class="text-gray-700 mb-6">{{ $dogsitter->experience }}</p>

            {{-- <h3 class="text-xl font-semibold text-gray-800 mb-4">Services</h3>
            <ul class="list-disc pl-6 text-gray-700">
                <li>{{ $dogsitter->service }}</li>
            </ul> --}}

            <h3 class="text-xl font-semibold text-gray-800 mb-4">Services</h3>
            <ul class="list-disc pl-6 text-gray-700">
                @foreach($dogsitter->prestationtypes as $prestationType)
                    <li>{{ $prestationType->nom }} - {{ $prestationType->pivot->prix }} €</li>
                @endforeach
            </ul>

            
            <h3 class="text-xl font-semibold text-gray-800 mb-4 pt-6">Prendre rendez-vous</h3>
            <a href="{{ route('prestations.create', $dogsitter->id) }}" class="inline-block bg-gradient-to-r from-yellow-300 to-pink-300 text-white px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                Cliquez ici pour prendre rendez-vous
            </a>

            <h3 class="text-xl font-semibold text-gray-800 mb-4 pt-6">Avis clients</h3>
            @foreach ($prestations as $prestation)
                @if($prestation->avis)
                    <div class="border-t border-gray-300 pt-4 mt-4">
                        <h4 class="font-semibold text-gray-800">{{ $prestation->proprietaire->name.' '.$prestation->proprietaire->prenom }}</h4>
                        <p class="text-gray-700">{{ $prestation->avis->commentaire }}</p>
                        <p class="text-gray-500 text-sm">{{ $prestation->avis->created_at->format('d M Y') }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

</div>
@endsection
