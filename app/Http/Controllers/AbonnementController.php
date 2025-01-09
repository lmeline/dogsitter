<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbonnementController extends Controller
{

    // public function showAbonnements()
    // {
    //     $abonnements_types = Abonnement::all();
    //     return view('abonnements.choose', compact('abonnements_types'));
    // }

    // public function registerabonnement()
    // {
    //     $user = Auth::user();
    //     if ($user == null) {
    //         return redirect(route('login'));
    //     } 
    //     return view('auth.registerabonnement', compact('user'));
    // }
    // // Enregistre le choix de l'abonnement
    // public function chooseAbonnement(Request $request)
    // {
    //     $request->validate([
    //         'abonnement_id' => 'required|exists:abonnements_types,id',
    //     ]);

    //     // Stocke l'abonnement choisi en session
    //     session(['abonnements_types_id' => $request->abonnements_types_id]);

    //     return redirect()->route('dashboard'); // Redirige vers l'inscription
    // }
}
