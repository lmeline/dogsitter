@extends('layouts.defaultLayout')

@section('content')

    <!-- Bandeau de navigation -->
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo / Titre du site -->
            <div class="text-2xl font-bold">
                Dogsitter
            </div>
            <!-- Liens de navigation -->
            <nav>
                <ul class="flex space-x-8">
                    <li>
                        <a href="/" class="hover:text-gray-300">Accueil</a>
                    </li>
                    <li>
                        <a href="/profilusers" class="hover:text-gray-300">Trouvez son dogsitter</a>
                    </li>
                    <li>
                        <a href="/messages" class="hover:text-gray-300">Messages</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Contenu de la page -->
    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Liste des Clients</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($clients->where('role', 'proprietaire') as $client)
            <a href="{{ route('clients.show', $client->id) }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-blue-50">
                <div class="flex items-center">
                    <!-- Texte avec nom et prénom -->
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                            {{ $client->name }} {{ $client->prenom }}
                        </h2>
                    </div>
                    <!-- Image ronde -->
                    <img src="{{ $client->photo }}" alt="{{ $client->name }}" class="w-24 h-24 rounded-full object-cover ml-4"/>
                </div>
            
                <!-- Informations supplémentaires -->
                <p class="text-gray-600 mt-2">Ville: {{ $client->ville }}</p>
            </a>
            @endforeach
        </div>
    </div>
@endsection
