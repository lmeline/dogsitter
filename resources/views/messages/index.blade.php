<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vos messages ') }}
        </h2>
    </x-slot>
    
        <div class="container mx-auto py-8">
            <ul class="space-y-4">
                @forelse ($threads as $thread)
                    <li class="flex items-center justify-between bg-white shadow p-4 rounded-lg">
                        <span class="text-gray-800 font-medium">{{ $thread->subject }}</span>
                        <a href="{{ route('messages.show', $thread->id) }}" 
                           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            Voir les messages
                        </a>
                    </li>
                @empty
                    <li>Aucune conversation disponible.</li>
                @endforelse
            </ul>
        </div>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('messages.create') }}" 
               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                Nouvelle Conversation
            </a>
        </div>
    </div>
</x-app-layout>
