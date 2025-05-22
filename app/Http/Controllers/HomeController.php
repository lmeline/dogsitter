<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Prestation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{

    $avis = Avis::with('user')->latest()->take(3)->get();
    $utilisateurs = User::where("role","!=", "admin")->count();
    $proprietaires = User::where('role','proprietaire')->count();
    $dogsitters = User::where('role','dogsitter')->count();
   
    $moyenneNotes = Avis::avg('rating');    
    $pourcentageSatisfaction = round(($moyenneNotes / 5) * 100,2);

    return view('index', compact('avis','proprietaires','dogsitters','utilisateurs','pourcentageSatisfaction'));
}

    
}
