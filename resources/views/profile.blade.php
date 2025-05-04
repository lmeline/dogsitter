<x-app-layout>
    <div class="flex pt-10 flex-col items-center bg-gradient-to-br from-yellow-50 via-rose-50 to-green-50">

        <div class="text-black py-10 w-full flex items-center bg-gradient-to-r from-red-200 to-orange-200 rounded-lg shadow-lg">

            <div class="flex-shrink-0 mr-8">
                <img src="/storage/{{ Auth::user()->photo }}" alt="{{ Auth::user()->name }}" class="w-20 h-20 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-lg ml-10">
            </div>

            <div class="flex flex-col justify-end">
                <h1 class="text-3xl-sm text-xl font-bold text-gray-800">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</h1>
            </div>
        </div>

        <div class="flex flex-col md:flex-row w-full mt-12 mb-12 px-6 md:px-12 space-y-6 md:space-y-0 gap-x-6">

            <div class="w-full md:w-1/3 bg-gradient-to-r from-green-100 to-pink-100 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Informations personnelles</h2>
                <p class="mb-2"><strong>Ville :</strong> {{ Auth::user()->ville->nom_de_la_commune }}</p>
                @if (Auth::user()->role === 'proprietaire')
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 ">Information sur mon toutou</h3>
                        @foreach(Auth::user()->dogs as $dog)
                            <div class="flex justify-center mb-5">
                                <button 
                                    onclick="toggleDetails('dog-details-{{ $dog->id }}')" 
                                    class=" text-black w-full sm:w-full h-10 bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition">
                                    Détails de {{ $dog->nom }}
                                </button>
                            </div>

                            <div id="dog-details-{{ $dog->id }}" class="w-full bg-white p-2 mb-2 rounded-lg shadow-lg hidden">
                                <!-- Nom -->
                                <div class="flex justify-between items-center">
                                    <span class="text-sm"><strong>Nom :</strong></span>
                                    <span id="dog-nom-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">{{ $dog->nom }}</span>
                                    <button id="edit-btn-nom-{{ $dog->id }}" onclick="editField('nom', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-nom-{{ $dog->id }}" onclick="saveField('nom', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Race -->
                                <div class="flex justify-between items-center">
                                    <span class="text-sm"><strong>Race :</strong></span>
                                    <span id="dog-race-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">{{ $dog->race }}</span>
                                    <button id="edit-btn-race-{{ $dog->id }}" onclick="editField('race', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-race-{{ $dog->id }}" onclick="saveField('race', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Poids -->
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm"><strong>Poids :</strong></span>
                                    <span id="dog-poids-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">{{ $dog->poids }} kgs</span>
                                    <button id="edit-btn-poids-{{ $dog->id }}" onclick="editField('poids', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-poids-{{ $dog->id }}" onclick="saveField('poids', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Âge -->
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm"><strong>Âge :</strong></span>
                                    <span id="dog-age-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm" data-birthdate="{{ $dog->date_naissance }}"> {{ $dog->date_naissance }}</span>

                                    <button id="edit-btn-age-{{ $dog->id }}" onclick="editField('age', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-age-{{ $dog->id }}" onclick="saveField('age', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Sexe -->
                                <div class="flex justify-between items-center">
                                    <span class="text-sm"><strong>Sexe :</strong></span>
                                    <span id="dog-sexe-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm">
                                        @if ($dog->sexe == "F") Femelle @else Mâle @endif
                                    </span>
                                    <button id="edit-btn-sexe-{{ $dog->id }}" onclick="editField('sexe', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-sexe-{{ $dog->id }}" onclick="saveField('sexe', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Caractère -->
                                <div class="flex justify-between items-start">
                                    <span class="text-sm"><strong class="whitespace-nowrap">Caractère :</strong></span>
                                    <span id="dog-comportement-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm break-words">{{ $dog->comportement }}</span>
                                    <button id="edit-btn-comportement-{{ $dog->id }}" onclick="editField('comportement', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-comportement-{{ $dog->id }}" onclick="saveField('comportement', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Besoins spéciaux -->
                                <div class="flex justify-between items-start">
                                    <span class="text-sm"><strong class="whitespace-nowrap">Besoins <br> spéciaux :</strong></span>
                                    <span id="dog-besoins_speciaux-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent text-sm break-words">
                                        {{ $dog->besoins_speciaux }}
                                    </span>
                                    <button id="edit-btn-besoins_speciaux-{{ $dog->id }}" onclick="editField('besoins_speciaux', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-besoins_speciaux-{{ $dog->id }}" onclick="saveField('besoins_speciaux', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Stérilisation -->
                                <div class="flex justify-between mt-2">
                                    <span class="text-sm"><strong>Stérilisation :</strong></span>
                                    <span id="dog-sterilise-{{ $dog->id }}" class="dog-info text-gray-600 bg-transparent w-20 text-sm">
                                        @if ($dog->sterilise == 1) Oui @else Non @endif
                                    </span>
                                    <button id="edit-btn-sterilise-{{ $dog->id }}" onclick="editField('sterilise', {{ $dog->id }})" class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button id="save-btn-sterilise-{{ $dog->id }}" onclick="saveField('sterilise', {{ $dog->id }})" class="hidden text-green-500 hover:text-green-700">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </div>

                                <!-- Bouton Supprimer -->
                                <div class="flex justify-end mt-2">
                                    <button 
                                        onclick="confirmDelete({{ $dog->id }})" 
                                        class="text-red-500 hover:text-red-700 flex items-center space-x-2">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Supprimer</span>
                                    </button>
                                </div>
                            </div>              
                        @endforeach
                        <div id="confirmation-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                <p class="text-lg">Êtes-vous sûr de vouloir supprimer ce chien ?</p>
                                <div class="flex justify-end mt-6 space-x-4">
                                    <button onclick="deleteDogAjax()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                        Oui, supprimer
                                    </button>
                                    <button onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                                        Annuler
                                    </button>
                                </div>
                            </div>
                        </div>

                @else
                    <p class="mb-2"><strong>Disponibilité :</strong>
                        @foreach (Auth::user()->disponibilites as $disponibilite)
                            {{ $disponibilite->jour_semaine }}@if(!$loop->last), @endif 
                        @endforeach
                    </p>
                    @foreach(Auth::user()->prestationtypes as $prestationtype)
                        @if($prestationtype->id === 1)
                            <p class="mb-2">
                                <strong>Tarif de {{ $prestationtype->nom }} :</strong>
                                {{ $prestationtype->pivot->prix }} € / jour
                            </p>
                        @else
                            <p class="mb-2">
                                <strong>Tarif de {{ $prestationtype->nom }} :</strong>
                                {{ $prestationtype->pivot->prix }} € / heure
                            </p>
                        @endif
                    @endforeach

                    @if(Auth::user()->prestationtypes->isEmpty())
                        <p class="mb-2">Aucun tarif défini.</p>
                    @endif
                @endif
            </div>

            <div class="w-full md:w-2/3 bg-gradient-to-r from-yellow-100 to-orange-100 p-6 rounded-lg shadow-lg">

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
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                            </div>
                            <button type="submit" id="save-btn"
                                class="mt-3 bg-gradient-to-r from-yellow-300 to-pink-300 w-full text-black px-4 py-2 rounded-lg hover:bg-blue-600 transition hidden">
                                Mettre à jour
                            </button>
                        </form>
                        <h3 class="text-xl font-semibold mb-4 text-gray-800 ">Photos de mes chiens</h3>
                        <div class="flex flex-wrap justify-center gap-6 mb-5">
                            @php
                                $dogsWithPhoto = Auth::user()->dogs->filter(function ($dog) {
                                    return $dog->photo && file_exists(public_path('storage/' . $dog->photo));
                                });
                            @endphp
                            
                            @if ($dogsWithPhoto->isEmpty())
                                <p>Aucune photo disponible.</p>
                            @else
                                <div class="flex flex-wrap justify-center gap-6">
                                    @foreach ($dogsWithPhoto as $dog)
                                        <div class="flex flex-col items-center">
                                            <div class="relative">
                                                <img src="{{ asset('storage/' . $dog->photo) }}" alt="{{ $dog->nom }}" class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-lg">
                                                <form action="{{ route('dogs.delete', $dog->id) }}" method="POST" class="absolute top-3 right-3">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                @endif

                @if (Auth::user()->role === 'dogsitter')
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 pt-2">A propos de moi et mes expériences</h3>
                        <form action="{{ route('update.description') }}" method="POST" id="description-form" class="w-full">
                            @csrf
                            <div class="relative w-full">
                                <textarea id="description-text" name="description"
                                    class="w-full  p-3 lg text-black border-none bg-gradient-to-r from-yellow-100 to-orange-100 focus:outline-none rounded-lg"
                                    rows="4" readonly>{{ Auth::user()->description }}</textarea>

                                <button type="button" id="edit-btn"
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 transition maxheight-[50px] ">
                                    <!-- Icône de crayon -->
                                    <i class="fas fa-edit"></i> Modifier
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
                            <p class="text-gray-700 mb-4">Vous ne pouvez pas prendre rendez-vous avec vous-même</p>
                        @endif

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

    function editField(field, dogId) {
    let fieldText = document.getElementById(`dog-${field}-${dogId}`);
    let fieldValue = fieldText.textContent;

    if (field === 'sexe') {
        fieldText.innerHTML = `<select id="input-${field}-${dogId}" class="p-2 border rounded">
            <option value="F" ${fieldValue === 'Femelle' ? 'selected' : ''}>Femelle</option>
            <option value="M" ${fieldValue === 'Male' ? 'selected' : ''}>Male</option>
        </select>`;
    } if (field === 'sterilise') {
        fieldText.innerHTML = `<select id="input-${field}-${dogId}" class="py-2 border rounded">
            <option value="0" ${fieldValue === '0' ? 'selected' : ''}>Non</option>
            <option value="1" ${fieldValue === '1' ? 'selected' : ''}>Oui</option>
        </select>`;
    } else {
        fieldText.innerHTML = `
    <input type="text" value="${fieldValue}" id="input-${field}-${dogId}" class="p-2 bg-transparent focus:outline-none focus:ring-0 border-none w-full">`;
    }

    document.getElementById(`edit-btn-${field}-${dogId}`).classList.add('hidden');
    document.getElementById(`save-btn-${field}-${dogId}`).classList.remove('hidden');
}

function saveField(field, dogId) {
    let inputValue = document.getElementById(`input-${field}-${dogId}`).value;

    fetch(`/dogs/${dogId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            [field]: inputValue
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const fieldText = document.getElementById(`dog-${field}-${dogId}`);
            fieldText.textContent = inputValue === '1' ? 'Oui' : 'Non';
            document.getElementById(`edit-btn-${field}-${dogId}`).classList.remove('hidden');
            document.getElementById(`save-btn-${field}-${dogId}`).classList.add('hidden');

        } else {
            alert('Erreur lors de la mise à jour.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur s\'est produite.');
    });
}

    let dogIdToDelete = null;

    function confirmDelete(dogId) {
        dogIdToDelete = dogId;
        document.getElementById('confirmation-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmation-modal').classList.add('hidden');
        dogIdToDelete = null;
    }

    function deleteDogAjax() {
        if (!dogIdToDelete) return;

        fetch(`/dogs/${dogIdToDelete}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Suppression échouée');
            return response.json();
        })
        .then(data => {
            const detailsDiv = document.getElementById(`dog-details-${dogIdToDelete}`);
            if (detailsDiv) detailsDiv.parentElement.remove();
            closeModal();
            alert(data.message || "Chien supprimé avec succès.");
        })
        .catch(error => {
            closeModal();
            alert("Erreur : " + error.message);
        });
    }
</script>