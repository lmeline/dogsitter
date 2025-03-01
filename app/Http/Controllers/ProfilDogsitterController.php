<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use App\Models\Prestation;
use App\Models\PrestationType;
use App\Models\User;
use App\Models\UserPrestationType;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        $disponibilites = Disponibilite::where('dogsitter_id', $id)->get();
        $prestations = Prestation::where('dogsitter_id', $id)->with('avis')->get();

        return view('dogsitters.show', compact('dogsitter', 'prestations','disponibilites'));
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

    public function updateDescription(Request $request){
        $request->validate([
            'description' => ['required', 'string', 'max:255']
        ]);
        $dogsitter = Auth::user();
        $dogsitter->description = $request->description;
        $dogsitter->save();
        return redirect()->back()->with('success', 'Description mise à jour avec succès');
    }
    
    public function annonce(Request $request)
    {
        try{
            $disponibilites = Disponibilite::all();
            $prestationtypes= PrestationType::all();
            return view('dogsitters.annonce', compact('prestationtypes', 'disponibilites'));
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $userPrestation = UserPrestationType::where('dogsitter_id', $id)->get();
        $disponibilites = Disponibilite::where('dogsitter_id', $id)->get();
        $prestationtypes = PrestationType::all();
        return view('dogsitters.edit', compact('userPrestation', 'disponibilites', 'prestationtypes'));
    }

    public function showCalendar()
    {
        $dogsitter = Auth::user();
        $prestations = Prestation::where('dogsitter_id', Auth::id())->get();
        return view('dogsitters.calendar', compact('prestations',"dogsitter"));
    }
}
