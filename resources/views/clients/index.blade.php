{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>utilisateurs</title>
</head>
<body>
    @foreach ( $users->where('role', 'dogsitter') as $user )

    <div class="container">
        <div class="row">
            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }} <br> </a>
        </div>
    </div>

    @endforeach
    
</body>
</html> --}}

@extends('layouts.defaultLayout')

@section('content')

    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Liste des Clients</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ( $clients->where('role', 'proprietaire') as $client )
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
            
            </a>
            @endforeach
        </div>
    </div>
@endsection
