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
Route::put('/dogsitters/{id}', [ProfilDogsitterController::class, 'update']);
Route::delete('dogsitters/{id}', [ProfilDogsitterController::class, 'destroy']);
Route::post('/dogsitters', [ProfilDogsitterController::class, 'store']);

Route::get('/villes',[VilleController::class,'index']);
Route::put('/villes/{id}',[VilleController::class,'update']);
Route::delete('villes/{id}', [VilleController::class, 'destroy']);
Route::post('/villes', [VilleController::class, 'store']);

Route::get('/races',[RaceController::class,'index']);
Route::put('/races/{id}',[RaceController::class,'update']);
Route::delete('races/{id}', [RaceController::class, 'destroy']);
Route::post('/races', [RaceController::class, 'store']);
