<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DogController extends Controller
{
    public function create()
    {
        $races = Race::orderBy('nom')->get();
        return view('dogs.create', compact('races'));
    }

    public function registerdog()
    {
        $races = Race::orderBy('nom')->get();
        $user = Auth::user();
        if ($user == null) {
            return redirect(route('login'));
        }
        return view('auth.registerdog', compact('user', 'races'));
    }

    public function storeregisterdog(Request $request): RedirectResponse
    {

        // Validation des données
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'race' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'],
            'poids' => ['required', 'numeric'],
            'sexe' => ['required', 'string'],
            'comportement' => ['nullable', 'string', 'max:1000'],
            'besoins_speciaux' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photoPath = $request->file('photo')->store('dogs-photos', 'public');
        }
        //dd($photoPath);
        // Création du chien
        Dog::create([
            'nom' => $request->nom,
            'race' => $request->race,
            'date_naissance' => $request->date_naissance,
            'poids' => $request->poids,
            'sexe' => $request->sexe,
            'comportement' => $request->comportement ?? '',
            'besoins_speciaux' => $request->besoins_speciaux ?? '',
            'sterilise' => $request->sterilise ? true : false,
            'proprietaire_id' => Auth::id(),
            'photo' => $photoPath,
        ]);


        // Redirection après la création avec un message de succès
        return redirect()->route('index')->with('success', 'Le chien a été ajouté avec succès.');
    }

    public function edit($id)
    {
        $dog = Dog::findOrFail($id);
        return view('profile', compact('dog'));
    }

    public function update(Request $request, Dog $dog)
    {
        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'race' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'sexe' => 'nullable|in:F,M',
            'comportement' => 'nullable|string|max:255',
            'besoins_speciaux' => 'nullable|string|max:255',
            'sterilise' => 'nullable|boolean',
        ]);

        $dog->update($validated);

        return response()->json(['success' => true, 'dog' => $dog]);
    }

    public function destroy($id)
    {
        $dog = Dog::findOrFail($id);
        $dog->delete();
        return response()->json(['success' => true]);
    }

    public function deletephoto($id)
    {
        $dog = Dog::findOrFail($id);
        $dog->photo = null;
        $dog->save();
        return view('profile', compact('dog'));
    }
}
