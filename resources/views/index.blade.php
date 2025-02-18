@extends('layouts.partials.default-layout')
@section('title', 'Bienvenue sur Patte à Patte')
@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-pink-100 via-yellow-100 to-orange-100 text-black py-20 text-gris backdrop-blur-md bg-white/70">
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
            
            <!-- Contenu Formulaire -->
            <div class="w-full lg:w-2/3 text-black rounded-lg">
                <!-- Rejoignez notre communauté -->
                <div class="p-6 backdrop-blur-md bg-white/70 shadow-md p-8 rounded-md mt-12">
                    <h2 class="text-3xl font-bold text-black mb-4 text-center">Rejoignez notre communauté</h2>
                    <p class="text-lg text-black mb-6">
                        Que vous soyez un propriétaire cherchant les meilleurs soins pour votre animal
                        ou un dogsitter passionné prêt à offrir vos services, inscrivez-vous dès aujourd'hui !
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('register') }}?proprietaire=true"
                            class="px-6 py-3 bg-orange-300 text-white text-lg font-bold rounded-lg shadow-lg hover:bg-red-200 focus:outline-none focus:ring-4 focus:ring-red-100 focus:ring-opacity-75 transition duration-300">
                            Je suis propriétaire
                        </a>
                        <a href="{{ route('register') }}?proprietaire=false"
                            class="px-6 py-3 bg-blue-300 text-white text-lg font-bold rounded-lg shadow-lg hover:bg-green-400 focus:outline-none focus:ring-4 focus:ring-green-100 focus:ring-opacity-75 transition duration-300">
                            Je suis dogsitter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gradient-to-r from-yellow-100 via-pink-100 to-orange-100 bg-opacity-60">
    <div class="container mx-auto">
        <h4 class="text-center mb-12 text-3xl text-gray-800">
            Chez <strong>Patte à patte</strong>, nous savons qu’il est difficile de laisser votre chien. C’est pourquoi nous proposons un dog-sitting personnalisé et sécurisé, pour que vous partiez sereinement, votre compagnon bien pris en charge !
        </h4>

        <!-- Propriétaire -->
        <div class="p-6 rounded-lg shadow-lg text-center w-full mb-8 backdrop-blur-md bg-white/70">
            <h3 class="text-2xl font-semibold mb-4 text-orange-300">Propriétaire</h3>
            <p class="text-gray-600">
                Parce que le bien-être de votre chien est notre priorité, confiez-le à un dog sitter attentionné qui veille à ses besoins, à son confort, et à son équilibre émotionnel.
                Qu'il s'agisse de promenades stimulantes, de jeux ou de moments de calme, votre compagnon bénéficiera d’un environnement sécurisé et bienveillant, comme s’il était chez vous.
            </p>
        </div>

        <!-- Dogsitter -->
        <div class="p-6 rounded-lg shadow-lg text-center w-full backdrop-blur-md bg-white/70">
            <h3 class="text-2xl font-semibold mb-4 text-blue-300">Dogsitter</h3>
            <p class="text-gray-600 mb-4">
                Vous adorez les chiens et souhaitez un métier qui vous passionne ? Devenez dog sitter et profitez d’une activité flexible et enrichissante.
                Offrez des soins, de l'attention et des moments de joie aux chiens tout en gagnant la confiance de leurs propriétaires.
                Faites de votre amour pour les animaux un véritable atout au quotidien !
            </p>
        </div>
    </div>
</section>

<!-- How it works Section -->
<section class="py-16 bg-gradient-to-r from-pink-100 via-yellow-100 to-orange-100">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center mb-12 text-black">Comment ça fonctionne ?</h2>

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
<section class="py-16 bg-gradient-to-r from-orange-100 via-pink-100 to-yellow-100">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Nos Abonnements pour les dogsitters </h2>
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

<!-- Footer Section -->
<section class="py-5 bg-gradient-to-r from-pink-100 via-orange-100 to-yellow-100 text-black">
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

        <!-- Réseaux sociaux -->
        <div class="text-center mt-4">
            <h3 class="text-xl font-bold mb-4">Réseaux sociaux et communauté</h3>
            <div class="flex justify-center space-x-2">
                <a href="#" aria-label="Facebook"><img src="{{ asset('images/facebook_logo.png') }}" alt="Facebook" class="w-6 h-6"></a>
                <a href="#" aria-label="Instagram"><img src="{{ asset('images/instagram_logo.jpg') }}" alt="Instagram" class="w-6 h-6"></a>
                <a href="#" aria-label="LinkedIn"><img src="{{ asset('images/linkedIn_logo.png') }}" alt="LinkedIn" class="w-6 h-6"></a>
            </div>
        </div>
    </div>
</section>


@endsection
