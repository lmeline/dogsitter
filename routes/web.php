<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\ProfilUserController;
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
route::get('/profilusers',[ProfilUserController::class,'index'])->name('users.index');
route::get('/profilusers/{id}',[ProfilUserController::class,'show'])->name('users.show');
route::get('/profilclient',[ClientController::class,'index'])->name('clients.index');
route::get('/profilclient/{id}',[ClientController::class,'show'])->name('clients.show');
route::get('/', function (){
    return view('index');
});

route::get('/presta', function (){
    return view('prestations.create');
});