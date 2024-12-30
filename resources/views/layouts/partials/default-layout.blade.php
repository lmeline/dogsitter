<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class=" flex flex-col text-black min-h-screen">

    <!-- header -->
    <header class="text-black sticky top-0 z-50 shadow-md bg-gray">
        <nav class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <div class="text-2xl font-bold">
                <a href="{{ route('index') }}" class="text-black hover:text-green transition duration-300">
                    Patte à patte
                </a>
            </div>

    <!-- Bandeau utilisateur connecté -->
            @auth
            <div class=" font-bold text-black py-3 ">
                <div class="container mx-auto flex items-center justify-between">
                    <div>
                       <a href="{{ route('dashboard') }}">Bonjour, {{ Auth::user()->name }} !</a> 
                    </div>
              
                </div>
            </div>
            @endauth

    <!-- Action Buttons pour les non-connectés -->
            @guest
            <div class="flex gap-4">
                <a href="{{ route('register') }}?proprietaire=true" class="bg-gray hover:bg-green text-black py-2 px-4 rounded-lg transition duration-300">
                    S'inscrire
                </a>
                <a href="{{ route('login') }}" class="bg-gray hover:bg-green text-black py-2 px-4 rounded-lg transition duration-300">
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
            <p>&copy; 2024 Patte à patte. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>
