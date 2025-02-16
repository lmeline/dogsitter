 @extends('layouts.partials.default-layout')

 @section('content')
 <x-app-layout>
     <div class="container mx-auto px-4 py-8">
 
         <!--  Hero Section -->
         <div class="text-center mb-12">
             <h1 class="text-5xl font-extrabold text-gray-800">Bienvenue sur Patte à Patte 🐕</h1>
             <p class="text-lg text-gray-600 mt-4">Découvrez nos services exclusifs, les avis de nos utilisateurs et comment tirer le meilleur parti de votre expérience !</p>
         </div>
 
         <!--  Avantages -->
         <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-12">
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
 
         <!--  Dernières Actualités -->
         <div class="text-center mb-12">
             <h2 class="text-3xl font-semibold text-gray-800">Nos dernières actualités</h2>
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
 
         <!--  Témoignages et Avis -->
         <div class="text-center mb-12">
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
 
         <!-- Statistiques sur DogSitting Connect -->
         <div class="bg-gray-100 py-12 mb-12">
             <div class="text-center">
                 <h2 class="text-3xl font-semibold text-gray-800">Quelques chiffres sur DogSitting Connect</h2>
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
 
         <!-- Inscription à la Newsletter -->
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
 
         <!-- Call-to-Action pour Accéder aux Services -->
         <div class="text-center mb-16">
             <h2 class="text-3xl font-semibold text-gray-800">Accédez dès maintenant à vos services et gérez vos disponibilités !</h2>
             <p class="text-lg text-gray-600 mt-4">Connectez-vous à votre espace pour modifier vos informations, mettre à jour vos disponibilités et consulter les demandes de réservation.</p>
             <a href="{{ route('profile') }}" class="mt-5 inline-block bg-gradient-to-r from-yellow-400 to-pink-400 text-black px-8 py-4 rounded-lg font-semibold hover:opacity-90 transition">
                 Accéder à mon espace
             </a>
         </div>
 
     </div>
 </x-app-layout>
 @endsection
 