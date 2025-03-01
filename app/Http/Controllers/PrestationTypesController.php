<?php

namespace App\Http\Controllers;

use App\Models\PrestationType;
use App\Models\User;
use App\Models\UserPrestationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestationTypesController extends Controller
{
    public function show($id)
    {
        $dogsitter = User::with('prestationtypes')->find($id);

        if (!$dogsitter) {
            return redirect()->route('dogsitters.index')->with('error', 'Dogsitter non trouvé');
        }
        return view('dogsitters.show', compact('dogsitter'));
    }
    public function create()
    {
        $prestationtypes = PrestationType::all();

        return view('userPrestations.create', compact('prestationtypes'));
    }


    public function store(Request $request)
    {
        try {
            // Validation des données du formulaire
            $request->validate([
                'prestation_type_id' => 'required|exists:prestations_types,id',
                'prix' => 'required|numeric|min:0',
                'dogsitter_id' => 'required|exists:users,id',
                'duree' => 'required|numeric|min:1',
            ]);
    
            // Vérifier si un tarif existe déjà pour cette prestation et ce dogsitter
            $existe = UserPrestationType::where('dogsitter_id', $request->dogsitter_id)
                                        ->where('prestation_type_id', $request->prestation_type_id)
                                        ->exists();
    
            if ($existe) {
                // Si un tarif existe déjà pour cette prestation, retourner un message d'avertissement
                session()->flash('warning', "Vous avez déjà rentré un tarif pour cette prestation.");
                return redirect()->route('dogsitters.annonce');
            }
    
            // Sinon, on peut ajouter un nouveau tarif
            UserPrestationType::create([
                'dogsitter_id' => $request->dogsitter_id,
                'prestation_type_id' => $request->prestation_type_id,
                'prix' => $request->prix,
                'duree' => $request->duree
            ]);
    
            // Message de succès
            session()->flash('success', 'Tarif ajouté avec succès.');
            return redirect()->route('dogsitters.annonce')->with('success', 'Tarif ajouté avec succès.');
    
        } catch (\Exception $e) {
            // En cas d'erreur, on retourne un message d'erreur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function edit($id)
{
    $tarif = UserPrestationType::where('id', $id)
                               ->where('dogsitter_id', Auth::id())
                               ->first();

    if (!$tarif) {
        return redirect()->route('dogsitters.annonce')->with('error', 'Tarif non trouvé.');
    }

    return view('dogsitters.editTarif', compact('tarif'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'prix' => 'required|numeric|min:0',
        'duree' => 'required|numeric|min:1',
    ]);

    $tarif = UserPrestationType::where('id', $id)
                               ->where('dogsitter_id', Auth::id())
                               ->first();

    if (!$tarif) {
        return redirect()->route('dogsitters.annonce')->with('error', 'Tarif non trouvé.');
    }

    $tarif->update([
        'prix' => $request->prix,
        'duree' => $request->duree,
    ]);

    return redirect()->route('dogsitters.annonce')->with('success', 'Tarif mis à jour.');
}


}
