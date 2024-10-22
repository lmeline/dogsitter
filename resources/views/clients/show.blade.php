@extends('layouts.defaultLayout')

@section('content')

    <div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">
        <!-- En-tête avec Flexbox pour aligner le nom à gauche et la photo à droite -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">{{ $client->name }} {{ $client->prenom }}</h1>
            <!-- Image ronde à droite -->
            <img src="{{ $client->photo }}" alt="{{ $client->name }}" class="w-24 h-24 rounded-full object-cover"/>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Nom du chien</h2>
            @foreach ( $client->dogs as $dog)
            <p class="text-gray-600">{{ $dog->nom }}</p>
            @endforeach
            
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Ville</h2>
            <p class="text-gray-600">{{ $client->ville }}</p>
        </div>
    
    </div>
@endsection
