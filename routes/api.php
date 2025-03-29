<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DogController;
use App\Http\Controllers\Api\ProfilDogsitterController;
use App\Http\Controllers\Api\RaceController;
use App\Http\Controllers\Api\VilleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::post('/login', [AuthController::class, 'login']);

//Route::resouce('/dogs',DogController::class,);
Route::get('/dogs', [DogController::class, 'index']);

Route::get('/dogsitters', [ProfilDogsitterController::class, 'index']);
Route::middleware('auth:sanctum')->delete('dogsitters/{id}', [ProfilDogsitterController::class, 'destroy']);
Route::post('/dogsitters', [ProfilDogsitterController::class, 'store']);

Route::get('/villes',[VilleController::class,'index']);
Route::middleware('auth:sanctum')->post('/villes', [VilleController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/villes/{id}', [VilleController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/villes/{id}', [VilleController::class, 'update']);
//Route::put('/villes/{id}', [VilleController::class, 'update']);


Route::get('/races',[RaceController::class,'index']);
Route::middleware('auth:sanctum')->post('/races', [RaceController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/races/{id}', [RaceController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/races/{id}', [RaceController::class, 'update']);


