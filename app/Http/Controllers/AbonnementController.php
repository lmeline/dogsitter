<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbonnementController extends Controller
{

    public function registerabonnement()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect(route('login'))->with('error', 'Veuillez vous connecter pour choisir un abonnement.');
        }
    
        // Récupération des types d'abonnement
        $abonnements_types = Abonnement::all();
    
        return view('auth.registerabonnement', compact('user', 'abonnements_types'));
    }
    
    // Enregistre le choix de l'abonnement
    public function chooseAbonnement(Request $request)
{
    // Validation pour vérifier que l'ID de l'abonnement existe dans la table abonnements_types
    $request->validate([
        'abonnements_types_id' => 'required|exists:abonnements_types,id',
    ]);

    // Récupérer l'utilisateur authentifié
    $user = Auth::user();

    // Vérifiez si l'utilisateur existe (bien qu'il devrait être toujours authentifié)
    if (!$user) {
        return redirect(route('login'))->with('error', 'Veuillez vous connecter pour choisir un abonnement.');
    }

    // Enregistrer l'ID de l'abonnement choisi dans la table users
    $user->abonnement_type_id = $request->abonnements_types_id;  // Enregistrement de l'abonnement
    $user->save();  // Sauvegarde de l'utilisateur dans la base de données

    // Rediriger vers le tableau de bord après l'enregistrement
    return redirect()->route('dashboard');
}

    
}
