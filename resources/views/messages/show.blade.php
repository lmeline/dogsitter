<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            
            @if($thread->users->count() > 1)
                @foreach($thread->users as $user)
                    @if($user->id !== auth()->id())  {{-- Assurez-vous de ne pas afficher l'utilisateur connecté --}}
                        {{ $user->name }}
                        @break
                    @endif
                @endforeach
            @endif
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="bg-white shadow p-4 rounded-lg">
            <h3 class="text-xl font-semibold">Messages :</h3>
            <ul class="space-y-4 mt-4">
                @foreach ($thread->messages as $message)
                    <li class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex justify-between">
                            <span class="font-bold">{{ $message->user->name }} :</span>
                            <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-2 text-gray-700">{{ $message->body }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-6">
            <form action="{{ route('messages.addMessage', $thread->id) }}" method="POST">
                @csrf
                <textarea name="message" class="w-full p-4 border rounded-lg" placeholder="Écrire un message..." required></textarea>
                <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Envoyer
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
