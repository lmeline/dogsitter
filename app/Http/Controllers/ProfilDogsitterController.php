<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;

class ProfilDogsitterController extends Controller
{
    public function index()
    {
        $dogsitters = User::where('role', 'dogsitter')->paginate(20);
        $villes = User::distinct('ville_id')->where('role', 'dogsitter')->pluck('ville_id')->toArray();

        $villesDetails = Ville::whereIn('id', $villes)->get();

        return view('dogsitters.index', compact('dogsitters', 'villes'));
    }


    public function show($id)
    {
        $dogsitter = User::find($id);

        if (!$dogsitter || $dogsitter->role !== 'dogsitter') {

            return redirect()->route('index');
        }


        $prestations = Prestation::where('dogsitter_id', $id)->with('avis')->get();

        return view('dogsitters.show', compact('dogsitter', 'prestations'));
    }

    public function create()
    {
        return view('dogsitters.create');
    }

    public function search(Request $request)
    {
        $query = User::query();
        $query->where('role', 'dogsitter');

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }
    
        if ($request->filled('ville')) {
            $query->whereHas('ville', function ($query) use ($request) {
                $query->where('nom_de_la_commune', 'LIKE', "%{$request->ville}%");
            });
        }
        if ($request->filled('note_moyenne')) {
            $query->where('note_moyenne', '>=', $request->note_moyenne);
        }
        $users = $query->with('ville')->get();
        return response()->json($users);
    }
  
}
