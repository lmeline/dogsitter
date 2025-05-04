<x-app-layout>
    <div class="min-h-screen flex justify-center items-center">
        <div class="container flex flex-col items-center border border-pink-300 rounded-lg p-6 bg-white shadow-lg w-full sm:w-96">
            <h2 class="text-2xl font-semibold text-center text-pink-600 mb-6">Créer une prestation</h2>
        
            <form action="{{ route('prestations.store') }}" method="POST">
                @csrf
        
                <!-- Champ de sélection de la prestation -->
                <div class="form-group mb-4">
                    <label for="prestation_type" class="block text-gray-700">Type de prestation</label>
                    <select id="ddlPrestation" name="prestation" class="mt-1 block w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                        <option value="" data-duree="60">Sélectionner une prestation</option>
                        @foreach ($dogsitter->prestationtypes as $prestationType)
                            @php
                                $heures = floor($prestationType->pivot->duree / 60);
                                $minutes = $prestationType->pivot->duree % 60;
                            @endphp
                            <option 
                                data-duree="{{ $prestationType->pivot->duree }}" 
                                data-prix="{{ $prestationType->pivot->prix }}" 
                                value="{{ $prestationType->id }}">
                                {{ $prestationType->nom }} - {{ sprintf('%0d', $heures) }}h{{ sprintf('%02d', $minutes) }}, {{ number_format($prestationType->pivot->prix, 2) }}€
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Champ de sélection du chien -->
                <div class="form-group mb-4">
                    <label for="dog" class="block text-gray-700">Choisir le chien</label>
                    <select id="ddlDog" name="dog" class="block w-full mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                        <option value="">Sélectionner un chien</option>
                        @foreach(Auth::user()->dogs as $dog)
                            <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Champ de sélection de la date avec Flatpickr -->
                <div class="form-group mb-4">
                    <label for="date" class="block text-gray-700">Date de prestation</label>
                    <input type="text" id="datepicker" name="date" class="form-control mt-1 block w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" placeholder="Sélectionner une date" required>
                </div>
    
                <p id="horaire-label" class="mb-2 text-lg font-semibold hidden text-center text-gray-700">Choisissez un horaire</p>
    
                <div class="form-group mb-4">
                    <div id="horaire-options" class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <!-- Créneaux injectés ici -->
                    </div>
                </div>
                
                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary w-full py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 transition duration-200">Créer la prestation</button>
            </form>
        </div>
    </div>
    
    
    <!-- Initialisation de Flatpickr pour le champ de date -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const creneauxDisponibles = @json($creneauxDisponibles);
    
            const horaireContainer = document.getElementById('horaire-options');
            const datepicker = document.getElementById('datepicker');
    
            function updateHoraires(date) {
                const horaires = creneauxDisponibles[date] || [];
                const horaireLabel = document.getElementById('horaire-label');
                const horaireContainer = document.getElementById('horaire-options');

                // Vide les anciens créneaux
                horaireContainer.innerHTML = '';

                if (horaires.length === 0) {
                    horaireLabel.classList.add('hidden');
                    horaireContainer.innerHTML = '<p>Aucun créneau disponible pour cette date.</p>';
                    return;
                }

                horaireLabel.classList.remove('hidden');

                horaires.forEach((creneau, index) => {
                    const inputId = `horaire_${index}`;
                    const radioHtml = `
                        <label for="${inputId}" class="cursor-pointer">
                            <input type="radio" name="horaire" id="${inputId}" value="${creneau.heure}" class="sr-only peer" required>
                            <div class="peer-checked:bg-pink-600 peer-checked:text-white text-gray-700 bg-white border border-gray-300 rounded-xl px-4 py-3 text-center shadow-sm hover:bg-pink-100 transition duration-200">
                                ${creneau.heure}
                            </div>
                        </label>
                    `;
                    horaireContainer.insertAdjacentHTML('beforeend', radioHtml);
                });
            }

    
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                altInput: true,
                altFormat: "F j, Y",
                disableMobile: true,
                locale: { firstDayOfWeek: 1 },
                disable: [
                    function (date) {
                        const y = date.getFullYear();
                        const m = String(date.getMonth() + 1).padStart(2, '0');
                        const d = String(date.getDate()).padStart(2, '0');
                        const localDate = `${y}-${m}-${d}`;
                        return !(localDate in creneauxDisponibles);
                    }
                ],
                onChange: function(selectedDates, dateStr) {
                    updateHoraires(dateStr);
                }
            });
        });
    </script>
    
    </x-app-layout>
    