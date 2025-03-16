<x-app-layout>
    <div class="container mx-auto py-10">
        <form id="searchForm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <!-- Recherche par nom -->
                <input type="text" id="search" name="name" placeholder="Nom de famille"
                    class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">

                <div class="relative">
                    <input type="text" id="ville" name="ville" placeholder="Ville" autocomplete="off"
                        class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <ul id="villeSuggestions"
                        class="absolute w-full bg-white border border-gray-300 rounded mt-1 hidden"></ul>
                </div>

                <select id="note_moyenne" name="note_moyenne"
                    class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <option value="">Toutes notes</option>
                    <option value="4">4+ étoiles</option>
                    <option value="3">3+ étoiles</option>
                    <option value="2">2+ étoiles</option>
                </select>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="dogsittersContainer">
            @foreach ($dogsitters as $dogsitter)
                <a href="{{ route('dogsitters.show', $dogsitter->id) }}"
                    class="block bg-gradient-to-r from-pink-100 via-yellow-100 to-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-gradient-to-r hover:from-pink-200 hover:via-yellow-200 hover:to-green-200">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-black hover:text-red-800 transition-colors duration-300">
                                {{ $dogsitter->name }} {{ $dogsitter->prenom }}
                            </h2>
                        </div>

                        <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}"
                            class="w-24 h-24 rounded-full object-cover ml-4 border-4 border-white" />
                    </div>
                    <p class="text-gray-600 mt-2">Ville: {{ $dogsitter->ville->nom_de_la_commune }}</p>
                    <p class="text-gray-600">Note moyenne: {{ $dogsitter->note_moyenne }}/5 </p>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Afficher la pagination -->
    <div class="mt-8 flex justify-center">
        <!-- Masquer le texte "Page X sur Y" -->
        <style>
            .pagination .page-item .page-link[rel="prev"],
            .pagination .page-item .page-link[rel="next"] {
                display: none;
            }
        </style>

        {{ $dogsitters->links() }}
    </div>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const villeInput = document.getElementById('ville');
        const noteMoyenneInput = document.getElementById('note_moyenne');
        const dogsittersContainer = document.getElementById('dogsittersContainer');

        let timeout = null;

        function fetchDogSitters() {
            const search = encodeURIComponent(searchInput.value.trim());
            const ville = encodeURIComponent(villeInput.value.trim());
            const noteMoyenne = encodeURIComponent(noteMoyenneInput.value.trim());

            const URL = `{{ route('search.dogsitters') }}?name=${search}&ville=${ville}&note_moyenne=${noteMoyenne}`;

            fetch(URL, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    dogsittersContainer.innerHTML = '';

                    if (data.length === 0) {
                        dogsittersContainer.innerHTML = '<p class="text-gray-500">Aucun résultat trouvé.</p>';
                        return;
                    }

                    data.forEach(dogsitter => {
                        dogsittersContainer.innerHTML += `
                    <a href="/dogsitters/${dogsitter.id}" class="block bg-gradient-to-r from-pink-100 via-yellow-100 to-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-gradient-to-r hover:from-pink-200 hover:via-yellow-200 hover:to-green-200">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-black hover:text-red-800 transition-colors duration-300">
                                    ${dogsitter.name} ${dogsitter.prenom}
                                </h2>
                            </div>
                            <img src="${dogsitter.photo}" alt="${dogsitter.name}" class="w-24 h-24 rounded-full object-cover ml-4 border-4 border-white"/>
                        </div>
                        <p class="text-gray-600 mt-2">Ville: ${dogsitter.ville.nom_de_la_commune}</p>
                        <p class="text-gray-600">Note moyenne: ${dogsitter.note_moyenne}/5 </p>
                    </a>`;
                    });
                })
                .catch(error => console.error('Erreur:', error));
        }

        [searchInput, villeInput, noteMoyenneInput].forEach(input => {
            input.addEventListener('input', function () {
                clearTimeout(timeout);
                timeout = setTimeout(fetchDogSitters, 500);
            });
        });
    });


</script>
