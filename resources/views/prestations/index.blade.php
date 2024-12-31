@extends('layouts.partials.default-layout')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Toutes les Prestations</h1>

        <!-- Table pour afficher les prestations -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Propriétaire</th>
                        <th class="px-4 py-2 text-left">Dogsitter</th>
                        <th class="px-4 py-2 text-left">Service</th>
                        <th class="px-4 py-2 text-left">Date de début</th>
                        <th class="px-4 py-2 text-left">Date de fin</th>
                        <th class="px-4 py-2 text-left">Statut</th>
                        <th class="px-4 py-2 text-left">Prix</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($prestations as $prestation)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $prestation->id }}</td>
                            <td class="px-4 py-2">{{ $prestation->proprietaire->name }}</td>
                            <td class="px-4 py-2">{{ $prestation->dogsitter->name }}</td>
                            <td class="px-4 py-2">{{ $prestation->prestationtype ? $prestation->prestationtype->nom : 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $prestation->date_debut }}</td>
                            <td class="px-4 py-2">{{ $prestation->date_fin }}</td>
                            <td class="px-4 py-2">{{ $prestation->statut }}</td>
                            <td class="px-4 py-2">{{ $prestation->prix }} €</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('prestations.show', $prestation->id) }}" class="text-blue-500 hover:text-blue-700 font-semibold">Détails</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
