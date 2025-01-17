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
    $user = Auth::user();
    if (!$user) {
        return redirect(route('login'))->with('error', 'Veuillez vous connecter pour choisir un abonnement.');
    }
   $user->update([
       'abonnement_type_id' => $request->input('abonnement_type_id'),
   ]);
    // Rediriger vers le tableau de bord après l'enregistrement
    return redirect()->route('dashboard');
}

public function updateAbonnement(Request $request)
{
    $request->validate([
        'abonnement_type_id' => 'required|exists:abonnements_types,id',
    ]);

    $user = Auth::user();
    
    $user->update([
        'abonnement_type_id' => $request->input('abonnement_type_id'),
    ]);

    return redirect()->route('abonnements.update');
}

public function show(){
    $user = Auth::user();
    $abonnements_types = Abonnement::all();
    return view('abonnements.update', compact('user', 'abonnements_types'));
}
}
