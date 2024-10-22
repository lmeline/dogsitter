<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de Rendez-vous</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Prise de Rendez-vous</h1>

        <!-- Formulaire de rendez-vous -->
        <form action="#" method="POST" class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto" id="appointment-form">
            <div class="mb-6">
                <label for="date" class="block text-gray-700 font-bold mb-2">Date du rendez-vous</label>
                <input type="date" id="date" name="date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="heure" class="block text-gray-700 font-bold mb-2">Heure</label>
                <select id="heure" name="heure" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Choisissez une heure</option>
                </select>
            </div>

            <!-- Choix du service -->
            <div class="mb-6">
                <label for="service" class="block text-gray-700 font-bold mb-2">Type de service</label>
                <select id="service" name="service" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Sélectionner un service</option>
                    <option value="promenade">Promenade</option>
                    <option value="garde">Garde de chien</option>
                </select>
            </div>

            <!-- Choix du chien -->
            <div class="mb-6">
                <label for="chien" class="block text-gray-700 font-bold mb-2">Choix du chien</label>
                <select id="chien" name="chien" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Sélectionner un chien</option>
                    <option value="chien1">Rex</option>
                    <option value="chien2">Bella</option>
                    <option value="chien3">Max</option>
                    <option value="chien4">Luna</option>
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
            '2024-10-23': ['08:00', '09:00', '10:00', '14:00'], // horaires disponibles pour le 23 octobre 2024
            '2024-10-24': ['08:30', '09:30', '10:30', '15:00'], // horaires disponibles pour le 24 octobre 2024
            '2024-10-25': ['09:00', '10:00', '11:00', '15:30'], // horaires disponibles pour le 25 octobre 2024
            '2024-10-26': ['09:30', '10:30', '11:30', '16:00'], // horaires disponibles pour le 26 octobre 2024
            '2024-10-27': ['10:00', '11:00', '12:00', '16:30'], // horaires disponibles pour le 27 octobre 2024
            '2024-10-28': ['10:30', '11:30', '12:30', '17:00'], // horaires disponibles pour le 28 octobre 2024
            '2024-10-29': ['11:00', '12:00', '13:00', '17:30'], // horaires disponibles pour le 29 octobre 2024
            // Ajoutez d'autres dates et horaires selon vos besoins
        };

        document.getElementById('date').addEventListener('change', function() {
            const selectedDate = this.value; // Obtenir la date sélectionnée
            populateAvailableHours(selectedDate); // Remplit les heures disponibles
        });

        function populateAvailableHours(selectedDate) {
            const hourSelect = document.getElementById('heure');
            hourSelect.innerHTML = ''; // Réinitialiser les heures disponibles
            const available = availableHours[selectedDate] || []; // Obtenir les heures disponibles

            // Remplir le select avec les heures disponibles
            if (available.length > 0) {
                available.forEach(hour => {
                    hourSelect.innerHTML += `<option value="${hour}">${hour}</option>`;
                });
            } else {
                hourSelect.innerHTML = '<option value="">Aucune heure disponible</option>';
            }
        }
    </script>
</body>
</html>
