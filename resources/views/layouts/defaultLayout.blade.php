<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="relative min-h-[100vh]">
    <header class=" text-white sticky top-0 z-50 shadow-md bg-slate-600 bg-opacity-80" >
        <nav class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <div class="text-2xl font-bold">
                <a href="#" class="text-white hover:text-gray-300 transition duration-300">
                    Patte à patte
                </a>
            </div>
    
            <!-- Menu Items -->
            <input type="text" class="rounded-md w-96" placeholder="Rechercher...">
    
            <!-- Call to Action button (optional) -->
            <div class="flex gap-4">
                <a href="{{ route('register') }}" class="bg-gray-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition duration-300">
                    S'inscrire
                </a>
                <a href="{{ route('login') }}" class="bg-gray-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition duration-300">
                    Se connecter
                </a>
            </div>
        </nav>
    </header>
    
    <main class="pb-48">
        @yield('content')
    </main >
    <footer class="bg-gray-900 text-white py-6 absolute w-full bottom-0">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 MyWebsite. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>