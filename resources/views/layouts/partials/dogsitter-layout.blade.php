@extends('layouts.depart-layout')

@section('barre')
    <nav class="container mx-auto flex items-center justify-between">
        <a href="{{ route('index') }}" class="text-2xl font-bold text-red-600">Patte à patte</a>
        <div class="flex items-center space-x-4">
            <a href="{{ route('dogsitters.index') }}" class="hover:underline">Mon Profil</a>
            <!--<a href="{ route('prestations.create', ['id' => Auth::user()->id]) }}" class="hover:underline">Mon Calendrier</a> -->
            <a href="{{ route('dogsitters.index') }}" class="hover:underline">Mes Rendez-vous</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Déconnexion</button>
            </form>
        </div>
    </nav>
@endsection

@section('content')
    <!-- Votre contenu principal ici -->
@endsection

@include('layouts.partials.dogsitter-layout')

<footer class="bg-gray-900 text-white py-6">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 Patte à patte. Tous droits réservés.</p>
    </div>
</footer>
