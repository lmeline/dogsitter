<x-guest-layout>
    <div x-data="{ open: false }">
        <div class="flex flex-col justify-center items-center mt-4 gap-2 dark:text-white mb-4">
            <p class="text-2xl pb-4 "> Voulez-vous ajouter votre chien ?  </p>
            <div class="flex gap-2">
                <a href="{{ route('index') }}"  class="bg-red-600 hover:bg-red-400 text-white font-bold py-2 px-4 rounded ">
                    Passez cette étape
                </a>
                <button @click="open = true" class="bg-orange-600 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded "> Ajouter un chien</button>
            </div>
           
        </div>
        
    
        <form x-show="open"  method="POST" action="{{ route('storeregisterdog') }}" class="overflow-y-auto px-6 py-4 relative" >
            @csrf
    
            <!-- Name -->
            <div class="flex w-full gap-2 mt-4">
    
                <div>
                    <x-input-label for="nom" :value="__('Nom')" />
                    <x-text-input id="nom" class=" block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500 rounded" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                </div>
    
                <div>
                    <x-input-label for="race" :value="__('Race de chien')" />
                
                    <select id="race" name="race" class="block mt-1 w-full rounded border border-red-300 focus:ring-red-500 focus:border-red-500">
                        <option value="">- Choisissez une race -</option>
                        @foreach ($races as $race )
                            <option value="{{ $race->nom }}"> {{ $race->nom }}</option>
                        @endforeach
                        <option value="Autre"> Autre</option>
                    </select>
                    <x-input-error :messages="$errors->get('race')" class="mt-2" />
                </div>
            </div>
         
            <div class="mt-4">
                <x-input-label for="date_naissance" :value="__('Date of birth')" />
                <x-text-input id="date_naissance" class="block mt-1 w-full border" type="date" name="date_naissance" :value="old('date_naissance')" required />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="poids" :value="__('Poids')" />
                
                <select id="poids" name="poids" class="block mt-1 w-full border border-yellow-300 focus:ring-yellow-500 focus:border-yellow-500 rounded-md">
                    @for ($i = 1; $i <= 70; $i++)
                        <option value="{{ $i }}" {{ old('poids') == $i ? 'selected' : '' }}>
                            {{ $i }} kg
                        </option>
                    @endfor
                    <option value="plus"> plus</option>
                </select>
                <x-input-error :messages="$errors->get('poids')" class="mt-2" />
            </div>
            
    
            <div class="mt-4">
                <x-input-label for="comportement" :value="__('Comportement')" />
                <textarea id="comportement" name="comportement" rows="4" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500 rounded-md" autocomplete="comportement">{{ old('comportement') }}</textarea>
                <x-input-error :messages="$errors->get('comportement')" class="mt-2" />
            </div>
            
            <div class= "mt-4">
                
                <x-input-label for="besoins_speciaux" :value="__('Besoin Spéciaux')" />
                <textarea id="besoins_speciaux" name="besoins_speciaux" rows="4" class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500 rounded-md" autofocus autocomplete="besoin_speciaux">{{ old('besoin_speciaux') }}</textarea>
                <x-input-error :messages="$errors->get('besoins_speciaux')" class="mt-2" />
            </div>
            
    
            <div>
                <x-input-label for="sexe" :value="__('Sexe')" />
                <select id="sexe" class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500 rounded-md" type="text" name="sexe" :value="old('sexe')" required autofocus autocomplete="sexe">
                    <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Femelle</option>
                </select>
                <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
            </div>
        
            <div class="block mt-4">
                    <input id="sterilise" type="checkbox" name="sterilise" class="rounded-full h-[1.1rem] w-[1.1rem] border border-pink-300 focus:ring-pink-500 focus:border-pink-500">
                   <label for="sterilise" class="dark:text-white"> Stérilisé</label>
            </div>
            

            <div class="mt-4">
                <button class="mx-4 px-4 py-2 bg-yellow-600 text-white font-semibold rounded-md shadow-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 ease-in-out">
                {{ __('Register') }}
                </button>

            </div>

        </form>
    </div>
   

</x-guest-layout>