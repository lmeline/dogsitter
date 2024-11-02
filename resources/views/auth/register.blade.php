<x-guest-layout>

    <div x-data="{proprietaire: {{$proprietaire}}}">

        <div class="flex items-center justify-evenly mt-4 w-full">
            <button @click="proprietaire = true" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5" :class="proprietaire ? 'bg-gray-100 dark:bg-gray-900' : ''"> proprietaire</button>
            <button @click="proprietaire = false" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5" :class="proprietaire ? '' : 'bg-gray-100 dark:bg-gray-900'"> dogsitter</button>
        </div>
        
        <form x-show="proprietaire" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="flex w-full gap-2 mt-4">
                <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                <x-input-label for="prenom" :value="__('Prenom')" />
                <x-text-input id="prenom"  class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                </div>
            </div>
         
            <div class="mt-4">
                <x-input-label for="date_naissance" :value="__('Date de naissance')" />
                <x-text-input id="date_naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('date_naissance')" required autocomplete="date_naissance" />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="telephone" :value="__('Numero de telephone')" />
                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required autocomplete="adresse" />
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div>

        
            <div class="flex w-full gap-2 mt-4">
                <div>
                <x-input-label for="code_postal" :value="__('Code postal')" />
                <x-text-input id="code_postal" class="block mt-1 w-full" type="text" name="code_postal" :value="old('code_postal')" required autofocus autocomplete="code_postal" />
                <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
                </div>

                <div>
                <x-input-label for="ville" :value="__('Ville')" />
                <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')" required autofocus autocomplete="ville" />
                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                </div>
            </div>

           
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('mot de passe')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

        <form x-show="!proprietaire" method="POST" action="{{ route('registerdogsitter') }}">
            @csrf

            <!-- Name -->
            <div class="flex w-full gap-2 mt-4">
                <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                <x-input-label for="prenom" :value="__('Prenom')" />
                <x-text-input id="prenom"  class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                </div>
            </div>

            <div class="mt-4">
                <x-input-label for="date_naissance" :value="__('Date de naissance')" />
                <x-text-input id="date_naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('date_naissance')" required autocomplete="date_naissance" />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>
        

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="telephone" :value="__('Numero de telephone')" />
                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="description" :value="__('A propos de moi ')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autocomplete="description" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="experience" :value="__('Experience')" />
                <x-text-input id="experience" class="block mt-1 w-full" type="text" name="experience" :value="old('experience')" required autocomplete="experience" />
                <x-input-error :messages="$errors->get('experience')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required autocomplete="adresse" />
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div>


            <div class="flex w-full gap-2 mt-4">
                <div>
                <x-input-label for="code_postal" :value="__('Code postal')" />
                <x-text-input id="code_postal" class="block mt-1 w-full" type="text" name="code_postal" :value="old('code_postal')" required autofocus autocomplete="code_postal" />
                <x-input-error :messages="$errors->get('code_postal')" class="mt-2" />
                </div>

                <div>
                <x-input-label for="ville" :value="__('Ville')" />
                <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')" required autofocus autocomplete="ville" />
                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                </div>
            </div>
            <!-- Email Address -->

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-guest-layout>
