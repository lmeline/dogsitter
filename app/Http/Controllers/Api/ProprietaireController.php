<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            User::whereIn('role', ['proprietaire'])->get()
        );
        
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
        $dogsitter = User::find($id);
        $dogsitter->name = $request->name;
        $dogsitter->prenom = $request->prenom;
        $dogsitter->email = $request->email;
        $dogsitter->date_naissance = $request->date_naissance;
        $dogsitter->code_postal = $request->code_postal;
        $dogsitter->ville = $request->ville;
        $dogsitter->adresse = $request->adresse;
        $dogsitter->save();

        return response()->json($dogsitter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $proprietaire = User::find($id);
            if (!$proprietaire) {
                return response()->json(['error' => 'Propriétaire non trouvé'], 404);
            }

            $proprietaire->delete();
            return response()->json(['message' => 'Propriétaire supprimé avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
