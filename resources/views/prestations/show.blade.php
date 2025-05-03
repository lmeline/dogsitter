<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-semibold mb-4">Informations sur la Prestation</h1>
        
        <div class="p-6 rounded-lg shadow-md 
            @switch($prestation->id % 5)
                @case(0) bg-gradient-to-r from-pink-50 to-pink-100 @break
                @case(1) bg-gradient-to-r from-red-50 to-red-100 @break
                @case(2) bg-gradient-to-r from-orange-50 to-orange-100 @break
                @case(3) bg-gradient-to-r from-green-50 to-green-100 @break
                @case(4) bg-gradient-to-r from-yellow-50 to-yellow-100 @break
            @endswitch"
        >
            <div class="space-y-4">
                @if(Auth::user()->role === 'dogsitter')
                    <p><strong class="font-semibold text-gray-700">Numéro de la prestation :</strong> {{ $prestation->id }}</p>
                    <p><strong class="font-semibold text-gray-700">Propriétaire :</strong> {{ $prestation->proprietaire->name }}</p>
                @endif
                @if(Auth::user()->role === 'proprietaire')
                    <p><strong class="font-semibold text-black">Dogsitter :</strong> {{ $prestation->dogsitter->name }}</p>
                @endif
                <p><strong class="font-semibold text-black">Chien :</strong> {{ $prestation->dog ? $prestation->dog->nom : 'N/A' }}</p>
                <p><strong class="font-semibold text-black">Service :</strong> {{ $prestation->prestationType ? $prestation->prestationType->nom : 'N/A' }}</p>
                <p><strong class="font-semibold text-black">Date de début :</strong> {{ $prestation->formatted_date_debut }}</p>
                <p><strong class="font-semibold text-black">Date de fin :</strong> {{ $prestation->formatted_date_fin }}</p>
                <p><strong class="font-semibold text-black">Statut :</strong> {{ $prestation->statut }}</p>
                <p><strong class="font-semibold text-black">Prix :</strong> {{ $prestation->prix_total }} €</p>
                @if (Auth::user()->role === "proprietaire")
                    <form action="{{ route('messages.create', $prestation->dogsitter->id) }}" method="GET">
                        @csrf
                        <button type="submit" class=" text-black font-semibold rounded-lg focus:from-yellow-400 hover:to-pink-400 transition">
                            Envoyer un message a {{ $prestation->dogsitter->name }}
                        </button>
                    </form>
                @else
                    <form action="{{ route('messages.create', $prestation->proprietaire->id) }}" method="GET">
                        @csrf
                        <button type="submit" class=" text-black font-semibold rounded-lg focus:from-yellow-400 hover:to-pink-400 transition">
                            Envoyer un message a {{ $prestation->proprietaire->name }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
       @if (Auth::user()->role === "proprietaire")
            <div class=" flex column justify-between gap-2">
                <form action="{{ route('prestations.destroy', $prestation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette prestation ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mt-6 bg-gradient-to-r from-red-300 to-pink-400 text-black px-6 py-3 rounded-lg hover:from-red-400 hover:to-pink-500 transition">
                        Supprimer la prestation
                    </button>
                </form>
                <a href="{{ route('proprietaires.mesprestations') }}" class=" mt-6 bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">Retour aux Prestations</a>
            </div>          
       @else
            <div class="mt-6">
                <a href="{{ route('dogsitters.calendar') }}" class="bg-gradient-to-r from-yellow-300 to-pink-300 text-black px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">Retour aux Prestations</a>
            </div>
       @endif
       
    </div>
</x-app-layout>
