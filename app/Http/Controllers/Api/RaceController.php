<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Race::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données reçues
        $request->validate([
            'name' => 'required|string|max:255',
            // Ajoute d'autres validations si nécessaire
        ]);

        // Trouver la race à mettre à jour
        $breed = Race::find($id);

        if (!$breed) {
            return response()->json(['message' => 'Race non trouvée'], 404);
        }

        // Mise à jour de la race
        $breed->name = $request->name;
        $breed->save();

        return response()->json($breed);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $breed = Race::find($id);

        if (!$breed) {
            return response()->json(['message' => 'Race non trouvée'], 404);
        }
    
        // Suppression de la race
        $breed->delete();
    
        return response()->json(['message' => 'Race supprimée avec succès']);
    }
}
