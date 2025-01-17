<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Race;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
        $races = Race::orderBy('nom')->get();
        return view('dogs.create',compact('races'));
    }

    public function registerdog()
    {
        $races = Race::orderBy('nom')->get();
        $user = Auth::user();
        if ($user == null) {
            return redirect(route('login'));
        } 
        return view('auth.registerdog', compact('user','races'));
    }

    public function storeregisterdog(Request $request): RedirectResponse
{
 
    // Validation des données
    $request->validate([
        'nom' => ['required', 'string', 'max:255'],
        'race' => ['required', 'string', 'max:255'],
        'age' => ['required', 'integer'], 
        'poids' => ['required', 'numeric'], 
        'sexe' => ['required', 'string'], 
        'comportement' => ['nullable', 'string', 'max:1000'], 
        'besoins_speciaux' => ['nullable', 'string', 'max:1000'], 
    ]);

    // Création du chien
    Dog::create([
        'nom' => $request->nom,
        'race' => $request->race,
        'age' => $request->age,
        'poids' => $request->poids,
        'sexe' => $request->sexe,
        'comportement' => $request->comportement ?? '', 
        'besoins_speciaux' => $request->besoins_speciaux ?? '', 
        'sterilise' => $request->sterilise ? true : false,
        'proprietaire_id' => Auth::id(),
    ]);

 
    // Redirection après la création avec un message de succès
    return redirect()->route('dashboard')->with('success', 'Le chien a été ajouté avec succès.');
}

}