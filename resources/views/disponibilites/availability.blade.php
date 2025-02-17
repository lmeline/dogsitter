@extends('layouts.partials.default-layout')

@section('content')
    <x-app-layout>
        <div class="container">
            <h2 class="mb-4">Mes disponibilités</h2>
            <form action="{{ route('disponibilites.store') }}" method="POST">
                @csrf
                <input type="hidden" name="dogsitter_id" value="{{ auth()->id() }}">

                <label>Jour :</label>

                <select name="jour_semaine" required>
                    <option value="Lundi">Lundi</option>
                    <option value="Mardi">Mardi</option>
                    <option value="Mercredi">Mercredi</option>
                    <option value="Jeudi">Jeudi</option>
                    <option value="Vendredi">Vendredi</option>
                    <option value="Samedi">Samedi</option>
                    <option value="Dimanche">Dimanche</option>
                </select>
                
                <label>Heure de début :</label>
                <input type="time" name="heure_debut" required>
                
                <label>Heure de fin :</label>
                <input type="time" name="heure_fin" required>
                
                <button type="submit">Enregistrer</button>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </x-app-layout>
@endsection

