<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PrestationController extends Controller
{
  // public function index() 
  // {
  //   $dogsitters = User::all();
  //   return view('prestations.index', compact('dogsitters'));

  // }
  public function index()
  {
      // Récupérer toutes les prestations
      $prestations = Prestation::all();
  
      // Passer la variable $prestations à la vue
      return view('prestations.index', compact('prestations'));
  }

  public function create($id)
  {
    $dogsitter = User::find($id);
    $proprietaire = Auth::user();
    $dogs = $proprietaire->dogs;
    return view('prestations.create', compact('dogsitter','proprietaire','dogs'));
  }

  public function store(Request $request)
  {
      // Affiche les données envoyées pour vérifier leur contenu
      dd($request->all());

      // Validation des données
      $request->validate([
          'date' => ['required', 'date'],
          'heure-debut' => ['required', 'date_format:H:i'],
          'heure-fin' => ['required', 'date_format:H:i', 'after:heure-debut'],
          'dog' => ['required', 'exists:dogs,id'], // Vérifie que le chien existe dans la base
          'service' => ['required', 'exists:prestationtypes,id'], // Vérifie que le service existe dans la base
          'dogsitter_id' => ['required', 'exists:users,id'],
      ]);

      // Vérifie que le chien appartient au client connecté
      $proprietaire = Auth::user();
      if (!$proprietaire->dogs->contains($request->input('dog'))) {
          return redirect()->back()->withErrors(['dog' => 'Le chien sélectionné ne vous appartient pas.']);
      }

      // Création de la prestation
      $prestation = Prestation::create([
          'date_debut' => $request->input('date') . ' ' . $request->input('heure-debut'),
          'date_fin' => $request->input('date') . ' ' . $request->input('heure-fin'),
          'dog_id' => $request->input('dog'),
          'prestation_type_id' => $request->input('service'),
          'dogsitter_id' => $request->input('dogsitter_id'),
          'proprietaire_id' => Auth::id(),
      ]);
        $prestation->save();
        if ($prestation) {
          return redirect()->route('prestations.index')->with('success', 'Prestation créée avec succès');
      } else {
          return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de la prestation');
      }
      //return redirect()->route('prestations.index')->with('success', 'Votre rendez-vous a été pris avec succès !');
  }
    public function show($id)
  {
      // Récupérer la prestation par son ID
      $prestation = Prestation::findOrFail($id);

      // Retourner la vue avec la prestation
      return view('prestations.show', compact('prestation'));
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
