<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;
use App\Models\Prestationtype;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DisponibiliteController extends Controller
{

    public function index()
    {
        $disponibilites = Disponibilite::where('dogsitter_id', Auth::id())->get();
        return response()->json($disponibilites);
    }

    public function show($id)
    {

        $disponibilites = Disponibilite::where('dogsitter_id', $id)->get();
        $dogsitter = User::find($id);
        return view('dogsitters.show', compact('disponibilites', 'dogsitter'));
    }

    public function store(Request $request)
    {
        try {
            dd($request->all());
            $request->validate([
                'jour_semaine' => 'required|string',
                'heure_debut' => 'required|date_format:H:i',
                'heure_fin' => 'required|date_format:H:i|after:heure_debut',
                'dogsitter_id' => 'required|exists:users,id',
            ]);

            $existe = Disponibilite::where('dogsitter_id', $request->dogsitter_id)
                ->where('jour_semaine', $request->jour_semaine)
                ->exists();

            if ($existe) {
                session()->flash('warning', "Vous avez déjà rentré une disponibilité pour ce jour.");
                return redirect()->route('dogsitters.annonce');
            }

            Disponibilite::create([
                'dogsitter_id' => Auth::id(),
                'jour_semaine' => $request->jour_semaine,
                'heure_debut' => $request->heure_debut,
                'heure_fin' => $request->heure_fin,
            ]);

            session()->flash('success', 'Votre horaire a été pris en compte avec succès.');
            return redirect()->route('dogsitters.annonce');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $disponibilite = Disponibilite::where('id', $id)->where('dogsitter_id', Auth::id())->first();

        if ($disponibilite) {
            $disponibilite->delete();

            $disponibilites = Disponibilite::where('dogsitter_id', Auth::id())->get();

            return view('dogsitters.annonce', [
                'disponibilites' => $disponibilites,
                'prestationtypes' => Prestationtype::all(),
                'success' => 'Disponibilité supprimée avec succès.'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Disponibilité introuvable'], 404);
    }

    public function edit($id)
    {

        $disponibilite = Disponibilite::where('id', $id)
            ->where('dogsitter_id', Auth::id())
            ->first();

        if (!$disponibilite) {
            return redirect()->route('dogsitters.annonce')->with('error', 'Disponibilité non trouvée.');
        }

        return view('dogsitters.annonce', compact('disponibilite'));
    }

    public function update(Request $request, $id)
    {
        try {
            //dd($request->all());
            $request->validate([
                'jour_semaine' => 'required|string',
                'heure_debut' => 'required|date_format:H:i',
                'heure_fin' => 'required|date_format:H:i',
            ]);

            $disponibilite = Disponibilite::where('id', $id)
                ->where('dogsitter_id', Auth::id())
                ->first();

            if (!$disponibilite) {
                return redirect()->route('dogsitters.annonce')->with('error', 'Disponibilité non trouvée.');
            }
            $heure_debut = $request->heure_debut; // Ajout des secondes à l'heure de début
            $heure_fin = $request->heure_fin; // Ajout des secondes à l'heure de fin

            $disponibilite->update([
                'jour_semaine' => $request->jour_semaine,
                'heure_debut' => $heure_debut,
                'heure_fin' => $heure_fin,
            ]);

            return redirect()->route('dogsitters.annonce')->with('success', 'Disponibilité mise à jour.');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
