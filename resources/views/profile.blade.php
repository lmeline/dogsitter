@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="flex pt-10 flex-col items-center ">
        <!-- Bandeau supérieur -->
        <div class="bg-pink text-black py-10 w-full flex items-center">
            <!-- Photo à gauche -->
            <div class="flex-shrink-0 mr-8">
                <!-- Affichage de la photo de profil de l'utilisateur connecté -->
                <img src="{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" class="w-40 h-40 rounded-full border-4">
            </div>
            
            <!-- Texte aligné en bas à droite -->
            <div class="flex flex-col justify-end">
                <h1 class="text-3xl font-bold">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</h1>
            </div>
        </div>

        <!-- Contenu en deux colonnes avec ligne de séparation -->
        <div class="flex bg-green flex-col md:flex-row w-full">
            <!-- Colonne de gauche -->
            <div class="w-full md:w-1/2 bg-gray p-6 md:pl-12">
                <h2 class="text-2xl font-semibold mb-4 text-black">Informations personnelles</h2>
                <p class="mb-2"><strong>Ville :</strong> {{ Auth::user()->ville }}</p>
                <p class="mb-2"><strong>Contact :</strong> Envoyer un message</p>
                <p class="mb-2"><strong>Disponibilité:</strong> {{ Auth::user()->disponibilite_jour }}</p>

                @if (Auth::user()->role === 'dogsitter')
                    <p class="mb-2"><strong>Nombre de notes :</strong> {{ Auth::user()->nb_notes }}</p>
                    <p class="mb-2"><strong>Note /5 :</strong> {{ Auth::user()->note_moyenne }}</p>
                @endif
               
            </div>
            <div class="hidden md:block w-px bg-orange"></div>
            <div class="w-full md:w-1/2 bg-gris p-6 md:pl-12">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">À propos de moi</h2>

                <p class="text-gray-700 mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In aperiam sed aliquid iure vero fugit autem rem suscipit id voluptatum molestiae voluptate maiores libero eaque eum soluta ipsum ab sapiente laudantium quia, explicabo necessitatibus. Quae fugiat facere tempore aspernatur facilis perspiciatis officia quia temporibus? Laboriosam, eveniet. Consectetur veritatis accusamus reiciendis?
                </p>
               
                @if (Auth::user()->role === 'proprietaire')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Information sur mon toutou </h3>
                    @foreach(Auth::user()->dogs as $dog)
                        <span> Nom: {{ $dog->nom }}</span><br>
                        <span> Race: {{ $dog->race }}</span><br>
                        <span> Âge: {{ $dog->age }} ans</span><br>
                        <span> Caractère: {{ $dog->comportement }}</span><br>
                        <span> Besoins spéciaux: {{ $dog->besoins_speciaux }}</span><br>
                        <span> Oui / Non: {{ $dog->sterilise }}</span><br>
                        <span>{{ $dog->photo }}</span><br>
                    @endforeach
                    
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Ce que je recherche chez un dogsitter</h3>
                <p>test de reussite</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In deserunt nam beatae cupiditate ipsum deleniti iste, quod id fugiat repellat ipsa totam et quibusdam, vero, numquam voluptatem. Voluptatum nostrum laudantium ipsa magni sunt architecto veritatis cum. Molestias corrupti eveniet saepe. Nesciunt fuga repellendus laudantium nobis rem aliquam nostrum, vero tempora.</p>
                @endif

                @if(Auth::user()->role === 'dogsitter')
                    <div class="w-full md:w-1/2 p-6 md:pl-12">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">À propos de moi</h2>
                        <p class="text-gray-700 mb-4">
                            {{ Auth::user()->description }}
                        </p>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Expériences</h3>
                        <p class="text-gray-700 mb-4">{{ Auth::user()->experience }}</p>
        
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">Services</h3>
                        <ul class="list-disc pl-6 text-gray-700 space-y-1">
                            <li>{{ Auth::user()->service }}</li>
                        </ul>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Prendre rendez-vous</h3>
                            <a href="{{ route('prestations.create', Auth::user()->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">Cliquez ici</a>
        
                        <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Avis clients</h3>
                        @foreach (Auth::user()->prestationsAsdogsitter as $prestation)
                            @if($prestation->avis)
                                <h3>{{ $prestation->proprietaire->name.' '. $prestation->proprietaire->prenom.' '.$prestation->avis->created_at }}</h3>
                                <p class="text-gray-700 mb-4">{{ $prestation->avis->commentaire }}</p>
                            @endif
                        @endforeach

                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
@endsection
