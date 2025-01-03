@extends('layouts.partials.default-layout')

@section('content')

    <div class="  flex flex-col items-center">
        <!-- Bandeau supérieur -->
      <div class="bg-pink text-black py-10 w-full flex items-center">
    <!-- Photo à gauche -->
    <div class="flex-shrink-0 mr-8">
        <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}" class="w-40 h-40 rounded-full border-4 border-white">
    </div>
    
    <!-- Texte aligné en bas à droite -->
    <div class="flex flex-col justify-end">
        <h1 class="text-3xl font-bold">{{ $dogsitter->name }} {{ $dogsitter->prenom }}</h1>
    </div>
</div>

        <!-- Contenu en deux colonnes avec ligne de séparation -->
        <div class="flex flex-col md:flex-row w-full">
            <!-- Colonne de gauche -->
            <div class="w-full md:w-1/2 bg-gray p-6 md:pl-12">
                <h2 class="text-2xl font-semibold mb-4 text-black ">Informations personnelles</h2>
                <p class=" mb-2"><strong>Ville :</strong> {{ $dogsitter->ville }}</p>
                <p class=" mb-2"><strong>Disponibilité  :</strong> {{$dogsitter->disponibilite_jour }} </p>
                <form action="{{ route('messages.create', $dogsitter->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Me contacter
                    </button>
                </form>
                <p class=" mb-2"><strong> Nombre de notes :</strong> {{ $dogsitter->nb_notes }}</p>
                <p class=" mb-2"><strong> Note /5 :</strong> {{ $dogsitter->note_moyenne }}</p>
            </div>
    
            <!-- Ligne de séparation -->
            <div class="hidden md:block w-px bg-gray"></div>
    
            <!-- Colonne de droite -->
            <div class="w-full md:w-1/2 bg-green p-6 md:pl-12">
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