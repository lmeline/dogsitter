<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Prestation;
use App\Models\PrestationDog;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPrestationType;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;

class PrestationController extends Controller
{

  public function index()
  {
    $prestations = Prestation::all();
    return view('prestations.index', compact('prestations'));
  }

public function create($id)
{
    $dogsitter = User::find($id); 
    $proprietaire = Auth::user(); 
    $dogs = Dog::find($id); 

    $disponibilites = $dogsitter->disponibilites;

    $joursSemaine = [
        'Lundi' => 'Monday',
        'Mardi' => 'Tuesday',
        'Mercredi' => 'Wednesday',
        'Jeudi' => 'Thursday',
        'Vendredi' => 'Friday',
        'Samedi' => 'Saturday',
        'Dimanche' => 'Sunday',
    ];

    foreach ($disponibilites as $disponibilite) {
        $jour = $disponibilite->jour_semaine;  
        
       
        if (isset($joursSemaine[$jour])) {
            $jourAnglais = $joursSemaine[$jour]; 
            
            $date = Carbon::now()->next($jourAnglais);
            $disponibilite->date = $date->format('Y-m-d');  
        }
    }

    return view('prestations.create', compact('dogsitter', 'proprietaire', 'dogs', 'disponibilites'));
}

  

  public function store(Request $request)
  {

    //dd($request->all());
    try {
      $request->validate([
        'date_debut' => ['required', 'date', 'before:date_fin'],
        'date_fin' => ['required', 'date', 'after:date_debut'],
        'dog' => ['required', 'exists:dogs,id'],
        'prestation_type_id' => ['required', 'exists:prestations_types,id'],
        'dogsitter_id' => ['required', 'exists:users,id'],
      ]);
      $proprietaire = Auth::user();
      if (!$proprietaire->dogs->contains($request->input('dog'))) {
        return redirect()->back()->withErrors(['dog' => 'Le chien sélectionné ne vous appartient pas.']);
      }

      $prestation = Prestation::create([
        'date_debut' => $request->input('date') . ' ' . $request->input('date_debut'),
        'date_fin' => $request->input('date') . ' ' . $request->input('date_fin'),
        'prestation_type_id' => $request->input('prestation_type_id'),
        'dogsitter_id' => $request->input('dogsitter_id'),
        'proprietaire_id' => Auth::id(),
      ]);
      $prestation->save();

      PrestationDog::create([
        'prestation_id' => $prestation->id,
        'dog_id' => $request->input('dog'),
        'prix' => UserPrestationType::where('dogsitter_id', $request->input('dogsitter_id'))->where('prestation_type_id', $request->input('prestation_type_id'))->first()->prix
      ]);

      return redirect()->route('mesprestations')->with('success', 'Prestation créée avec succès');
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function showPrestations()
{
    $user = Auth::user();

    if ($user->role === 'proprietaire') {

        $prestations = $user->prestationsAsproprietaire;
        $prestationDogs =Prestation::with('prestationDogs.dog')->get();
    } elseif ($user->role === 'dogsitter') {

        $prestations = $user->prestationsAsdogsitter;
        $prestationDogs =Prestation::with('prestationDogs.dog')->get();
    } else {

        $prestations = collect();
    }

    return view('mesprestations', compact('prestations'));
}

  public function show($id)
  {
    $prestation = Prestation::find($id);

    $prestation->formatted_date_debut = Carbon::parse($prestation->date_debut)->translatedFormat('d F Y à H:i');
    $prestation->formatted_date_fin = Carbon::parse($prestation->date_fin)->translatedFormat('d F Y à H:i');
    $prestationDogs = Prestation::with('prestationDogs.dog')->get();

    return view('prestations.show', compact('prestation'));
  }

  public function getprestations(Request $request){
    
    $evenements = [];
    try {
      $start = Carbon::parse($request->start);
      $end = Carbon::parse($request->end);
      $prestations =Prestation::whereBetween('date_debut', [$start, $end])->get();
      foreach ($prestations as $prestation) {
        $evenements[] = [
          'title' => $prestation->proprietaire->name,
          'start' => $prestation->date_debut,
          'end' => $prestation->date_fin,
          'color' => '#b54d6d',
        ];
      }
      return response()->json($evenements);
    } catch (Exception $e) {
      return response()->json(['error' => $e->getMessage()]);
    }
  }

}