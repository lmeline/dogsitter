@extends('layouts.partials.default-layout')
@section('title', 'Bienvenue sur Patte à Patte')
@section('content')
    @auth
        <x-app-layout>
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
    @endauth
@endsection
