<?php

namespace App\Http\Controllers;

use App\Models\PrestationType;
use App\Models\User;
use App\Models\UserPrestationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestationTypesController extends Controller
{
    public function show($id)
    {
        $dogsitter = User::with('prestationtypes')->find($id);

        if (!$dogsitter) {
            return redirect()->route('dogsitters.index')->with('error', 'Dogsitter non trouvé');
        }
        return view('dogsitters.show', compact('dogsitter'));
    }

    public function create()
    {
        $prestationtypes = PrestationType::all();

        return view('userPrestations.create', compact('prestationtypes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'prestation_type_id' => 'required|exists:prestations_types,id',
            'prix' => 'required|numeric|min:0',
            'dogsitter_id' => 'required|exists:users,id',
            'duree' => 'required|numeric|min:1',
        ]);


        UserPrestationType::create([
            'dogsitter_id' => $request->dogsitter_id,
            'prestation_type_id' => $request->prestation_type_id,
            'prix' => $request->prix,
            'duree' => $request->duree
        ]);

        return redirect()->route('dashboard')->with('success', 'Tarif ajouté avec succès.');
    }
}
