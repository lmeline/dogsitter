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
                <div id="deleteSection" class="mb-6 text-center">
                    <button id="deleteButton"
                        class="w-1/2 bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">
                        Supprimer
                    </button>
                </div>
                           
            </div>

            {{-- Ajouter un tarif par prestation --}}
            <div class="bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
                <h2 class="text-2xl font-semibold mb-4 text-center">Ajouter un tarif par prestation</h2>
                <form id="tarifForm" action="{{ route('userPrestations.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="dogsitter_id" value="{{ Auth::user()->id }}" />
                    <input type="hidden" name="_method" id="formMethodTarif" value="POST">
                    <input type="hidden" name="user_prestation_id" id="prestation_id" value="">
                    <input type="hidden" name="user_prestation_id" id="prestation_id" value="">

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

                    <button type="submit" id="submitButtonTarif"
                            class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 font-semibold rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                        Ajouter
                    </button>
                    <div id="deleteSectionTarif" class="mb-6 text-center">
                        <button id="deleteButtonTarif"
                            class="w-1/2 bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">
                            Supprimer
                        </button>
                    </div>                    
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

    function updateFormForSelectedDay(jour) {
        const dispo = disponibilites.find(d => d.jour_semaine === jour);

        if (dispo) {
            // Mode modification
            form.action = `/disponibilites/${dispo.id}`;
            methodInput.value = "PUT";
            disponibiliteIdInput.value = dispo.id;

            heureDebut.value = dispo.heure_debut.slice(0,5);
            heureFin.value = dispo.heure_fin.slice(0,5);

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

    const deleteButton = document.getElementById("deleteButton");
    const deleteSection = document.getElementById("deleteSection");
    let timeoutId;  // Variable pour stocker l'ID du timeout

    deleteButton.addEventListener("click", function (e) {
        e.preventDefault();
        const id = disponibiliteIdInput.value;

        if (!id) return;

        // Délai de confirmation avant d'exécuter la suppression
        timeoutId = setTimeout(() => {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette disponibilité ?")) {
                fetch(`/disponibilites/${id}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();  // Recharge la page après la suppression
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur AJAX :", error);
                    alert("Erreur de communication avec le serveur.");
                });
            }
        }, 2000);  

        // Annuler le délai si l'utilisateur change d'avis
        const cancelButton = document.getElementById("cancelButton");  // Assure-toi d'avoir un bouton "annuler"
        if (cancelButton) {
            cancelButton.addEventListener("click", () => {
                clearTimeout(timeoutId);  // Annule le délai
                console.log("Le délai de suppression a été annulé.");
            });
        }
    });
});
    document.addEventListener("DOMContentLoaded", function() {
        const tarif = @json($prestationtypes);
        const prestation = @json($userPrestations);
        const tarifForm = document.getElementById("tarifForm");
        const methodInputTarif = document.getElementById("formMethodTarif");
        const prestationIdInput = document.getElementById("prestation_id");
        const select = document.getElementById("prestation_type_id");
        const prixInput = document.getElementById("prix");
        const dureeDisplay = document.getElementById("dureeDisplay");
        const submitButtonTarif = document.getElementById("submitButtonTarif");

        const prixParPrestation = {};
        prestation.forEach(p => {
            prixParPrestation[p.prestation_type_id] = p.prix;
        });

        function updateDureeEtPrix() {
            const selectedId = select.value;

            // Affiche durée
            if (selectedId == 1) {
                dureeDisplay.innerHTML = "Durée 1 jour";
            } else {
                dureeDisplay.innerHTML = "Durée 1 heure";
            }

            // Si déjà une prestation → on passe en mode modification
            if (prixParPrestation[selectedId]) {
                const prestationExistante = prestation.find(p => p.prestation_type_id == selectedId);

                prixInput.value = prixParPrestation[selectedId];
                submitButtonTarif.textContent = "Modifier";

                // On passe le formulaire en PUT
                tarifForm.action = `/user-prestation/${prestationExistante.id}`;
                methodInputTarif.value = "PUT";
                prestationIdInput.value = prestationExistante.id;
            } else {
                prixInput.value = "";
                submitButtonTarif.textContent = "Ajouter";

                // Formulaire en POST
                tarifForm.action = `{{ route('userPrestations.store') }}`;
                methodInputTarif.value = "POST";
                prestationIdInput.value = "";
            }
        }


        updateDureeEtPrix();
        select.addEventListener("change", updateDureeEtPrix);

        let timeoutId;

        const cancelButton = document.getElementById("cancelButton");
        if (cancelButton) {
            cancelButton.addEventListener("click", () => {
                clearTimeout(timeoutId);
                console.log("Suppression annulée.");
            });
        }

        document.getElementById("deleteButtonTarif").addEventListener("click", function (e) {
            e.preventDefault();

            const id = document.getElementById("prestation_id").value;
            if (!id) return;

            timeoutId = setTimeout(() => {
                if (confirm("Êtes-vous sûr de vouloir supprimer ce tarif ?")) {
                    fetch(`/user-prestation/${id}/delete`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Erreur AJAX :", error);
                        alert("Erreur de communication avec le serveur.");
                    });
                }
            }, 2000);
        });


    });

    </script>

</x-app-layout>
