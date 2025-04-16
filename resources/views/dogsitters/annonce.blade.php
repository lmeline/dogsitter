<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Poster son annonce</h2>
              {{-- pop-up --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-md mt-8 max-w-lg mx-auto mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="bg-yellow-100 text-yellow-700 p-4 rounded-md mt-8 max-w-lg mx-auto mb-4">
                    <strong>Attention :</strong> {{ session('warning') }}
                </div>
            @endif
        <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8 justify-center">
            {{-- Ajouter une disponibilité --}}
            <div class="bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
                <h2 class="text-2xl font-semibold mb-4 text-center">Ajouter une disponibilité</h2>
                <form id="disponibiliteForm" action="{{ route('disponibilites.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <input type="hidden" name="dogsitter_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="disponibilite_id" id="disponibilite_id" value="">
                
                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Jour :</label>
                        <select
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            name="jour_semaine" id="jour_semaine" required>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                            <option value="Dimanche">Dimanche</option>
                        </select>
                    </div>
                
                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Heure de début :</label>
                        <input
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            type="time" name="heure_debut" id="heure_debut" required>
                    </div>
                
                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Heure de fin :</label>
                        <input
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            type="time" name="heure_fin" id="heure_fin" required>
                    </div>
                
                    <div class="mb-6 text-center">
                        <button id="submitButton" type="submit"
                            class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black font-semibold py-3 px-4 rounded-lg hover:bg-pink-600 transition-all duration-300">
                            Ajouter
                        </button>
                    </div>
                </form>                
            </div>
            <div class="bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
                <h2 class="text-2xl font-semibold mb-4 text-center">Ajouter un tarif par prestation</h2>
                <form action="{{ route('userPrestations.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="dogsitter_id" value="{{ Auth::user()->id }}" />

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2" for="prestation_type_id">Type de prestation :</label>
                        <select name="prestation_type_id" id="prestation_type_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            @foreach($prestationtypes as $prestationtype)
                                <option value="{{ $prestationtype->id }}">{{ $prestationtype->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="prix" class="block text-lg font-semibold text-gray-700 mb-2">Tarif (€) :</label>
                        <input type="number" name="prix" id="prix" class="w-full border-gray-300 rounded-lg px-3 py-2"
                        step="001" min="1" required>
                    </div>

                    <!-- Zone où on affiche la durée -->
                    <div id="dureeDisplay" class="text-lg font-semibold text-gray-700"></div>
                    <input type="hidden" name="duree" value="1">

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 font-semibold rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                        Ajouter
                    </button>
                </form>
            </div>
        </div>
        
    </div>
       

     <script>
        document.addEventListener("DOMContentLoaded", function () {

            const disponibilites = @json($disponibilites);
            const form = document.getElementById("disponibiliteForm");
            const methodInput = document.getElementById("formMethod");
            const disponibiliteIdInput = document.getElementById("disponibilite_id");
            const jourSelect = document.getElementById("jour_semaine");
            const heureDebut = document.getElementById("heure_debut");
            const heureFin = document.getElementById("heure_fin");
            const submitButton = document.getElementById("submitButton");

            const minHeure = "07:00";
            const maxHeure = "21:00";
            heureDebut.setAttribute("min", minHeure);
            heureFin.setAttribute("max", maxHeure);
            heureFin.setAttribute("min", minHeure);

            function updateFormForSelectedDay(jour) {
                const dispo = disponibilites.find(d => d.jour_semaine === jour);

                if (dispo) {
                    // Mode modification
                    form.action = `/disponibilites/${dispo.id}`;
                    methodInput.value = "PUT";
                    disponibiliteIdInput.value = dispo.id;

                    heureDebut.value = dispo.heure_debut;
                    heureFin.value = dispo.heure_fin;

                    submitButton.textContent = "Modifier";
                } else {
                    // Mode ajout
                    form.action = `{{ route('disponibilites.store') }}`;
                    methodInput.value = "POST";
                    disponibiliteIdInput.value = "";

                    heureDebut.value = "";
                    heureFin.value = "";

                    submitButton.textContent = "Ajouter";
                }
            }
            jourSelect.addEventListener("change", () => {
                updateFormForSelectedDay(jourSelect.value);
            });
            // Initialisation au chargement
            updateFormForSelectedDay(jourSelect.value);
        });

        document.addEventListener("DOMContentLoaded", function() {
            const tarif = @json($prestationtypes);
            const prestation = @json($userPrestations);
            const select = document.getElementById("prestation_type_id");
            const prixInput = document.getElementById("prix");
            const dureeDisplay = document.getElementById("dureeDisplay");

            const prixParPrestation = {};
            prestation.forEach(p => {
                prixParPrestation[p.prestation_type_id] = p.prix;
            });

            function updateDureeEtPrix() {
                const selectedId = select.value;

                // Mise à jour de la durée
                if (selectedId == 1) {
                    dureeDisplay.innerHTML = "Durée 1 jour";
                } else {
                    dureeDisplay.innerHTML = "Durée 1 heure";
                }

                // Mise à jour du tarif
                if (prixParPrestation[selectedId]) {
                    prixInput.value = prixParPrestation[selectedId];
                } else {
                    prixInput.value = "";
                }
            }

            updateDureeEtPrix();
            select.addEventListener("change", updateDureeEtPrix);
        });
    </script>

</x-app-layout>
