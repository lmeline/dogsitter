<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de Rendez-vous </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Prise de Rendez-vous {{ $dogsitter->name }}</h1>

        <!-- Formulaire de rendez-vous -->
        <form action="#" method="POST" class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto" id="appointment-form">
            <div class="mb-6">
                <label for="date" class="block text-gray-700 font-bold mb-2">Date du rendez-vous</label>
                <input type="date" id="date" name="date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="heure-debut" class="block text-gray-700 font-bold mb-2">Heure de début</label>
                <select id="heure-debut" name="heure-debut" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Choisissez une heure de début</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="heure-fin" class="block text-gray-700 font-bold mb-2">Heure de fin</label>
                <select id="heure-fin" name="heure-fin" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Choisissez une heure de fin</option>
                </select>
            </div>

            <!-- Choix du service -->
            <div class="mb-6">
                <label for="service" class="block text-gray-700 font-bold mb-2">Type de service</label>
                <select id="service" name="service" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Sélectionner un service</option>
                    @foreach ($dogsitter->prestationtypes as $type)
                        <option value="">{{ $type->nom }} - {{ $type->pivot->prix }}€</option>
                    @endforeach
                </select>
            </div>

            <!-- Choix du chien -->
            <div class="mb-6">
                <label for="chien" class="block text-gray-700 font-bold mb-2">Choix du chien</label>
                <select id="chien" name="chien" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Sélectionner un chien</option>
                    @foreach($client->dogs as $dog)
                        <option value="">{{ $dog->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300">
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
</body>
</html>
