{{-- @extends('layouts.partials.default-layout')

@section('content')
@endsection --}}

<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($dogsitters as $dogsitter)
            <a href="{{ route('dogsitters.show', $dogsitter->id) }}" class="block bg-gradient-to-r from-pink-100 via-yellow-100 to-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-gradient-to-r hover:from-pink-200 hover:via-yellow-200 hover:to-green-200">
                <div class="flex items-center">
                    <!-- Texte avec nom et prénom -->
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-black hover:text-red-800 transition-colors duration-300">
                            {{ $dogsitter->name }} {{ $dogsitter->prenom }}
                        </h2>
                    </div>
                    <!-- Image ronde -->
                    <img src="{{ $dogsitter->photo }}" alt="{{ $dogsitter->name }}" class="w-24 h-24 rounded-full object-cover ml-4 border-4 border-white"/>
                </div>
            
                <!-- Informations supplémentaires -->
                <p class="text-gray-600 mt-2">Ville: {{ $dogsitter->ville }}</p>
                <p class="text-gray-600">Note moyenne: {{ $dogsitter->note_moyenne }}/5 </p>
                <p class="text-gray-600">Expérience: {{ $dogsitter->experience }} ans</p>
            </a>
            @endforeach
        </div>
    </div>
    
    <!-- Afficher la pagination -->
    <div class="mt-8 flex justify-center">
        <!-- Masquer le texte "Page X sur Y" -->
        <style>
            .pagination .page-item .page-link[rel="prev"],
            .pagination .page-item .page-link[rel="next"] {
                display: none;
            }
        </style>
    
        {{ $dogsitters->links() }}
    </div>

</x-app-layout>
