<?php

namespace App\Http\Controllers;

use App\Models\Prestationtype;
use App\Models\User;
use App\Models\Userprestationtype;
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
        $prestationtypes = Prestationtype::all();

        return view('userPrestations.create', compact('prestationtypes'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'prestation_type_id' => 'required|exists:prestations_types,id',
                'prix' => 'required|numeric|min:1',
                'dogsitter_id' => 'required|exists:users,id',
                'duree' => 'required|numeric|min:1',
            ]);

            $existe = Userprestationtype::where('dogsitter_id', $request->dogsitter_id)
                ->where('prestation_type_id', $request->prestation_type_id)
                ->exists();

            if ($existe) {
                session()->flash('warning', "Vous avez déjà rentré un tarif pour cette prestation.");
                return redirect()->route('dogsitters.annonce');
            }

            Userprestationtype::create([
                'dogsitter_id' => $request->dogsitter_id,
                'prestation_type_id' => $request->prestation_type_id,
                'prix' => $request->prix,
                'duree' => 1,
            ]);

            session()->flash('success', 'Tarif ajouté avec succès.');
            return redirect()->route('dogsitters.annonce')->with('success', 'Tarif ajouté avec succès.');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        $tarif = Userprestationtype::where('id', $id)
            ->where('dogsitter_id', Auth::id())
            ->first();

        if (!$tarif) {
            return redirect()->route('dogsitters.annonce')->with('error', 'Tarif non trouvé.');
        }

        return view('dogsitters.editTarif', compact('tarif'));
    }


    public function update(Request $request, $id)
    {
        //dd($request->all());
        try{
            $request->validate([
                'prix' => 'required|numeric|min:1',
                'duree' => 'required|numeric|min:1',
            ]);
    
            $tarif = Userprestationtype::where('id', $id)
                ->where('dogsitter_id', Auth::id())
                ->first();
    
            if (!$tarif) {
                return redirect()->route('dogsitters.annonce')->with('error', 'Tarif non trouvé.');
            }
    
            $tarif->update([
                'prix' => $request->prix,
                'duree' => 1,
            ]);
    
            return redirect()->route('dogsitters.annonce')->with('success', 'Tarif mis à jour.');
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
      

    public function destroy($id)
    {
        $tarif = Userprestationtype::where('id', $id)
            ->where('dogsitter_id', Auth::id())
            ->first();

        if (!$tarif) {
            return redirect()->route('dogsitters.annonce')->with('error', 'Tarif non rencontré.');
        }

        $tarif->delete();

        return redirect()->route('dogsitters.annonce')->with('success', 'Tarif supprimé.');
    }
}
