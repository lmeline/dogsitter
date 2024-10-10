<?php

use App\Http\Controllers\DogsitterpController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PostController::class,'index'])->name('index'); 
//Route::get('/',[DogsitterpController::class,'index'])->name('profile'); 
setCookie("monCookie", "Valeur de mon cookie", time() + 365*24*3600);