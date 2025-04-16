<x-app-layout>
    <div class="flex flex-col items-center bg-gradient-to-br from-yellow-50 via-pink-50 to-green-50">

        <!-- Bandeau supérieur avec photo et nom -->
        <div class="bg-gradient-to-r from-yellow-200 to-pink-300 w-full py-8 flex items-center justify-center flex-col">
            <div class="flex-shrink-0 mb-4">
                <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}"
                    class="w-40 h-40 rounded-full border-4 border-white">
            </div>
            <h1 class="text-4xl font-semibold text-gray-800">{{ $dogsitter->name }} {{ $dogsitter->prenom }}</h1>
            <p class="mt-2 text-lg text-gray-700">{{ $dogsitter->role }}</p>
        </div>

        <!-- Contenu du profil (informations personnelles, services et avis clients) -->
        <div class="flex flex-col md:flex-row w-full mt-12 mb-12 px-6 md:px-12 space-y-6 md:space-y-0 gap-x-6">

            <!-- Bloc Informations personnelles, Expérience et Description -->
            <div class="w-full md:w-1/3 bg-gradient-to-r from-green-100 to-pink-100 p-6 rounded-lg shadow-lg">
                <!-- Section Informations personnelles -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informations personnelles</h2>
                <p class="text-gray-700 mb-2"><strong>Ville :</strong> {{ $dogsitter->ville->nom_de_la_commune }}</p>
                <p class="text-gray-700 mb-2"><strong>Jours disponibles :</strong>
                    @foreach ($disponibilites as $disponibilite)
                        {{ $disponibilite->jour_semaine }}@if(!$loop->last), @endif
                    @endforeach
                </p>
                
                <!-- Formulaire de contact -->
                <form action="{{ route('messages.create', $dogsitter->id) }}" method="GET">
                    @csrf
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                        Me contacter
                    </button>
                </form>

                <!-- Section Services -->
                <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-4">Tarifs</h3>
                <ul class="list-disc pl-6 text-gray-700">

                    @foreach($dogsitter->prestationtypes as $prestationType)                    
                        <li>{{ $prestationType->nom }} : {{ number_format($prestationType->pivot->prix, 2) + 0 }}€ / heure </li>
                    @endforeach
                </ul>
            </div>

            <!-- Bloc Expérience et Description -->
            <div class="w-full md:w-2/3 bg-gradient-to-r from-yellow-100 to-orange-100 p-6 rounded-lg shadow-lg">

                <!-- Section Description -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">À propos de moi et mes expériences</h2>
                <p class="text-gray-700 mb-6">{{ $dogsitter->description }}</p>
            </div>
        </div>

        <!-- Bloc Prendre rendez-vous et Avis Clients -->
        <div class="w-full max-w-6xl mx-auto mt-12 px-6">

            <!-- Section Prendre rendez-vous -->
            <div class="w-full bg-white p-6 rounded-lg shadow-lg mb-6 bg-gradient-to-br from-yellow-50 via-pink-50 to-green-50">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Prendre rendez-vous</h3>
                <a href="{{ route('prestations.create', $dogsitter->id) }}"
                    class="inline-block bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                    Cliquez ici pour prendre rendez-vous
                </a>
            </div>

            <!-- Section Avis Clients -->
        </div>

    </div>
</x-app-layout>