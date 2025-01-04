<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une nouvelle conversation avec ') }} {{ $dogsitter->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-6">
        <form action="{{ route('messages.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6 space-y-6">
            @csrf

            <!-- Message initial -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 pb-2">Message</label>
                <textarea name="message" id="message" class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-lg p-3" rows="4" required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Participants (prédéfini avec le dogsitter) -->
            <div class="pt-4 hidden">
                <label for="participants" class="block text-sm font-medium text-gray-700">Participants</label>
                <select name="participants[]" id="participants" class="mt-1 block w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" multiple required>
                    <option value="{{ $dogsitter->id }}" selected>{{ $dogsitter->name }} ({{ $dogsitter->role }})</option>
                </select>
                @error('participants')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

               <!-- Sujet de la conversation (automatiquement rempli avec le nom du dogsitter, et non modifiable ni cliquable) -->
            <div class="mb-4 hidden">
                <label for="subject" class="block text-sm font-medium text-gray-700">Sujet</label>
                <input type="text" name="subject" id="subject" class="mt-1 block w-full" value="{{ $dogsitter->name }}" disabled>
                <!-- Champ hidden pour envoyer la valeur du sujet dans la requête -->
                <input type="hidden" name="subject" value="{{ $dogsitter->name }}">
                @error('subject')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit button -->
            <div class="pt-4"> <!-- Réduit la marge supérieure du bouton ici -->
                <button type="submit" class="w-full bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-200 dark:focus:ring-yellow-700 p-3 rounded-lg">
                    Créer la conversation
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
