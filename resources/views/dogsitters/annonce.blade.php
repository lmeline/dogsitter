{{-- <x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Poster son annonce</h2>

        <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8 justify-center">
            {{-- Ajouter une disponibilité --}
            <div class="bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
                <h2 class="text-2xl font-semibold mb-4 text-center">Ajouter une disponibilité</h2>
                <form action="{{ route('disponibilites.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="dogsitter_id" value="{{ auth()->id() }}">

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Jour :</label>
                        <select
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            name="jour_semaine" required>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                            <option value="Dimanche">Dimanche</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Heure de début :</label>
                        <input
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            type="time" name="heure_debut" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Heure de fin :</label>
                        <input
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            type="time" name="heure_fin" required>
                    </div>

                    <div class="mb-6 text-center">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black font-semibold py-3 px-4 rounded-lg hover:bg-pink-600 transition-all duration-300">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>

            {{-- Ajouter un tarif pour un type de prestation --}
            <div class="bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
                <h2 class="text-2xl font-semibold mb-4 text-center">Ajouter un tarif par prestation</h2>
                <form action="{{ route('userPrestations.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="dogsitter_id" value="{{ Auth::user()->id }}" />

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2" for="prestation_type_id">Type de prestation :</label>
                            <select name="prestation_type_id" id="prestation_type_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                                @foreach($prestationtypes as $prestationtype)
                                    <option value="{{ $prestationtype->id }}">{{ $prestationtype->nom }}</option>
                                @endforeach
                            </select>
                    </div>

                    <div class="mb-6">
                        <label for="prix" class="block text-lg font-semibold text-gray-700 mb-2">Tarif (€) :</label>
                        <input type="number" name="prix" id="prix" class="w-full border-gray-300 rounded-lg px-3 py-2"
                            step="0.01" required>
                    </div>
                    <!-- Zone où on affiche la durée -->
                            <div id="dureeDisplay" class=" text-lg font-semibold text-gray-700"></div>
                            <input type="hidden" name="duree" value="1">

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 font-semibold rounded-lg hover:from-yellow-400 hover:to-pink-400 transition ">Ajouter</button>
                </form>
            </div>
        </div> <!-- Fin du conteneur flex -->

        {{-- pop-up --}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mt-8 max-w-lg mx-auto">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-md mt-8 max-w-lg mx-auto">
                <strong>Attention :</strong> {{ session('warning') }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById("prestation_type_id");
            const dureeDisplay = document.getElementById("dureeDisplay");
    
            function updateDuree() {
                const selectedId = select.value;
    
                // Condition pour afficher la durée
                if (selectedId == 1) {
                    dureeDisplay.innerHTML = "Durée 1 jour ";
                } else {
                    dureeDisplay.innerHTML = "Durée 1 heure";
                }
            }
    
            updateDuree();

            select.addEventListener("change", updateDuree);
        });
    </script>
    
</x-app-layout> --}}


<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-xl font-semibold mt-10 mb-4 text-center">Mes Disponibilités</h2>
        <ul class="space-y-4">
            @foreach($disponibilites as $dispo)
                <li class="bg-gray-100 p-4 rounded-lg flex justify-between items-center">
                    <div>
                        <strong>{{ $dispo->jour_semaine }}</strong> :
                        {{ \Carbon\Carbon::parse($dispo->heure_debut)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($dispo->heure_fin)->format('H:i') }}
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('disponibilites.edit', $dispo) }}" class="text-blue-600 hover:underline">Modifier</a>
                        <form action="{{ route('disponibilites.destroy', $dispo) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette disponibilité ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
    
        </ul>
        
            </div>

            {{-- Ajouter un tarif pour un type de prestation --}}
            <div class="bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
                <h2 class="text-2xl font-semibold mb-4 text-center">Ajouter un tarif par prestation</h2>
                <form action="{{ route('userPrestations.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="dogsitter_id" value="{{ Auth::user()->id }}" />

                    <div class="mb-6">
                        <label class="block text-lg font-semibold text-gray-700 mb-2" for="prestation_type_id">Type de prestation :</label>
                        <select name="prestation_type_id" id="prestation_type_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            @foreach($prestationtypes as $prestationtype)
                                <option value="{{ $prestationtype->id }}">{{ $prestationtype->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="prix" class="block text-lg font-semibold text-gray-700 mb-2">Tarif (€) :</label>
                        <input type="number" name="prix" id="prix" class="w-full border-gray-300 rounded-lg px-3 py-2"
                            step="0.01" required>
                    </div>

                    <div id="dureeDisplay" class="text-lg font-semibold text-gray-700 mb-2"></div>
                    <input type="hidden" name="duree" value="1">

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 font-semibold rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                        Ajouter
                    </button>
                </form>

                {{-- Liste des tarifs existants --}}
                <h3 class="text-xl font-semibold mt-8 mb-4 text-center">Mes tarifs</h3>
                <ul class="space-y-4">
                </ul>
            </div>
        </div>

        {{-- pop-up --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mt-8 max-w-lg mx-auto">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-md mt-8 max-w-lg mx-auto">
                <strong>Attention :</strong> {{ session('warning') }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById("prestation_type_id");
            const dureeDisplay = document.getElementById("dureeDisplay");

            function updateDuree() {
                const selectedId = parseInt(select.value);
                if (selectedId === 1) {
                    dureeDisplay.innerHTML = "Durée : 1 jour";
                } else {
                    dureeDisplay.innerHTML = "Durée : 1 heure";
                }
            }

            updateDuree();
            select.addEventListener("change", updateDuree);
        });
    </script>
</x-app-layout>
