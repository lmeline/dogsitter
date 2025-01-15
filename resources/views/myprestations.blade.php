@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($prestations as $index => $prestation)
                    <div class="p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg 
                        @switch($index % 5)
                            @case(0) bg-gradient-to-r from-pink-50 to-pink-100 @break
                            @case(1) bg-gradient-to-r from-red-50 to-red-100 @break
                            @case(2) bg-gradient-to-r from-orange-50 to-orange-100 @break
                            @case(3) bg-gradient-to-r from-green-50 to-green-100 @break
                            @case(4) bg-gradient-to-r from-yellow-50 to-yellow-100 @break
                        @endswitch
                        transform hover:-translate-y-2 transition-all duration-300 ease-in-out"
                    >
                        <div class="mb-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                Prestation avec 
                                <span class="text-indigo-600 dark:text-indigo-400">
                                    {{ $prestation->dogsitter ? $prestation->dogsitter->name : 'N/A' }}
                                </span>
                            </h4>
                        </div>

                        <div class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                            <p><strong>Service :</strong> {{ $prestation->prestationType ? $prestation->prestationType->nom : 'N/A' }}</p>
                            <p>
                                <strong>Statut :</strong> 
                                <span class="px-2 py-1 text-xs font-bold rounded 
                                    {{ $prestation->statut === 'Confirmé' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ $prestation->statut }}
                                </span>
                            </p>
                        </div>

                        <div class="mt-6 flex justify-between items-center">
                            <a href="{{ route('prestations.show', $prestation->id) }}" 
                                class="text-sm text-orange-500 font-semibold hover:text-red-700">
                                Voir les détails →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
