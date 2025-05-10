<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DogController;
use App\Http\Controllers\Api\ProfilDogsitterController;
use App\Http\Controllers\Api\ProprietaireController;
use App\Http\Controllers\Api\RaceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VilleController;
use App\Http\Controllers\Api\PrestationTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

//Route::resouce('/dogs',DogController::class,);
Route::get('/dogs', [DogController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/dogsitters', [ProfilDogsitterController::class, 'index']);
Route::get('/proprietaires', [ProprietaireController::class, 'index']);
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

Route::get('/prestations_types',[PrestationTypeController::class,'index']);
Route::middleware('auth:sanctum')->post('/prestations_types', [PrestationTypeController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/prestations_types/{id}', [PrestationTypeController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/prestations_types/{id}', [PrestationTypeController::class, 'update']);

