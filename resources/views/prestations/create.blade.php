<x-app-layout>
    <div class="min-h-screen flex justify-center items-center py-10 px-4">
        <form x-data="{ choosen: 0 }" 
              class="w-full max-w-2xl bg-white shadow-xl rounded-2xl border border-pink-200 p-8 space-y-6" 
              method="POST" 
              action="{{ route('prestations.store') }}">
            
            @csrf
            <input type="hidden" name="dogsitter_id" value="{{ $dogsitter->id }}">

            <h2 class="text-3xl font-semibold text-center text-black">Créer une prestation</h2>

            {{-- Sélection du chien --}}
            <div>
                <label for="ddlDog" class="block text-sm font-medium text-gray-700 mb-1">Choisir le chien</label>
                <select id="ddlDog" name="dog_id" class="w-full rounded-lg border border-pink-300 focus:ring-pink-500 focus:border-pink-500">
                    @foreach(Auth::user()->dogs as $dog)
                        <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Type de prestation --}}
            <div>
                <p class="text-sm font-medium text-gray-700 mb-2">Type de prestation</p>
                <div class="flex flex-wrap gap-3">
                    @foreach ($dogsitter->prestationtypes as $prestationType)
                        <div 
                            id="{{ $prestationType->id }}" 
                            @click="choosen = $el.id; document.querySelector('#prestation_type_id').value = $el.id" 
                            class="px-4 py-2 rounded-xl border border-pink-300 text-sm cursor-pointer transition 
                                   hover:bg-pink-100"
                            :class="choosen == '{{ $prestationType->id }}' ? 'bg-pink-200 font-semibold' : ''">
                            {{ $prestationType->nom }} 
                            @if ($prestationType->id > 1) <span class="text-gray-500">(1h)</span> @endif
                        </div>
                    @endforeach
                    <input type="hidden" name="prestation_type_id" id="prestation_type_id">
                </div>
            </div>

            {{-- Sélection de la date --}}
            <div>
                <label for="datepicker" class="block text-sm font-medium text-gray-700 mb-1">Sélectionnez une date</label>
                <input 
                    type="text" 
                    id="datepicker" 
                    name="date" 
                    class="w-full rounded-lg border border-pink-300 focus:ring-pink-500 focus:border-pink-500" 
                    placeholder="Sélectionner une date" 
                    required>
            </div>

            {{-- Sélection des horaires --}}
            <input type="hidden" name="heure_debut" id="heure_debut">
            <input type="hidden" name="heure_fin" id="heure_fin">

            <div id="garde">
                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">Horaires de début :</p>
                        <div id="horaire-options-debut" class="grid grid-cols-2 gap-3">
                            <!-- Options JS -->
                        </div>
                    </div>
                    <div x-show="choosen == 1">
                        <p class="text-sm font-medium text-gray-700 mb-2">Horaires de fin :</p>
                        <div id="horaire-options-fin" class="grid grid-cols-2 gap-3">
                            <!-- Options JS -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 text-center">
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-yellow-300 to-pink-300 text-black hover:bg-pink-600 text-black font-semibold py-2 px-6 rounded-full shadow-md transition">
                    Réserver
                </button>
            </div>
        </form>
    </div>

    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
            const creneaux = @json($creneaux);
            console.log(creneaux);
            const dejaReservees = @json($reservees);
            console.log(dejaReservees);

            const horaireContainerDebut = document.getElementById('horaire-options-debut');
            const horaireContainerFin = document.getElementById('horaire-options-fin');
            const datepicker = document.getElementById('datepicker');
    

            function injectHoraires(horaireContainer, date) {
                horaireContainer.innerHTML = '';
                const dateObj = new Date(date);
                const dayOfWeek = dateObj.toLocaleDateString("en-US", { weekday: "long" });
                let displayedHoraires = [];
                Object.entries(creneaux).forEach(([jour, horaires]) => {
                    if (dayOfWeek === jour) {
                        displayedHoraires = horaires;
                        console.log(horaires);
                        Object.entries(dejaReservees).forEach(([dateReservee, horairesReservees]) => {
                            if (date === dateReservee) {
                                console.log(horairesReservees);
                                horairesReservees.forEach(horaireReservee => {
                                    console.log(horaires);
                                    console.log(horaireReservee['heure_debut']);
                                    horaires = horaires.filter(horaire => horaire < horaireReservee['heure_debut'] || horaire >= horaireReservee['heure_fin']);
                                })
                                displayedHoraires = horaires;
                            } 
                        })
                    }
                    
                });

                if (displayedHoraires.length != 0) {
                    displayedHoraires.forEach(hour => {
                        horaireContainer.innerHTML += `<div onclick="injectHorairesFin(this, '${hour}'); document.querySelector('#heure_debut').value = '${hour}'" class="px-2 py-1 border border-pink-300 rounded-lg hover:bg-pink-200 cursor-pointer hourDebut"><p>${hour.replace(":", "h")}</p></div>`;
                    });
                }
            }

            window.injectHorairesFin = function(element, hour) {
                let selectedHour = parseInt(hour.substring(0, 2));
                    document.querySelectorAll('.hourDebut').forEach(el => {
                        if (el !== element) {
                            el.classList.remove('bg-pink-300');
                        } else {
                            el.classList.add('bg-pink-300');
                        }
                    })

                if (document.querySelector('#prestation_type_id').value == 1) {
                    document.querySelector('#heure_fin').value = '';
                    horaireContainerFin.innerHTML = '';
                    let date = document.getElementById('datepicker').value;
                    const dateObj = new Date(date);
                    const dayOfWeek = dateObj.toLocaleDateString("en-US", { weekday: "long" });
                    let displayedHoraires = [];
                    let horairesDay = [];
                    let horairesPrises = [];
                    Object.entries(creneaux).forEach(([jour, horaires]) => {
                        if (dayOfWeek === jour) {
                            horairesDay = horaires.map(heure => parseInt(heure.substring(0, 2)));
                            horairesDay.push(horairesDay[horairesDay.length - 1] + 1);
                            horairesDay = horairesDay.filter(heure => heure > selectedHour);
                            console.log(horairesDay);
                            Object.entries(dejaReservees).forEach(([dateReservee, horairesReservees]) => {
                                if (date === dateReservee) {
                                    horairesReservees.forEach(horaireReservee => {
                                        if (parseInt(horaireReservee['heure_debut'].substring(0, 2)) >= selectedHour) {
                                            horairesDay = horairesDay.filter(heure => heure <= parseInt(horaireReservee['heure_debut'].substring(0, 2)))
                                        }                                   
                                    })
                                }
                            })
                        }
                    });

                    displayedHoraires = horairesDay.map(heure => {
                        if(heure < 10) {
                            return `0${heure}:00`;
                        }
                        return `${heure}:00`});

                    if (displayedHoraires.length != 0) {
                        displayedHoraires.forEach(element => {
                            horaireContainerFin.innerHTML += `<div onclick="toggleHoraireFin(this); document.querySelector('#heure_fin').value = '${element}'" class="px-2 py-1 border border-pink-300 rounded-lg hover:bg-pink-200 cursor-pointer hourFin"><p>${element.replace(":", "h")}</p></div>`;
                        });
                    }
                } else {
                    document.querySelector('#heure_fin').value = (selectedHour+1) + ':00';
                }
                
            };

            window.toggleHoraireFin = function(element) {
                document.querySelectorAll('.hourFin').forEach(el => {
                    if (el !== element) {
                        el.classList.remove('bg-pink-300');
                    } else {
                        el.classList.add('bg-pink-300');
                    }
                })

            }


    
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                "locale": "fr",
                minDate: "today",
                altInput: true,
                altFormat: "F j, Y",
                disableMobile: true,
                onChange: function(selectedDates, dateStr) {
                    console.log(dateStr);
                    injectHoraires(horaireContainerDebut, dateStr);
                },
                disable: [
                    function (date) {
                        const joursDisponibles = @json($joursDisponibles); 
                        const nomJour = date.toLocaleDateString('en-US', { weekday: 'long' });
                        return !joursDisponibles.includes(nomJour);
                    }
                ], 
            });
        });

    </script>
    
</x-app-layout>
    