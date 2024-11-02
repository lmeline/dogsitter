<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Propriétaire - Patte à patte')</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header spécifique pour les propriétaires -->
    <header class="bg-teal-600 text-white py-4 shadow-lg">
        <nav class="container mx-auto flex items-center justify-between">
            <a href="{{ route('dogs.index') }}" class="text-2xl font-bold">Patte à patte</a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('dogsitters.index') }}" class="hover:underline">Trouver un Dogsitter</a>
                <a href="{{ route('dogsitters.index') }}" class="hover:underline">Mes Rendez-vous</a>
                <a href="{{ route('dogsitters.index') }}" class="hover:underline">Mon Profil</a>
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
