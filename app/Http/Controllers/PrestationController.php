<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PrestationController extends Controller
{
  public function index() 
  {
    $dogsitters = User::all();
    return view('prestation.index', compact('dogsitters'));

  }
  public function create($id)
  {
    $dogsitter = User::find($id);
    $proprietaire = Auth::user();
    
    return view('prestations.create', compact('dogsitter','proprietaire'));
  }

 public function store() {
  $prestation = new Prestation();
  $prestation->date_debut = request('date');
  $prestation-> date_fin = request('date');
  $prestation->heure_debut = request('heure_debut');
  $prestation->heure_fin = request('heure_fin');
 
 }
  
}

// affiche les orestation que le dogsitter 
// planning du mec 
// cliquer un crenaux horaire
// liste des prestations (liste deroulante)
// afficher le tarif
// bouton valider
// puisse annuler 
// choisir le chien (list des chiens )
// si un choisi par default
