<x-app-layout>


<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Ajouter un Chien') }}
    </h2>
</x-slot>


<div class="container mx-auto py-10">
    <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Ajouter un Chien</h1>

    {{-- <form action="{{route('dogs.store')}}" method="POST" class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto">
        @csrf
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nom du chien</label>
            <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="race" class="block text-gray-700 font-bold mb-2">Race du chien</label>
            <input type="text" id="race" name="race" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="age" class="block text-gray-700 font-bold mb-2">Âge du chien</label>
            <input type="number" id="age" name="age" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                Ajouter le chien
            </button>
        </div>
    </form> --}}

    <form method="POST" action="{{ route('storeregisterdog') }}">
        @csrf

        <!-- Name -->
        <div class="flex w-full gap-2 mt-4">
            <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="race" :value="__('Race de chien')" />
            
                <select id="race" name="race" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700">
                    <option value="">-- Choisissez une race --</option>
                    <option value="Labrador Retriever">Labrador Retriever</option>
                    <option value="Berger Allemand">Berger Allemand</option>
                    <option value="Golden Retriever">Golden Retriever</option>
                    <option value="Bulldog">Bulldog</option>
                    <option value="Beagle">Beagle</option>
                    <option value="Caniche">Caniche</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Shih Tzu">Shih Tzu</option>
                    <option value="Rottweiler">Rottweiler</option>
                    <option value="Bouledogue Français">Bouledogue Français</option>
                    <option value="Cocker Spaniel">Cocker Spaniel</option>
                    <option value="Schnauzer">Schnauzer</option>
                    <option value="Yorkshire Terrier">Yorkshire Terrier</option>
                    <option value="Dachshund">Dachshund</option>
                    <option value="Mastin Espagnol">Mastin Espagnol</option>
                    <option value="Dalmatien">Dalmatien</option>
                    <option value="Border Collie">Border Collie</option>
                    <option value="Bichon Frisé">Bichon Frisé</option>
                    <option value="Akita">Akita</option>
                    <option value="Chow Chow">Chow Chow</option>
                    <option value="Husky Sibérien">Husky Sibérien</option>
                    <option value="Shiba Inu">Shiba Inu</option>
                    <option value="Pitbull">Pitbull</option>
                    <option value="Jack Russell Terrier">Jack Russell Terrier</option>
                    <option value="Pug">Pug</option>
                    <option value="Weimaraner">Weimaraner</option>
                    <option value="Cavalier King Charles Spaniel">Cavalier King Charles Spaniel</option>
                    <option value="Lhassa Apso">Lhassa Apso</option>
                    <option value="Chesapeake Bay Retriever">Chesapeake Bay Retriever</option>
                    <option value="Boxer">Boxer</option>
                    <option value="Great Dane">Great Dane</option>
                    <option value="Saint-Bernard">Saint-Bernard</option>
                    <option value="Bernese Mountain Dog">Bernese Mountain Dog</option>
                    <option value="English Setter">English Setter</option>
                    <option value="American Staffordshire Terrier">American Staffordshire Terrier</option>
                    <option value="Newfoundland">Newfoundland</option>
                    <option value="Scottish Terrier">Scottish Terrier</option>
                    <option value="Whippet">Whippet</option>
                    <option value="Tibetan Mastiff">Tibetan Mastiff</option>
                    <option value="Vizsla">Vizsla</option>
                    <option value="Rottweiler">Rottweiler</option>
                    <option value="Shikoku">Shikoku</option>
                    <option value="Papillon">Papillon</option>
                    <option value="American Bulldog">American Bulldog</option>
                    <option value="Basset Hound">Basset Hound</option>
                    <option value="Bloodhound">Bloodhound</option>
                    <option value="Saluki">Saluki</option>
                    <option value="Great Pyrenees">Great Pyrenees</option>
                    <option value="American Foxhound">American Foxhound</option>
                    <option value="Basenji">Basenji</option>
                    <option value="Belgian Malinois">Belgian Malinois</option>
                    <option value="Cairn Terrier">Cairn Terrier</option>
                    <option value="Gordon Setter">Gordon Setter</option>
                    <option value="Dogo Argentino">Dogo Argentino</option>
                    <option value="Fox Terrier">Fox Terrier</option>
                    <option value="Irish Setter">Irish Setter</option>
                    <option value="Norfolk Terrier">Norfolk Terrier</option>
                    <option value="Pekingese">Pekingese</option>
                    <option value="Schipperke">Schipperke</option>
                    <option value="Tenterfield Terrier">Tenterfield Terrier</option>
                    <option value="Yorkshire Terrier">Yorkshire Terrier</option>
                    <option value="Autre">Autre</option>
                </select>
                <x-input-error :messages="$errors->get('race')" class="mt-2" />
            </div>
        </div>
     
        <div class="mt-4">
            <x-input-label for="age" :value="__('Age')" />
            
            <select id="age" name="age" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @for ($i = 1; $i <= 25; $i++)
                    <option value="{{ $i }}" {{ old('age') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="poids" :value="__('Poids (kg)')" />
            
            <select id="poids" name="poids" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @for ($i = 1; $i <= 70; $i++)
                    <option value="{{ $i }}" {{ old('poids') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
                <option value="plus"> plus</option>
            </select>
            <x-input-error :messages="$errors->get('poids')" class="mt-2" />
        </div>
        

        <div class="mt-4">
            <x-input-label for="comportement" :value="__('Comportement')" />
            <textarea id="comportement" name="comportement" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700" autocomplete="comportement">{{ old('comportement') }}</textarea>
            <x-input-error :messages="$errors->get('comportement')" class="mt-2" />
        </div>
        
        <div class= "mt-4">
            
            <x-input-label for="besoins_speciaux" :value="__('Besoins Spéciaux')" />
            <textarea id="besoins_speciaux" name="besoins_speciaux" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700" autofocus autocomplete="besoin_speciaux">{{ old('besoin_speciaux') }}</textarea>
            <x-input-error :messages="$errors->get('besoins_speciaux')" class="mt-2" />
        </div>
        

        <div>
            <x-input-label for="sexe" :value="__('Sexe')" />
            <select id="sexe" name="sexe" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>M</option>
                <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>F</option>
            <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
        </div>
    
        <div class="block mt-4">
            <x-input-label for="sterilise" :value="__('Sterilisé')" />
            <input type="checkbox" id="sterilise" name="sterilise">
        </div>
        

        <div class="mt-4">
            <button class="mx-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 ease-in-out">
            {{ __('Register') }}
            </button>
        </div>

    </form>
</div>
</x-app-layout>
