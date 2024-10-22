<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    public function index()
    {
        $prestations = Prestation::all();
        return view('prestations.index',compact('prestations'));
    }
}

// affiche les orestation que le dogsitter 
// planning du mec 
// cliquer un crenaux horaire
// liste des prestations (liste derooulante)
// afficher le tarif
// bouton valider
// puisse annuler 
// choisir le chien (list des chiens )
// si un choisi par default
