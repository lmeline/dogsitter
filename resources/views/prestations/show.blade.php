@extends('layouts.partials.default-layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Détails de la Prestation</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="space-y-4">
                <p><strong class="font-semibold text-gray-700">numéro de la prestation:</strong> {{ $prestation->id }}</p>
                <p><strong class="font-semibold text-gray-700">Propriétaire:</strong> {{ $prestation->proprietaire->name }}</p>
                <p><strong class="font-semibold text-gray-700">Dogsitter:</strong> {{ $prestation->dogsitter->name }}</p>
                {{-- <p><strong class="font-semibold text-gray-700">Chien:</strong> {{ $prestation->dog->nom }}</p> --}}
                <p><strong class="font-semibold text-gray-700">Service:</strong> {{ $prestation->prestationType ? $prestation->prestationType->nom : 'N/A' }}</p>
                <p><strong class="font-semibold text-gray-700">Date de début:</strong> {{ $prestation->date_debut }}</p>
                <p><strong class="font-semibold text-gray-700">Date de fin:</strong> {{ $prestation->date_fin }}</p>
                <p><strong class="font-semibold text-gray-700">Statut:</strong> {{ $prestation->statut }}</p>
                <p><strong class="font-semibold text-gray-700">Prix:</strong> {{ $prestation->prix }} €</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('prestations.index') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600 transition duration-200">Retour à la liste</a>
            </div>
        </div>
    </div>
@endsection
