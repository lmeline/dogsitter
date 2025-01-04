<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PrestationTypesController extends Controller
{
    // Méthode pour récupérer un dogsitter avec ses services
    public function show($id)
    {
        // Récupérer le dogsitter avec ses services associés, y compris le prix
        $dogsitter = User::with('prestationtypes')->find($id);

        // Vérifier si le dogsitter existe
        if (!$dogsitter) {
            return redirect()->route('dogsitters.index')->with('error', 'Dogsitter non trouvé');
        }

        // Retourner la vue avec les données
        return view('dogsitters.show', compact('dogsitter'));
    }
}
