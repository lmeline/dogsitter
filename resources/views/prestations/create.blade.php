<x-app-layout>
    <div class="container mx-auto" style="border: 1px solid red;">
        <div class="w-full mb-6 mt-6" style="border: 1px solid yellow;">
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
                        <select id="dog" name="dog"
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

        <div id="calendar"></div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarElement = document.getElementById('calendar');
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
                timeZone: 'Europe/Paris', // Fuseau horaire
                height: 'auto', // Hauteur automatique  
                eventOverlap: false, // Empêche le chevauchement des événements
                selectOverlap: false, // Empêche le chevauchement des événements
                selectable: true, // Permet la sélection des dates
                editable: true,   // Permet l'édition des événements
                droppable: true,  // Permet le drag-and-drop des événements
                dateClick: function (info) {
                    let startDate = new Date(info.date); // Date cliquée
                    let endDate = new Date(startDate); // Copier la date
                    endDate.setHours(endDate.getHours() + 2); // Ajouter 2 heures

                    // Ajouter l'événement au calendrier
                    calendar.addEvent({
                        title: 'Nouvel événement', // Nom de l'événement
                        start: startDate,
                        end: endDate,
                        allDay: false // Important pour gérer les heures
                    });

                    alert('Événement ajouté de ' + startDate.toLocaleString() + ' à ' + endDate.toLocaleString());
                },



            });
            calendar.render();
        });

    </script>

</x-app-layout>