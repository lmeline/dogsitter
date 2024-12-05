<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen">

    <!-- Bandeau utilisateur connecté -->
    @auth
    <div class="bg-blue-700 text-white py-3 shadow-md">
        <div class="container mx-auto flex items-center justify-between">
            <div>
                Bonjour, {{ Auth::user()->name }} !
            </div>
      
        </div>
    </div>
    @endauth

    <!-- Header -->
    <header class="text-black sticky top-0 z-50 shadow-md bg-slate-600 bg-opacity-80">
        <nav class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <div class="text-2xl font-bold">
                <a href="{{ route('index') }}" class="text-white hover:text-green transition duration-300">
                    Patte à patte
                </a>
            </div>

            <!-- Search Bar -->


            <!-- Action Buttons pour les non-connectés -->
            @guest
            <div class="flex gap-4">
                <a href="{{ route('register') }}?proprietaire=true" class="bg-gray hover:bg-green text-white py-2 px-4 rounded-lg transition duration-300">
                    S'inscrire
                </a>
                <a href="{{ route('login') }}" class="bg-gray hover:bg-green text-white py-2 px-4 rounded-lg transition duration-300">
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
    <footer class="bg-black text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 MyWebsite. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>
