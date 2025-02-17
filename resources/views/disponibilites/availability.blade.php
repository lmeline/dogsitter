@extends('layouts.partials.default-layout')

@section('content')
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Mes disponibilités</h2>
            
            <div class=" bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto">
                <form action="{{ route('disponibilites.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="dogsitter_id" value="{{ auth()->id() }}">

                    <!-- Jour de la semaine -->
                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Jour :</label>
                        <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" name="jour_semaine" required>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                            <option value="Dimanche">Dimanche</option>
                        </select>
                    </div>

                    <!-- Heure de début -->
                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Heure de début :</label>
                        <input class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" type="time" name="heure_debut" required>
                    </div>

                    <!-- Heure de fin -->
                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Heure de fin :</label>
                        <input class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" type="time" name="heure_fin" required>
                    </div>

                    <!-- Bouton d'enregistrement -->
                    <div class="mb-6 text-center">
                        <button type="submit" class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black font-semibold py-3 px-4 rounded-lg hover:bg-pink-600 transition-all duration-300">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>

           {{-- pop-up --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-md mt-8 max-w-lg mx-auto">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 text-yellow-700 p-4 rounded-md mt-8 max-w-lg mx-auto">
                    <strong>Attention :</strong> {{ session('warning') }}
                </div>
            @endif
        </div>
    </x-app-layout>
@endsection
