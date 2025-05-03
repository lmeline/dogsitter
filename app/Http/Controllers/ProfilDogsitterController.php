<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use App\Models\Prestation;
use App\Models\Prestationtype;
use App\Models\User;
use App\Models\Userprestationtype;
use App\Models\Ville;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfilDogsitterController extends Controller
{
    public function index()
    {
        $dogsitters = User::where('role', 'dogsitter')
            ->whereHas('prestationtypes', function ($query) {
                $query->whereNotNull('users_prestations_types.prix')
                      ->where('users_prestations_types.prix', '>', 0);
            })
            ->whereHas('disponibilites')
            ->with(['ville', 'prestationtypes'])
            ->paginate(20);
    
        // Récupérer les villes des dogsitters filtrés
        $villesIds = $dogsitters->pluck('ville_id')->unique()->toArray();
        $villes = Ville::whereIn('id', $villesIds)->get();
    
        return view('dogsitters.index', compact('dogsitters', 'villes'));
    }
    
    

    public function show($id)
    {
        $dogsitter = User::find($id);

        if (!$dogsitter || $dogsitter->role !== 'dogsitter') {

            return redirect()->route('index');
        }
        
        $disponibilites = Disponibilite::where('dogsitter_id', $id)->get();
        $prestations = Prestation::where('dogsitter_id', $id)->get();

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
            $userPrestations = Userprestationtype::where('dogsitter_id', Auth::id())->get();
            $disponibilites = Disponibilite::where('dogsitter_id', Auth::id())->get();
            $prestationtypes= Prestationtype::all();
            return view('dogsitters.annonce', compact('prestationtypes', 'disponibilites','userPrestations'));	
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $userPrestation = Userprestationtype::where('dogsitter_id', $id)->get();
        $disponibilites = Disponibilite::where('dogsitter_id', $id)->get();
        $prestationtypes = Prestationtype::all();
        return view('dogsitters.edit', compact('userPrestation', 'disponibilites', 'prestationtypes'));
    }


public function showCalendar()
{
    $prestations = Prestation::all();
    
    $prestations->transform(function ($prestation) {
        $prestation->formatted_date_debut = Carbon::parse($prestation->date_debut)->format('Y-m-d\TH:i:s');
        $prestation->formatted_date_fin = Carbon::parse($prestation->date_fin)->format('Y-m-d\TH:i:s');
        return $prestation;
    });

    return view('dogsitters.calendar', compact('prestations'));
}

}
