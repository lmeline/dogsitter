<x-app-layout>


    <div class="flex flex-col sm:justify-center items-center mt-4 sm:pt-0 max-w-3xl mx-auto px-4 py-6">
        <h1 class="text-center mb-5 font-bold text-3xl pt-5">Ajoutez un chien</h1>
        <form method="POST" action="{{ route('storeregisterdog') }}"
            class="overflow-y-auto px-6 py-4 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg space-y-4">
            @csrf

            <!-- Name -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                <div>
                    <x-input-label for="nom" :value="__('Nom')" />
                    <x-text-input id="nom"
                        class="block mt-1 w-full rounded border border-red-300 focus:ring-red-500 focus:border-red-500 dark:bg-white dark:text-black"
                        type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="race" :value="__('Race de chien')" />
                    <select id="race" name="race"
                        class="block mt-1 w-full rounded border border-red-300 focus:ring-red-500 focus:border-red-500">
                        <option value="">- Choisissez une race -</option>
                        @foreach ($races as $race)
                            <option value="{{ $race->nom }}"> {{ $race->nom }}</option>
                        @endforeach
                        <option value="Autre"> Autre</option>
                    </select>
                    <x-input-error :messages="$errors->get('race')" class="mt-2" />
                </div>
            </div>

            <!-- Age -->
            <div class="mt-4">
                <x-input-label for="date_naissance" :value="__('Date of birth')" />
                <x-text-input id="date_naissance" class="block mt-1 w-full border" type="date" name="date_naissance" :value="old('date_naissance')" required />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>

            <!-- Poids -->
            <div class="mt-4">
                <x-input-label for="poids" :value="__('Poids')" />
                <select id="poids" name="poids"
                    class="block mt-1 w-full border border-yellow-300 focus:ring-yellow-500 focus:border-yellow-500 rounded-md">
                    @for ($i = 1; $i <= 70; $i++)
                        <option value="{{ $i }}" {{ old('poids') == $i ? 'selected' : '' }}>
                            {{ $i }} kg
                        </option>
                    @endfor
                    <option value="plus"> plus</option>
                </select>
                <x-input-error :messages="$errors->get('poids')" class="mt-2" />
            </div>

            <!-- Comportement -->
            <div class="mt-4">
                <x-input-label for="comportement" :value="__('Comportement')" />
                <textarea id="comportement" name="comportement" rows="3"
                    class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500 rounded-md"
                    autocomplete="comportement">{{ old('comportement') }}</textarea>
                <x-input-error :messages="$errors->get('comportement')" class="mt-2" />
            </div>

            <!-- Besoins spéciaux -->
            <div class="mt-4">
                <x-input-label for="besoins_speciaux" :value="__('Besoins Spéciaux')" />
                <textarea id="besoins_speciaux" name="besoins_speciaux" rows="3"
                    class="block mt-1 w-full border border-pink-300 focus:ring-pink-500 focus:border-pink-500 rounded-md"
                    autocomplete="besoin_speciaux">{{ old('besoin_speciaux') }}</textarea>
                <x-input-error :messages="$errors->get('besoins_speciaux')" class="mt-2" />
            </div>

            <!-- Sexe -->
            <div class="mt-4">
                <x-input-label for="sexe" :value="__('Sexe')" />
                <select id="sexe" name="sexe"
                    class="block mt-1 w-full border border-red-300 focus:ring-red-500 focus:border-red-500 rounded-md"
                    required>
                    <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Femelle</option>
                </select>
                <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
            </div>

            <!-- Stérilisé -->
            <div class="mt-4 flex items-center gap-2">
                <input id="sterilise" type="checkbox" name="sterilise"
                    class="rounded-full h-[1.1rem] w-[1.1rem] border border-pink-300 focus:ring-pink-500 focus:border-pink-500 dark:text-white">
                <label for="sterilise" class="text-sm dark:text-white"> Stérilisé</label>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-center">
                <button type="submit"
                    class="mx-4 px-4 py-2 bg-yellow-600 text-white font-semibold rounded-md shadow-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 ease-in-out">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>