<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patte à patte</title>
</head>
<body>
    <!-- Barre de navigation -->
    @include('layouts.partials.dogsitter-layout') <!-- Section pour la barre -->

    <!-- Contenu principal -->
    <main>
        @incl('content')
    </main>

    <!-- Pied de page -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Patte à patte. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
