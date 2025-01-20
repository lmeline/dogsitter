<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="flex flex-col text-gray-800 min-h-screen bg-gradient-to-br from-green-100 via-blue-100 to-yellow-100">

    <!-- header -->
    <header class="text-black sticky top-0 z-50 backdrop-blur-md bg-white/70">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

        <nav class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <div class="text-2xl font-semibold">
                <a href="{{ route('index') }}" class="text-gray-800 hover:text-green-600 transition duration-300">
                    Patte à patte
                </a>
            </div>

            <!-- Bandeau utilisateur connecté -->
            @auth
            <div class="font-semibold text-gray-800 py-3">
                <div class="container mx-auto flex items-center justify-between">
                    <div>
                        <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-green-600 transition duration-300 ">Bonjour, {{ Auth::user()->name }} !</a>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Action Buttons pour les non-connectés -->
            @guest
            <div class="flex gap-4">
                <a href="{{ route('register') }}?proprietaire=true" class="font-semibold text-black bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 py-2 px-4 rounded-lg transition duration-300 hover:bg-gradient-to-r hover:from-green-300 hover:via-yellow-300 hover:to-blue-300">
                    S'inscrire
                </a>
                <a href="{{ route('login') }}" class="font-semibold text-black bg-gradient-to-r from-yellow-300 to-pink-300  px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 py-2 px-4 rounded-lg transition duration-300 hover:bg-gradient-to-r hover:from-blue-300 hover:via-yellow-300 hover:to-green-300">
                    Se connecter
                </a>
            </div>
            @endguest
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pb-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-200 via-green-200 to-yellow-200 text-gray-800 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Patte à patte. Tous droits réservés.</p>
            <p><a href="/politique-de-confidentialite" class="text-yellow-500">Politique de confidentialité</a> | <a href="/conditions-utilisation" class="text-yellow-500">Conditions générales d'utilisation</a></p>
        </div>
    </footer>
    

</body>
</html>
