<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\PrestationTypesController;
use App\Http\Controllers\ProfilDogsitterController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;

// Requêtes pour la page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/avis/create', [AvisController::class, 'create'])->name('avis.create');
Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');

route::get('/conditions-utilisation', function () {
    return view('footer.cgu');
})->name('cgu');

route::get('/politique-de-confidentialite', function () {
    return view('footer.politique-confidentialite');
})->name('cgu');

// Requêtes pour la page profil
Route::get('/pageprofil', function () {
    return view('profile');
})->middleware(['auth', 'verified'])->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/error', function () {
    return view('erreurs.unauthorized');
})->name('errorPage');

Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    Route::get('/messages/create/{dogsitterId}', [MessageController::class, 'createDogsitter'])->name('messages.createDogsitter');
    Route::get('/messages/create/{proprietaireId}', [MessageController::class, 'createProprietaire'])->name('messages.createProprietaire');
    Route::get('/profile/{dogsitterId}/message', [MessageController::class, 'showProfile'])->name('messages.create');

    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/add', [MessageController::class, 'addMessage'])->name('addMessage');

    Route::get('/disponibilites', [DisponibiliteController::class, 'index'])->name('disponibilites.index');
    Route::post('/disponibilites', [DisponibiliteController::class, 'store'])->name('disponibilites.store');
    Route::put('/disponibilites/{id}', [DisponibiliteController::class, 'update'])->name('disponibilites.update');
    Route::get('/disponibilites/{id}/edit', [DisponibiliteController::class, 'edit'])->name('disponibilites.edit');

        // Requêtes pour les chiens 
    Route::get('/register/dog', [DogController::class, 'registerdog'])->name('register.dog');
    Route::post('/register/dog', [DogController::class, 'storeregisterdog'])->name('storeregisterdog');
    Route::get('profil/ajoutchien', [DogController::class, 'create'])->name('dogs.create');
    Route::get('/dogs', [DogController::class, 'index'])->name('dogs.index');
    Route::get('/dogs/{id}', [DogController::class, 'show'])->name('dogs.show');
    Route::put('/dogs/{dog}', [DogController::class, 'update'])->name('dogs.update');
    Route::get('/dogs/{dog}/edit', [DogController::class, 'edit'])->name('dogs.edit');
    Route::delete('/dogs/{id}/delete', [DogController::class, 'destroy'])->name('dogs.destroy');
    Route::delete('/dogs/{dog}/delete/photo', [DogController::class, 'deletephoto'])->name('dogs.delete');    

    Route::get('/trouvezsondogsitter', function () {
        return view('dogsitters.index');
    })->middleware(['auth', 'verified'])->name('dogsitters.index');

    // Requêtes pour les dogsitters
    route::get('/dogsitters', [ProfilDogsitterController::class, 'index'])->name('dogsitters.index');
    route::get('/dogsitters/{id}', [ProfilDogsitterController::class, 'show'])->name('dogsitters.show');
    Route::get('/dogsitter/postersonannonce', [ProfilDogsitterController::class, 'annonce'])->name('dogsitters.annonce');
    Route::get('/dogsitter/calendar', [ProfilDogsitterController::class, 'showCalendar'])->name('dogsitters.calendar');

    Route::get('/abonnement', [AbonnementController::class, 'show'])->name('abonnements.update');
    Route::post('/abonnement', [AbonnementController::class, 'updateAbonnement'])->name('abonnements.update');

    Route::get('/choisir-abonnement', [AbonnementController::class, 'registerabonnement'])->name('register.abonnement');
    Route::post('/choisir-abonnement', [AbonnementController::class, 'chooseAbonnement'])->name('chooseAbonnement');

    Route::post('/user-prestation', [PrestationTypesController::class, 'store'])->name('userPrestations.store');
    Route::put('/user-prestation/{id}', [PrestationTypesController::class, 'update'])->name('userPrestations.update');
    Route::get('/user-prestation/{id}/edit', [PrestationTypesController::class, 'edit'])->name('userPrestations.edit');
    Route::delete('user-prestation/{id}/delete', [PrestationTypesController::class, 'destroy'])->name('userPrestations.destroy');

    // Requêtes pour les proprietaires
    route::get('/proprietaires', [ProprietaireController::class, 'index'])->name('proprietaires.index');
    //route::get('/proprietaires/{id}', [ProprietaireController::class, 'show'])->name('proprietaires.show');
    route::post('/update-description', [ProprietaireController::class, 'updateDescription'])->name('update.description');
    route::get('/proprietaires/mesprestations', [PrestationController::class, 'showPrestations'])->name('proprietaires.mesprestations');


    // Requêtes pour les prestations
    Route::get('/prestations/create/{id}', [PrestationController::class, 'create'])->name('prestations.create');
    Route::post('/prestations', [PrestationController::class, 'store'])->name('prestations.store');
    Route::get('/prestations/{id}', [PrestationController::class, 'show'])->name('prestations.show');
    Route::delete('/prestations/{id}', [PrestationController::class, 'destroy'])->name('prestations.destroy');


});


// Requêtes ajax 
Route::get('/prestations/calendar/getprestations', [PrestationController::class, 'getprestations']);
Route::get('/search-dogsitters', [ProfilDogsitterController::class, 'search'])->name('search.dogsitters');
Route::get('/search-villes', [ProfileController::class, 'searchVille'])->name('search.ville');
Route::post('/save-ville', [ProfileController::class, 'saveVille'])->name('save.ville');
Route::get('/search-owner', [MessageController::class, 'searchOwner'])->name('search.owner');
Route::get('/search-dogsitter', [MessageController::class, 'searchDogsitter'])->name('search.dogsitter');
Route::get('/messages/search', [MessageController::class, 'search'])->name('messages.search');
Route::delete('/disponibilites/{id}/delete', [DisponibiliteController::class, 'destroy'])->name('disponibilites.destroy');


