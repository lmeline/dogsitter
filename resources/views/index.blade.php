    @extends('layouts.partials.default-layout')
    @section('title', 'Bienvenue sur Patte à patte')
    @section('content')
    
    <!-- Hero Section -->
    <section class="bg-green text-black py-20  text-gris">
            <div class="container mx-auto">
                <!-- Titre Principal -->
                <div class="text-center text-black mb-12">
                    <h1 class="text-5xl font-bold mb-4">Bienvenue sur Patte à Patte</h1>
                    <p class="text-xl">
                        Le Dog Sitting de Confiance pour Votre Compagnon à Quatre Pattes <br>
                        Votre chien mérite les meilleurs soins, même en votre absence.
                    </p>
                </div>
        
                <!-- Conteneur Principal -->
                <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8">
                    <!-- Image -->
                    <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
                        <img src="{{ asset('images/pax.jpg') }}" alt="Dog Sitting" class="w-full rounded-lg">
                    </div>
        
                    <!-- Contenu Formulaire -->
                    <div class="w-full lg:w-2/3 text-black rounded-lg">
                        <!-- Formulaire -->
                        <form action="#" method="POST" class="space-y-6 bg-gris shadow md p-8 rounded-md">
                            <!-- Besoin -->
                            <div class="flex justify-between items-center">
                                <label class="text-lg font-semibold w-1/4">Votre besoin</label>
                                <div class="grid grid-cols-2 gap-4 w-3/4">
                                    <button 
                                        type="button" 
                                        class="p-6 text-xl bg-green rounded-lg hover:bg-pink transition font-semibold">
                                        Garde d'animaux
                                    </button>
                                    <button 
                                        type="button" 
                                        class="p-6 text-xl bg-green rounded-lg hover:bg-pink transition font-semibold">
                                        Promenades
                                    </button>
                                </div>
                            </div>
        
                            <!-- Localisation -->
                            <div class="flex justify-between items-center">
                                <label for="location" class="text-lg font-semibold w-1/4">Localisation</label>
                                <input 
                                    type="text" 
                                    id="location" 
                                    name="location" 
                                    placeholder="Entrez votre code postal ou ville" 
                                    class="w-3/4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green"
                                    required
                                >
                            </div>
        
                            <!-- Date -->
                            <div class="flex justify-between items-center">
                                <label for="date" class="text-lg font-semibold w-1/4">Date</label>
                                <input 
                                    type="date" 
                                    id="date" 
                                    name="date" 
                                    class="w-3/4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green"
                                    required
                                >
                            </div>
        
                            <!-- Bouton de soumission -->
                            <div class="flex justify-between items-center">
                                <div class="w-1/4"></div>
                                <button 
                                    type="submit" 
                                    class="w-3/4 bg-green py-3 px-6 rounded-lg font-semibold hover:bg-pink transition">
                                    Trouver mon dogsitter
                                </button>
                            </div>
                        </form>
        
                        <!-- Rejoignez notre communauté (Déplacé en dessous du formulaire) -->
                        
                        <div class="bg-gris-50 p-6 bg-gris shadow md p-8 rounded-md mt-12">
                            <h2 class="text-3xl font-bold text-black mb-4 text-center">Rejoignez notre communauté</h2>
                            <p class="text-lg text-black mb-6">
                                Que vous soyez un propriétaire cherchant les meilleurs soins pour votre animal 
                                ou un dogsitter passionné prêt à offrir vos services, inscrivez-vous dès aujourd'hui !
                            </p>
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('register') }}?proprietaire=true" 
                                    class="px-6 py-3 bg-pink text-white text-lg font-bold rounded-lg shadow-lg hover:bg-blue focus:outline-none focus:ring-4 focus:ring-blue focus:ring-opacity-75 transition duration-300">
                                    Je suis propriétaire
                                </a>
                                <a href="{{ route('register') }}?proprietaire=false" 
                                    class="px-6 py-3 bg-green text-white text-lg font-bold rounded-lg shadow-lg hover:bg-green focus:outline-none focus:ring-4 focus:ring-green focus:ring-opacity-75 transition duration-300">
                                    Je suis dogsitter
                                </a>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </section>
        
<!-- Features Section -->

    <section class="py-16 bg-gris">
        <div class="container mx-auto">
            <h4 class="text-center mb-12 text-3xl ">
                Chez <strong>Patte à patte</strong>, nous savons qu’il est difficile de laisser votre chien. C’est pourquoi nous proposons un dog-sitting personnalisé et sécurisé, pour que vous partiez sereinement, votre compagnon bien pris en charge !
            </h4>
    
            <!-- Propriétaire -->
            <div class="bg-green p-6 rounded-lg shadow-lg text-center w-full mb-8">
                <h3 class="text-2xl font-semibold mb-4">Propriétaire</h3>
                <p class="text-gris-600">
                    Parce que le bien-être de votre chien est notre priorité, confiez-le à un dog sitter attentionné qui veille à ses besoins, à son confort, et à son équilibre émotionnel. Qu'il s'agisse de promenades stimulantes, de jeux ou de moments de calme, votre compagnon bénéficiera d’un environnement sécurisé et bienveillant, comme s’il était chez vous.
                </p>
            </div>
    
            <!-- Dogsitter -->
            <div class="bg-green p-6 rounded-lg shadow-lg text-center w-full">
                <h3 class="text-2xl font-semibold mb-4">Dogsitter</h3>
                <p class="text-gris-600 mb-4">
                    Vous adorez les chiens et souhaitez un métier qui vous passionne ? Devenez dog sitter et profitez d’une activité flexible et enrichissante.
                    Offrez des soins, de l'attention et des moments de joie aux chiens tout en gagnant la confiance de leurs propriétaires.
                    Faites de votre amour pour les animaux un véritable atout au quotidien !
                </p>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="py-16 bg-green">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12">Comment ça fonctionne ? </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gris p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Créer votre profil gratuitement </h3>
                    <p class="text-gris-600 mb-4"> Inscrivez-vous en quelques minutes, complétez les informations sur votre chien, et découvrez les dog sitters disponibles près de chez vous.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gris p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Choississez votre dogsitter</h3>
                    <p class="text-gris-600 mb-4">Parcourez les profils détaillés des dog sitters, lisez les avis d’autres propriétaires, et sélectionnez celui qui correspond le mieux aux besoins de votre compagnon.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gris p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Reservez et partez l'esprit tranquille </h3>
                    <p class="text-gris-600 mb-4">Planifiez les dates, échangez avec le dog sitter, et suivez les mises à jour en temps réel pendant la garde, tout en bénéficiant de notre assurance et de notre assistance 24h/24.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gris">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12">Nos Abonnements</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Subscription 1 -->
                <div class="bg-green p-6 rounded-lg shadow-lg text-left">
                    <h3 class="text-2xl font-semibold mb-4 text-center">Abonnement Standard</h3>
                    <ul class="mb-4">
                        <li class="font-semibold">Mensuel: <span class="font-normal">29 € par mois</span></li>
                        <li class="font-semibold">Annuel: <span class="font-normal">290 € par an (2 mois offerts)</span></li>
                    </ul>
                    <ul class="space-y-2">
                        <li class="font-semibold">Services inclus:</li>
                        <li>- Profil complet avec photo, description, et avis clients</li>
                        <li>- 10 annonces actives pour des services (garde, promenade)</li>
                        <li>- Visibilité standard dans les résultats de recherche</li>
                        <li>- Accès aux statistiques de base (visites de profil, clics)</li>
                        <li>- Réception d'avis et évaluations clients</li>
                    </ul>
                </div>
                <!-- Subscription 2 -->
                <div class="bg-green p-6 rounded-lg shadow-lg text-left">
                    <h3 class="text-2xl font-semibold mb-4 text-center">Abonnement Premium</h3>
                    <ul class="mb-4">
                        <li class="font-semibold">Mensuel: <span class="font-normal">59 € par mois</span></li>
                        <li class="font-semibold">Annuel: <span class="font-normal">590 € par an (2 mois offerts)</span></li>
                    </ul>
                    <ul class="space-y-2">
                        <li class="font-semibold">Services inclus:</li>
                        <li>- Profil optimisé avec galerie de photos, vidéos, et recommandations</li>
                        <li>- Annonces illimitées pour proposer tous types de services</li>
                        <li>- Visibilité maximale avec mise en avant dans les résultats de recherche</li>
                        <li>- Badge "Dog Sitter Vérifié" (après vérification des références)</li>
                        <li>- Promotion via newsletters et réseaux sociaux</li>
                        <li>- Accès à des outils de marketing et campagnes publicitaires</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section class="py-5 bg-gray-600 text-white">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-5">Nos Informations et Services</h2>
            
            <div class="flex flex-wrap justify-between space-y-4 md:space-y-0">
                <!-- Informations légales et politiques -->
                <ul class="flex-1 p-4">
                    <h3 class="text-xl font-bold mb-4">Informations légales et politiques</h3>
                    <li><a href="#" class="hover:underline">Mentions légales</a></li>
                    <li><a href="#" class="hover:underline">Conditions générales d'utilisation (CGU)</a></li>
                    <li><a href="#" class="hover:underline">Politique de confidentialité</a></li>
                    <li><a href="#" class="hover:underline">Politique de cookies</a></li>
                </ul>
    
                <!-- Aide et support -->
                <ul class="flex-1 p-4">
                    <h3 class="text-xl font-bold mb-4">Aide et support</h3>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                    <li><a href="#" class="hover:underline">Aide / FAQ</a></li>
                    <li><a href="#" class="hover:underline">Plan du site</a></li>
                    <li><a href="#" class="hover:underline">Nous contacter</a></li>
                </ul>
    
                <!-- À propos de l'entreprise -->
                <ul class="flex-1 p-4">
                    <h3 class="text-xl font-bold mb-4">À propos de l'entreprise</h3>
                    <li><a href="#" class="hover:underline">À propos / Qui sommes-nous ?</a></li>
                    <li><a href="#" class="hover:underline">Carrières / Recrutement</a></li>
                    <li><a href="#" class="hover:underline">Presse / Partenaires</a></li>
                    <li><a href="#" class="hover:underline">Devenir dog sitter</a></li>
                </ul>
    
                <!-- Contenu et actualités -->
                <ul class="flex-1 p-4">
                    <h3 class="text-xl font-bold mb-4">Contenu et actualités</h3>
                    <li><a href="#" class="hover:underline">Blog / Actualités</a></li>
                    <li><a href="#" class="hover:underline">Newsletter</a></li>
                    <li><a href="#" class="hover:underline">Conseils pour les propriétaires de chiens</a></li>
                    <li><a href="#" class="hover:underline">Avis clients</a></li>
                </ul>
            </div>
    
            <!-- Réseaux sociaux -->
            <div class="text-center mt-4">
                <h3 class="text-xl font-bold mb-4">Réseaux sociaux et communauté</h3>
                <div class="flex justify-center space-x-2">
                    <a href="https://www.facebook.com/loise.meline" aria-label="Facebook"><img src="{{ asset('images/facebook_logo.png') }}" alt="Facebook" class="w-6 h-6"></a>
                    <a href="https://www.instagram.com/loise.mln" aria-label="Instagram"><img src="{{ asset('images/instagram_logo.jpg') }}" alt="Instagram" class="w-6 h-6"></a>
                    {{-- <a href="#" aria-label="Twitter"><img src="{{ asset('images/linkedIn_logo.png') }}" alt="Twitter" class="w-6 h-6"></a> --}}
                    <a href="https://www.linkedin.com/in/loïse-meline-777830271/" aria-label="LinkedIn"><img src="{{ asset('images/linkedIn_logo.png') }}" alt="LinkedIn" class="w-6 h-6"></a>
                </div>
            </div>
        </div>
    </section>
@endsection
