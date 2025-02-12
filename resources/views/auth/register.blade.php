<x-guest-layout>
    <div x-data="{ proprietaire: true }" class="h-full max-w-4xl mx-auto">

        <div class="flex items-center justify-evenly w-full">
            <!-- Bouton Proprietaire - Rouge -->
            <button @click="proprietaire = true" type="button"
                    :class="proprietaire ? 'bg-red-600 text-white' : 'bg-gray-400 text-gray-800'"
                    class=" w-full font-bold hover:bg-red-700 focus:outline-none text-sm p-2.5 transition-colors duration-300">
                Proprietaire
            </button>

            <!-- Bouton Dogsitter - Jaune -->
            <button @click="proprietaire = false" type="button"
                    :class="!proprietaire ? 'bg-yellow-600 text-white' : 'bg-gray-400 text-gray-800'"
                    class=" w-full font-boldhover:bg-yellow-700 focus:outline-none text-sm p-2.5 transition-colors duration-300">
                Dogsitter
            </button>
        </div>

        <!-- Formulaire Proprietaire -->
        <form x-show="proprietaire" method="POST" action="{{ route('register') }}" class=" px-6 py-4">
            @csrf
            <!-- Nom et prénom -->
            <div class="flex w-full gap-2 mt-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="prenom" :value="__('First name')" />
                    <x-text-input id="prenom" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
                    <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                </div>
            </div>

            <!-- Date de naissance -->
            <div class="mt-4">
                <x-input-label for="date_naissance" :value="__('Date of birth')" />
                <x-text-input id="date_naissance" class="block mt-1 w-full border border-orange-300 focus:ring-orange-500 focus:border-orange-500" type="date" name="date_naissance" :value="old('date_naissance')" required autocomplete="date_naissance" />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>

            <!-- Adresse email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border border-yellow-300 focus:ring-yellow-500 focus:border-yellow-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Numéro de téléphone -->
            <div class="mt-4">
                <x-input-label for="telephone" :value="__('Telephone number')" />
                <x-text-input id="telephone" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="telephone" :value="old('telephone')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            </div>

            <!-- Adresse -->
            <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="adresse" :value="old('adresse')" required autocomplete="adresse" />
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div>

            <!-- Code postal et Ville -->
            <div class="flex w-full gap-2 mt-4">
                {{-- <div>
                    <x-input-label for="code_postal" :value="__('Postal code')" />
                    <x-text-input id="code_postal" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="code_postal" :value="old('code_postal')" required autofocus autocomplete="code_postal" />
                    <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
                </div> --}}

                {{-- <div>
                    <x-input-label for="ville" :value="__('City')" />
                    <x-text-input id="ville" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="ville" :value="old('ville')" required autofocus autocomplete="ville" />
                    <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                </div> --}}
                
                {{-- <div class="form-group">
                    <label for="ville">Ville</label>
                    <select id="ville" name="ville" class="form-control" required>
                        <option value="" disabled selected>Choisissez une ville</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville['nom_de_la_commune'] }}">{{ $ville['nom_de_la_commune'] }} ({{ $ville['code_postal'] }})</option>
                        @endforeach
                    </select>
                </div> --}}
                
                <div class="relative"> 
                    <input id="inputville" class="text-start h-[29px] rounded w-[12rem] min-w-[4.6rem] dark:bg-zinc-400 bg-zinc-100 border dark:border-zinc-400 border-zinc-200 hover:border-zinc-300 text-sm cursor-pointer focus:cursor-text transition-all ease-in-out duration-200 relative hover:text-zinc-800 dark:hover:text-white">
                    <ul id="listville" class="hidden absolute mt-1 w-[14rem] max-h-[18.8rem] top-[2.3rem] rounded bg-zinc-50 dark:bg-zinc-600 ring-1 ring-zinc-300 dark:ring-zinc-400 overflow-y-auto z-10"></ul>
                    <button type="button" id="buttonville">Recherche</button>
                </div>
                
            </div>
            {{-- <div class="mt-4">
                <x-input-label for="photo" :value="__('Photo de profil')" />
                <input type="file" id="photo" name="photo" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" />
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div> --}}
            <!-- Mot de passe -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmation du mot de passe -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Password confirmation')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-200 dark:focus:ring-red-700">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Formulaire Dogsitter -->
        <form x-show="!proprietaire" method="POST" action="{{ route('registerdogsitter') }}" class="overflow-y-auto px-6 py-4 relative">
            @csrf
            <div class="w-full h-full">

               <div class="w-full h-full">
                    <!-- Nom et prénom -->
                    <div class="flex w-full gap-2 mt-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="prenom" :value="__('First name')" />
                            <x-text-input id="prenom" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
                            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                        </div>
                    </div>
                    <!-- Date de naissance -->
                    <div class="mt-4">
                        <x-input-label for="date_naissance" :value="__('Date of birth')" />
                        <x-text-input id="date_naissance" class="block mt-1 w-full border border-orange-300 focus:ring-orange-500 focus:border-orange-500" type="date" name="date_naissance" :value="old('date_naissance')" required autocomplete="date_naissance" />
                        <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
                    </div>
                    <!-- Adresse email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full border border-yellow-300 focus:ring-yellow-500 focus:border-yellow-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Numéro de téléphone -->
                    <div class="mt-4">
                        <x-input-label for="telephone" :value="__('Telephone number')" />
                        <x-text-input id="telephone" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="telephone" :value="old('telephone')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                    </div>
                    <!-- Adresse -->
                    <div class="mt-4">
                        <x-input-label for="adresse" :value="__('Adresse')" />
                        <x-text-input id="adresse" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="adresse" :value="old('adresse')" required autocomplete="adresse" />
                        <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                    </div>
                    <!-- Code postal et Ville -->
                    <div class="flex w-full gap-2 mt-4">
                        <div>
                            <x-input-label for="code_postal" :value="__('Postal code')" />
                            <x-text-input id="code_postal" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="code_postal" :value="old('code_postal')" required autofocus autocomplete="code_postal" />
                            <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="ville" :value="__('City')" />
                            <x-text-input id="ville" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="ville" :value="old('ville')" required autofocus autocomplete="ville" />
                            <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                        </div>
                    </div>
                    <!-- Description de soi -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('A Propos de Moi ')" />
                        <textarea id="description" class="block mt-1 w-full border rounded border-pink-300 focus:ring-pink-500 focus:border-pink-500 h-[50px] min-h-[50px]" name="description" :value="old('description')" required autocomplete="description" rows="4"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <!-- Mot de passe -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full rounded border border-red-300 focus:ring-red-500 focus:border-red-500" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Password confirmation')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    
                    <!-- Horaires -->
                    <div class="mt-4 font-medium text-sm">
                        <h2>Enregistrez vos horaires</h2>
                            <div class="block mt-1 w-full" id="schedule-form">
                                <!-- Les jours seront insérés ici dynamiquement -->
                            </div>
                    </div>
                    
                    <!--Tarif et service-->
                   
                    <div class="mt-4">
                        <x-input-label for="service" :value="__('Service')" />
                        <div class="flex space-x-4">
                            <!-- Garde de chien -->
                            <div class="flex items-center">
                                <input type="checkbox" id="garde_de_chien" name="service[]" value="garde_de_chien" 
                                    {{ in_array('garde_de_chien', old('service', [])) ? 'checked' : '' }} 
                                    onchange="toggleTarifField('garde_de_chien')"
                                    class="form-checkbox text-blue-600 focus:ring-2 focus:ring-blue-500">
                                <label for="garde_de_chien" class="ml-2 text-gray-700">Garde de chien</label>
                                <button type="button" onclick="hideService('garde de chien')" 
                                    class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none transition duration-200">
                                    <i class="fas fa-times-circle"></i> <span class="sr-only">Non disponible</span>
                                </button>
                            </div>
                    
                            <!-- Promenade -->
                            <div class="flex items-center">
                                <input type="checkbox" id="promenade" name="service[]" value="promenade" 
                                    {{ in_array('promenade', old('service', [])) ? 'checked' : '' }} 
                                    onchange="toggleTarifField('promenade')"
                                    class="form-checkbox text-blue-600 focus:ring-2 focus:ring-blue-500">
                                <label for="promenade" class="ml-2 text-gray-700">Promenade</label>
                                <button type="button" onclick="hideService('promenade')" 
                                    class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none transition duration-200">
                                    <i class="fas fa-times-circle"></i> <span class="sr-only">Non disponible</span>
                                </button>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('service')" class="mt-2" />
                    </div>
                    
                    <!-- Tarifs -->
                    <div class="mt-4" id="tarif-garde_de_chien" style="display:none;">
                        <x-input-label for="tarif_garde_de_chien" :value="__('Tarif Garde de chien')" />
                        <x-text-input id="tarif_garde_de_chien" class="block mt-1 w-full rounded border border-gray-300 focus:ring-blue-500 focus:border-blue-500" type="number" name="tarif_garde_de_chien" :value="old('tarif_garde_de_chien')" autocomplete="prix" />
                        <x-input-error :messages="$errors->get('tarif_garde_de_chien')" class="mt-2" />
                    </div>
                    
                    <div class="mt-4" id="tarif-promenade" style="display:none;">
                        <x-input-label for="tarif_promenade" :value="__('Tarif Promenade')" />
                        <x-text-input id="tarif_promenade" class="block mt-1 w-full rounded border border-gray-300 focus:ring-blue-500 focus:border-blue-500" type="number" name="tarif_promenade" :value="old('tarif_promenade')" autocomplete="prix" />
                        <x-input-error :messages="$errors->get('tarif_promenade')" class="mt-2" />
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        
                        <x-primary-button @click.prevent="nextstep = true" class="ms-4 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-200 dark:focus:ring-yellow-700">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script>
        function generateTimeOptions() {
            const options = [];
            for (let hour = 7; hour <= 20; hour++) {
                const time = (hour < 10 ? '0' : '') + hour + ':00';
                options.push(time);
            }
            return options;
        }
    
        function createDaySection(day) {
            const timeOptions = generateTimeOptions();
            return `
                <div class="flex flex-col gap-4 mt-4">
                    <div>
                        <label class="font-medium text-sm text-gray-700 ">${day}</label>
                        <div class="flex items-center gap-4 mt-2">
                            <select name="${day.toLowerCase()}_start" class="w-1/3 block mt-1 w-full rounded-lg border border-red-300 focus:ring-red-500 focus:border-red-500">
                                ${timeOptions.map(time => `<option value="${time}">${time}</option>`).join('')}
                            </select>
                            <span class="text-gray-500">à</span>
                            <select name="${day.toLowerCase()}_end" class="w-1/3 px-4 py-2 block mt-1 w-full rounded-lg border border-orange-300 focus:ring-orange-500 focus:border-orange-500">
                                ${timeOptions.map(time => `<option value="${time}">${time}</option>`).join('')}
                            </select>
                            <div class="flex items-center gap-2 ml-4">
                                <input type="checkbox" id="${day.toLowerCase()}_unavailable" class="w-5 h-5 block mt-1 rounded-lg border border-yellow-300  focus:border-yellow-500" />
                                <label for="${day.toLowerCase()}_unavailable" class="text-sm text-black dark:text-gray-600">Indisponible</label>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
    
        const daysOfWeek = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
        const scheduleForm = document.getElementById('schedule-form');
        daysOfWeek.forEach(day => {
            scheduleForm.innerHTML += createDaySection(day);
        });

        function toggleTarifField(service) {
            var tarifField = document.getElementById("tarif-" + service);
            var checkbox = document.getElementById(service);
            
            if (checkbox.checked) {
                tarifField.style.display = "block";
            } else {
                tarifField.style.display = "none";
            }
        }

        function hideService(service) {
            var checkbox = document.getElementById(service);
            var tarifField = document.getElementById("tarif-" + service);
            
          
            checkbox.checked = false;
            tarifField.style.display = "none";
        }

        function villeChoisi(ville) {
        document.getElementById('listville').classList.remove('block')
        document.getElementById('listville').classList.add('hidden')
        document.getElementById('inputville').value = ville.innerHTML
        //document.getElementById('inputville').innerText = ville.innerHTML
        }

        document.addEventListener("DOMContentLoaded", function() {
     
            toggleTarifField('garde_de_chien');
            toggleTarifField('promenade');
        });

    //     document.addEventListener('DOMContentLoaded', function () {
    //         const input = document.getElementById('inputville');
    //         const buttonville = document.getElementById('buttonville');
    //         const listville = document.getElementById('listville');

    // buttonville.addEventListener('click', function () {
    //     console.log('Bouton cliqué');

    //     if (!input.value.trim()) {
    //         console.log('Champ vide');
    //         return;
    //     }

    //     const processedInput = encodeURIComponent(input.value.trim());
    //     const url = `{{ route('search.villes') }}?query=${processedInput}`;
    //     console.log('URL générée :', url);

    //     fetch(url, {
    //         method: 'GET',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log('Données reçues :', data);
    //         listville.innerHTML = '';  // On vide la liste avant d'ajouter les nouvelles villes
            
    //         if (data.length === 0) {
    //             listville.innerHTML = `<li class="p-2 text-gray-500">Aucune ville trouvée</li>`;
    //         } else {
    //             data.forEach(ville => {
    //                 const li = document.createElement('li');
    //                 li.textContent = `${ville.nom_de_la_commune} (${ville.code_postal})`;
    //                 li.classList.add('w-full', 'py-1', 'px-2', 'cursor-pointer', 'hover:bg-gray-200', 'dark:hover:bg-gray-700');
    //                 li.onclick = function () {
    //                     villeChoisi(this);
    //                 };
    //                 listville.appendChild(li);
    //             });
    //         }

    //         listville.classList.remove('hidden');
    //         listville.classList.add('block');
    //     })
    //     .catch(error => {
    //         console.error('Erreur lors de la requête :', error);
    //     });
    // });

    // function villeChoisi(element) {
    //     input.value = element.textContent;
    //     listville.classList.add('hidden');
    // }
    // });
        
    document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('inputville');
    const buttonville = document.getElementById('buttonville');
    const listville = document.getElementById('listville');

    buttonville.addEventListener('click', function () {
        console.log('Recherche de ville');

        if (!input.value.trim()) {
            console.log('Champ vide');
            return;
        }

        const processedInput = encodeURIComponent(input.value.trim());
        const url = `/search-villes?query=${processedInput}`;  // Route vers le contrôleur

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Données reçues :', data);
            listville.innerHTML = '';  // Vide la liste des villes avant d'ajouter de nouveaux résultats
            
            if (data.length === 0) {
                listville.innerHTML = `<li class="p-2 text-gray-500">Aucune ville trouvée</li>`;
            } else {
                data.forEach(ville => {
                    const li = document.createElement('li');
                    li.textContent = `${ville.nom_de_la_commune} (${ville.code_postal})`;
                    li.classList.add('w-full', 'py-1', 'px-2', 'cursor-pointer', 'hover:bg-gray-200', 'dark:hover:bg-gray-700');
                    li.onclick = function () {
                        villeChoisi(this, ville);  // Sélectionner la ville
                    };
                    listville.appendChild(li);
                });
            }

            listville.classList.remove('hidden');
            listville.classList.add('block');
        })
        .catch(error => {
            console.error('Erreur lors de la requête :', error);
        });
    });

    // Fonction pour choisir la ville et la sauvegarder dans la base
    function villeChoisi(element, ville) {
        const input = document.getElementById('inputville');
        const listville = document.getElementById('listville');

        // Mettre la ville choisie dans l'input
        input.value = `${ville.nom_de_la_commune} (${ville.code_postal})`;

        // Masquer la liste des villes
        listville.classList.add('hidden');

        // Sauvegarder la ville sélectionnée dans la base
        fetch('/save-ville', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                id: ville.id,
                nom_de_la_commune: ville.nom_de_la_commune,
                code_postal: ville.code_postal
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Ville enregistrée avec succès :', data.message);
            } else {
                console.error('Erreur lors de l\'enregistrement de la ville.');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête :', error);
        });
    }
});


</script>

</x-guest-layout>

