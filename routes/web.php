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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/dogs',[DogController::class,'index'])->name('dogs.index');
Route::get('/dogs/{id}',[DogController::class,'show'])->name('dogs.show');

route::get('/accueildogsitters',[ProfilDogsitterController::class,'index'])->name('dogsitters.index');
route::get('/profildogsitters/{id}',[ProfilDogsitterController::class,'show'])->name('dogsitters.show');

route::get('/accueilproprietaires',[ProprietaireController::class,'index'])->name('proprietaires.index');
route::get('/profilproprietaire/{id}',[ProprietaireController::class,'show'])->name('proprietaires.show');

route::get('/', function (){
    return view('index');
});

Route::get('/prestations/{id}/create',[PrestationController::class,'create'])->name('prestations.create');
Route::get('/ajoutchien',[DogController::class,'create'])->name('dogs.create');

Route::get('/register/dog',[DogController::class,'registerdog'])->name('register.dog');


Route::get('/error', function() {
    return view('erreurs.unauthorized'); // Créez une vue simple d'erreur personnalisée
})->name('errorPage');
