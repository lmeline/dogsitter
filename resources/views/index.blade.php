<x-app-layout>
    <!-- Section Hero -->
    <section class="py-8">
        <div class="container mx-auto">
            <!-- Titre Principal -->
            <div class="text-center text-black mb-12">
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
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-8 mb-12">
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
            <h2 class="text-3xl font-semibold text-center mb-12 pt-16 text-black">Comment ça fonctionne ?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class=" p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                    <h3 class="text-2xl font-semibold mb-4 text-orange-300">Créer votre profil gratuitement</h3>
                    <p class="text-gray-600 mb-4"> Inscrivez-vous en quelques minutes, complétez les informations sur
                        votre chien, et découvrez les dog sitters disponibles près de chez vous.</p>
                </div>

                <!-- Feature 2 -->
                <div class=" p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-400">Choississez votre dogsitter</h3>
                    <p class="text-gray-600 mb-4">Parcourez les profils détaillés des dog sitters, lisez les avis
                        d’autres propriétaires, et sélectionnez celui qui correspond le mieux aux besoins de votre
                        compagnon.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                    <h3 class="text-2xl font-semibold mb-4 text-blue-300">Reservez et partez l'esprit tranquille</h3>
                    <p class="text-gray-600 mb-4">Planifiez les dates, échangez avec le dog sitter, et suivez les mises
                        à jour en temps réel pendant la garde, tout en bénéficiant de notre assurance et de notre
                        assistance 24h/24.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Subscriptions -->
    <section>
        <div class="container mx-auto">
            <h2 class="text-3xl font-semibold text-center mb-12 pt-16 text-gray-800">Nos abonnements pour les dogsitters
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Subscription 1 -->
                <div class=" p-6 rounded-lg shadow-lg text-left backdrop-blur-md bg-white/70">
                    <h3 class="text-2xl font-semibold mb-4 text-center text-orange-300">Abonnement / Mois</h3>
                    <ul class="mb-4">
                        <li class="font-semibold">Mensuel: <span class="font-normal">29 € par mois</span></li>
                    </ul>
                    <ul class="space-y-2">
                        <li class="font-semibold">Services inclus:</li>
                        <li>- Profil complet avec photo, description, et avis clients</li>
                        <li>- 10 annonces actives pour des services (garde, promenade)</li>
                        <li>- Visibilité dans les résultats de recherche</li>
                        <li>- Accès aux statistiques de base (visites de profil, clics)</li>
                        <li>- Réception d'avis et évaluations clients</li>
                    </ul>
                </div>

                <!-- Subscription 2 -->
                <div class="p-6 rounded-lg shadow-lg text-left backdrop-blur-md bg-white/70">
                    <h3 class="text-2xl font-semibold mb-4 text-center text-blue-300">Abonnement / Annuel </h3>
                    <ul class="mb-4">
                        <li class="font-semibold">Annuel: <span class="font-normal">290 € par an (2 mois offerts)</span>
                        </li>
                    </ul>
                    <ul class="space-y-2">
                        <li class="font-semibold">Services inclus:</li>
                        <li>- Profil complet avec photo, description, et avis clients</li>
                        <li>- 10 annonces actives pour des services (garde, promenade)</li>
                        <li>- Visibilité avec mise en avant dans les résultats de recherche</li>
                        <li>- Accès aux statistiques de base (visites de profil, clics)</li>
                        <li>- Réception d'avis et évaluations clients</li>

                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- Section Chiffres clés -->
    <section>
        <div class="container mx-auto pt-16">
            <div class="bg-gray-100 py-12 mb-12">
                <div class="text-center">
                    <h2 class="text-3xl font-semibold text-gray-800">Quelques chiffres sur Patte à Patte</h2>
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
            <div class="container mx-auto pb-16">
                <div class="text-center">
                    <h2 class="text-3xl mb-12 font-semibold text-gray-800">Témoignages de Nos Utilisateurs</h2>
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
            <form action="{{ route('avis.store') }}" method="POST" class="mt-6 mb-5 max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-lg">
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