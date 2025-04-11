<x-app-layout>
    <div class="container mx-auto py-8 ">

            <div class="flex justify-end md-4 pb-4">
                <button onclick="toggleModal()"
                    class="bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition text-right">
                    Créer une conversation
                </button>
            </div>


        <div id="searchModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg h-96 flex flex-col">
                @if (Auth::user()->role === 'dogsitter')
                <!-- Conteneur du haut (fixe) -->
                    <div class="p-4 flex justify-between items-center">
                        <h2 class="text-xl font-semibold">Rechercher un propriétaire</h2>
                        <button onclick="toggleModal()" class="text-gray-600 hover:text-gray-900 text-2xl">✖</button>
                    </div>
            
                    <!-- Barre de recherche (fixe) -->
                    <div class="p-4">
                        <input type="text" id="searchInput" placeholder="Nom du propriétaire..."
                            class="w-full border border-gray-300 rounded-lg shadow-md">
                    </div>
                @else
                    <div class="p-4 flex justify-between items-center">
                        <h2 class="text-xl font-semibold">Rechercher un dogsitter</h2>
                        <button onclick="toggleModal()" class="text-gray-600 hover:text-gray-900 text-2xl">✖</button>
                    </div>
            
                    <!-- Barre de recherche (fixe) -->
                    <div class="p-4">
                        <input type="text" id="searchInput" placeholder="Nom du dogsitter..."
                            class="w-full border border-gray-300 rounded-lg shadow-md">
                    </div>
                @endif

                <!-- Conteneur des résultats (défilable) -->
                <div id="searchResults" class="flex-1 overflow-y-auto p-4">
                    <!-- Les propriétaires apparaîtront ici -->
                </div>
        
            </div>
        </div>
                
        <form method="GET" action="{{ route('messages.index') }}" class="mb-6">
            <div class="flex items-center w-full space-x-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Rechercher un utilisateur..."
                    class="flex-grow mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 rounded-lg p-3" />
                <button type="submit" id="resultsContainer"
                    class="bg-gradient-to-r from-yellow-300 to-pink-300  px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                    Rechercher
                </button>
            </div>
        </form>
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

                                    <img src="{{ asset($otherUser->photo ?? 'images/default-avatar.jpg') }}"
                                        alt="{{ $otherUser->name }}" class="w-12 h-12 rounded-full object-cover">
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
            searchInput.addEventListener('input', function () {
                clearTimeout(timeout);
                timeout = setTimeout(fetchProprietaires, 500);
            });
            fetchProprietaires();
        });
    </script>
</x-app-layout>