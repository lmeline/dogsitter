<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Ville;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use League\Csv\Reader;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

     public function update(ProfileUpdateRequest $request): RedirectResponse
     {
       
         $user = Auth::user();
     
       
         $user->update([
             'name' => $request->name,
             'prenom' => $request->prenom,
             'numero_telephone' => $request->numero_telephone,
             'adresse' => $request->adresse,
             'code_postal' => $request->code_postal,
             'ville' => $request->ville,
             'email' => $request->email,
             'photo' => $request->photo
         ]);
     
        
         return Redirect::route('profile.edit')->with('status', 'profile-updated');
     }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function getvilles(Request $request)
    {
        $query = strtolower(trim($request->query('query')));  
    
        if (!$query) {
            return response()->json([]); 
        }
    
        // Recherche les villes qui correspondent à la requête
        $villes = Ville::where('nom_de_la_commune', 'like', '%' . $query . '%')
                        ->select('id', 'nom_de_la_commune', 'code_postal') 
                        ->get();
    
        return response()->json($villes);  
    }
    

    public function saveVille(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:villes,id',  // Vérifie que l'ID existe dans la table villes
            'nom_de_la_commune' => 'required|string|max:255',
            'code_postal' => 'required|string|max:5',  // Code postal composé de 5 caractères
        ]);
    
        // Trouver la ville par son ID
        $ville = Ville::find($request->id);
    
        if ($ville) {
            // Met à jour les informations de la ville
            $ville->nom_de_la_commune = $request->nom_de_la_commune;
            $ville->code_postal = $request->code_postal;
            $ville->save();  // Sauvegarde les modifications
        }
    
        // Renvoie une réponse JSON avec succès
        return response()->json(['success' => true, 'message' => 'Ville mise à jour avec succès']);
    }
    
} 
