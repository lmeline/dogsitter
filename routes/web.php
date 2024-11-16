<?php

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

Route::get('/dogsitter/accueil', function () {
    return view('dogsitters.accueilDogsitter');
})->middleware(['auth', 'verified'])->name('dogsitters.accueilDogsitter');

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

route::get('/proprietaires',[ProprietaireController::class,'index'])->name('proprietaires.index');
route::get('/proprietaires/{id}',[ProprietaireController::class,'show'])->name('proprietaires.show');

route::get('/', function (){
    return view('index');
})->name('index');

Route::get('/prestations/create/{id}',[PrestationController::class,'create'])->name('prestations.create');
Route::get('/ajoutchien',[DogController::class,'create'])->name('dogs.create');

Route::get('/register/dog',[DogController::class,'registerdog'])->name('register.dog');
Route::post('/register/dog', [DogController::class, 'storeregisterdog'])
->name('storeregisterdog');


Route::get('/error', function() {
    return view('erreurs.unauthorized'); // Créez une vue simple d'erreur personnalisée
})->name('errorPage');
