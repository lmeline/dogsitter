@extends('layouts.partials.default-layout')
@section('content')

    <x-app-layout>
        <div class="container mx-auto py-8">
            <form method="GET" action="{{ route('messages.index') }}" class="mb-6">
                <div class="flex items-center w-full space-x-2">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Rechercher un utilisateur..." 
                        class="flex-grow mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-lg p-3"
                    />
                    <button type="submit" class="bg-gradient-to-r from-yellow-300 to-pink-300  px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                        Rechercher
                    </button>
                </div>
            </form>
            <button id="openModal" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                Créer un message
            </button>
            
            <!-- MODAL -->
            <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg w-96">
                    <h2 class="text-lg font-bold mb-4">Sélectionner un propriétaire</h2>
                    
                    <ul id="proprietairesList" class="space-y-2">
                        @foreach ($proprietaires as $proprietaire)
                            <li class="flex justify-between items-center p-2 border rounded">
                                <span>{{ $proprietaire->name }}</span>
                                <a href="{{ route('messages.create', ['user_id' => $proprietaire->id]) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                    Envoyer
                                </a>
                            </li>
                        @endforeach
                    </ul>
            
                    <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                        Fermer
                    </button>
                </div>
            </div>
            

            <ul class="space-y-4">
                @foreach ($threads as $thread)
                    @php
                        $otherUser = $thread->users()->where('users.id', '!=', Auth::id())->first();

                        if (!$otherUser) {
                            continue;
                        }

                        $unreadCountThread = $thread->messages()
                                                    ->where('lu', false)
                                                    ->where('user_id', '!=', Auth::id())
                                                    ->count();

                        $lastMessage = $thread->messages()->latest()->first();
                    @endphp

                    <li class="flex items-center justify-between bg-white shadow p-4 rounded-lg hover:bg-gray-100 transition">
                        <a href="{{ route('messages.show', $thread->id) }}" class="flex items-center justify-between w-full">
                            <div class="flex items-center space-x-4">
                                
                                <img src="{{ asset($otherUser->photo ?? 'images/default-avatar.jpg') }}" alt="{{ $otherUser->name }}" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                
                                    <span class="text-gray-800 font-medium">{{ $otherUser->name }}</span>
                                    <p class="text-gray-500 text-sm">
                                        @if ($lastMessage)
                                        <strong>{{ $lastMessage->user->name }}:</strong>
                                            {{ Str::limit($lastMessage->body, 50) }}...
                                        @else
                                            <em>Aucun message dans ce thread</em>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if ($unreadCountThread > 0)
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $unreadCountThread }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <script>
            document.getElementById('openModal').addEventListener('click', function() {
                document.getElementById('modal').classList.remove('hidden');
            });
        
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('modal').classList.add('hidden');
            });
        </script>
        
    </x-app-layout>
@endsection
