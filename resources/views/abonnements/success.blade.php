<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen ">
        <div class="bg-white shadow-lg rounded-2xl p-8 max-w-md text-center">
            <h1 class="text-2xl font-bold text-green-600 mb-4">Merci pour votre abonnement !</h1>
            <p class="text-gray-700 text-lg">Votre souscription a été enregistrée avec succès.</p>
        </div>
        <a href="{{ route('index') }}" class="mt-4 text-xl font-bold text-black hover:underline">Retourner à l'accueil</a>
    </div>
</x-app-layout>