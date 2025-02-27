@extends('layouts.partials.default-layout')

@section('content')

    <form action="{{ route('prestations.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto" id="appointment-form">
        @csrf
        <input type="hidden" name="dogsitter_id" value="{{ $dogsitter->id }}"/>

        <!-- Date et Heure Disponibles -->
        <div class="mb-6">
            <label for="date_disponibilite" class="block text-gray-700 font-bold mb-2">
                Date et heure disponibles
            </label>
            <select id="date_debut" name="date_debut" class="block mt-1 w-full rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Sélectionnez une date et une heure</option>
                @foreach ($disponibilites as $disponibilite)
                    <option value="{{ $disponibilite->date }} {{ $disponibilite->heure_debut }}">
                        📅 {{ $disponibilite->date }} 🕒 {{ $disponibilite->heure_debut }}
                    </option>
                @endforeach
            </select>

            <select id="date_fin" name="date_fin" class="block mt-1 w-full rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Sélectionnez une date et une heure</option>
                @foreach ($disponibilites as $disponibilite)
                    <option value="{{ $disponibilite->date }} {{ $disponibilite->heure_debut }}">
                        📅 {{ $disponibilite->date }} 🕒 {{ $disponibilite->heure_fin }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Type de Prestation -->
        <div class="mb-6">
            <label for="prestation_type_id" class="block font-bold mb-2">Type de service</label>
            <select id="prestation_type_id" name="prestation_type_id" class="block mt-1 w-full border rounded-lg border-yellow-300 focus:ring-yellow-500 focus:border-yellow-500" required>
                <option value="">Sélectionner un service</option>
                @foreach ($dogsitter->prestationtypes as $type)
                    <option value="{{ $type->id }}">{{ $type->nom }} - {{ $type->pivot->prix }}€</option>
                @endforeach
            </select>
        </div>

        <!-- Sélection du Chien -->
        <div class="mb-6">
            <label for="dog" class="block font-bold mb-2">Choix du chien</label>
            <select id="dog" name="dog" class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                <option value="">Sélectionner un chien</option>
                @foreach(Auth::user()->dogs as $dog)
                    <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" class="ms-4 p-4 rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-200 dark:focus:ring-yellow-700">
                Prendre Rendez-vous
            </button>
        </div>
    </form>
@endsection