@extends('layouts.partials.default-layout')

@section('content')
<div class="container mx-auto my-10 p-4">
    <h2 class="text-center mb-8 text-3xl font-bold text-gray-800 uppercase">Choisissez un abonnement</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($abonnements_types as $index => $abonnement)
            @if($index != 3) <!-- Exclut l'abonnement avec l'index 1 (le deuxième abonnement) -->
                <div class="bg-gradient-to-r from-red-200 via-orange-200 via-pink-200 to-green-200 text-white rounded-lg shadow-xl overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold mb-4">{{ $abonnement->nom }}</h3>
                        <h4 class="text-xl mb-4">Prix : {{ $abonnement->prix }} €</h4>
                        
                        <p class="mb-6">{{ $abonnement->description ?? 'Aucune description disponible.' }}</p>

                        <form method="POST" action="{{ route('abonnements.choose') }}">
                            @csrf
                            <input type="hidden" name="abonnements_types_id" value="{{ $abonnement->id }}">
                            <button type="submit" class="w-full bg-white text-blue-600 hover:bg-blue-600 hover:text-white py-2 px-4 rounded-lg font-semibold transition duration-300">
                                Choisir cet abonnement
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
