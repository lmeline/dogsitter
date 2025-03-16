<x-app-layout>
    <div class="container  mx-auto py-10">
        <h1 class="text-4xl font-bold  text-black mb-10">Liste des Chiens</h1>
        <p class="text-lg text-gray-700 mb-10">
            Nombre total de chiens : <span class="font-semibold text-blue-600">{{ $dogs->count() }}</span>
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($dogs as $dog)
                <!-- Lien autour de tout le bloc pour le rendre cliquable -->
                <a href="{{ route('dogs.show', $dog->id) }}"
                    class="block bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-blue-50">
                    <h2 class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                        {{ $dog->nom }}
                    </h2>

                    <p class="text-gray-600 mt-2">Race: {{ $dog->race }}</p>
                    <p class="text-gray-600">Âge: {{ $dog->age }} ans</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>