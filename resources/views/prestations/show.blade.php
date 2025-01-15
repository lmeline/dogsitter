@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Détails de la Prestation</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="space-y-4">
                @if(Auth::user()->role === 'dogsitter')
                    <p><strong class="font-semibold text-gray-700">numéro de la prestation:</strong> {{ $prestation->id }}</p>
                    <p><strong class="font-semibold text-gray-700">Propriétaire:</strong> {{ $prestation->proprietaire->name }}</p>
                @endif
                @if(Auth::user()->role === 'proprietaire')
                    <p><strong class="font-semibold text-gray-700">Dogsitter:</strong> {{ $prestation->dogsitter->name }}</p>
                @endif
                <p><strong class="font-semibold text-gray-700">Chiens:</strong>
                    @foreach($prestation->prestationDogs as $prestationDog)
                       {{ $prestationDog->dog->nom }}
                    @endforeach
                </p>
                <p><strong class="font-semibold text-gray-700">Service:</strong> {{ $prestation->prestationType ? $prestation->prestationType->nom : 'N/A' }}</p>
                <p><strong class="font-semibold text-gray-700">Date de début:</strong> {{ $prestation->formatted_date_debut }}</p>
                <p><strong class="font-semibold text-gray-700">Date de fin:</strong> {{ $prestation->formatted_date_fin }}</p>
                <p><strong class="font-semibold text-gray-700">Statut:</strong> {{ $prestation->statut }}</p>
                <p><strong class="font-semibold text-gray-700">Prix:</strong>
                    @foreach($prestation->prestationDogs as $prestationDog)
                        {{ $prestationDog->prix }} €
                    @endforeach
                </p>
            </div>

            <div class="mt-6">
                <a href="{{ route('myprestations') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600 transition duration-200">Retour aux Prestations</a>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
