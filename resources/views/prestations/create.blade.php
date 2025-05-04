<x-app-layout>
    <div class="min-h-screen flex justify-center items-center">
        <form x-data="{ choosen: 0 }" class="container flex flex-col items-center border border-pink-300 rounded-lg p-6 bg-white shadow-lg w-full" method="POST" action="{{ route('prestations.store') }}">
            @csrf
            <input type="text" name="dogsitter_id" value="{{ $dogsitter->id }}" class="hidden">
            <h2 class="text-2xl font-semibold text-center text-pink-600 mb-6">Créer une prestation</h2>

            {{-- Selection du chien --}}
            <div class="mb-4">
                <label for="dog" class="block text-gray-700">Choisir le chien</label>
                <select id="ddlDog" name="dog_id" class="block w-full mt-1 border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" required>
                    @foreach(Auth::user()->dogs as $dog)
                        <option value="{{ $dog->id }}">{{ $dog->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Selection du type de prestation --}}
            <div class="flex w-full gap-2 justify-center">
                @foreach ($dogsitter->prestationtypes as $prestationType)
                    <div id="{{ $prestationType->id }}" @click="choosen = $el.id; document.querySelector('#prestation_type_id').value = $el.id" class="flex flex-col items-center justify-center text-center px-3 py-2 border border-pink-300 rounded-lg hover:bg-pink-200 cursor-pointer" :class="choosen == '{{ $prestationType->id }}' ? 'bg-pink-200' : ''">
                        <p class="font-medium">{{ $prestationType->nom }} <span>@if ($prestationType->id > 1) (1h) @endif</span></p>
                    </div>
                @endforeach
                <input type="text" name="prestation_type_id" class="hidden" id="prestation_type_id" value="">
            </div>

            {{-- Selection de date --}}
            <div class="mt-2">
                <div class="form-group mb-4">
                    <label for="date" class="block text-gray-700">Sélectionnez une date</label>
                    <input type="text" id="datepicker" name="date" class="form-control mt-1 block w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" placeholder="Sélectionner une date" required>
                </div>
            </div>

            {{-- Selection des horaires --}}
            <input type="text" class="hidden" name="heure_debut" id="heure_debut">
            <input type="text" class="hidden" name="heure_fin" id="heure_fin">

            <div  id="garde" class="mt-4">
                <div>
                    <div class="flex gap-10">
                        <div>
                            <p>Horaires de début :</p>
                            <div id="horaire-options-debut" class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            </div>
                        </div>
                        
                        <div x-show="choosen == 1">
                            <p>Horaires de fin :</p>
                            <div id="horaire-options-fin" class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                            </div>
                            
                        </div>
                        
                    </div>
                    <button type="submit" class="mt-4 mx-auto bg-pink-300 hover:bg-pink-400 transition text-white font-bold py-2 px-4 rounded">Réserver</button>
                </div>
            </div>
        </form>
    </div>
    
    
    <!-- Initialisation de Flatpickr pour le champ de date -->
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

                    displayedHoraires = horairesDay.map(heure => `${heure}:00`);

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
                minDate: "today",
                altInput: true,
                altFormat: "F j, Y",
                disableMobile: true,
                locale: { firstDayOfWeek: 1 },
                onChange: function(selectedDates, dateStr) {
                    console.log(dateStr);
                    injectHoraires(horaireContainerDebut, dateStr);
                },
                disable: [
                    function (date) {
                        const joursDisponibles = @json($joursDisponibles); // Ex: ['Monday', 'Tuesday']
                        const nomJour = date.toLocaleDateString('en-US', { weekday: 'long' });
                        return !joursDisponibles.includes(nomJour);
                    }
                ],
            });
        });
    </script>
    
    </x-app-layout>
    