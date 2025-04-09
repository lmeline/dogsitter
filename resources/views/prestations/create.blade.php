<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-between items-center w-[80%] mx-auto m-5">
            <div class="flex-grow text-center">
                <h1 class="font-bold text-3xl">Mes prestations</h1>
            </div>
        </div>


        <!-- <div id="calendar"></div> -->
        <!-- FullCalendar container -->
        <div id="calendar"
            class="w-100 mx-auto h-[calc(120vh-3rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>


    </div>

    <!-- Popup Modal -->
    <div id="prestationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-600">
            <h2 class="text-xl font-bold mb-4">Créer une nouvelle prestation</h2>
            <form id="prestationForm">
                <label class="block mb-2">Prestation :</label>

                <select id="ddlPrestation" name="prestation"
                    class="mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                    <option value="" data-duree="60">Sélectionner une prestation</option>
                    @foreach ($dogsitter->prestationtypes as $prestationType)
                                        @php
                                            $heures = floor($prestationType->pivot->duree / 60);
                                            $minutes = $prestationType->pivot->duree % 60;
                                        @endphp
                                        <option data-duree="{{ $prestationType->pivot->duree }}" value="{{ $prestationType->id }}">
                                            {{ $prestationType->nom }} - {{ sprintf('%0d', $heures) }}h{{ sprintf('%02d', $minutes) }},
                                            {{ number_format($prestationType->pivot->prix, 2) + 0 }}€
                                        </option>
                    @endforeach

                    
                </select>
                <span id="spanDuree" name="duree" class="p-2 text-gray-300">60</span>
                <label class="block mb-2">Chien :</label>
                <select id="ddlDog" name="dog"
                    class="block mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                    required>
                    <option value="">Sélectionner un chien</option>
                    @foreach(Auth::user()->dogs as $dog)
                        <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                    @endforeach
                </select>

                <span id="spanDateDe" class="inline-block w-[200px] p-2 text-gray-300"></span>
                <span id="spanDateA" class="inline-block w-[200px] p-2 text-gray-300"></span>

                <label class="block mb-2">Date et heure :</label>
                <input type="date" id="txtPrestationDate" name="prestationDate"
                    class="w-180 border rounded-lg p-2 mb-4">
                <label for="ddlPrestationDe">De : </label>
                <select id="ddlPrestationDe" name="prestationDe" class="w-100 border rounded-lg">
                    @for($hour = 8; $hour <= 20; $hour += 0.5)
                                        @php
                                            $formattedHour = str_pad(floor($hour), 2, '0', STR_PAD_LEFT);
                                            $formattedMinute = ($hour - floor($hour)) * 60;
                                            $formattedMinute = str_pad($formattedMinute, 2, '0', STR_PAD_LEFT);
                                        @endphp
                                        <option value="{{ $formattedHour }}:{{ $formattedMinute }}">
                                            {{ $formattedHour }}:{{ $formattedMinute }}
                                        </option>
                    @endfor
                </select>
                <label for="spanPrestationA">à : </label>
                <span id="spanPrestationA" name="prestationA" class="w-100 border p-2 mb-4 rounded-lg"></span>

                <div class="flex justify-end">
                    <button type="button" id="closeModal"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Annuler</button>
                    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let calendar = null;
        let prestations = @json($prestations);
        let prestationsDogsitter = @json($prestationsDogsitter);
        console.log(prestations);

        document.addEventListener('DOMContentLoaded', function () {
            const calendarElement = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarElement, {
                plugins: [
                    FullCalendar.plugins.dayGrid,
                    FullCalendar.plugins.timeGrid,
                    FullCalendar.plugins.interaction
                ], // Activation des plugins
                initialView: 'timeGridWeek', // Vue par défaut (Semaine)
                headerToolbar: {
                    start: 'today prev,next', // will normally be on the left. if RTL, will be on the right
                    center: '',
                    end: 'title', // will normally be on the right. if RTL, will be on the left
                },
                firstDay: 1, // Premier jour de la semaine (Lundi)
                allDaySlot: false, // Désactive la ligne "All-day"
                slotMinTime: "08:00:00", // Début de la journée
                slotMaxTime: "20:00:00", // Fin de la journée
                slotDuration: "00:30:00", // Durée des créneaux
                locale: 'fr', // Langue
                //timeZone: 'Europe/Paris', // Fuseau horaire
                height: 'auto', // Hauteur automatique  
                eventOverlap: true, // Empêche le chevauchement des événements
                selectOverlap: true, // Empêche le chevauchement des événements
                selectable: true, // Permet la sélection des dates
                editable: true,   // Permet l'édition des événements
                droppable: true,  // Permet le drag-and-drop des événements
                events: prestations.map(function (prestation) {
                    return {
                        title: prestation.dog.nom + "\n" + prestation.prestation_type.nom + ' avec ' + prestation.dogsitter.prenom,
                        start: prestation.date_debut,
                        end: prestation.date_fin,
                        allDay: false // Important pour gérer les heures
                    };
                }),
                
                eventContent: function (arg) {
                    return {
                        html: arg.event.title.replace(/\n/g, '<br>')
                    };
                },
                dateClick: function (info) {
                    let clickedDate = new Date(info.date); // Date cliquée
                    // Récupération de la date cliquée comme date de début et ajout d'une heure pour la date de fin
                    let dateDe = new Date(info.date); // Date cliquée
                    let dateA = new Date(info.date); // Date cliquée
                    dateA.setHours(dateA.getHours() + (spanDuree.textContent / 60)); // Ajouter la durée à la date de fin

                    // Formatage des heures:minutes pour les selects    
                    heureDe = dateDe.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });
                    heureA = dateA.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });

                    // Chargement du modal    
                    spanDateDe.textContent = dateDe;
                    spanDateA.textContent = dateA
                    txtPrestationDate.value = dateDe.toISOString().split('T')[0];
                    ddlPrestationDe.value = heureDe;
                    spanPrestationA.textContent = heureA;

                    // Affichage du modal
                    prestationModal.classList.remove('hidden');
                }

            });
            calendar.render();
        });

        // Bouton pour fermer le modal
        document.getElementById('closeModal').addEventListener('click', function () {
            prestationModal.classList.add('hidden');
        });

        // Changement de prestation
        document.getElementById('ddlPrestation').addEventListener('change', function () {

            // Récupérer l'option sélectionnée
            let selectedOption = this.options[this.selectedIndex];
            // Lire la valeur de data-duree
            let duree = selectedOption.getAttribute('data-duree');
            spanDuree.textContent = duree;
            console.log('Duree : ' + duree / 60);

            // Mettre à jour la date de fin
            let startDate = new Date(txtPrestationDate.value + 'T' + ddlPrestationDe.value);
            let endDate = new Date(txtPrestationDate.value + 'T' + ddlPrestationDe.value);


            // Ajouter la durée à la date de début
            //endDate.setMinutes(endDate.getMinutes() + parseInt(duree));
            endDate.setMinutes(endDate.getMinutes() + duree); // Ajouter la durée à la date de fin
            console.log('startDate : ' + startDate);
            console.log('endDate : ' + endDate);


            // Mettre à jour le select de la date de fin
            let heureA = endDate.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            spanPrestationA.textContent = heureA;

            // Mettra à jour la date de fin dans le champ caché
            //spanDateA.value = endDate.toISOString().split('T')[0] + ' ' + heureA;
            spanDateA.textContent = endDate;

        });

        ddlPrestationDe = document.getElementById('ddlPrestationDe');
        ddlPrestationDe.addEventListener('change', function () {
            console.log('ddlPrestationDe : ' + this.value);
            // Récupérer l'option sélectionnée
            let selectedOption = this.options[this.selectedIndex];
            // Lire la valeur de data-duree
            let duree = spanDuree.textContent;

            console.log('Duree : ' + duree);
            // Récupérer la date de début et de fin
            let startDate = new Date(txtPrestationDate.value + 'T' + ddlPrestationDe.value);
            let endDate = new Date(startDate);
            spanDateDe.value = startDate;

            // Ajouter la durée à la date de début
            endDate.setMinutes(endDate.getMinutes() + parseInt(duree));
            // Mettra à jour la date de fin dans le champ caché
            spanDateA.textContent = endDate;
            // Mettre à jour le select de la date de fin
            let heureA = endDate.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            spanPrestationA.textContent = heureA;


        });


        // Gestion de l'événement de soumission du formulaire
        prestationForm = document.getElementById('prestationForm');
        prestationForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Empêche le rechargement de la page

            // Récupérer les valeurs du formulaire
            let prestationTypeId = ddlPrestation.value;
            let dogId = ddlDog.value;
            let dateDe = txtPrestationDate.value + ' ' + ddlPrestationDe.value;
            let dateA = txtPrestationDate.value + ' ' + spanPrestationA.textContent;
            let dogSitterId = {{ $dogsitter->id }}; // ID du dogsitter

            console.log('prestationTypeId : ' + prestationTypeId + "dogId : " + dogId + "dateDe : " + dateDe + "dateA : " + dateA + "dogSitterId : " + dogSitterId);
            // Vérifier que tous les champs sont remplis
            // Envoyer les données au serveur (exemple avec fetch)
            fetch('/prestations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ajout du token CSRF
                },
                body: JSON.stringify({
                    prestation_type_id: prestationTypeId,
                    dog_id: dogId,
                    date_debut: dateDe,
                    date_fin: dateA,
                    dogsitter_id: dogSitterId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Prestation ajoutée avec succès !');
                        // Ajouter l'événement au calendrier
                        console.log(data.prestation);
                        calendar.addEvent({
                            title: data.prestation.dog.nom + "\n" + data.prestation.prestation_type.nom + ' avec ' + data.prestation.dogsitter.prenom,
                            start: data.prestation.date_debut,
                            end: data.prestation.date_fin,
                            allDay: false // Important pour gérer les heures
                        });
                        // Fermer le modal
                        prestationModal.classList.add('hidden');
                    } else {
                        alert('Erreur lors de l\'ajout de la prestation : ' + data.message);
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });


    </script>

</x-app-layout>