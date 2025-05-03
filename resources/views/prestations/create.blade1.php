<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-between items-center w-[80%] mx-auto m-5">
            <div class="flex-grow text-center">
                <h1 class="font-bold text-3xl">Prendre un rendez-vous avec </h1>
            </div>
        </div>

        <div id="calendar" class="w-100 mx-auto sm:h-[calc(100vh-8rem)] h-[calc(100vh-8rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>
    </div>

    <!-- Popup Modal -->
    <div id="prestationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-600">
            <h2 class="text-xl font-bold mb-4">Créer une nouvelle prestation</h2>
            <form id="prestationForm">
                <label class="block mb-2">Prestation :</label>
                <select id="ddlPrestation" name="prestation" class="mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
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
                        {{ $prestationType->nom }} - {{ sprintf('%0d', $heures) }}h{{ sprintf('%02d', $minutes) }}, {{ number_format($prestationType->pivot->prix, 2) + 0 }}€
                    </option>
                    @endforeach
                </select>
                <span id="spanDuree" name="duree" class="p-2 hidden text-gray-300">60</span>

                <label class="block mb-2">Chien :</label>
                <select id="ddlDog" name="dog" class="block mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                    <option value="">Sélectionner un chien</option>
                    @foreach(Auth::user()->dogs as $dog)
                        <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                    @endforeach
                </select>

                <span id="spanDateDe" class="inline-block w-[200px] p-2 text-gray-300"></span>
                <span id="spanDateA" class="inline-block w-[200px] p-2 text-gray-300"></span>
                <span id="spanPrixTotal" class="block mt-2 text-gray-700 font-semibold"></span>

                <label class="block mb-2">Date et heure :</label>
                <input type="date" id="txtPrestationDate" name="prestationDate" class="w-180 border rounded-lg p-2 mb-4">
                <label for="ddlPrestationDe">De : </label>
                <select id="ddlPrestationDe" name="prestationDe" class=" w-100 border rounded-lg">
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
                    <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Annuler</button>
                    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-lg">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let prestationsDogsitter = @json($prestationsDogsitter);
        let calendar = null; 
        let currentUserId = @json(Auth::user()->id);
        let prestations = @json($prestations);
        console.log(prestations);

        document.addEventListener('DOMContentLoaded', function () {
            const calendarElement = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarElement, {
                plugins: [
                    FullCalendar.plugins.dayGrid,
                    FullCalendar.plugins.timeGrid,
                    FullCalendar.plugins.interaction
                ],
                initialView: 'timeGridWeek',
                headerToolbar: {
                    start: 'today prev,next',
                    center: '',
                    end: 'title',
                },
                firstDay: 1,
                allDaySlot: false,
                slotMinTime: "08:00:00",
                slotMaxTime: "20:00:00",
                slotDuration: "00:30:00",
                locale: 'fr',
                height: 'auto',
                eventOverlap: true,
                selectOverlap: true,
                selectable: true,
                editable: false,
                droppable: false,
                eventOverlap: false,
                events: [
                    ...prestations.map(function (prestation) {
                        return {
                            id: prestation.id,
                            title: prestation.dog.nom + "\n" + prestation.prestation_type.nom + ' avec ' + prestation.dogsitter.prenom,
                            start: prestation.date_debut,
                            end: prestation.date_fin,
                            allDay: false
                        };
                    }),
                    ...prestationsDogsitter.map(function (prestation) {
                        // Vérifie si l'utilisateur connecté a pris la prestation
                        let isCurrentUser = prestation.proprietaire_id === currentUserId;
                        let eventTitle = isCurrentUser ? prestation.dog.nom + " - " + prestation.prestation_type.nom : "Déjà réservée"; // Titre conditionnel
                        return {
                            title: eventTitle,
                            start: prestation.date_debut,
                            end: prestation.date_fin,
                            allDay: false,
                            extendedProps: {
                                hidden: isCurrentUser // Marque l'événement comme caché si c'est l'utilisateur connecté
                            }
                        };
                    })
                ],
                eventDidMount: function (info) {
                    // Si l'événement est marqué comme caché, on cache son affichage et ne le laisse pas prendre de place
                    if (info.event.extendedProps.hidden) {
                        info.el.style.visibility = 'hidden';  // Cache l'événement sans laisser de place
                        info.el.style.height = '100%'; // Cache l'événement sans qu'il prenne de place
                    }
                },
                eventContent: function (arg) {
                    return {
                        html: arg.event.title.replace(/\n/g, '<br>')
                    };
                },
                dateClick: function (info) {
                    let clickedDate = new Date(info.date);

                    let today = new Date();
                    today.setHours(0, 0, 0, 0); 
                    if (clickedDate < today) {
                        alert("Vous ne pouvez pas créer une prestation dans le passé.");
                        return; 
                    }

                    let hasConflict = calendar.getEvents().some(event => {
                        let eventStart = new Date(event.start);
                        let eventEnd = new Date(event.end);

                        return clickedDate >= eventStart && clickedDate < eventEnd;
                    });

                    if (hasConflict) {
                        alert("Un créneau est déjà réservé à cette heure.");
                        return; 
                    }

                    let dateDe = new Date(info.date);
                    let dateA = new Date(info.date);
                    dateA.setMinutes(dateA.getMinutes() + parseInt(spanDuree.textContent));

                    heureDe = dateDe.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });
                    heureA = dateA.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });

                    spanDateDe.textContent = dateDe;
                    spanDateA.textContent = dateA;
                    txtPrestationDate.value = dateDe.toISOString().split('T')[0];
                    ddlPrestationDe.value = heureDe;
                    spanPrestationA.textContent = heureA;

                    prestationModal.classList.remove('hidden');
                },
                eventClick: function (info) {
                    const prestationId = info.event.id;
                    window.location.href = '/prestations/' + prestationId;
                
                },

            });
            calendar.render();
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            prestationModal.classList.add('hidden');
        });

        document.getElementById('ddlPrestation').addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];
            let duree = selectedOption.getAttribute('data-duree');
            spanDuree.textContent = duree;
            let prestationPrix = selectedOption.getAttribute('data-prix');
            spanPrixTotal.textContent = prestationPrix;


            let startDate = new Date(txtPrestationDate.value + 'T' + ddlPrestationDe.value);
            let endDate = new Date(txtPrestationDate.value + 'T' + ddlPrestationDe.value);

            endDate.setMinutes(endDate.getMinutes() + duree);
            let heureA = endDate.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            spanPrestationA.textContent = heureA;
        });

        ddlPrestationDe = document.getElementById('ddlPrestationDe');
        ddlPrestationDe.addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];
            let duree = spanDuree.textContent;
            let startDate = new Date(txtPrestationDate.value + 'T' + ddlPrestationDe.value);
            let endDate = new Date(startDate);
            spanDateDe.value = startDate;
            endDate.setMinutes(endDate.getMinutes() + parseInt(duree));
            spanDateA.textContent = endDate;
            let heureA = endDate.toLocaleString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            spanPrestationA.textContent = heureA;
        });

        prestationForm = document.getElementById('prestationForm');
        prestationForm.addEventListener('submit', function (event) {
            event.preventDefault();

            let prestationTypeId = ddlPrestation.value;
            let dogId = ddlDog.value;
            let dateDe = txtPrestationDate.value + ' ' + ddlPrestationDe.value;
            let dateA = txtPrestationDate.value + ' ' + spanPrestationA.textContent;
            let dogSitterId = {{ $dogsitter->id }};

            fetch('/prestations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    prestation_type_id: prestationTypeId,
                    dog_id: dogId,
                    date_debut: dateDe,
                    date_fin: dateA,
                    dogsitter_id: dogSitterId,
                    prix_total: spanPrixTotal.textContent
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Prestation ajoutée avec succès !');
                        calendar.addEvent({
                            title: data.prestation.dog.nom + "\n" + data.prestation.prestation_type.nom + ' avec ' + data.prestation.dogsitter.prenom,
                            start: data.prestation.date_debut,
                            end: data.prestation.date_fin,
                            allDay: false
                        });
                        prestationModal.classList.add('hidden');
                    } else {
                        alert('Erreur lors de l\'ajout de la prestation : ' + data.message);
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });

    </script>
</x-app-layout>
