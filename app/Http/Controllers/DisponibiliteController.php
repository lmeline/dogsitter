<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;
use Illuminate\Support\Facades\Auth;
class DisponibiliteController extends Controller
{

    // Récupérer les disponibilités du dogsitter
    public function index()
    {
        $disponibilites = Disponibilite::where('user_id', Auth::id())->get();
        return response()->json($disponibilites);
    }

    // Enregistrer une nouvelle disponibilité
    public function store(Request $request)
    {
        $request->validate([
            'jour_semaine' => 'required|string',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ]);

        Disponibilite::create([
            'dogsitter_id' => Auth::id(),
            'jour_semaine' => $request->jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
        ]);

        return response()->json(['success' => true, 'message' => 'Disponibilité ajoutée']);
    }

    // Supprimer une disponibilité
    public function destroy($id)
    {
        $disponibilite = Disponibilite::where('id', $id)->where('dogsitter_id', Auth::id())->first();
        
        if ($disponibilite) {
            $disponibilite->delete();
            return response()->json(['success' => true, 'message' => 'Disponibilité supprimée']);
        }
        
        return response()->json(['success' => false, 'message' => 'Disponibilité introuvable']);
    }
}

