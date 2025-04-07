<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['dogsitter', 'proprietaire'])->get()->groupBy('role');

        return response()->json([
            'dogsitters' => $users->get('dogsitter', collect()),
            'proprietaires' => $users->get('proprietaire', collect()),
        ]);
        
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
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['error' => 'Utilisateur non trouvé.'], 404);
        }
    
        if (!in_array($user->role, ['dogsitter', 'proprietaire'])) {
            return response()->json(['error' => 'Rôle non pris en charge.'], 400);
        }
    
        // Mise à jour des champs communs
        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->date_naissance = $request->date_naissance;
        $user->code_postal = $request->code_postal;
        $user->ville = $request->ville;
        $user->adresse = $request->adresse;
    
        // Si vous avez des champs spécifiques selon le rôle, vous pouvez les traiter ici
        // Par exemple :
        if ($user->role === 'dogsitter') {
            $user->abonnement_type_id = $request->abonnement_type_id;
        }
    
        $user->save();
    
        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès.',
            'user' => $user,
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'user non trouvée'], 404);
            }
    
            $user->delete();
            return response()->json(['message' => 'user supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
