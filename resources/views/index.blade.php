

    @extends('layouts.partials.defaultLayout')
    @section('title', 'Bienvenue sur Patte à patte')
    @section('content')
    
    

    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20 bg-gray-100 text-gray-800">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">Bienvenue sur Patte à patte</h1>
            <p class="text-xl mb-8">Le Dog Sitting de Confiance pour Votre Compagnon à Quatre Pattes <br>
                Votre chien mérite les meilleurs soins, même en votre absence.</p>
            <a href="#" class="bg-white text-blue-600 py-3 px-6 rounded-lg font-semibold hover:bg-gray-200 transition duration-300">En savoir plus</a>
        </div>
    </section>
    <div class="flex space-x-4 mt-4">
        <a href="{{ route('register') }}?proprietaire=true" 
           class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300">
           Proprietaire
        </a>
        <a href="{{ route('register') }}?proprietaire=false" 
           class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75 transition duration-300">
           Dogsitter
        </a>
    </div>
    
    <!-- Features Section -->
    <section class="py-16">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12">Comment ça fonctionne ? </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Créer votre profil gratuitement </h3>
                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In in felis vitae metus laoreet tincidunt.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:underline">En savoir plus</a>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Choississez votre dogsitter</h3>
                    <p class="text-gray-600 mb-4">Sed auctor augue nec urna hendrerit, vel tincidunt arcu luctus. Donec eget ultricies orci.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:underline">En savoir plus</a>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold mb-4">Reservez et partez l'esprit tranquille </h3>
                    <p class="text-gray-600 mb-4">Nullam tincidunt, purus id lacinia tincidunt, nisi quam scelerisque justo, sit amet malesuada enim nisl in elit.</p>
                    <a href="#" class="text-blue-600 font-semibold hover:underline">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

@endsection
