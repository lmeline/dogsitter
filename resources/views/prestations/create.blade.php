<x-app-layout>
    <div class="container mx-auto" >
        <div class="w-full mb-6 mt-6">
            <div class="md:flex">
                <div class="flex md:w-1/4">
                    <label class="md:w-1/4 font-bold pr-4" for="dog">
                        Chien :
                    </label>
                    <div class="inline md:w-3/4">
                        <select id="dog" name="dog"
                            class="block mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                            required>
                            <option value="">Sélectionner un chien</option>
                            @foreach(Auth::user()->dogs as $dog)
                                <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex md:w-1/3">
                    <label class="md:w-1/4 font-bold mb-1 md:mb-0 pr-4" for="dog">
                        Prestation :
                    </label>
                    <div class="inline md:w-3/4">
                        <select id="prestation-dog" name="prestation"
                            class="block mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500"
                            required>
                            <option value="">Sélectionner une prestation</option>
                            @foreach ($dogsitter->prestationtypes as $type)
                                <option value="{{ $type->id }}">{{ $type->nom }} - {{ $type->pivot->prix }}€</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <form id="eventForm" method="POST" action="{{ route('prestations.store') }}">
            @csrf
            <input type="hidden" id="hidden-dog" name="dog">
            <input type="hidden" id="prestation_type_id" name="prestation_type_id">
            <input type="hidden" id="date_debut" name="date_debut">
            <input type="hidden" id="date_fin" name="date_fin">
            <input type="hidden" id="dogsitter_id" name="dogsitter_id" value="{{ $dogsitter->id }}">
        </form>

        <div id="calendar"></div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarElement = document.getElementById('calendar');
            const eventForm = document.getElementById('eventForm');

            const calendar = new FullCalendar.Calendar(calendarElement, {
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
                timeZone: 'local', // Fuseau horaire
                height: 'auto', // Hauteur automatique  
                eventOverlap: true, // Empêche le chevauchement des événements
                selectOverlap: true, // Empêche le chevauchement des événements
                selectable: true, // Permet la sélection des dates
                editable: true,   // Permet l'édition des événements
                droppable: true,  // Permet le drag-and-drop des événements
                select: function (info) {
                    let startDate = info.start;
                    let endDate = info.end;
                    let selectedDog = document.getElementById('dog').value;
                    let selectedDogText = document.getElementById('dog').selectedOptions[0].text;
                    let selectedPrestation = document.getElementById('prestation-dog').value;
                    let selectedPrestationText = document.getElementById('prestation-dog').selectedOptions[0].text;

                    if (!selectedDog || !selectedPrestation || selectedDogText === "Sélectionner un chien" || selectedPrestationText === "Sélectionner une prestation") {
                    alert('Veuillez sélectionner un chien et une prestation avant d’ajouter un événement.');
                    return;
                }
                    document.getElementById('hidden-dog').value = selectedDog;
                    document.getElementById('prestation_type_id').value = selectedPrestation;

                    function formatDate(date) {
                        let d = new Date(date);
                        return d.getFullYear() + "-" +
                            ("0" + (d.getMonth() + 1)).slice(-2) + "-" +
                            ("0" + d.getDate()).slice(-2) + " " +
                            ("0" + d.getHours()).slice(-2) + ":" +
                            ("0" + d.getMinutes()).slice(-2) + ":" +
                            ("0" + d.getSeconds()).slice(-2);
                    }

                    document.getElementById('date_debut').value = formatDate(info.start);
                    document.getElementById('date_fin').value = formatDate(info.end);

                    // Ajouter l'événement sélectionné
                    calendar.addEvent({
                        title: selectedDogText + " - " + selectedPrestationText,
                        start: startDate,
                        end: endDate,
                        allDay: false
                    });
                    eventForm.submit();

                    alert('Événement ajouté de ' + startDate.toLocaleString() + ' à ' + endDate.toLocaleString());
                },
            });
            calendar.render();
        });

    </script>

</x-app-layout>