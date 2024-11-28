    @extends('layouts.partials.defaultLayout')
    @section('title', 'Bienvenue sur Patte à patte')
    @section('content')
    
    <!-- Hero Section -->
    <section class="bg-green text-black py-20 bg-gray-100 text-gray-800">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">Bienvenue sur Patte à patte</h1>
            <p class="text-xl mb-8">Le Dog Sitting de Confiance pour Votre Compagnon à Quatre Pattes <br>
                Votre chien mérite les meilleurs soins, même en votre absence.</p>
            <div class="container mx-auto mt-8 flex items-start space-x-8">
                <!-- Image -->
                <div class="w-1/3">
                    <img src="{{ asset('images/test.jpg') }}" alt="Dog Sitting" class="w-full rounded-lg">
                </div>
                <div class="w-2/3 bg-gray p-8 rounded-lg shadow-md">
                    <form action="#" method="POST" class="space-y-6">
                        <!-- Besoin -->
                        <div>
                            <label class="text-lg font-semibold mb-2 block">Votre besoin</label>
                            <div class="flex space-x-4 ">
                                <button type="button" class="p-3 bg-green  rounded-lg hover:bg-gray-200 transition">Garde d'animaux</button>
                                <button type="button" class="p-3 bg-green rounded-lg hover:bg-gray-200 transition">Promenades</button>
                            </div>
                        </div>
                        <!-- Localisation -->
                        <div>
                            <label for="location" class="text-lg font-semibold mb-2 block">Location </label>
                            <input 
                                type="text" 
                                id="location" 
                                name="location" 
                                placeholder="Entrez votre code postal ou ville" 
                                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green"
                                required
                            >
                        </div>
                        <!-- Date -->
                        <div>
                            <label for="date" class="text-lg font-semibold mb-2 block">Date</label>
                            <input 
                                type="date" 
                                id="date" 
                                name="date" 
                                class="w-full p-3 border rounded-lg"
                                required
                            >
                        </div>
                        <!-- Bouton de soumission -->
                        <div class="text-center">
                            <button 
                                type="submit" 
                                class="w-full bg-green py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Trouver mon dogsitter
                            </button>
                        </div>
                    </form>
                </div>    
        </div>
    </section>
    <div class="flex space-x-4 mt-4">
        <a href="{{ route('register') }}?proprietaire=true" 
           class="px-6 py-2 bg-pink text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
           Proprietaire
        </a>
        <a href="{{ route('register') }}?proprietaire=false" 
           class="px-6 py-2 bg-pink text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 transition duration-300">
           Dogsitter
        </a>
    </div>
    <section class="py-16 bg-gray">
        <div class="container mx-auto">
            <p class="text-center mb-12">
                Chez patte à patte, nous savons qu’il est difficile de laisser votre chien. 
                C’est pourquoi nous proposons un dog-sitting personnalisé et sécurisé, pour que vous partiez sereinement, 
                votre compagnon bien pris en charge !
            </p>
    
            <!-- Propriétaire -->
            <div class="bg-green p-6 rounded-lg shadow-lg text-center w-full mb-8">
                <h3 class="text-2xl font-semibold mb-4">Propriétaire</h3>
                <p class="text-gray-600">
                    Parce que le bien-être de votre chien est notre priorité, confiez-le à un dog sitter attentionné qui veille à ses besoins, à son confort, et à son équilibre émotionnel. Qu'il s'agisse de promenades stimulantes, de jeux ou de moments de calme, votre compagnon bénéficiera d’un environnement sécurisé et bienveillant, comme s’il était chez vous.
                </p>
            </div>
    
            <!-- Dogsitter -->
            <div class="bg-green p-6 rounded-lg shadow-lg text-center w-full">
                <h3 class="text-2xl font-semibold mb-4">Dogsitter</h3>
                <p class="text-gray-600 mb-4">
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
                <div class="bg-gray p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Créer votre profil gratuitement </h3>
                    <p class="text-gray-600 mb-4"> Inscrivez-vous en quelques minutes, complétez les informations sur votre chien, et découvrez les dog sitters disponibles près de chez vous.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Choississez votre dogsitter</h3>
                    <p class="text-gray-600 mb-4">Parcourez les profils détaillés des dog sitters, lisez les avis d’autres propriétaires, et sélectionnez celui qui correspond le mieux aux besoins de votre compagnon.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Reservez et partez l'esprit tranquille </h3>
                    <p class="text-gray-600 mb-4">Planifiez les dates, échangez avec le dog sitter, et suivez les mises à jour en temps réel pendant la garde, tout en bénéficiant de notre assurance et de notre assistance 24h/24.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray">
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
                        <li>- 10 annonces actives pour des services (garde, promenade, etc.)</li>
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
                        <li>- Outils de gestion complète (réservations, statistiques avancées, paiements en ligne)</li>
                        <li>- Promotion via newsletters et réseaux sociaux</li>
                        <li>- Accès à des outils de marketing et campagnes publicitaires</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    

@endsection
