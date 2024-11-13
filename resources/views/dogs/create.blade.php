@extends('layouts.defaultLayout')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Ajouter un Chien</h1>

    <form action="" method="POST" class="bg-white p-8 rounded-lg shadow-md max-w-lg mx-auto">
        @csrf
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nom du chien</label>
            <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="race" class="block text-gray-700 font-bold mb-2">Race du chien</label>
            <input type="text" id="race" name="race" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="age" class="block text-gray-700 font-bold mb-2">Âge du chien</label>
            <input type="number" id="age" name="age" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                Ajouter le chien
            </button>
        </div>
    </form>
</div>
@endsection
