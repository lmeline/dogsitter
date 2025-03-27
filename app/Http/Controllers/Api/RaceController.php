<?php

namespace App\Http\Controllers\Api;

use App\Models\Race;
use Illuminate\Routing\Controller;
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

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Non autorisé'], 401);
        }

        // Validation et création de la race
        $request->validate([
            'nom' => 'required|string|unique:races',
        ]);

        $race = Race::create([
            'nom' => $request->nom,
        ]);

        return response()->json(['message' => 'Race ajoutée avec succès', 'race' => $race], 201);
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
    public function update(Request $request, $id)
    {
        try {
            $race = Race::find($id);

            if (!$race) {
                return response()->json(['error' => 'Race non trouvée'], 404);
            }

            $request->validate([
                'nom' => 'required|string|unique:races,nom,' . $id
            ]);

            $race->update([
                'nom' => $request->nom
            ]);

            return response()->json(['message' => 'Race mise à jour avec succès', 'race' => $race], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $race = Race::find($id);
            if (!$race) {
                return response()->json(['error' => 'Race non trouvée'], 404);
            }

            $race->delete();
            return response()->json(['message' => 'Race supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
