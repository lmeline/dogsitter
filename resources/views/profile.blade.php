@extends('layouts.partials.default-layout')

@section('content')
<x-app-layout>
    <div class="flex pt-10 flex-col items-center bg-gradient-to-br from-yellow-50 via-rose-50 to-green-50">

        <div class="text-black py-10 w-full flex items-center bg-gradient-to-r from-red-200 to-orange-200 rounded-lg shadow-lg">
        
            <div class="flex-shrink-0 mr-8">
                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}" class="w-40 h-40 rounded-full border-4 border-white shadow-lg">
            </div>
            
            <div class="flex flex-col justify-end">
                <h1 class="text-3xl font-bold text-gray-800">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</h1>
            </div>
        </div>

        <div class="flex flex-col md:flex-row w-full mt-12 mb-12 px-6 md:px-12 space-y-6 md:space-y-0 gap-x-6">

            <div class="w-full md:w-1/2 bg-gradient-to-r from-green-100 to-pink-100 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Informations personnelles</h2>
                <p class="mb-2"><strong>Ville :</strong> {{ Auth::user()->ville->nom_de_la_commune }}</p>
                
                @if (Auth::user()->role === 'dogsitter')
                    <p class="mb-2"><strong>Disponibilité :</strong>
                        @foreach (Auth::user()->disponibilites as $disponibilite)
                            {{ $disponibilite->jour_semaine }}@if(!$loop->last), @endif 
                        @endforeach
                    </p>
                    <p class="mb-2"><strong>Nombre de notes :</strong> {{ Auth::user()->nb_notes }}</p>
                    <p class="mb-2"><strong>Note /5 :</strong> {{ Auth::user()->note_moyenne }}</p>
                    @foreach(Auth::user()->prestationtypes as $prestationtype)
                        <p class="mb-2">
                            <strong>Tarif de {{ $prestationtype->nom }} :</strong>
                            {{ $prestationtype->pivot->prix }} € /
                            {{ $prestationtype->pivot->duree }}h
                        </p>
                    @endforeach
                
                    @if(Auth::user()->prestationtypes->isEmpty())
                        <p class="mb-2">Aucun tarif défini.</p>
                    @endif
                @endif
            </div>

            <div class="w-full md:w-1/2 bg-gradient-to-r from-yellow-100 to-orange-100 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">À propos de moi</h2>
                <p class="text-gray-700 mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In aperiam sed aliquid iure vero fugit autem rem suscipit id voluptatum molestiae voluptate maiores libero eaque eum soluta ipsum ab sapiente laudantium quia, explicabo necessitatibus. Quae fugiat facere tempore aspernatur facilis perspiciatis officia quia temporibus? Laboriosam, eveniet.
                </p>
                
                @if (Auth::user()->role === 'proprietaire')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2 ">Information sur mon toutou</h3>
                    @foreach(Auth::user()->dogs as $dog)
                        <div class="mb-4">
                            <button 
                                onclick="toggleDetails('dog-details-{{ $dog->id }}')" 
                                class=" text-black w-80 h-10 bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition ">
                                Détails de {{ $dog->nom }}
                            </button>
                            <div id="dog-details-{{ $dog->id }}" class="hidden mt-2 bg-gray-100 p-4 rounded shadow-md">
                                <span><strong>Nom :</strong> {{ $dog->nom }}</span><br>
                                <span><strong>Race :</strong> {{ $dog->race }}</span><br>
                                <span><strong>Âge :</strong> {{ $dog->age }} ans</span><br>
                                <span><strong>Caractère :</strong> {{ $dog->comportement }}</span><br>
                                <span><strong>Besoins spéciaux :</strong> {{ $dog->besoins_speciaux }}</span><br>
                                <span><strong>Stérilisation :</strong> {{ $dog->sterilise }}</span>
                            </div>
                        </div>
                    @endforeach
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Ce que je recherche chez un dogsitter</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In deserunt nam beatae cupiditate ipsum deleniti iste, quod id fugiat repellat ipsa totam et quibusdam, vero, numquam voluptatem.</p>
                @endif

                @if (Auth::user()->role === 'dogsitter')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">A propos de moi et mes expériences</h3>
                    <p class="text-gray-700 mb-4">{{ Auth::user()->description }}</p>

                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Services</h3>
                    <ul class="list-disc pl-6 text-gray-700 space-y-1">
                        @foreach (Auth::user()->prestationtypes as $prestationtype)
                            <li>{{$prestationtype->nom }}</li>
                        @endforeach
                    </ul>
                    
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Prendre rendez-vous</h3>
                    @if(Auth::id()!== Auth::user()->id)
                        <a href="{{ route('prestations.create', Auth::user()->id) }}" class="inline-block bg-gradient-to-r from-yellow-200 to-pink-300 text-white px-6 py-3 rounded-lg hover:from-yellow-300 hover:to-pink-400 transition text-sm">Cliquez ici</a>
                    @else
                        <p class="text-gray-700 mb-4">Vous ne pouvez pas prendre rendez-vous avec vous-meme</p>
                    @endif

                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">Avis clients</h3>
                    @foreach (Auth::user()->prestationsAsdogsitter as $prestation)
                        @if($prestation->avis)
                            <div class="border-t border-gray-300 pt-4 mt-4">
                                <h4 class="font-semibold text-gray-800">{{ $prestation->proprietaire->name.' '. $prestation->proprietaire->prenom.' '.$prestation->avis->created_at }}</h4>
                                <p class="text-gray-700 mb-4">{{ $prestation->avis->commentaire }}</p>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleDetails(id) {
        const details = document.getElementById(id);
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
        } else {
            details.classList.add('hidden');
        }
    }
</script>
@endsection
