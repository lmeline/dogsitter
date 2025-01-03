<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer une nouvelle conversation') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf

            <!-- Sujet de la conversation -->
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700">Sujet</label>
                <input type="text" name="subject" id="subject" class="mt-1 block w-full" value="{{ old('subject') }}" required>
                @error('subject')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Message initial -->
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" class="mt-1 block w-full" rows="4" required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Participants -->
            <div class="mb-4">
                <label for="participants" class="block text-sm font-medium text-gray-700">Participants</label>
                <select name="participants[]" id="participants" class="mt-1 block w-full" multiple required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                    @endforeach
                </select>
                @error('participants')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit button -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Créer la conversation
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
