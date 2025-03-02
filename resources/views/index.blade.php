@extends('layouts.partials.default-layout')
@section('title', 'Bienvenue sur Patte à Patte')
@section('content')
    @auth
        <x-app-layout>
            <!-- Hero Section -->
            <div>
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

                        <!-- Conteneur Principal -->
                        <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8"> 
                            <!--  Avantages -->
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-8 mb-12">
                                <!-- Image -->
                                <div class="w-full h-full rounded-lg ">
                                    <img src="{{ asset('images/pax.jpg') }}" alt="Dog Sitting" class="w-2/3 lg:w-1/2 h-auto rounded-lg shadow-md">
                                </div>
                                <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                                    <span class="text-4xl text-yellow-500">🏅</span>
                                    <h3 class="text-xl font-bold mt-3">Des Dogsitters Vérifiés</h3>
                                    <p class="text-gray-600 mt-2">Tous nos dogsitters sont soigneusement sélectionnés et vérifiés pour vous garantir sécurité et tranquillité d'esprit.</p>
                                </div>
                                <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                                    <span class="text-4xl text-yellow-500">📅</span>
                                    <h3 class="text-xl font-bold mt-3">Réservation Facile</h3>
                                    <p class="text-gray-600 mt-2">Réservez un dogsitter en quelques clics selon votre emploi du temps et la disponibilité de nos prestataires.</p>
                                </div>
                                <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                                    <span class="text-4xl text-yellow-500">💬</span>
                                    <h3 class="text-xl font-bold mt-3">Avis & Témoignages</h3>
                                    <p class="text-gray-600 mt-2">Lisez les avis authentiques de nos utilisateurs pour faire le meilleur choix et avoir l’esprit tranquille.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-semibold text-center mb-12 pt-16 text-black">Comment ça fonctionne ?</h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Feature 1 -->
                            <div class=" p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                                <h3 class="text-2xl font-semibold mb-4 text-orange-300">Créer votre profil gratuitement</h3>
                                <p class="text-gray-600 mb-4"> Inscrivez-vous en quelques minutes, complétez les informations sur votre chien, et découvrez les dog sitters disponibles près de chez vous.</p>
                            </div>

                            <!-- Feature 2 -->
                            <div class=" p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                                <h3 class="text-2xl font-semibold mb-4 text-gray-400">Choississez votre dogsitter</h3>
                                <p class="text-gray-600 mb-4">Parcourez les profils détaillés des dog sitters, lisez les avis d’autres propriétaires, et sélectionnez celui qui correspond le mieux aux besoins de votre compagnon.</p>
                            </div>

                            <!-- Feature 3 -->
                            <div class="p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                                <h3 class="text-2xl font-semibold mb-4 text-blue-300">Reservez et partez l'esprit tranquille</h3>
                                <p class="text-gray-600 mb-4">Planifiez les dates, échangez avec le dog sitter, et suivez les mises à jour en temps réel pendant la garde, tout en bénéficiant de notre assurance et de notre assistance 24h/24.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Subscriptions Section -->
                <section>
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-semibold text-center mb-12 pt-16 text-gray-800">Nos Abonnements pour les dogsitters </h2>
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
                                    <li class="font-semibold">Annuel: <span class="font-normal">290 € par an (2 mois offerts)</span></li>
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

                {{-- dernieres actualites --}}
                <section>
                    <div class="container mx-auto">
                            <h2 class="text-3xl font-semibold text-gray-800 text-center mb-12 pt-16">Nos dernières actualités</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-6">
                                <div class="bg-white p-6 shadow-lg rounded-lg">
                                    <h3 class="text-xl font-bold text-gray-800">Nouvelle fonctionnalité pour les dogsitters !</h3>
                                    <p class="text-gray-600 mt-3">Nous avons lancé un nouvel outil pour gérer vos disponibilités de manière plus intuitive. Découvrez-le dès maintenant dans votre espace personnel.</p>
                                </div>
                                <div class="bg-white p-6 shadow-lg rounded-lg">
                                    <h3 class="text-xl font-bold text-gray-800">Offre spéciale pour les propriétaires de chiens</h3>
                                    <p class="text-gray-600 mt-3">Réservez une prestation et bénéficiez de 10% de réduction sur votre première commande. Profitez-en avant la fin du mois !</p>
                                </div>
                                <div class="bg-white p-6 shadow-lg rounded-lg">
                                    <h3 class="text-xl font-bold text-gray-800">De nouveaux dogsitters ajoutés !</h3>
                                    <p class="text-gray-600 mt-3">Nous avons élargi notre communauté de dogsitters. Découvrez des profils qualifiés près de chez vous pour garder votre chien en toute sécurité.</p>
                                </div>
                            </div>
                        </div>
                </section>

                <section>
                    <div class="container mx-auto pt-16">
                        <div class="bg-gray-100 py-12 mb-12">
                            <div class="text-center">
                                <h2 class="text-3xl font-semibold text-gray-800">Quelques chiffres sur Patte à Patte</h2>
                                <p class="text-lg text-gray-600 mt-4">Plus de 100,000 utilisateurs satisfaits et une communauté grandissante chaque jour !</p>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 text-center mt-10">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">+ 2000</h3>
                                    <p class="text-gray-600">Dogsitters</p>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">+ 50,000</h3>
                                    <p class="text-gray-600">Propriétaires</p>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">99%</h3>
                                    <p class="text-gray-600">Taux de Satisfaction</p>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">+ 300</h3>
                                    <p class="text-gray-600">Réservations chaque mois</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- avis et temoignages -->
                <section>
                    <div class="container mx-auto pb-16">
                        <div class="text-center">
                            <h2 class="text-3xl font-semibold text-gray-800">Témoignages de Nos Utilisateurs</h2>
                            <div class="flex justify-center gap-8 mt-6">
                                <div class="bg-white p-6 shadow-lg rounded-lg w-80">
                                    <p class="text-gray-600 italic">"Je suis ravi de trouver un dogsitter de confiance en quelques minutes. Mon chien adore son séjour avec Max !" - Jean, Paris</p>
                                    <div class="mt-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <span class="font-semibold text-yellow-500">⭐⭐⭐⭐⭐</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-6 shadow-lg rounded-lg w-80">
                                    <p class="text-gray-600 italic">"Un site simple et efficace. Je recommande vivement pour tous les propriétaires de chiens !" - Marie, Lyon</p>
                                    <div class="mt-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <span class="font-semibold text-yellow-500">⭐⭐⭐⭐⭐</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Inscription à la Newsletter -->
                <div class="container mx-auto">
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center mb-12">
                        <h2 class="text-3xl font-semibold text-gray-800">Recevez des mises à jour et offres exclusives !</h2>
                        <p class="text-lg text-gray-600 mt-4">Restez connecté avec DogSitting Connect pour recevoir des nouvelles importantes, des offres et des promotions.</p>
                        <form action="" method="POST" class="mt-6 flex justify-center gap-4">
                            @csrf
                            <input type="email" name="email" class="px-4 py-2 border-gray-300 rounded-lg w-80" placeholder="Votre email" required>
                            <button type="submit" class="bg-yellow-500 text-black px-6 py-3 rounded-lg hover:bg-yellow-600 transition">
                                S'abonner
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer Section -->
                <section>
                    <div class="container mx-auto">
                        <h2 class="text-4xl font-bold text-center mb-5">Nos Informations et Services</h2>

                        <div class="flex flex-wrap justify-between space-y-4 md:space-y-0">
                            <!-- Aide et support -->
                            <ul class="flex-1 p-4 text-center">
                                <h3 class="text-xl font-bold mb-4">Aide et support</h3>
                                <li><a href="#" class="hover:underline">Contact</a></li>
                                <li><a href="#" class="hover:underline">Aide / FAQ</a></li>
                                <li><a href="#" class="hover:underline">Plan du site</a></li>
                                <li><a href="#" class="hover:underline">Nous contacter</a></li>
                            </ul>

                            <!-- À propos de l'entreprise -->
                            <ul class="flex-1 p-4 text-center">
                                <h3 class="text-xl font-bold mb-4">À propos de l'entreprise</h3>
                                <li><a href="#" class="hover:underline">À propos / Qui sommes-nous ?</a></li>
                                <li><a href="#" class="hover:underline">Carrières / Recrutement</a></li>
                                <li><a href="#" class="hover:underline">Presse / Partenaires</a></li>
                                <li><a href="#" class="hover:underline">Devenir dog sitter</a></li>
                            </ul>

                            <!-- Contenu et actualités -->
                            <ul class="flex-1 p-4 text-center">
                                <h3 class="text-xl font-bold mb-4">Contenu et actualités</h3>
                                <li><a href="#" class="hover:underline">Blog / Actualités</a></li>
                                <li><a href="#" class="hover:underline">Newsletter</a></li>
                                <li><a href="#" class="hover:underline">Conseils pour les propriétaires de chiens</a></li>
                                <li><a href="#" class="hover:underline">Avis clients</a></li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Réseaux sociaux -->
                <div class="text-center p-4">
                    <h3 class="text-xl font-bold mb-4">Réseaux sociaux et communauté</h3>
                    <div class="flex justify-center space-x-2">
                        <a href="#" aria-label="Facebook"><img src="{{ asset('images/facebook_logo.png') }}" alt="Facebook" class="w-6 h-6"></a>
                        <a href="#" aria-label="Instagram"><img src="{{ asset('images/instagram_logo.jpg') }}" alt="Instagram" class="w-6 h-6"></a>
                        <a href="#" aria-label="LinkedIn"><img src="{{ asset('images/linkedIn_logo.png') }}" alt="LinkedIn" class="w-6 h-6"></a>
                    </div>
                </div>
            </div>
        </x-app-layout>
    @else
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-yellow-100 via-pink-100 to-orange-100 bg-opacity-60">
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

                    <!-- Conteneur Principal -->
                    <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8">
                        <!-- Image -->
                        <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
                            <img src="{{ asset('images/pax.jpg') }}" alt="Dog Sitting" class="w-2/3 lg:w-1/2 h-auto rounded-lg shadow-md">
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
                </div>
            </section>

            <section>
                <div class="container mx-auto">
                    <h2 class="text-3xl font-semibold text-center mb-12 pt-16 text-black">Comment ça fonctionne ?</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class=" p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                            <h3 class="text-2xl font-semibold mb-4 text-orange-300">Créer votre profil gratuitement</h3>
                            <p class="text-gray-600 mb-4"> Inscrivez-vous en quelques minutes, complétez les informations sur votre chien, et découvrez les dog sitters disponibles près de chez vous.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class=" p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                            <h3 class="text-2xl font-semibold mb-4 text-gray-400">Choississez votre dogsitter</h3>
                            <p class="text-gray-600 mb-4">Parcourez les profils détaillés des dog sitters, lisez les avis d’autres propriétaires, et sélectionnez celui qui correspond le mieux aux besoins de votre compagnon.</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="p-6 rounded-lg shadow-lg text-center backdrop-blur-md bg-white/70">
                            <h3 class="text-2xl font-semibold mb-4 text-blue-300">Reservez et partez l'esprit tranquille</h3>
                            <p class="text-gray-600 mb-4">Planifiez les dates, échangez avec le dog sitter, et suivez les mises à jour en temps réel pendant la garde, tout en bénéficiant de notre assurance et de notre assistance 24h/24.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Subscriptions Section -->
            <section>
                <div class="container mx-auto">
                    <h2 class="text-3xl font-semibold text-center mb-12 pt-16 text-gray-800">Nos Abonnements pour les dogsitters </h2>
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
                                <li class="font-semibold">Annuel: <span class="font-normal">290 € par an (2 mois offerts)</span></li>
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

            {{-- dernieres actualites --}}
            <section>
                <div class="container mx-auto">
                        <h2 class="text-3xl font-semibold text-gray-800 text-center mb-12 pt-16">Nos dernières actualités</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-6">
                            <div class="bg-white p-6 shadow-lg rounded-lg">
                                <h3 class="text-xl font-bold text-gray-800">Nouvelle fonctionnalité pour les dogsitters !</h3>
                                <p class="text-gray-600 mt-3">Nous avons lancé un nouvel outil pour gérer vos disponibilités de manière plus intuitive. Découvrez-le dès maintenant dans votre espace personnel.</p>
                            </div>
                            <div class="bg-white p-6 shadow-lg rounded-lg">
                                <h3 class="text-xl font-bold text-gray-800">Offre spéciale pour les propriétaires de chiens</h3>
                                <p class="text-gray-600 mt-3">Réservez une prestation et bénéficiez de 10% de réduction sur votre première commande. Profitez-en avant la fin du mois !</p>
                            </div>
                            <div class="bg-white p-6 shadow-lg rounded-lg">
                                <h3 class="text-xl font-bold text-gray-800">De nouveaux dogsitters ajoutés !</h3>
                                <p class="text-gray-600 mt-3">Nous avons élargi notre communauté de dogsitters. Découvrez des profils qualifiés près de chez vous pour garder votre chien en toute sécurité.</p>
                            </div>
                        </div>
                    </div>
            </section>

            <section>
                <div class="container mx-auto pt-16">
                    <div class="bg-gray-100 py-12 mb-12">
                        <div class="text-center">
                            <h2 class="text-3xl font-semibold text-gray-800">Quelques chiffres sur Patte à Patte</h2>
                            <p class="text-lg text-gray-600 mt-4">Plus de 100,000 utilisateurs satisfaits et une communauté grandissante chaque jour !</p>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 text-center mt-10">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">+ 2000</h3>
                                <p class="text-gray-600">Dogsitters</p>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">+ 50,000</h3>
                                <p class="text-gray-600">Propriétaires</p>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">99%</h3>
                                <p class="text-gray-600">Taux de Satisfaction</p>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">+ 300</h3>
                                <p class="text-gray-600">Réservations chaque mois</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- avis et temoignages -->
            <section>
                <div class="container mx-auto pb-16">
                    <div class="text-center">
                        <h2 class="text-3xl font-semibold text-gray-800">Témoignages de Nos Utilisateurs</h2>
                        <div class="flex justify-center gap-8 mt-6">
                            <div class="bg-white p-6 shadow-lg rounded-lg w-80">
                                <p class="text-gray-600 italic">"Je suis ravi de trouver un dogsitter de confiance en quelques minutes. Mon chien adore son séjour avec Max !" - Jean, Paris</p>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="font-semibold text-yellow-500">⭐⭐⭐⭐⭐</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-6 shadow-lg rounded-lg w-80">
                                <p class="text-gray-600 italic">"Un site simple et efficace. Je recommande vivement pour tous les propriétaires de chiens !" - Marie, Lyon</p>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="font-semibold text-yellow-500">⭐⭐⭐⭐⭐</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Inscription à la Newsletter -->
            <div class="container mx-auto">
                <div class="bg-white p-8 rounded-lg shadow-lg text-center mb-12">
                    <h2 class="text-3xl font-semibold text-gray-800">Recevez des mises à jour et offres exclusives !</h2>
                    <p class="text-lg text-gray-600 mt-4">Restez connecté avec DogSitting Connect pour recevoir des nouvelles importantes, des offres et des promotions.</p>
                    <form action="" method="POST" class="mt-6 flex justify-center gap-4">
                        @csrf
                        <input type="email" name="email" class="px-4 py-2 border-gray-300 rounded-lg w-80" placeholder="Votre email" required>
                        <button type="submit" class="bg-yellow-500 text-black px-6 py-3 rounded-lg hover:bg-yellow-600 transition">
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Section -->
            <section>
                <div class="container mx-auto">
                    <h2 class="text-4xl font-bold text-center mb-5">Nos Informations et Services</h2>

                    <div class="flex flex-wrap justify-between space-y-4 md:space-y-0">
                        <!-- Aide et support -->
                        <ul class="flex-1 p-4 text-center">
                            <h3 class="text-xl font-bold mb-4">Aide et support</h3>
                            <li><a href="#" class="hover:underline">Aide / FAQ</a></li>
                            <li><a href="#" class="hover:underline">Plan du site</a></li>
                            <li><a href="#" class="hover:underline">Nous contacter</a></li>
                        </ul>

                        <!-- À propos de l'entreprise -->
                        <ul class="flex-1 p-4 text-center">
                            <h3 class="text-xl font-bold mb-4">À propos de l'entreprise</h3>
                            <li><a href="#" class="hover:underline">Carrières / Recrutement</a></li>
                            <li><a href="#" class="hover:underline">Presse / Partenaires</a></li>
                            <li><a href="#" class="hover:underline">Avis clients / Actualités</a></li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Réseaux sociaux -->
            <div class="text-center p-4">
                <h3 class="text-xl font-bold mb-4">Réseaux sociaux et communauté</h3>
                <div class="flex justify-center space-x-2">
                    <svg viewBox="0 0 24 24" fill="none" weight="24" height="24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M20 1C21.6569 1 23 2.34315 23 4V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H20ZM20 3C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H15V13.9999H17.0762C17.5066 13.9999 17.8887 13.7245 18.0249 13.3161L18.4679 11.9871C18.6298 11.5014 18.2683 10.9999 17.7564 10.9999H15V8.99992C15 8.49992 15.5 7.99992 16 7.99992H18C18.5523 7.99992 19 7.5522 19 6.99992V6.31393C19 5.99091 18.7937 5.7013 18.4813 5.61887C17.1705 5.27295 16 5.27295 16 5.27295C13.5 5.27295 12 6.99992 12 8.49992V10.9999H10C9.44772 10.9999 9 11.4476 9 11.9999V12.9999C9 13.5522 9.44771 13.9999 10 13.9999H12V21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3H20Z" fill="#4a5bb0"></path> </g></svg>

                  <svg viewBox="0 0 24 24" fill="none" weight="24" height="24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6C2 3.79086 3.79086 2 6 2H18C20.2091 2 22 3.79086 22 6V18C22 20.2091 20.2091 22 18 22H6C3.79086 22 2 20.2091 2 18V6ZM6 4C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V6C20 4.89543 19.1046 4 18 4H6ZM12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9ZM7 12C7 9.23858 9.23858 7 12 7C14.7614 7 17 9.23858 17 12C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12ZM17.5 8C18.3284 8 19 7.32843 19 6.5C19 5.67157 18.3284 5 17.5 5C16.6716 5 16 5.67157 16 6.5C16 7.32843 16.6716 8 17.5 8Z" fill="#9f56a4"></path> </g></svg>

                  <svg viewBox="0 0 24 24" fill="none" weight="24" height="24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.5 8C7.32843 8 8 7.32843 8 6.5C8 5.67157 7.32843 5 6.5 5C5.67157 5 5 5.67157 5 6.5C5 7.32843 5.67157 8 6.5 8Z" fill="#146e94"></path> <path d="M5 10C5 9.44772 5.44772 9 6 9H7C7.55228 9 8 9.44771 8 10V18C8 18.5523 7.55228 19 7 19H6C5.44772 19 5 18.5523 5 18V10Z" fill="#146e94"></path> <path d="M11 19H12C12.5523 19 13 18.5523 13 18V13.5C13 12 16 11 16 13V18.0004C16 18.5527 16.4477 19 17 19H18C18.5523 19 19 18.5523 19 18V12C19 10 17.5 9 15.5 9C13.5 9 13 10.5 13 10.5V10C13 9.44771 12.5523 9 12 9H11C10.4477 9 10 9.44772 10 10V18C10 18.5523 10.4477 19 11 19Z" fill="#146e94"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M20 1C21.6569 1 23 2.34315 23 4V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H20ZM20 3C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3H20Z" fill="#146e94"></path> </g></svg>
                </div>
            </div>
        </div>
    @endauth
@endsection
