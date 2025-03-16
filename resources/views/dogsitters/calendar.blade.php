<x-app-layout>
    <div class="w-full h-full">
        <div class="flex justify-between items-center w-[80%] mx-auto m-5">
            <div class="flex-grow text-center">
                <h1 class="font-bold text-3xl">Calendrier</h1>
            </div>
        </div>

        <!-- FullCalendar container -->
        <div id="calendar" class="w-[80%] mx-auto h-[calc(100vh-14rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>

        <!-- Retourner aux Prestations -->
        <div class="mt-6">
            <a href="{{ route('myprestations') }}" class="bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">Retour aux Prestations</a>
        </div>
    </div>

    <!-- FullCalendar JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Afficher en vue mensuelle
                events: [
                    @foreach($prestations as $prestation)
                        {
                            title: '{{ $prestation->prestationType->nom }}',
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
                dateClick: function(info) {
                    alert('Vous avez cliqué sur la date : ' + info.dateStr);
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>
