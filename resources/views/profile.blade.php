@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="flex pt-10 flex-col items-center bg-gradient-to-br from-yellow-50 via-rose-50 to-green-50">

        <!-- Bandeau supérieur -->
        <div class="text-black py-10 w-full flex items-center bg-gradient-to-r from-red-200 to-orange-200 rounded-lg shadow-lg">
            <!-- Photo à gauche -->
            <div class="flex-shrink-0 mr-8">
                <!-- Affichage de la photo de profil de l'utilisateur connecté -->
                <img src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" class="w-40 h-40 rounded-full border-4 border-white shadow-lg">
            </div>
            
            <!-- Texte aligné en bas à droite -->
            <div class="flex flex-col justify-end">
                <h1 class="text-3xl font-bold text-gray-800">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</h1>
            </div>
        </div>

        <!-- Contenu en deux colonnes avec ligne de séparation -->
        <div class="flex bg-white flex-col md:flex-row w-full mt-12 mb-12 px-6 md:px-12 space-y-6 md:space-y-0">

            <!-- Colonne de gauche -->
            <div class="w-full md:w-1/2 bg-gradient-to-r from-yellow-100 to-orange-100 p-6 rounded-lg shadow-lg mb-6 md:mb-0">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Informations personnelles</h2>
                <p class="mb-2"><strong>Ville :</strong> {{ Auth::user()->ville }}</p>
                <p class="mb-2"><strong>Contact :</strong> Envoyer un message</p>
                <p class="mb-2"><strong>Disponibilité:</strong> {{ Auth::user()->disponibilite_jour }}</p>

                @if (Auth::user()->role === 'dogsitter')
                    <p class="mb-2"><strong>Nombre de notes :</strong> {{ Auth::user()->nb_notes }}</p>
                    <p class="mb-2"><strong>Note /5 :</strong> {{ Auth::user()->note_moyenne }}</p>
                @endif
            </div>

            <!-- Séparation pour mobile -->
            <div class="hidden md:block w-px bg-orange-200"></div>

            <!-- Colonne de droite -->
            <div class="w-full md:w-1/2 bg-gradient-to-r from-green-100 to-pink-100 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">À propos de moi</h2>
                <p class="text-gray-700 mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In aperiam sed aliquid iure vero fugit autem rem suscipit id voluptatum molestiae voluptate maiores libero eaque eum soluta ipsum ab sapiente laudantium quia, explicabo necessitatibus. Quae fugiat facere tempore aspernatur facilis perspiciatis officia quia temporibus? Laboriosam, eveniet.
                </p>
               
                @if (Auth::user()->role === 'proprietaire')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Information sur mon toutou </h3>
                    @foreach(Auth::user()->dogs as $dog)
                        <span class="text-gray-800"> Nom: {{ $dog->nom }}</span><br>
                        <span class="text-gray-800"> Race: {{ $dog->race }}</span><br>
                        <span class="text-gray-800"> Âge: {{ $dog->age }} ans</span><br>
                        <span class="text-gray-800"> Caractère: {{ $dog->comportement }}</span><br>
                        <span class="text-gray-800"> Besoins spéciaux: {{ $dog->besoins_speciaux }}</span><br>
                        <span class="text-gray-800"> Oui / Non: {{ $dog->sterilise }}</span><br>
                        <span class="text-gray-800">{{ $dog->photo }}</span><br>
                    @endforeach
                    
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Ce que je recherche chez un dogsitter</h3>
                <p>test de reussite</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In deserunt nam beatae cupiditate ipsum deleniti iste, quod id fugiat repellat ipsa totam et quibusdam, vero, numquam voluptatem. Voluptatum nostrum laudantium ipsa magni sunt architecto veritatis cum. Molestias corrupti eveniet saepe. Nesciunt fuga repellendus laudantium nobis rem aliquam nostrum, vero tempora.</p>
                @endif

                @if(Auth::user()->role === 'dogsitter')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Expériences</h3>
                    <p class="text-gray-700 mb-4">{{ Auth::user()->experience }}</p>

                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Services</h3>
                    <ul class="list-disc pl-6 text-gray-700 space-y-1">
                        <li>{{ Auth::user()->service }}</li>
                    </ul>

                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Prendre rendez-vous</h3>
                    <a href="{{ route('prestations.create', Auth::user()->id) }}" class="inline-block bg-gradient-to-r from-yellow-200 to-pink-300 text-white px-6 py-3 rounded-lg hover:from-yellow-300 hover:to-pink-400 transition text-sm">Cliquez ici</a>

                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Avis clients</h3>
                    @foreach (Auth::user()->prestationsAsdogsitter as $prestation)
                        @if($prestation->avis)
                            <div class="border-t border-gray-300 pt-4 mt-4">
                                <h4 class="font-semibold text-gray-800">{{ $prestation->proprietaire->name.' '. $prestation->proprietaire->prenom.' '.$prestation->avis->created_at }}</h4>
                                <p class="text-gray-700 mb-4">{{ $prestation->avis->commentaire }}</p>
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
@endsection
