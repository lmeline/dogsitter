@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="w-full h-full">
        <div class="flex justify-center items-center w-[80%] mx-auto  m-5">
            <h1 class="font-bold text-3xl text-center flex-grow">Calendrier</h1>
            <a type="button" id="create-event" href="{{ route('availability') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded ml-4">
                Mes disponibilités 
            </a>
        </div>
        <div id="calendar" class="w-[80%] mx-auto h-[calc(100vh-14rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>
    </div>
</x-app-layout>

@endsection
