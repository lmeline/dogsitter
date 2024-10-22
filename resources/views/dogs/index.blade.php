{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dogs</title>
</head>
<body>
    @foreach ( $dogs as $dog )

        <a href="{{ route('dogs.show', $dog->id) }}">{{ $dog->nom }} </a>

        <p>{{ $dog->race }}</p>

        <p>{{ $dog->age }}</p>
        
    @endforeach
</body>
</html> 
 --}}

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Dogs</title>
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 </head>
 <body class="bg-blue-100 text-gray-800">
     <div class="container mx-auto py-10">
         <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Liste des Chiens</h1>
 
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
             @foreach ( $dogs as $dog )
             <!-- Lien autour de tout le bloc pour le rendre cliquable -->
             <a href="{{ route('dogs.show', $dog->id) }}" class="block bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-blue-50">
                 <h2 class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                     {{ $dog->nom }}
                 </h2>
 
                 <p class="text-gray-600 mt-2">Race: {{ $dog->race }}</p>
                 <p class="text-gray-600">Âge: {{ $dog->age }} ans</p>
             </a>
             @endforeach
         </div>
     </div>
 </body>
 </html>
 