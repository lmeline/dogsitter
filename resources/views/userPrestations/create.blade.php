@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Ajouter un tarif pour un service</h1>

        <form action="{{ route('userPrestations.store') }}" method="POST" class="max-w-lg mx-auto space-y-4 bg-opacity-40 backdrop-blur-md bg-white shadow-lg rounded-lg p-2">
            @csrf
            <input type="hidden" name="dogsitter_id" value="{{ Auth::user()->id }}"/>

            <div class="pb-4">
                <label for="prestation_type_id" class="block font-medium pb-2 text-xl">Type de prestation</label>
                <select name="prestation_type_id" id="prestation_type_id" class="w-full border-gray-300 rounded-lg px-3 py-2">
                    @foreach($prestationtypes as $type)
                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="prix" class="block font-medium pb-2 text-xl">Tarif (€)</label>
                <input type="number" name="prix" id="prix" class="w-full border-gray-300 rounded-lg px-3 py-2" step="0.01" required>
            </div>

            <div class="mb-4">
                <label for="duree" class="block font-medium pb-2 text-xl">Durée (en heures)</label>
                <input type="number" name="duree" id="duree" class="w-full border-gray-300 rounded-lg px-3 py-2" required>
            </div>

            <button type="submit" class="bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">Ajouter</button>
        </form>
    </div>
</x-app-layout>
@endsection
