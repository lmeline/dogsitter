<x-app-layout>
    <div class="container mx-auto py-10">
        <form id="searchForm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mb-4">
                <input type="text" id="search" name="name" placeholder="Nom de famille"
                    class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">

                <div class="relative">
                    <input type="text" id="ville" name="ville" placeholder="Ville" autocomplete="off"
                        class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <ul id="villeSuggestions"
                        class="absolute w-full bg-white border border-gray-300 rounded mt-1 hidden"></ul>
                </div>
                <div class="relative">
                    <select id="prestationTypes" name="prestationTypes"
                        class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        <option value="">-- Sélectionnez un type de prestation --</option>
                        @foreach ($prestationtypes as $prestationtype)
                            <option value="{{ $prestationtype->id }}">{{ $prestationtype->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="relative">
                        <input type="number" id="priceMin" name="priceMin" placeholder="Tarif minimum (€)" min="0" step="5"
                            class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>

                    <div class="relative">
                        <input type="number" id="priceMax" name="priceMax" placeholder="Tarif maximum (€)" min="0" step="5"
                            class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>
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
                    <p class="text-gray-600 mt-2">Type de prestations: {{ $dogsitter->prestationTypes->implode('nom', ' , ') }}</p>
                   <p class="text-gray-600 mt-2">
                        Tarif par prestation : <br>
                        @foreach($dogsitter->prestationTypes as $prestation)
                            {{ $prestation->nom }} : {{ $prestation->pivot->prix }} € <br>
                        @endforeach
                    </p>
                </a>
            @endforeach
        </div>
    </div>

    <div class="mt-8 flex justify-center">

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
        const prestationTypesInput = document.getElementById('prestationTypes');
        const dogsittersContainer = document.getElementById('dogsittersContainer');
        const priceMinInput = document.getElementById('priceMin');
        const priceMaxInput = document.getElementById('priceMax');

        let timeout = null;

        function fetchDogSitters() {
            const search = encodeURIComponent(searchInput.value.trim());
            const ville = encodeURIComponent(villeInput.value.trim());
            const prestationTypes = encodeURIComponent(prestationTypesInput.value);
            const priceMin = encodeURIComponent(priceMinInput.value.trim());
            const priceMax = encodeURIComponent(priceMaxInput.value.trim());
            const URL = `{{ route('search.dogsitters') }}?name=${search}&ville=${ville}&prestationTypes=${prestationTypes}&priceMin=${priceMin}&priceMax=${priceMax}`;

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
                       <p class="text-gray-600 mt-2">Type de prestations: ${
                            dogsitter.prestation_types && dogsitter.prestation_types.length > 0
                                ? dogsitter.prestation_types.map(type => type.nom).join(' , ') 
                                : 'Non spécifié'
                            }
                        </p>
                        <p class="text-gray-600 mt-2">
                            Tarif par prestation : <br>
                            ${dogsitter.prestation_types && dogsitter.prestation_types.length > 0
                                ? dogsitter.prestation_types.map(prestation => {
                                    const price = prestation.pivot && prestation.pivot.prix !== undefined
                                        ? `${prestation.pivot.prix} €`
                                        : 'N/A';
                                    return `<p class="text-gray-600"> ${prestation.nom} : ${price}</p>`; 
                                }).join('')
                                : 'Non spécifié'
                            }
                        </p>
                    </a>`;
                    });
                })
                .catch(error => console.error('Erreur:', error));
        }

        [searchInput, villeInput, prestationTypesInput, priceMinInput, priceMaxInput].forEach(input => {
            input.addEventListener('input', function () {
                clearTimeout(timeout);
                timeout = setTimeout(fetchDogSitters, 500);
            });
        });
    });


</script>
