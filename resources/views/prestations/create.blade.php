@extends('layouts.partials.default-layout')
@section('content')
    <x-guest-layout>

        <div class="container mx-auto py-10 text-black">
            <h1 class="text-4xl font-bold text-center text-black mb-10">Prise de Rendez-vous avec {{ $dogsitter->name }}</h1>

            <!-- Formulaire de rendez-vous -->
            <form action="{{ route('prestations.store') }}" method="POST" class="bg-green p-8 rounded-lg shadow-md max-w-lg mx-auto" id="appointment-form">
                @csrf
                <input type="hidden" name="dogsitter_id" value="{{ $dogsitter->id }}"/>
                <!-- Date et heure de début -->
                <div class="mb-6">
                    <label for="date_debut" class="block text-gray-700 font-bold mb-2">Date et heure de début</label>
                    <select id="date_debut" name="date_debut" 
                        class="block mt-1 w-full rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Sélectionnez une date et une heure</option>
                    </select>
                </div>

                <!-- Date et heure de fin -->
                <div class="mb-6">
                    <label for="date_fin" class="block text-gray-700 font-bold mb-2">Date et heure de fin</label>
                    <select id="date_fin" name="date_fin" 
                        class="block mt-1 w-full border rounded-lg border-orange-300 focus:ring-orange-500 focus:border-orange-500" required>
                        <option value="">Sélectionnez une heure de fin</option>
                    </select>
                </div>

                <!-- Choix du service -->
                <div class="mb-6">
                    <label for="prestation_type_id" class="block font-bold mb-2">Type de service</label>
                    <select id="prestation_type_id" name="prestation_type_id" 
                        class="block mt-1 w-full border rounded-lg border-yellow-300 focus:ring-yellow-500 focus:border-yellow-500" required>
                        <option value="">Sélectionner un service</option>
                        @foreach ($dogsitter->prestationtypes as $type)
                            <option value="{{ $type->id }}">{{ $type->nom }} - {{ $type->pivot->prix }}€</option>
                        @endforeach
                    </select>
                </div>

                <!-- Choix du chien -->
                <div class="mb-6">
                    <label for="dog" class="block font-bold mb-2">Choix du chien</label>
                    <select id="dog" name="dog" 
                        class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
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
        </div>

        <script>
            // Simulation des horaires disponibles
            const availableHours = {
                '2024-10-23': [['2024-10-23T08:00', '2024-10-23T09:00'], ['2024-10-23T09:00', '2024-10-23T10:00']],
                '2024-10-24': [['2024-10-24T08:30', '2024-10-24T09:30'], ['2024-10-24T09:30', '2024-10-24T10:30']],
                // Ajoutez d'autres dates et horaires selon vos besoins
            };

            // Remplir les horaires disponibles
            document.getElementById('date_debut').addEventListener('change', function () {
                const selectedStart = this.value;
                populateEndHours(selectedStart);
            });

            function populateEndHours(selectedStart) {
                const endHourSelect = document.getElementById('date_fin');
                endHourSelect.innerHTML = '<option value="">Sélectionnez une heure de fin</option>';

                Object.entries(availableHours).forEach(([date, slots]) => {
                    slots.forEach(([start, end]) => {
                        if (start === selectedStart) {
                            endHourSelect.innerHTML += `<option value="${end}">${new Date(end).toLocaleTimeString('fr-FR')}</option>`;
                        }
                    });
                });
            }

            // Remplir les options de début lors du chargement de la page
            const startHourSelect = document.getElementById('date_debut');
            Object.entries(availableHours).forEach(([date, slots]) => {
                slots.forEach(([start, _]) => {
                    startHourSelect.innerHTML += `<option value="${start}">${new Date(start).toLocaleString('fr-FR')}</option>`;
                });
            });
        </script>
    </x-guest-layout>
@endsection
