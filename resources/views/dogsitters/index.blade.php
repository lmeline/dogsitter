@extends('layouts.partials.default-layout')
@section('content')
<x-app-layout>
    <div class="container mx-auto py-10">
        <form action="">
            <input type="text" id="search" name="name" placeholder="nom" class="w-full h-10 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500 mb-4">
        </form>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="dogsittersContainer">
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

<script defer>
    const searchInput = document.getElementById('search');
    searchInput.addEventListener('input', () => {
        const searchTerm = encodeURIComponent(searchInput.value);
        const URL = `{{ route('search.dogsitters') }}?name=${searchTerm}`;
        fetch(URL, {
            method: 'GET',
            headers: {
               'Content-Type': "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            let dogsittersContainer = document.getElementById('dogsittersContainer');
            dogsittersContainer.innerHTML = '';
            data.forEach(dogsitter => {
                dogsittersContainer.innerHTML += `        
                <a href="{{ route('dogsitters.show', $dogsitter->id) }}" class="block bg-gradient-to-r from-pink-100 via-yellow-100 to-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-gradient-to-r hover:from-pink-200 hover:via-yellow-200 hover:to-green-200">
                    <div class="flex items-center">
                        <!-- Texte avec nom et prénom -->
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-black hover:text-red-800 transition-colors duration-300">
                                ${dogsitter.name} ${dogsitter.prenom}
                            </h2>
                        </div>
                        <!-- Image ronde -->
                        <img src=${dogsitter.photo}" alt="${dogsitter.name}" class="w-24 h-24 rounded-full object-cover ml-4 border-4 border-white"/>
                    </div>
                
                    <p class="text-gray-600 mt-2">Ville: ${dogsitter.ville}</p>
                    <p class="text-gray-600">Note moyenne: ${dogsitter.note_moyenne}/5 </p>
                </a>`
            })
        })

    });
</script>
@endsection