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
            @if (Auth::user()->role === 'dogsitter')
                <!-- Bouton pour ouvrir la modal -->
                <button onclick="toggleModal()" 
                        class="bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                    Créer une conversation
                </button>
            @endif

            <!-- Modal cachée au départ -->
            <div id="searchModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-semibold mb-4">Rechercher un propriétaire</h2>

                    <!-- Barre de recherche AJAX -->
                    <input type="text" id="searchInput" 
                        placeholder="Nom du propriétaire..." 
                        class="w-full border border-gray-300 rounded-lg p-2 mb-4">
                    
                    <!-- Résultats dynamiques ici -->
                    <div id="searchResults" class="mt-4"></div>

                    <!-- Bouton fermer -->
                    <button onclick="toggleModal()" class="mt-4 w-full bg-red-500 text-white py-2 rounded-lg">
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
    </x-app-layout>
    <script>
        function toggleModal() {
            document.getElementById('searchModal').classList.toggle('hidden');
        };
        
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');

            let timeout = null;
            function fetchProprietaires() {
                const search = encodeURIComponent(searchInput.value.trim());
                const URL = `{{ route('search.owner') }}?name=${search}`;
                
                fetch(URL, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';

                    if (data.length === 0) {
                        searchResults.innerHTML = '<p class="text-gray-500">Aucun propriétaire trouvé.</p>';
                        return;
                    }

                    data.forEach(proprietaire => {
                        searchResults.innerHTML += `
                            <a href="/messages/create/${proprietaire.id}" class="block p-4 hover:bg-gray-100 transition">
                                <div class="flex items-center">
                                    <img src="${proprietaire.photo}" alt="${proprietaire.name}" class="w-12 h-12 rounded-full object-cover mr-4">
                                    <div>
                                        <h2 class="text-lg font-semibold">${proprietaire.name}</h2>
                                        <p class="text-gray-500">${proprietaire.prenom}</p>
                                    </div>
                                </div>
                            </a>`;
                    });
                })
                .catch(error => {
                    console.error('Error fetching proprietaires:', error);
                });
            }
            searchInput.addEventListener('input',function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(fetchProprietaires, 500);
            });
        }); 

    </script>
@endsection
