@php
    $note = $dogsitter->note_moyenne; // Exemple de note moyenne
    $fullStars = floor($note); // Nombre d'étoiles pleines
    $halfStar = $note - $fullStars >= 0.5; // Si une demi-étoile est nécessaire
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Étoiles vides restantes
@endphp

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
        <div class="flex flex-col md:flex-row w-full max-w-6xl mx-auto mt-12 px-6">

            <!-- Bloc Informations personnelles, Expérience et Description -->
            <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg mb-6 md:mb-0 md:mr-6">

                <!-- Section Informations personnelles -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informations personnelles</h2>
                <p class="text-gray-700 mb-2"><strong>Ville :</strong> {{ $dogsitter->ville->nom_de_la_commune }}</p>
                <p class="text-gray-700 mb-2"><strong>Jours disponibles :</strong>
                    @foreach ($disponibilites as $disponibilite)
                        {{ $disponibilite->jour_semaine }}@if(!$loop->last), @endif
                    @endforeach
                </p>
                <p class="text-gray-700 mb-2"><strong>Nombre de notes :</strong> {{ $dogsitter->nb_notes }}</p>
                <p class="text-gray-700 mb-4">
                    <strong>Note moyenne :</strong>
                    <span class="flex items-center">
                        {{-- Étoiles pleines --}}
                        @for ($i = 0; $i < $fullStars; $i++)
                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 .587l3.668 7.568 8.332 1.15-6.064 5.89 1.468 8.287L12 18.897l-7.404 4.585 1.468-8.287-6.064-5.89 8.332-1.15L12 .587z" />
                            </svg>
                        @endfor

                        {{-- Demi-étoile --}}
                        @if ($halfStar)
                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.3l2.76 5.692 6.28.868-4.54 4.406 1.07 6.062L12 16.93V2.3z" fill="#FFD700" />
                                <path d="M11.999 2.3v14.629l-5.57 2.938 1.07-6.062-4.54-4.406 6.28-.868L12 2.3z"
                                    fill="#E0E0E0" />
                            </svg>
                        @endif

                        {{-- Étoiles vides --}}
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 .587l3.668 7.568 8.332 1.15-6.064 5.89 1.468 8.287L12 18.897l-7.404 4.585 1.468-8.287-6.064-5.89 8.332-1.15L12 .587z" />
                            </svg>
                        @endfor
                    </span>
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
                        <li>{{ $prestationType->nom }} : {{ number_format($prestationType->pivot->prix, 2) + 0 }}€ /
                            {{ number_format($prestationType->pivot->duree, 2) + 0 }}
                            heure{{ $prestationType->pivot->duree > 1 ? 's' : '' }} </li>
                    @endforeach
                </ul>
            </div>

            <!-- Bloc Expérience et Description -->
            <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-lg mb-6 md:mb-0 md:ml-6">

                <!-- Section Description -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">À propos de moi et mes expériences</h2>
                <p class="text-gray-700 mb-6">{{ $dogsitter->description }}</p>
            </div>
        </div>

        <!-- Bloc Prendre rendez-vous et Avis Clients -->
        <div class="w-full max-w-6xl mx-auto mt-12 px-6">

            <!-- Section Prendre rendez-vous -->
            <div class="w-full bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Prendre rendez-vous</h3>
                <a href="{{ route('prestations.create', $dogsitter->id) }}"
                    class="inline-block bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                    Cliquez ici pour prendre rendez-vous
                </a>
            </div>

            <!-- Section Avis Clients -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-10">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Avis clients</h3>
                @foreach ($prestations as $prestation)
                    @if($prestation->avis)
                        <div class="border-t border-gray-300 pt-4 mt-4">
                            <h4 class="font-semibold text-gray-800">
                                {{ $prestation->proprietaire->name . ' ' . $prestation->proprietaire->prenom }}</h4>
                            <p class="text-gray-700">{{ $prestation->avis->commentaire }}</p>
                            <p class="text-gray-500 text-sm">{{ $prestation->avis->created_at->format('d M Y') }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

    </div>
</x-app-layout>