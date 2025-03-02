<?php

use App\Http\Controllers\Api\DogController;
use App\Http\Controllers\Api\ProfilDogsitterController;
use App\Http\Controllers\Api\VilleController;
use App\Models\Dog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/dogs',DogController::class);
Route::resource('/villes',VilleController::class);
Route::resource('/dogsitters',ProfilDogsitterController::class);