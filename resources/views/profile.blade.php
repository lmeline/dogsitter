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
                                    <span><strong>Stérilisation :</strong>  
                                        @if ($dog->sterilise == 1)
                                        Oui
                                    @else
                                        Non
                                    @endif</span>
                                </div>
                            </div>
                        @endforeach
                @endif
                
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
                
                @if (Auth::user()->role === 'proprietaire')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Ce que je recherche chez un dogsitter</h3>
                        <form action="{{ route('update.description') }}" method="POST" id="description-form" class="w-full">
                            @csrf
                            <div class="relative w-full">
                                <textarea id="description-text" name="description"
                                    class="w-full p-3 lg text-black border-none bg-gradient-to-r from-yellow-100 to-orange-100 focus:outline-none rounded-lg"
                                    rows="4" readonly>{{ Auth::user()->description }}</textarea>
                        
                                <button type="button" id="edit-btn"
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 transition ">
                                    <!-- Icône de crayon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                      
                                </button>
                            </div>
                            <button type="submit" id="save-btn"
                                class="mt-3 bg-gradient-to-r from-yellow-300 to-pink-300 w-full text-black px-4 py-2 rounded-lg hover:bg-blue-600 transition hidden">
                                Mettre à jour
                            </button>
                        </form>
                @endif

                @if (Auth::user()->role === 'dogsitter')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">A propos de moi et mes expériences</h3>
                        <form action="{{ route('update.description') }}" method="POST" id="description-form" class="w-full">
                            @csrf
                            <div class="relative w-full">
                                <textarea id="description-text" name="description"
                                    class="w-full p-3 lg text-black border-none bg-gradient-to-r from-yellow-100 to-orange-100 focus:outline-none rounded-lg"
                                    rows="4" readonly>{{ Auth::user()->description }}</textarea>
                        
                                <button type="button" id="edit-btn"
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 transition ">
                                    <!-- Icône de crayon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                    
                                </button>
                            </div>
                            <button type="submit" id="save-btn"
                                class="mt-3 bg-gradient-to-r from-yellow-300 to-pink-300 w-full text-black px-4 py-2 rounded-lg hover:bg-blue-600 transition hidden">
                                Mettre à jour
                            </button>
                        </form>
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
    /* pour afficher les chiens */
    function toggleDetails(id) {
        const details = document.getElementById(id);
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
        } else {
            details.classList.add('hidden');
        }
    }
    /* fonction pour ajouter un texte description */
    document.addEventListener("DOMContentLoaded", function () {
    const editBtn = document.getElementById("edit-btn");
    const saveBtn = document.getElementById("save-btn");
    const descriptionText = document.getElementById("description-text");

    editBtn.addEventListener("click", function () {
        descriptionText.removeAttribute("readonly");
        descriptionText.classList.remove("bg-gray-100", "cursor-not-allowed", "text-gray-600");
        descriptionText.classList.add("border-blue-500", "text-black");
        saveBtn.classList.remove("hidden"); 
    });

    document.getElementById("description-form").addEventListener("submit", function () {
        saveBtn.classList.add("hidden"); 
        descriptionText.setAttribute("readonly", true);
        descriptionText.classList.add("bg-gray-100", "cursor-not-allowed", "text-gray-600");
    });
});
</script>

