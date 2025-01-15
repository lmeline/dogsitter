@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes Prestations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    Liste de vos prestations
                </h3>
                
                {{-- Barre de recherche ou de filtre (facultative) --}}
                <div class="mb-6">
                    <input type="text" placeholder="Rechercher une prestation..." 
                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                {{-- Liste des prestations --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($prestations as $prestation)

                        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-md shadow-md">
                            <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                                Prestation avec {{ $prestation->dogsitter ? $prestation->dogsitter->name : 'N/A' }}
                            </h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                <strong>Nom du dogsitter:</strong> {{ $prestation->dogsitter ? $prestation->dogsitter->name : 'N/A' }}
                            </p>
                            
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                               <strong>Service:</strong> {{ $prestation->prestationType ? $prestation->prestationType->nom : 'N/A' }}
                            </p>   

                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                                <strong>Statut :</strong> 
                                <span class="px-2 py-1 text-xs rounded 
                                    {{ $prestation->statut === 'Confirmé' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ $prestation->statut }}
                                </span>
                            </p>
                           
                            <td class="px-4 py-2">
                                <a href="{{ route('prestations.show', $prestation->id) }}" class="text-orange-500 hover:text-blue-700 font-semibold">Détails</a>
                            </td>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
