<x-app-layout>
    <!-- Section Hero -->
    <section class="py-8">
        <div class="container mx-auto">
            <!-- Titre Principal -->
            <div class="text-center text-black mb-8">
                <h1 class="text-5xl font-bold mb-4">Bienvenue sur Patte à Patte</h1>
                <p class="text-xl">
                    Le Dog Sitting de Confiance pour Votre Compagnon à Quatre Pattes <br>
                    Votre chien mérite les meilleurs soins, même en votre absence.
                </p>
            </div>

            @auth 
                <!-- Conteneur Principal -->
                <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8">
                    <!--  Avantages -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-8 mb-8">
                        <!-- Image -->
                        <div class="w-full h-full flex justify-center items-center">
                            <img src="/images/paxa.jpg" alt="Dog Sitting pax"
                                class="w-2/3 lg:w-1/2 h-auto rounded-lg shadow-md">
                        </div>                        
                        <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                            <span class="text-4xl text-yellow-500">🏅</span>
                            <h3 class="text-xl font-bold mt-3">Des Dogsitters Vérifiés</h3>
                            <p class="text-gray-600 mt-2">Tous nos dogsitters sont soigneusement sélectionnés et vérifiés
                                pour vous garantir sécurité et tranquillité d'esprit.</p>
                        </div>
                        <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                            <span class="text-4xl text-yellow-500">📅</span>
                            <h3 class="text-xl font-bold mt-3">Réservation Facile</h3>
                            <p class="text-gray-600 mt-2">Réservez un dogsitter en quelques clics selon votre emploi du
                                temps et la disponibilité de nos prestataires.</p>
                        </div>
                        <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                            <span class="text-4xl text-yellow-500">💬</span>
                            <h3 class="text-xl font-bold mt-3">Avis & Témoignages</h3>
                            <p class="text-gray-600 mt-2">Lisez les avis authentiques de nos utilisateurs pour faire le
                                meilleur choix et avoir l’esprit tranquille.</p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Conteneur Principal -->
                <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8">
                    <!-- Image -->
                    <div class="w-full lg:w-1/3 mb-8 lg:mb-0 flex justify-center">
                        <img src="{{ asset('images/paxa.jpg') }}" alt="Dog Sitting pax"
                            class="w-2/3 lg:w-1/2 h-auto rounded-lg shadow-md">
                    </div>

                    <div class="w-full lg:w-2/3 text-black rounded-lg">

                        <div class="p-6 backdrop-blur-md bg-white/70 shadow-md p-8 rounded-md mt-12">
                            <h2 class="text-3xl font-bold text-black mb-4 text-center">Rejoignez notre communauté</h2>
                            <p class="text-lg text-black mb-6">
                                Que vous soyez un propriétaire cherchant les meilleurs soins pour votre animal
                                ou un dogsitter passionné prêt à offrir vos services, inscrivez-vous dès aujourd'hui !
                            </p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('register') }}?proprietaire=true"
                                    class="px-6 py-3 bg-orange-300 text-white text-lg font-bold rounded-lg shadow-lg hover:bg-orange-400 focus:outline-none focus:ring-4 focus:ring-red-100 focus:ring-opacity-75 transition duration-300">
                                    Je suis propriétaire
                                </a>
                                <a href="{{ route('register') }}?proprietaire=false"
                                    class="px-6 py-3 bg-blue-300 text-white text-lg font-bold rounded-lg shadow-lg hover:bg-blue-400 focus:outline-none focus:ring-4 focus:ring-green-100 focus:ring-opacity-75 transition duration-300">
                                    Je suis dogsitter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endauth
        </div>
    </section>

    <!-- Section Features -->
<section>
    <div class="container mx-auto">
        <h2 class="text-3xl font-semibold text-center mb-8 pt-16 text-black">Comment ça fonctionne ?</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Étape 1 -->
            <div class="p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                <h3 class="text-2xl font-semibold mb-4 text-orange-400">1. Inscription</h3>
                <p class="text-gray-700 mb-2"><span class="font-semibold text-gray-800">Propriétaire :</span> créez votre profil gratuitement, ajoutez les informations sur votre chien et votre lieu de résidence.</p>
                <p class="text-gray-700"><span class="font-semibold text-gray-800">Dogsitter :</span> complétez votre profil vitrine pour vous présenter et indiquer vos disponibilités.</p>
            </div>

            <!-- Étape 2 -->
            <div class="p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                <h3 class="text-2xl font-semibold mb-4 text-gray-500">2. Mise en relation</h3>
                <p class="text-gray-700 mb-2"><span class="font-semibold text-gray-800">Propriétaire :</span> explorez les profils des dogsitters et contactez celui qui vous inspire confiance.</p>
                <p class="text-gray-700"><span class="font-semibold text-gray-800">Dogsitter :</span> recevez des messages de propriétaires et échangez pour organiser la prestation.</p>
            </div>

            <!-- Étape 3 -->
            <div class="p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                <h3 class="text-2xl font-semibold mb-4 text-blue-400">3. Réservation</h3>
                <p class="text-gray-700 mb-2"><span class="font-semibold text-gray-800">Propriétaire :</span> réservez les dates en toute sérénité et partez l'esprit tranquille.</p>
                <p class="text-gray-700"><span class="font-semibold text-gray-800">Dogsitter :</span> confirmez la prestation et accueillez l’animal dans un cadre chaleureux et sécurisé.</p>
            </div>
        </div>
    </div>
</section>


    <!-- Section Subscriptions -->
<section>
    <div class="container mx-auto pt-16">
        <h2 class="text-3xl font-semibold text-center mb-8 text-black">Nos abonnements pour les dogsitters</h2>

        <div class="mx-auto p-6 rounded-lg shadow-lg backdrop-blur-md bg-white/70">
            <p class="text-lg text-gray-700 mb-6">
                Sur notre site, nous souhaitons offrir aux dogsitters un espace dédié, où ils peuvent se présenter de manière sérieuse et professionnelle. Pour cela, nous proposons la possibilité de créer un <strong>profil vitrine</strong>, accessible via un abonnement.
            </p>

            <div class="mb-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Deux formules sont disponibles :</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 rounded-lg border border-orange-200 bg-orange-50">
                        <h4 class="text-xl font-semibold text-orange-600 mb-2">Abonnement mensuel</h4>
                        <p class="text-gray-700">Pour ceux qui préfèrent avancer pas à pas.</p>
                        <p class="text-lg font-bold text-orange-700 mt-2">29,90€ / mois</p>
                    </div>
                    <div class="p-4 rounded-lg border border-blue-200 bg-blue-50">
                        <h4 class="text-xl font-semibold text-blue-400 mb-2">Abonnement annuel</h4>
                        <p class="text-gray-700">Pour ceux qui s’inscrivent dans la durée avec constance.</p>
                        <p class="text-lg font-bold text-blue-500 mt-2">199,90€ / an</p>
                    </div>
                </div>
            </div>

            <p class="text-gray-700">
                Ces abonnements permettent d’afficher son profil dans un cadre coloré et soigné, auprès de familles en recherche de personnes de confiance. Cela reflète un engagement sincère dans l’activité de dogsitting, dans le respect des animaux et des maîtres.
            </p>
        </div>
    </div>
</section>



    <!-- Section Chiffres clés -->
    <section>
        <div class="container mx-auto pt-16">
            <h2 class="text-3xl font-semibold text-center mb-8 text-black">Quelques chiffres sur Patte à Patte</h2>
            <div class="bg-white/70 p-6 rounded-lg shadow-lg backdrop-blur-md bg-white/70">
                <div class="text-center ">
                    <p class="text-lg text-gray-600 mt-4">Plus de {{ $utilisateurs }} utilisateurs satisfaits et une communauté
                        grandissante chaque jour !</p>
                </div>
                <div class="flex justify-center items-center gap-12 text-center mt-10">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $dogsitters }}</h3>
                        <p class="text-gray-600">Dogsitters</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $proprietaires }}</h3>
                        <p class="text-gray-600">Propriétaires</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $pourcentageSatisfaction }} %</h3>
                        <p class="text-gray-600">Taux de Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Avis et temoignages -->
        <section>
            <div class="container mx-auto p-16 ">
                <div class="text-center">
                    <h2 class="text-3xl font-semibold text-center mb-8 text-black">Témoignages de Nos Utilisateurs</h2>
                    <!-- Affichage des avis -->
                    <div class="flex flex-col lg:flex-row justify-center gap-8 mt-6">
                        @forelse($avis as $avis)
                            <div class="bg-white p-6 shadow-lg rounded-lg w-full lg:w-1/3">
                                <p class="text-gray-600 italic">"{{ $avis->commentaire }}"</p>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="text-3xl {{ $i <= $avis->rating ? 'text-yellow-500' : 'text-gray-300' }}">★</span>
                                        @endfor
                                    </div>
                                    <div class="text-sm text-gray-500 ml-5">
                                        {{ $avis->user->name }}, {{ ucwords(strtolower($avis->user->ville->nom_de_la_commune)) }}
                                    </div>                                    
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 italic text-center">Aucun commentaire pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    @auth
        <div class="container mx-auto pb-8 text-center">
            <h3 class="text-2xl font-semibold text-gray-800 ">Laissez Votre Avis</h3>
            <p class="text-gray-600 mt-2">Nous apprécions vos retours pour améliorer nos services !</p>
            <form action="{{ route('avis.store') }}" method="POST" class="mt-6 mb-5 max-w-3xl mx-auto bg-white/70 p-6 shadow-lg rounded-lg">
                @csrf
                <!-- Note -->
                <label for="rating" class="block text-gray-700 text-lg font-semibold">Note :</label>
                <div class="rating-container flex items-center justify-center gap-2 mt-2 mb-5 text-5xl">
                    <input type="radio" name="rating" value="1" id="rating1" class="hidden" />
                    <label for="rating1" class="cursor-pointer text-gray-300">★</label>
                
                    <input type="radio" name="rating" value="2" id="rating2" class="hidden" />
                    <label for="rating2" class="cursor-pointer text-gray-300">★</label>
                
                    <input type="radio" name="rating" value="3" id="rating3" class="hidden" />
                    <label for="rating3" class="cursor-pointer text-gray-300">★</label>
                
                    <input type="radio" name="rating" value="4" id="rating4" class="hidden" />
                    <label for="rating4" class="cursor-pointer text-gray-300">★</label>
                
                    <input type="radio" name="rating" value="5" id="rating5" class="hidden" />
                    <label for="rating5" class="cursor-pointer text-gray-300">★</label>
                </div>
                

                <!-- Commentaire -->
                <div class="mb-2 max-height-8">
                    <label for="commentaire" class="block text-gray-700 text-lg font-semibold mb-5">Votre Commentaire :</label>
                    <textarea id="commentaire" name="commentaire" rows="4" class="w-full max-h-[20rem] min-h-[10rem] p-3 mt-2 border border-gray-300 rounded-lg" placeholder="Écrivez votre avis ici..." required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="mt-4 px-6 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600">Envoyer mon Avis</button>
            </form>
        </div>
    @endauth
    <script>
        document.querySelectorAll('.rating-container input[name="rating"]').forEach(input => {
        input.addEventListener('change', function() {
            let rating = parseInt(this.value); 
            let stars = this.closest('.rating-container').querySelectorAll('label'); 
            
            stars.forEach((label, index) => {
                if (index < rating) {
                    label.textContent = '★'; 
                    label.classList.add('text-yellow-500');
                } else {
                    label.textContent = '☆'; 
                    label.classList.remove('text-yellow-500');
                }
            });
        });
    });


    </script>

</x-app-layout>