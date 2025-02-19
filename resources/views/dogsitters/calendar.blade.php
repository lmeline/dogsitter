@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="w-full h-full">

        <div class="flex justify-between items-center w-[80%] mx-auto m-5">

            <div class="flex-grow text-center">
                <h1 class="font-bold text-3xl">Calendrier</h1>
            </div>
        </div>

        <div id="calendar" class="w-[80%] mx-auto h-[calc(100vh-14rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>
    </div>
</x-app-layout>

@endsection
