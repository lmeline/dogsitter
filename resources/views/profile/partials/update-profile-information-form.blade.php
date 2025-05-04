<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Grille pour les champs "Nom" et "Prénom" -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full h-10" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="prenom" :value="__('First name')" />
                <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full h-10" :value="old('prenom', $user->prenom)" required autofocus autocomplete="prenom" />
                <x-input-error class="mt-2" :messages="$errors->get('prenom')" />
            </div>
        </div>

        <!-- Grille pour les champs "Ville" et "Code postal" -->
        <div class="grid grid-cols-2 gap-4">
            <div class="relative">
                <x-input-label for="ville" :value="__('City')" />
                <x-text-input id="villeInput" type="text" 
                    class="block mt-1 w-full border rounded-lg" :value="old('nom_de_la_commune', $user->ville->nom_de_la_commune)"/>
                <ul id="villeContainer" class="hidden absolute mt-8 w-full max-h-[12rem] top-[2.3rem] rounded bg-white dark:bg-zinc-600 ring-1 ring-zinc-300 dark:ring-zinc-400 overflow-y-auto z-10 shadow-lg" ></ul>
                <input type="hidden" id="villeId" name="ville_id" value="{{ $user->ville_id }}" >
            </div>
        
            <!-- Champ du code postal -->
            <div class="relative">
                <x-input-label for="code_postal" :value="__('Postal code')" />
                <x-text-input id="codePostalInput" name="code_postal" 
                    class="block mt-1 w-full border rounded-lg"  :value="old('colde_postal', $user->code_postal)" readonly/>
            </div>
        </div>
        <!-- Champ pour l'email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full h-10" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <!-- Champ pour la photo de profil -->
        <div>
            <x-input-label for="photo" :value="__('Photo de profil')" />
            <input 
                id="photo" 
                class="block mt-1 w-full h-10 border-gray-300 rounded-md" 
                type="file" 
                name="photo" 
            />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>
        <!-- Boutons de soumission -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>


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
    </script>
</section>