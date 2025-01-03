<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vos messages') }}
            @if ($unreadCount > 0)
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-2">
                    {{ $unreadCount }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <ul class="space-y-4">
            @foreach ($threads as $thread)
                @php
                    // Calculer le nombre de messages non lus pour l'utilisateur actuel
                    $unreadCountThread = $thread->messages()->where('lu', false)
                                                           ->where('user_id', '!=', Auth::id())
                                                           ->count();
                    
                    // Récupérer le dernier message du thread
                    $lastMessage = $thread->messages()->latest()->first();
                @endphp
                <li class="flex items-center justify-between bg-white shadow p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <!-- Photo de profil de l'utilisateur (Récupéré via la relation) -->
                        <img src="{{ asset($lastMessage->user->photo ?? 'images/default-avatar.jpg') }}" alt="{{ $lastMessage->user->name }}" class="w-12 h-12 rounded-full object-cover">

                        <div>
                            <!-- Nom de l'utilisateur -->
                            <span class="text-gray-800 font-medium">{{ $lastMessage->user->name }}</span>
                            <p class="text-gray-500 text-sm">
                                <!-- Aperçu du dernier message -->
                                {{ Str::limit($lastMessage->body, 50) }}...
                            </p>
                        </div>
                    </div>

                    <!-- Afficher le nombre de messages non lus -->
                    @if ($unreadCountThread > 0)
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                            {{ $unreadCountThread }}
                        </span>
                    @endif
                    
                    <a href="{{ route('messages.show', $thread->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Voir les messages
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</x-app-layout>
