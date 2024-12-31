@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes prestations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Voici vos prestations :") }}
                    <div class="mt-4">
                            <ul>
                                @foreach($prestations as $prestation)
                                    <li class="mb-4">
                                        <div class="bg-gray-100 p-4 rounded-md">
                                            <p><strong>Service:</strong> {{ $prestation->prestationType ? $prestation->prestationType->nom : 'N/A' }}</p>
                                            <p><strong>Date de début:</strong> {{ $prestation->date_debut }}</p>
                                            <p><strong>Date de fin:</strong> {{ $prestation->date_fin }}</p>
                                            <p><strong>Prix:</strong> {{ $prestation->prix }} €</p>
                                            <p><strong>Statut:</strong> {{ $prestation->statut }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
