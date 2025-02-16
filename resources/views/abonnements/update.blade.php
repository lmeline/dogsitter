@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">Gestion de votre Abonnement</h2>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <p><strong>Abonnement actuel :</strong> {{ $user->abonnement ? $user->abonnement->nom : 'Aucun abonnement' }}</p>
            <p><strong>Prix :</strong> {{ $user->abonnement ? $user->abonnement->prix . ' €' : 'Gratuit' }}</p>

            <h3 class="text-xl font-semibold mb-4 mt-6">Changer d'Abonnement</h3>

            <form action="{{ route('abonnements.update') }}" method="POST">
                @csrf
                <select name="abonnement_type_id" class="block mt-1 w-full border border-orange-300 focus:ring-orange-500 focus:border-orange-500 rounded-md">
                    @foreach($abonnements_types as $abonnement)
                        <option value="{{ $abonnement->id }}" {{ $abonnement->id == $user->abonnement_type_id ? 'selected' : '' }}>
                            {{ $abonnement->nom }} - {{ $abonnement->prix }} €
                        </option>
                    @endforeach
                </select>

                <div class="mt-4">
                    <button type="submit" class="bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">Changer d'Abonnement</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
@endsection
