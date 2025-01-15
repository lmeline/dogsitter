@extends('layouts.partials.default-layout')

@section('content')
<div class="container my-5">
    <h2 class="text-2xl font-bold mb-5">Ajouter un tarif pour un service</h2>

    <form action="{{ route('userPrestations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="dogsitter_id" value="{{ Auth::user()->id }}"/>
        <div class="mb-4">
            <label for="prestation_type_id" class="block font-medium">Type de prestation</label>
            <select name="prestation_type_id" id="prestation_type_id" class="w-full border-gray-300 rounded-lg">
                @foreach($prestationtypes as $type)
                    <option value="{{ $type->id }}">{{ $type->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="prix" class="block font-medium">Tarif (€)</label>
            <input type="number" name="prix" id="prix" class="w-full border-gray-300 rounded-lg" step="0.01" required>
        </div>

        <div class="mb-4">
            <label for="duree" class="block font-medium">Durée (en heures)</label>
            <input type="number" name="duree" id="duree" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Ajouter</button>
    </form>
</div>
@endsection
