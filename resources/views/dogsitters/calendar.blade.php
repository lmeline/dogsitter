<x-app-layout>
    <div class="container mx-auto">
        <!-- <div class="w-full h-full"> -->
        <div class="flex justify-between items-center w-[60%] mx-auto m-5">
            <div class="flex-grow text-center">
                <h1 class="font-bold text-3xl">Mes rendez-vous</h1>
            </div>
        </div>

        <!-- FullCalendar container -->
        <div id="calendar"
            class="w-100 mx-auto max-sm:h-[calc(100vh-2rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>

    </div>

    <!-- FullCalendar JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [
                    FullCalendar.plugins.dayGrid,
                    FullCalendar.plugins.timeGrid,
                    FullCalendar.plugins.interaction
                ], // Activation des plugins
                locale: 'fr',
                initialView: 'timeGridWeek', // Vue par défaut (Semaine)
                headerToolbar: {
                    start: 'today prev,next', // will normally be on the left. if RTL, will be on the right
                    center: '',
                    end: 'title', // will normally be on the right. if RTL, will be on the left
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                firstDay: 1, // Premier jour de la semaine (Lundi)
                allDaySlot: false, // Désactive la ligne "All-day"
                slotMinTime: "08:00:00", // Début de la journée
                slotMaxTime: "20:00:00", // Fin de la journée
                slotDuration: "00:30:00", // Durée des créneaux
                timeZone: 'local', // Fuseau horaire
                height: 'auto', // Hauteur automatique  

                events: [
                    @foreach($prestations as $prestation)
                            {
                            title: '{{ $prestation->prestationType->nom }}-{{$prestation->proprietaire->name}} -- {{ $prestation->statut }}',
                            start: '{{ $prestation->formatted_date_debut }}', // Assurez-vous que le format de la date est valide pour FullCalendar
                            end: '{{ $prestation->formatted_date_fin }}', // Idem pour la date de fin
                            description: 'Prix: {{ $prestation->prix }} €',
                            url: '{{ route('prestations.show', $prestation->id) }}', // Lien vers les détails de la prestation
                            backgroundColor: '#FF5733', // Couleur de fond (exemple)
                            borderColor: '#FF5733', // Couleur de bordure (exemple)
                            textColor: '#fff' // Couleur du texte (exemple)
                        },
                    @endforeach
                ],
                dateClick: function (info) {
                    alert('Vous avez cliqué sur la date : ' + info.dateStr);
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>