<x-guest-layout>
    <div x-data="{ proprietaire: true }" class="h-full max-w-4xl mx-auto">

        <div class="flex items-center justify-evenly w-full">
            <!-- Bouton Proprietaire - jaune -->
            <button @click="proprietaire = true" type="button"
                    :class="proprietaire ? 'bg-orange-300 text-white' : 'bg-gray-400 text-gray-800'"
                    class=" w-full font-bold hover:bg-orange-200 focus:outline-none text-sm p-2.5 transition-colors duration-300">
                Proprietaire
            </button>

            <!-- Bouton Dogsitter - bleu -->
            <button @click="proprietaire = false" type="button"
                    :class="!proprietaire ? 'bg-blue-300 text-white' : 'bg-gray-400 text-gray-800'"
                    class=" w-full font-bold hover:bg-blue-200 focus:outline-none text-sm p-2.5 transition-colors duration-300">
                Dogsitter
            </button>
        </div>

        <!-- Formulaire Proprietaire -->
        <form x-show="proprietaire" method="POST" action="{{ route('register') }}" class=" px-6 py-4" enctype="multipart/form-data">
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

            <!-- Adresse -->
            <!-- <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="adresse" :value="old('adresse')" required autocomplete="adresse" />
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div> -->

            <!-- Code postal et Ville -->
            <div class="flex w-full gap-2 mt-4">
                <div class="relative">
                    <x-input-label for="ville" :value="__('City')" />
                    <input id="villeInput" type="text" 
                           class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500">
                    <ul id="villeContainer" class="hidden absolute mt-8 w-full max-h-[12rem] top-[2.3rem] rounded bg-white dark:bg-zinc-600 ring-1 ring-zinc-300 dark:ring-zinc-400 overflow-y-auto z-10 shadow-lg"></ul>
                    <input type="hidden" id="villeId" name="ville_id">
                </div>
            
                <!-- Champ du code postal -->
                <div class="relative">
                    <x-input-label for="code_postal" :value="__('Postal code')" />
                    <input id="codePostalInput" name="code_postal" 
                           class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" readonly>
                </div>
            </div>
            <!-- Photo de profil -->
            {{-- <div class="mt-4">
                <x-input-label for="photo" :value="__('Photo de profil')" />
                <input type="file" id="photo" name="photo" accept="image/*" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" />
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

                <x-primary-button class="ms-4 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-red-200 dark:focus:ring-red-700">
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

                    <!-- Adresse
                    <div class="mt-4">
                        <x-input-label for="adresse" :value="__('Adresse')" />
                        <x-text-input id="adresse" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" type="text" name="adresse" :value="old('adresse')" required autocomplete="adresse" />
                        <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                    </div> -->
                    <!-- Code postal et Ville -->
                    <div class="flex w-full gap-2 mt-4">
                        <div class="relative">
                            <x-input-label for="ville" :value="__('City')" />
                            <input id="villeInput2" type="text" 
                                class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500">
                            <ul id="villeContainer2" class="hidden absolute mt-8 w-full max-h-[12rem] top-[2.3rem] rounded bg-white dark:bg-zinc-600 ring-1 ring-zinc-300 dark:ring-zinc-400 overflow-y-auto z-10 shadow-lg"></ul>
                            <input type="hidden" id="villeId2" name="ville_id">
                        </div>
                    
                        <!-- Champ du code postal -->
                        <div class="relative">
                            <x-input-label for="code_postal" :value="__('Postal code')" />
                            <input id="codePostalInput2" name="code_postal" 
                                class="block mt-1 w-full border rounded-lg border-pink-300 focus:ring-pink-500 focus:border-pink-500" readonly>
                        </div>
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
    
                    <!-- Bouton de soumission -->
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-200 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        
                        <x-primary-button class="ms-4 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-200 dark:focus:ring-yellow-700">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script>
                                  
        /* fonction recuperation ville */
        document.addEventListener('DOMContentLoaded',function(){
            const villeInput = document.getElementById('villeInput');
            const villeContainer = document.getElementById('villeContainer');
            const codePostalInput = document.getElementById('codePostalInput');
            const searchVilleURL = "{{ route('search.ville') }}";
            let timeout = null;

            function handleVilleClick(event) {
                const selectedVille = event.target.textContent;
                const selectedVilleId = event.target.getAttribute('data-id');
                const selectedCodePostal = event.target.getAttribute('data-code_postal');
                villeInput.value = selectedVille;
                document.getElementById('villeId').value = selectedVilleId;
                codePostalInput.value = selectedCodePostal;
                villeContainer.classList.add('hidden');

                villeInput.setAttribute('name', 'ville_id');
            }
            
            function fetchville(){
                const ville = encodeURIComponent(villeInput.value.trim());
                const URL = `${searchVilleURL}?ville=${ville}`;

                fetch(URL,{
                    method:'GET',
                    headers:{
                        'Content-Type':'application/json',
                    }
                })
                .then(response=> response.json())
                .then(data=>{
                    //console.log(data)
                    villeContainer.innerHTML = '';
                    if(data.length === 0){
                        villeContainer.innerHTML = '<p class="text-gray-500"> Aucun résultat trouvé </p>';
                        return;
                    }
                    villeContainer.classList.remove('hidden');
                    
                    data.forEach(ville => {
                        let li = document.createElement('li');
                        li.textContent = `${ville.nom_de_la_commune } (${ville.code_postal})`;
                        li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                        li.setAttribute('data-id',ville.id);
                        li.setAttribute('data-code_postal', ville.code_postal)
                        //console.log(ville.code_postal);
                        li.addEventListener('click', handleVilleClick); 
                        
                        villeContainer.appendChild(li);
                    });

                })
                .catch(error=>console.error('Erreur:',error));
            };

            villeInput.addEventListener('input',function(){
                clearTimeout(timeout);
                timeout = setTimeout(fetchville,500);
            })

        });

        /* fonction recuperation ville */
        document.addEventListener('DOMContentLoaded',function(){
            const villeInput2 = document.getElementById('villeInput2');
            const villeContainer2 = document.getElementById('villeContainer2');
            const codePostalInput2 = document.getElementById('codePostalInput2');
            const searchVilleURL2 = "{{ route('search.ville') }}";
            let timeout = null;
            console.log('test');

            function handleVilleClick(event) {
                const selectedVille = event.target.textContent;
                const selectedVilleId = event.target.getAttribute('data-id');
                const selectedCodePostal = event.target.getAttribute('data-code_postal');
                villeInput2.value = selectedVille;
                document.getElementById('villeId2').value = selectedVilleId;
                codePostalInput2.value = selectedCodePostal;
                villeContainer2.classList.add('hidden');

                villeInput2.setAttribute('name', 'ville_id');
            }
            
            function fetchville(){
                const ville = encodeURIComponent(villeInput2.value.trim());
                const URL = `${searchVilleURL2}?ville=${ville}`;

                fetch(URL,{
                    method:'GET',
                    headers:{
                        'Content-Type':'application/json',
                    }
                })
                .then(response=> response.json())
                .then(data=>{
                    //console.log(data)
                    villeContainer2.innerHTML = '';
                    if(data.length === 0){
                        villeContainer2.innerHTML = '<p class="text-gray-500"> Aucun résultat trouvé </p>';
                        return;
                    }
                    villeContainer2.classList.remove('hidden');
                    
                    data.forEach(ville => {
                        let li = document.createElement('li');
                        li.textContent = `${ville.nom_de_la_commune } (${ville.code_postal})`;
                        li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                        li.setAttribute('data-id',ville.id);
                        li.setAttribute('data-code_postal', ville.code_postal)
                        //console.log(ville.code_postal);
                        li.addEventListener('click', handleVilleClick); 
                        
                        villeContainer2.appendChild(li);
                    });

                })
                .catch(error=>console.error('Erreur:',error));
            };

            villeInput2.addEventListener('input',function(){
                clearTimeout(timeout);
                timeout = setTimeout(fetchville,500);
            })

        });

    </script>

</x-guest-layout>

