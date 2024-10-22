@extends('layouts.defaultLayout')

@section('content')

    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Liste des Dogsitters</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ( $users->where('role', 'dogsitter') as $user )
            <a href="{{ route('users.show', $user->id) }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-blue-50">
                <div class="flex items-center">
                    <!-- Texte avec nom et prénom -->
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                            {{ $user->name }} {{ $user->prenom }}
                        </h2>
                    </div>
                    <!-- Image ronde -->
                    <img src="{{ $user->photo }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover ml-4"/>
                </div>
            
                <!-- Informations supplémentaires -->
                <p class="text-gray-600 mt-2">Ville: {{ $user->ville }}</p>
                <p class="text-gray-600">Note moyenne: {{ $user->note_moyenne }}</p>
                <p class="text-gray-600">Expérience: {{ $user->experience }} ans</p>
            </a>
            
            </a>
            @endforeach
        </div>
    </div>
   
@endsection
