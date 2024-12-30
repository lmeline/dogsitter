@extends('layouts.partials.default-layout')
@section('content')
    <x-guest-layout>

        <div class="container mx-auto py-10 text-black">
            <h1 class="text-4xl font-bold text-center text-black mb-10">Prise de Rendez-vous avec  {{ $dogsitter->name }}</h1>

            <!-- Formulaire de rendez-vous -->
            <form action="{{route('prestations.store')}}" method="POST" class="bg-green p-8 rounded-lg shadow-md max-w-lg mx-auto" id="appointment-form">
                @csrf
                <div class="mb-6">
                    <label for="date" class="block text-gray-700 font-bold mb-2">Date du rendez-vous</label>
                    <input type="date" id="date" name="date" class="block mt-1 w-full rounded-md border border-red-300 focus:ring-red-500 focus:border-red-500" required>
                </div>

                <div class="mb-6">
                    <label for="heure-debut" class="block  font-bold mb-2">Heure de début</label>
                    <select id="heure-debut" name="heure-debut" class="block mt-1 w-full border  rounded-lg border-red-300 focus:ring-red-500 focus:border-red-500" required>
                        <option value="">Choisissez une heure de début</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="heure-fin" class="block  font-bold mb-2">Heure de fin</label>
                    <select id="heure-fin" name="heure-fin" class="block mt-1 w-full border rounded-lg border-orange-300 focus:ring-orange-500 focus:border-orange-500" required>
                        <option value="">Choisissez une heure de fin</option>
                    </select>
                </div>

                <!-- Choix du service -->
                <div class="mb-6">
                    <label for="service" class="block  font-bold mb-2">Type de service</label>
                    <select id="service" name="service" class="block mt-1 w-full border rounded-lg border-yellow-300 focus:ring-yellow-500 focus:border-yellow-500" required>
                        <option value="">Sélectionner un service</option>
                        @foreach ($dogsitter->prestationtypes as $type)
                            <option value="{{ $type->id }}">{{ $type->nom }} - {{ $type->pivot->prix }}€</option>
                        @endforeach
                    </select>
                </div>

                <!-- Choix du chien -->
                <div class="mb-6">
                    <label for="dog" class="block font-bold mb-2">Choix du chien</label>
                    <select id="dog" name="dog" class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                        <option value="">Sélectionner un chien</option>
                        @foreach($proprietaire->dogs as $dog)
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
                '2024-10-23': [['08:00', '09:00'], ['09:00', '10:00'], ['10:00', '11:00'], ['14:00', '15:00']],
                '2024-10-24': [['08:30', '09:30'], ['09:30', '10:30'], ['10:30', '11:30'], ['15:00', '16:00']],
                '2024-10-25': [['09:00', '10:00'], ['10:00', '11:00'], ['11:00', '12:00'], ['15:30', '16:30']],
                '2024-10-26': [['09:30', '10:30'], ['10:30', '11:30'], ['11:30', '12:30'], ['16:00', '17:00']],
                '2024-10-27': [['10:00', '11:00'], ['11:00', '12:00'], ['12:00', '13:00'], ['16:30', '17:30']],
                '2024-10-28': [['10:30', '11:30'], ['11:30', '12:30'], ['12:30', '13:30'], ['17:00', '18:00']],
                '2024-10-29': [['11:00', '12:00'], ['12:00', '13:00'], ['13:00', '14:00'], ['17:30', '18:30']],
                // Ajoutez d'autres dates et horaires selon vos besoins
            };

            document.getElementById('date').addEventListener('change', function() {
                const selectedDate = this.value; // Obtenir la date sélectionnée
                populateAvailableHours(selectedDate); // Remplit les heures disponibles
            });

            function populateAvailableHours(selectedDate) {
                const startHourSelect = document.getElementById('heure-debut');
                const endHourSelect = document.getElementById('heure-fin');
                startHourSelect.innerHTML = ''; // Réinitialiser les heures de début
                endHourSelect.innerHTML = ''; // Réinitialiser les heures de fin

                const available = availableHours[selectedDate] || []; // Obtenir les plages horaires disponibles

                // Remplir les selects avec les plages horaires disponibles
                if (available.length > 0) {
                    available.forEach(hourRange => {
                        const [startHour, endHour] = hourRange;
                        startHourSelect.innerHTML += `<option value="${startHour}">${startHour}</option>`;
                        endHourSelect.innerHTML += `<option value="${endHour}">${endHour}</option>`;
                    });
                } else {
                    startHourSelect.innerHTML = '<option value="">Aucune heure disponible</option>';
                    endHourSelect.innerHTML = '<option value="">Aucune heure disponible</option>';
                }
            }
        </script>
    </x-guest-layout>
@endsection
