{{-- @extends('layouts.partials.default-layout')

@section('content')

    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold text-center  mb-10">Liste des propriétaires</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($proprietaires->where('role', 'proprietaire') as $proprietaire)
            <a href="{{ route('proprietaires.show', $proprietaire->id) }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-blue-50">
                <div class="flex items-center">
                    <!-- Texte avec nom et prénom -->
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                            {{ $proprietaire->name }} {{ $proprietaire->prenom }}
                        </h2>
                    </div>
                    <!-- Image ronde -->
                    <img src="{{ $proprietaire->photo }}" alt="{{ $proprietaire->name }}" class="w-24 h-24 rounded-full object-cover ml-4"/>
                </div>
            
                <!-- Informations supplémentaires -->
                <p class="text-gray-600 mt-2">Ville: {{ $proprietaire->ville }}</p>
            </a>
            @endforeach
        </div>
    </div>
@endsection --}}
@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messagerie ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- la liste des dogsitters ne fonctionne pas  --}}
                  <a href="{{ route('dogs.index') }}"> liste des dogsitters</a> 

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@endsection