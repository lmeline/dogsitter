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
        // Lire le fichier CSV
        $csv = Reader::createFromPath(public_path('communes.csv'), 'r');
        $csv->setHeaderOffset(0); // Si le fichier a une ligne d'en-tête

        $query = strtolower(trim($request->query('query')));

        // Si aucun terme de recherche, retourner une liste vide
        if (!$query) {
            return response()->json([]);
        }

        $villes = [];

        // Parcourir le CSV et filtrer les résultats
        foreach ($csv as $record) {
            if (isset($record['nom_de_la_commune']) && stripos($record['nom_de_la_commune'], $query) !== false) {
                $villes[] = [
                    'nom' => $record['nom_de_la_commune'],
                    'code_postal' => $record['code_postal'] ?? '',
                ];
            }
        }

        return response()->json($villes);
    }
} 
