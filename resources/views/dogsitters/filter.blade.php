@extends('layouts.partials.default-layout')

@section('content')
    <x-app-layout>
        <div class="container mx-auto py-6">
            <h2 class="text-2xl font-semibold text-gray-800">Tous les Dogsitters</h2>

            <!-- Formulaire de filtre -->
            <form method="GET" action="{{ route('dogsitters.index') }}" class="mb-6">
                <div class="flex items-center space-x-4">
                    <!-- Filtre de localisation -->
                    <div class="flex-1">
                        <label for="ville" class="block text-gray-700">Ville</label>
                        <select name="ville" id="ville" class="w-full border border-gray-300 rounded-lg p-3">
                            <option value="">Toutes les villes</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville }}" @if(request('ville') == $ville) selected @endif>
                                    {{ $ville }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtre de tarif -->
                    <div class="flex-1">
                        <label for="tarif_min" class="block text-gray-700">Tarif Minimum (€)</label>
                        <input type="number" name="tarif_min" id="tarif_min" value="{{ request('tarif_min') }}" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Ex: 10">
                    </div>

                    <div class="flex-1">
                        <label for="tarif_max" class="block text-gray-700">Tarif Maximum (€)</label>
                        <input type="number" name="tarif_max" id="tarif_max" value="{{ request('tarif_max') }}" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Ex: 50">
                    </div>

                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-gradient-to-r from-yellow-300 to-pink-300 text-white px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                            Filtrer
                        </button>
                    </div>
                </div>
            </form>

            <!-- Affichage des dogsitters -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($dogsitters as $dogsitter)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}" class="w-32 h-32 rounded-full mx-auto mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $dogsitter->name }} {{ $dogsitter->prenom }}</h3>
                        <p class="text-gray-500">Ville : {{ $dogsitter->ville }}</p>
                        <p class="text-gray-500">Tarif : {{ $dogsitter->prestationtypes->first()->pivot->prix }}€</p>
                        <a href="{{ route('dogsitters.show', $dogsitter->id) }}" class="mt-4 text-blue-500 hover:underline">Voir le profil</a>
                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
@endsection
