{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profil chien</title>
</head>
<body>
    {{$dog->user->name}}
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil du Chien</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-100 text-gray-800">
    <div class="container mx-auto py-10">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-blue-600 mb-4">Propriétaire du Chien</h1>
                
                <!-- Nom de l'utilisateur/propriétaire -->
                <p class="text-lg font-semibold text-gray-700 mb-2">
                    Propriétaire : {{ $dog->user->name }}
                </p>

                <!-- Informations supplémentaires sur le propriétaire (ajout optionnel) -->
                <p class="text-gray-600 mb-4">Email : {{ $dog->user->email }}</p>
                <p class="text-gray-600 mb-4">Ville : {{ $dog->user->ville }}</p>

                <!-- Informations sur le chien -->
                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-blue-500">Informations sur le Chien</h2>
                    <p class="text-gray-600 mt-2">Nom : {{ $dog->nom }}</p>
                    <p class="text-gray-600 mt-2">Race : {{ $dog->race }}</p>
                    <p class="text-gray-600 mt-2">Âge : {{ $dog->age }} ans</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
