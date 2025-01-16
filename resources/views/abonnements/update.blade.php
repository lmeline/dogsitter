@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-4">Gestion de votre Abonnement</h2>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Abonnement Actuel</h3>
            <p><strong>Abonnement actuel :</strong> {{ $user->abonnement ? $user->abonnement->nom : 'Aucun abonnement' }}</p>
            <p><strong>Prix :</strong> {{ $user->abonnement ? $user->abonnement->prix . ' €' : 'Gratuit' }}</p>

            <h3 class="text-xl font-semibold mb-4 mt-6">Changer d'Abonnement</h3>

            <form action="{{ route('abonnements.update') }}" method="POST">
                @csrf
                <select name="abonnement_type_id" class="form-select mt-2 block w-full">
                    @foreach($abonnements_types as $abonnement)
                        <option value="{{ $abonnement->id }}" {{ $abonnement->id == $user->abonnement_type_id ? 'selected' : '' }}>
                            {{ $abonnement->nom }} - {{ $abonnement->prix }} €
                        </option>
                    @endforeach
                </select>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-600">Changer d'Abonnement</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
@endsection
