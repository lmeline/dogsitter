@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="w-full h-full">
        <h1 class="text-center mb-5 font-bold text-3xl pt-5">Calendrier</h1>
        <div id="calendar" class="w-[80%] mx-auto h-[calc(100vh-14rem)] bg-opacity-40 backdrop-blur-md bg-white p-6 rounded-lg"></div>
    </div>
</x-app-layout>

@endsection
