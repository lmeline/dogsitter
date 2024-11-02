<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dogsitter - Patte à patte')</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header spécifique pour les dogsitters -->
    <header class="bg-blue-700 text-white py-4 shadow-lg">
        <nav class="container mx-auto flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold">Patte à patte</a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('dogsitter.index') }}" class="hover:underline">Mon Profil</a>
                <a href="{{ route('dogsitter.show') }}" class="hover:underline">Mon Calendrier</a>
                <a href="{{ route('register.dog') }}" class="hover:underline">Mes Rendez-vous</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Déconnexion</button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Contenu principal -->
    <main class="flex-grow container mx-auto py-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Patte à patte. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
