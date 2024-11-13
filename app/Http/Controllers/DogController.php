<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DogController extends Controller
{
    public function index()
    {
       $dogs = Dog::all();
       return view('dogs.index', compact('dogs'));
    }

    public function show($id)
    {
        $dog = Dog::find($id);
        return view('dogs.show', compact('dog'));
    }

    public function create()
    {
        return view('dogs.create');
    }

    public function registerdog()
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect(route('login'));
        } 
        return view('auth.registerdog', compact('user'));
    }

}


public function storeregisterdog(Request $request): RedirectResponse
{
    // Validation des données
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'race' => ['required', 'string', 'max:255'],
        'age' => ['required', 'integer'], // Age devrait être un entier
        'poids' => ['required', 'numeric'], // Poids pourrait être un nombre
        'sexe' => ['required', 'in:male,female'], // Exemple de validation pour un sexe spécifique
        'description' => ['nullable', 'string', 'max:1000'], // Description peut être plus longue et est optionnelle
        'besoins_speciaux' => ['nullable', 'string', 'max:1000'], // Besoins spéciaux peuvent être optionnels
        'sterilise' => ['required', 'boolean'], // Sterilisé devrait être un booléen
    ]);

    // Création du chien
    $dog = Dog::create([
        'nom' => $request->name,
        'race' => $request->race,
        'age' => $request->age,
        'poids' => $request->poids,
        'sexe' => $request->sexe,
        'description' => $request->description ?? '', // Si la description est vide, mettre une chaîne vide
        'besoins_speciaux' => $request->besoins_speciaux ?? '', // Idem pour les besoins spéciaux
        'sterilise' => $request->sterilise,
        'proprietaire_id' => Auth::id(), // Utiliser l'ID de l'utilisateur connecté
    ]);

    // Redirection après la création avec un message de succès
    return redirect()->route('dogs.index')->with('success', 'Le chien a été ajouté avec succès.');
}
