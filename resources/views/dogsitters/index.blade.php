@extends('layouts.depart-layout')

@section('content')

    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Liste des Dogsitters</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ( $dogsitters as $dogsitter )
            <a href="{{ route('dogsitters.show', $dogsitter->id) }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-blue-50">
                <div class="flex items-center">
                    <!-- Texte avec nom et prénom -->
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                            {{ $dogsitter->name }} {{ $dogsitter->prenom }}
                        </h2>
                    </div>
                    <!-- Image ronde -->
                    <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}" class="w-24 h-24 rounded-full object-cover ml-4"/>
                </div>
            
                <!-- Informations supplémentaires -->
                <p class="text-gray-600 mt-2">Ville: {{ $dogsitter->ville }}</p>
                <p class="text-gray-600">Note moyenne: {{ $dogsitter->note_moyenne }}/5 </p>
                <p class="text-gray-600">Expérience: {{ $dogsitter->experience }} ans</p>
            </a>
            
            </a>
            @endforeach
            
        </div>
    </div>
   
@endsection
