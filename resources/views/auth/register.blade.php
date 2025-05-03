@php
    $isProprietaire = old('role', 'proprietaire') === 'proprietaire' ? 'true' : 'false';
@endphp

<x-guest-layout>
    <div x-data="{ proprietaire: {{ $isProprietaire }} }" class="h-full max-w-4xl mx-auto">

        <!-- Sélection du rôle -->
        <div class="flex items-center justify-evenly w-full gap-1 mt-6">
            <button @click="proprietaire = true" type="button"
                    :class="proprietaire ? 'bg-orange-300 text-white' : 'bg-gray-400 text-gray-800'"
                    class="w-full font-bold hover:bg-orange-200 focus:outline-none text-sm p-2.5 transition-colors duration-300 rounded">
                Propriétaire
            </button>

            <button @click="proprietaire = false" type="button"
                    :class="!proprietaire ? 'bg-blue-300 text-white' : 'bg-gray-400 text-gray-800'"
                    class="w-full font-bold hover:bg-blue-200 focus:outline-none text-sm p-2.5 transition-colors duration-300 rounded">
                Dogsitter
            </button>
        </div>

        <!-- Formulaire unique pour les deux rôles -->
        <form method="POST" action="{{ route('register') }}" class="px-6 py-4" enctype="multipart/form-data">
            @csrf

            <!-- Champ caché pour le rôle -->
            <input type="hidden" name="role" :value="proprietaire ? 'proprietaire' : 'dogsitter'">

            <!-- Nom et prénom -->
            <div class="flex w-full gap-2 mt-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full border" type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="prenom" :value="__('First name')" />
                    <x-text-input id="prenom" class="block mt-1 w-full border" type="text" name="prenom" :value="old('prenom')" required />
                    <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                </div>
            </div>

            <!-- Date de naissance -->
            <div class="mt-4">
                <x-input-label for="date_naissance" :value="__('Date of birth')" />
                <x-text-input id="date_naissance" class="block mt-1 w-full border" type="date" name="date_naissance" :value="old('date_naissance')" required />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>
            <!-- Photo de profil -->
            {{-- <div class="mt-4">
                <x-input-label for="photo" :value="__('Photo de profil')" />
                <input type="file" id="photo" name="photo" accept="image/*" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500" />
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div> --}}

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full border" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>


            <!-- Ville et Code postal -->
            <div class="flex w-full gap-2 mt-4">
                <div class="relative w-full">
                    <x-input-label for="ville" :value="__('City')" />
                    <input id="villeInput" type="text"
                           class="block mt-1 w-full border rounded-lg"
                           placeholder="Rentrez une ville ">
                    <ul id="villeContainer" class="hidden absolute mt-8 w-full max-h-[12rem] top-[2.3rem] rounded bg-white ring-1 overflow-y-auto z-10 shadow-lg"></ul>
                    <input type="hidden" id="villeId" name="ville_id">
                </div>

                <div class="relative w-full">
                    <x-input-label for="code_postal" :value="__('Postal code')" />
                    <input id="codePostalInput" name="code_postal"
                           class="block mt-1 w-full border rounded-lg" readonly>
                </div>
            </div>

            <!-- Mot de passe -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full border" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmation -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Lien de connexion -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 bg-yellow-500 hover:bg-yellow-600">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Script villes / code postal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
            }

            function fetchVille() {
                const ville = encodeURIComponent(villeInput.value.trim());
                const URL = `${searchVilleURL}?ville=${ville}`;

                fetch(URL, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' }
                })
                .then(response => response.json())
                .then(data => {
                    villeContainer.innerHTML = '';
                    if (data.length === 0) {
                        villeContainer.innerHTML = '<li class="p-2 text-gray-500">Aucun résultat</li>';
                        villeContainer.classList.remove('hidden');
                        return;
                    }

                    villeContainer.classList.remove('hidden');
                    data.forEach(ville => {
                        let li = document.createElement('li');
                        li.textContent = `${ville.nom_de_la_commune} (${ville.code_postal})`;
                        li.classList.add('p-2', 'cursor-pointer', 'hover:bg-gray-200');
                        li.setAttribute('data-id', ville.id);
                        li.setAttribute('data-code_postal', ville.code_postal);
                        li.addEventListener('click', handleVilleClick);
                        villeContainer.appendChild(li);
                    });
                })
                .catch(error => console.error('Erreur :', error));
            }

            villeInput.addEventListener('input', function () {
                clearTimeout(timeout);
                timeout = setTimeout(fetchVille, 500);
            });
        });
    </script>

</x-guest-layout>
