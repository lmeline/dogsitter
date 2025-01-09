
@extends('layouts.partials.default-layout')
@section('content')
<x-app-layout>
    <!-- Hero Section (Bannière Principale) -->
    <section class="bg-cover bg-center relative" style="background-image: url('images/banner.jpg'); height: 500px;">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center text-white pt-32">
            <h1 class="text-4xl font-bold mb-4">Bienvenue sur Dogsitter</h1>
            <p class="text-lg mb-6">Profitez de notre plateforme pour trouver des dogsitters qualifiés ou devenir un dogsitter !</p>
        </div>
    </section>

    <!-- Promotions Abonnement -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-6">Offres Spéciales et Promotions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-semibold">Abonnement Premium</h3>
                    <p class="mt-2">Accédez à des fonctionnalités exclusives avec l'abonnement Premium !</p>
                    <span class="block text-xl font-bold text-yellow-500">Seulement 9,99€/mois</span>
                    <a href="/" class="text-yellow-500 mt-3 block">Souscrire maintenant</a>
                </div>

                <div class="p-6 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-semibold">Réduction pour les nouveaux Dogsitters</h3>
                    <p class="mt-2">Devenez dogsitter et bénéficiez d'une réduction de 20% sur votre abonnement Premium !</p>
                    <span class="block text-xl font-bold text-yellow-500">Réduction de 20%</span>
                    <a href="/" class="text-yellow-500 mt-3 block">S'inscrire en tant que Dogsitter</a>
                </div>

                <div class="p-6 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-semibold">Pack Annuel</h3>
                    <p class="mt-2">Économisez 15% en souscrivant à un abonnement annuel et profitez des avantages toute l'année !</p>
                    <span class="block text-xl font-bold text-yellow-500">Abonnement Annuel : 99,99€</span>
                    <a href="/" class="text-yellow-500 mt-3 block">Souscrire maintenant</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Actualités du Site -->
    <section class="py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-6">Actualités et Nouveautés</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold">Nouvelle Fonctionnalité : Messagerie Instantanée</h3>
                    <p class="mt-2">Communiquez instantanément avec les dogsitters grâce à notre nouvelle fonctionnalité de messagerie !</p>
                    <a href="/" class="text-yellow-500 mt-3 block">En savoir plus</a>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold">Extension du Service à [Nom de la Ville]</h3>
                    <p class="mt-2">Nous avons étendu nos services à [Nom de la Ville]. Trouvez un dogsitter près de chez vous !</p>
                    <a href="/" class="text-yellow-500 mt-3 block">Voir les détails</a>
                </div>

                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold">Mise à Jour : Amélioration du Profil Dogsitter</h3>
                    <p class="mt-2">Nous avons amélioré les profils des dogsitters pour plus de transparence et de confiance.</p>
                    <a href="/" class="text-yellow-500 mt-3 block">Voir les modifications</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-6">Témoignages de nos utilisateurs</h2>
            <div class="flex justify-center space-x-8">
                <div class="max-w-xs bg-white p-6 shadow-lg rounded-lg">
                    <img src="images/testimonial1.jpg" alt="Photo de Témoignage 1" class="w-16 h-16 rounded-full mx-auto">
                    <p class="mt-4 text-gray-700">"Un service exceptionnel ! Mon chien a été bien pris en charge. Je recommande vivement."</p>
                    <span class="text-yellow-500">⭐⭐⭐⭐⭐</span>
                    <p class="mt-2">- Alice, Propriétaire</p>
                </div>

                <div class="max-w-xs bg-white p-6 shadow-lg rounded-lg">
                    <img src="images/testimonial2.jpg" alt="Photo de Témoignage 2" class="w-16 h-16 rounded-full mx-auto">
                    <p class="mt-4 text-gray-700">"Devenir dogsitter m'a permis de gagner de l'argent tout en faisant ce que j'aime. Très satisfaite !" </p>
                    <span class="text-yellow-500">⭐⭐⭐⭐⭐</span>
                    <p class="mt-2">- Julien, Dogsitter</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
@endsection


