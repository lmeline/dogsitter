<?php

use App\Http\Controllers\Api\DogController;
use App\Http\Controllers\Api\ProfilDogsitterController;
use App\Http\Controllers\Api\RaceController;
use App\Http\Controllers\Api\VilleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::resouce('/dogs',DogController::class,);
Route::get('/dogs', [DogController::class, 'index']);
Route::get('/dogsitters', [ProfilDogsitterController::class, 'index']);
Route::get('/villes',[VilleController::class,'index']);
Route::get('/races',[RaceController::class,'index']);