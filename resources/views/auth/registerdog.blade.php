<x-guest-layout>
    
    <div x-data="{ open: false }">
        <div class="flex flex-col justify-center items-center mt-4 gap-2">
            <p class="text-2xl"> Voulez-vous ajouter votre chien ?  </p>
            <div class="flex gap-2">
                <a href="{{ route('dashboard') }}"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                    Passez cette étape
                </a>
                <button @click="open = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded "> Ajouter un chien</button>
            </div>
           
        </div>
        
    
        <form x-show="open"  method="POST" action="{{ route('register') }}">
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
                <x-input-label for="adresse" :value="__('adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required autocomplete="username" />
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
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
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