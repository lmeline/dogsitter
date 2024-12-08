@extends('layouts.partials.default-layout')

@section('content')
    <div class="container mx-auto py-10">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-blue-600 mb-4">Propriétaire du Chien</h1>
                
                <!-- Nom de l'utilisateur/propriétaire -->
                <p class="text-lg font-semibold text-gray-700 mb-2">
                    Propriétaire : {{ $dog->user->name }}
                </p>

                <!-- Informations supplémentaires sur le propriétaire (ajout optionnel) -->
                <p class="text-gray-600 mb-4">Email : {{ $dog->user->email }}</p>
                <p class="text-gray-600 mb-4">Ville : {{ $dog->user->ville }}</p>

                <!-- Informations sur le chien -->
                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-blue-500">Informations sur le Chien</h2>
                    <p class="text-gray-600 mt-2">Nom : {{ $dog->nom }}</p>
                    <p class="text-gray-600 mt-2">Race : {{ $dog->race }}</p>
                    <p class="text-gray-600 mt-2">Âge : {{ $dog->age }} ans</p>
                </div>
            </div>
        </div>
    </div>
@endsection