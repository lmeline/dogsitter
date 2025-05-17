<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbonnementController extends Controller
{



    public function chooseAbonnement(Request $request)
{
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

    return redirect()->route('index');
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
