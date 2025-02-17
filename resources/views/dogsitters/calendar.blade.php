@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="w-full h-full">
        <!-- Utilisation de flex avec un container centré -->
        <div class="flex justify-between items-center w-[80%] mx-auto m-5">
            <!-- Titre centré dans son propre bloc -->
            <div class="flex-grow text-center">
                <h1 class="font-bold text-3xl">Calendrier</h1>
            </div>
            <!-- Bouton à droite -->
            <a type="button" id="create-event" href="{{ route('disponibilites.availability') }}" class="flex justify-center items-center font-semibold bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition mr-4">
                <svg fill="#ae6565" viewBox="0 0 48 48" enable-background="new 0 0 48 48" id="Layer_3" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#ae6565" class="w-6 h-6">
                    <g>
                        <path d="M38,4V0h-4v4H14V0h-4v4H0v11.9v4V48h48V19.9v-4V4H38z M44,44H4V19.9h40V44z M4,15.9V8h6v4h4V8h20v4h4V8h6v7.9H4z"></path>
                        <rect height="6" width="6" x="7.5" y="24"></rect>
                        <rect height="6" width="6" x="16.667" y="24"></rect>
                        <rect height="6" width="6" x="25.583" y="24"></rect>
                        <rect height="6" width="6" x="34.5" y="24"></rect>
                        <rect height="6" width="6" x="7.5" y="33"></rect>
                        <rect height="6" width="6" x="16.667" y="33"></rect>
                        <rect height="6" width="6" x="25.583" y="33"></rect>
                        <rect height="6" width="6" x="34.5" y="33"></rect>
                    </g>
                </svg>
            </a>
            
        </div>

        <!-- Calendrier -->
        <div id="calendar" class="w-[80%] mx-auto h-[calc(100vh-14rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>
    </div>
</x-app-layout>

@endsection
