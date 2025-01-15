<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\ProfilDogsitterController;
use App\Http\Controllers\ProprietaireController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


route::get('/myprestations',[PrestationController::class,'showPrestations'])->name('myprestations');

Route::get('/dogsitter/accueil', function () {
    return view('dogsitters.PageAccueilDogsitter');
})->middleware(['auth', 'verified'])->name('dogsitters.PageAccueilDogsitter');

Route::get('/proprietaire/accueil', function () {
    return view('proprietaires.PageAccueilProprietaire');
})->middleware(['auth', 'verified'])->name('proprietaires.PageAccueilProprietaire');

Route::get('/proprietaire/message', function () {
    return view('proprietaires.message');
})->middleware(['auth', 'verified'])->name('proprietaires.message');

Route::get('/trouvezsondogsitter', function () {
    return view('dogsitters.index');
})->middleware(['auth', 'verified'])->name('dogsitters.index');

Route::get('/pageprofil', function () {
    return view('profile');
})->middleware(['auth', 'verified'])->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/dogs',[DogController::class,'index'])->name('dogs.index');
Route::get('/dogs/{id}',[DogController::class,'show'])->name('dogs.show');

route::get('/dogsitters',[ProfilDogsitterController::class,'index'])->name('dogsitters.index');
route::get('/dogsitters/{id}',[ProfilDogsitterController::class,'show'])->name('dogsitters.show');
Route::get('/dogsitters/filtrer', [ProfilDogsitterController::class, 'filter'])->name('dogsitters.filter');

route::get('/proprietaires',[ProprietaireController::class,'index'])->name('proprietaires.index');
route::get('/proprietaires/{id}',[ProprietaireController::class,'show'])->name('proprietaires.show');



route::get('/', function (){
    return view('index');
})->name('index');

Route::get('/prestations/create/{id}',[PrestationController::class,'create'])->name('prestations.create');
Route::get('/prestations',[PrestationController::class,'index'])->name('prestations.index');
Route::post('/prestations/store', [PrestationController::class, 'store'])->name('prestations.store');
Route::get('/prestations/{id}', [PrestationController::class, 'show'])->name('prestations.show');


Route::get('profile/ajoutchien',[DogController::class,'create'])->name('dogs.create');

Route::get('/register/dog',[DogController::class,'registerdog'])->name('register.dog');
Route::post('/register/dog', [DogController::class, 'storeregisterdog'])->name('storeregisterdog');

Route::get('/choisir-abonnement', [AbonnementController::class, 'registerabonnement'])->name('register.abonnement');
Route::post('/choisir-abonnement', [AbonnementController::class, 'chooseAbonnement'])->name('abonnements.choose');

Route::get('/error', function() {
    return view('erreurs.unauthorized'); // Créez une vue simple d'erreur personnalisée
})->name('errorPage');

use App\Http\Controllers\MessageController;

Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create/{dogsitterId}', [MessageController::class, 'createOrRedirectToThread'])->name('messages.create');
    Route::get('/profile/{dogsitterId}/message', [MessageController::class, 'showProfile'])->name('messages.create');

    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/add', [MessageController::class, 'addMessage'])->name('messages.addMessage');
});
