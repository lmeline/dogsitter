<x-app-layout>
    <div class="flex flex-col items-center">
        <!-- Bandeau supérieur avec photo et nom -->
        <div class="bg-gradient-to-r from-yellow-200 to-pink-300 w-full py-8 flex items-center justify-center flex-col">
            <div class="flex-shrink-0 mb-4">
                <img src="{{ $proprietaire->photo }}" alt="{{ $proprietaire->name }}"
                    class="w-40 h-40 rounded-full border-4 border-white">
            </div>
            <h1 class="text-4xl font-semibold text-gray-800">{{ $proprietaire->name }} {{ $proprietaire->prenom }}</h1>
            <p class="mt-2 text-lg text-gray-700">{{ $proprietaire->role }}</p>
        </div>

        <!-- Contenu du profil (informations personnelles, services et avis clients) -->
        <div class="flex flex-col md:flex-row w-full mt-12 mb-12 px-6 md:px-12 space-y-6 md:space-y-0 gap-x-6">

            <!-- Bloc Informations personnelles, Expérience et Description -->
            <div class="w-full md:w-1/3 bg-gradient-to-r from-green-100 to-pink-100 p-6 rounded-lg shadow-lg">
                <!-- Section Informations personnelles -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informations personnelles</h2>
                <p class="text-gray-700 mb-2"><strong>Ville :</strong> {{ $proprietaire->ville->nom_de_la_commune }}</p>
                <p class="text-gray-700 mb-2"><strong>Mes chiens  :</strong> </p>
                    @foreach($proprietaire->dogs as $dog)
                    <div class="flex justify-center mb-5">
                        <button 
                            onclick="toggleDetails('dog-details-{{ $dog->id }}')" 
                            class=" text-black w-full sm:w-full h-10 bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                            Détails de {{ $dog->nom }}
                        </button>
                    </div>

                    <div id="dog-details-{{ $dog->id }}" class="w-full bg-white p-2 mb-2 rounded-lg shadow-lg hidden">
                        <!-- Nom -->
                        <div class="flex justify-between items-center">
                            <span class="text-sm"><strong>Nom :</strong></span>
                            <span id="dog-nom-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">{{ $dog->nom }}</span>
                        </div>

                        <!-- Race -->
                        <div class="flex justify-between items-center">
                            <span class="text-sm"><strong>Race :</strong></span>
                            <span id="dog-race-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">{{ $dog->race }}</span>
                        </div>

                        <!-- Poids -->
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm"><strong>Poids :</strong></span>
                            <span id="dog-poids-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">{{ $dog->poids }} kgs</span>
                        </div>

                        <!-- Âge -->
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm"><strong>Âge :</strong></span>
                            <span id="dog-age-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm" data-birthdate="{{ $dog->date_naissance }}"> {{ $dog->date_naissance }}</span>
                        </div>

                        <!-- Sexe -->
                        <div class="flex justify-between items-center">
                            <span class="text-sm"><strong>Sexe :</strong></span>
                            <span id="dog-sexe-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">
                                @if ($dog->sexe == "F") Femelle @else Mâle @endif
                            </span>
                        </div>

                        <!-- Caractère -->
                        <div class="flex justify-between items-start">
                            <span class="text-sm"><strong class="whitespace-nowrap">Caractère :</strong></span>
                            <span id="dog-comportement-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm break-words">{{ $dog->comportement }}</span>
                        </div>

                        <!-- Besoins spéciaux -->
                        <div class="flex justify-between items-start">
                            <span class="text-sm"><strong class="whitespace-nowrap">Besoins <br> spéciaux :</strong></span>
                            <span id="dog-besoins_speciaux-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm break-words">
                                {{ $dog->besoins_speciaux }}
                            </span>
                        </div>

                        <!-- Stérilisation -->
                        <div class="flex justify-between mt-2">
                            <span class="text-sm"><strong>Stérilisation :</strong></span>
                            <span id="dog-sterilise-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent w-20 text-sm">
                                @if ($dog->sterilise == 1) Oui @else Non @endif
                            </span>
                        </div>
                    </div>              
                @endforeach
                
                <!-- Formulaire de contact -->
                <form action="{{ route('messages.create', $proprietaire->id) }}" method="GET">
                    @csrf
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                        Me contacter
                    </button>
                </form>
            </div>

            <!-- Bloc Expérience et Description -->
            <div class="w-full md:w-2/3 bg-gradient-to-r from-yellow-100 to-orange-100 p-6 rounded-lg shadow-lg">
                <!-- Section Description -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ce que je recherche chez un dogsitter</h2>
                <p class="text-gray-700 mb-6">{{ $proprietaire->description }}</p>
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 ">Photos de mes chiens</h2>
                <div class="flex flex-wrap justify-center gap-6 mb-5">
                    @php
                        $dogsWithPhoto = Auth::user()->dogs->filter(function ($dog) {
                            return $dog->photo && file_exists(public_path('storage/' . $dog->photo));
                        });
                    @endphp
                    
                    @if ($dogsWithPhoto->isEmpty())
                        <p>Aucune photo disponible.</p>
                    @else
                        <div class="flex flex-wrap justify-center gap-6">
                            @foreach ($dogsWithPhoto as $dog)
                                <div class="flex flex-col items-center">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $dog->photo) }}" alt="{{ $dog->nom }}" class="w-50 h-50 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-lg">
                                        <form action="{{ route('dogs.delete', $dog->id) }}" method="POST" class="absolute top-3 right-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
        </div>

    </div>

    <script>
        function toggleDetails(id) {
            const details = document.getElementById(id);
            if (details.classList.contains('hidden')) {
                details.classList.remove('hidden');
            } else {
                details.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>