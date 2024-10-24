{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profil utilisateur</title>
</head>
<body>
    {{$user->name}} <br>
    {{$user->prenom }} <br>
    {{ $user->ville }} <br>
    {{ $user->description}} <br>
    {{ $user->experience }} <br>
    {{ $user->service }} <br>
    {{ $user->disponibilite_jour }} <br>
    {{ $user->note_moyenne }} <br>
    {{ $user->nb_notes }}
</body>
</html> --}}

@extends('layouts.defaultLayout')

@section('content')

    <div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-lg">
        <!-- En-tête avec Flexbox pour aligner le nom à gauche et la photo à droite -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }} {{ $user->prenom }}</h1>
            <!-- Image ronde à droite -->
            <img src="{{ $user->photo }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover"/>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Ville</h2>
            <p class="text-gray-600">{{ $user->ville }}</p>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
            <p class="text-gray-600">{{ $user->description }}</p>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Expérience</h2>
            <p class="text-gray-600">{{ $user->experience }}</p>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Services</h2>
            <p class="text-gray-600">{{ $user->service }}</p>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Disponibilité</h2>
            <p class="text-gray-600">{{ $user->disponibilite_jour }}</p>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Notes</h2>
            <p class="text-gray-600">Note Moyenne: {{ $user->note_moyenne }} / 5</p>
            <p class="text-gray-600">Nombre de Notes: {{ $user->nb_notes }}</p>
        </div>
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2"> Prendre rendez-vous </h2>
            <a href="{{ route('prestations.create', $user->id) }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-blue-50"> cliquez ici </a>
        </div>
    </div>

@endsection