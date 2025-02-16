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

        <!-- Champ pour le numéro de téléphone -->
        <div>
            <x-input-label for="numero_telephone" :value="__('Telephone number')" />
            <x-text-input id="numero_telephone" class="block mt-1 w-full h-10" type="text" name="numero_telephone" :value="old('numero_telephone', $user->numero_telephone)" required autocomplete="telephone" />
            <x-input-error :messages="$errors->get('numero_telephone')" class="mt-2" />
        </div>
       
        
        <!-- Champ pour l'adresse -->
        <div>
            <x-input-label for="adresse" :value="__('Address')" />
            <x-text-input id="adresse" class="block mt-1 w-full h-10" type="text" name="adresse" :value="old('adresse', $user->adresse)" required autocomplete="adresse" />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        <!-- Grille pour les champs "Code postal" et "Ville" -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="code_postal" :value="__('Postal code')" />
                <x-text-input id="code_postal" class="block mt-1 w-full h-10" type="text" name="code_postal" :value="old('code_postal', $user->code_postal)" required autocomplete="code_postal" />
                <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="ville" :value="__('City')" />
                <x-text-input id="ville_id" class="block mt-1 w-full h-10" type="text" name="ville" :value="old('ville', $user->ville->nom_de_la_commune)" required autocomplete="ville" />
                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
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
        {{-- <div>
            <x-input-label for="photo" :value="__('Photo de profil')" />
            <input 
                id="photo" 
                class="block mt-1 w-full h-10 border-gray-300 rounded-md" 
                type="file" 
                name="photo" 
                accept="image/*" 
            />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div> --}}
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
</section>
