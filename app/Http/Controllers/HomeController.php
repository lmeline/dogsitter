<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // Récupérer les 10 derniers avis
    $avis = Avis::with('user')->latest()->take(5)->get(); // On récupère les 10 derniers avis avec les informations sur l'utilisateur

    return view('index', compact('avis')); // Passer les avis à la vue
}

    
}
