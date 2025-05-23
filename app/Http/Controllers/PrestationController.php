<?php

namespace App\Http\Controllers;

use App\Mail\Reservationconfirmee;
use App\Models\Dog;
use App\Models\Prestation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Userprestationtype;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Output\ConsoleOutput;

class PrestationController extends Controller
{
  public function create($id)
  {
    $proprietaire = Auth::user($id);
    $dogsitter = User::find($id);

    //$prestations = $proprietaire->prestationsAsproprietaire()->with(['dog', 'prestationType', 'dogsitter'])->get();
    $prestationsDogsitter = $dogsitter->prestationsAsDogsitter()->get();
    //return response()->json($prestationsDogsitter);
    $dogs = Dog::where('proprietaire_id', $proprietaire->id)->get();

    $disponibilites = $dogsitter->disponibilites;
    //return response()->json($disponibilites);

    $joursSemaine = [
      'Lundi' => 'Monday',
      'Mardi' => 'Tuesday',
      'Mercredi' => 'Wednesday',
      'Jeudi' => 'Thursday',
      'Vendredi' => 'Friday',
      'Samedi' => 'Saturday',
      'Dimanche' => 'Sunday',
    ];

    $today = Carbon::now();
    $endDate = Carbon::now()->addMonths(3);

    $tempDisponibilites = $disponibilites->toBase();
    foreach ($tempDisponibilites as $disponibilite) {
      $disponibilite->jour_semaine = $joursSemaine[$disponibilite->jour_semaine];
    }
    //return response()->json($tempDisponibilites);

    $creneaux = [];

    foreach ($tempDisponibilites as $disponibilite) {
      $debut = Carbon::parse($disponibilite->heure_debut);
      $fin = Carbon::parse($disponibilite->heure_fin);

      while ($debut->lessThan($fin)) {
        $creneaux[$disponibilite->jour_semaine][] = $debut->format('H:i');
        $debut->addHour();
      }
    }

    $reservees = [];
    foreach ($prestationsDogsitter as $prestationDogsitter) {
      if ($prestationDogsitter->statut == 'annulée') {
        continue;
      }
      if (Carbon::parse($prestationDogsitter->date_debut)->isBefore($today)) {
        continue;
      }
      $date = Carbon::parse($prestationDogsitter->date_debut)->format('Y-m-d');
      $heureDebut = Carbon::parse($prestationDogsitter->date_debut)->format('H:i');
      $heureFin = Carbon::parse($prestationDogsitter->date_fin)->format('H:i');

      $reservees[$date][] = [
        'heure_debut' => $heureDebut,
        'heure_fin' => $heureFin,
      ];
    }
    $joursDisponibles = array_unique(array_column($tempDisponibilites->toArray(), 'jour_semaine'));

    //return response()->json(['creneaux' => $creneaux, 'reservees' => $reservees]);

    return view('prestations.create', compact('dogsitter', 'proprietaire', 'dogs', 'creneaux', 'reservees', 'joursDisponibles'));
  }

  public function store(Request $request)
  {

    $request->validate([
      'date' => ['required', 'date_format:Y-m-d'],
      'heure_debut' => ['required', 'date_format:H:i', 'before:heure_fin'],
      'heure_fin' => ['required', 'date_format:H:i', 'after:heure_debut'],
      'dog_id' => ['required', 'exists:dogs,id'],
      'prestation_type_id' => ['required', 'exists:prestations_types,id'],
      'dogsitter_id' => ['required', 'exists:users,id'],
    ]);

    $proprietaire = Auth::user();
    if (!$proprietaire->dogs->contains($request->input('dog_id'))) {
      return redirect()->back()->withErrors(['dog' => 'Le chien sélectionné ne vous appartient pas.']);
    }


    try {

      $debut = Carbon::parse($request->heure_debut);
      $fin = Carbon::parse($request->heure_fin);
      $nbHeures = $debut->diffInHours($fin);

      $prix = (Userprestationtype::where('dogsitter_id', $request->input('dogsitter_id'))
        ->where('prestation_type_id', $request->input('prestation_type_id'))
        ->first()
        ->prix) * $nbHeures;

      $prestation = Prestation::create([
        'date_debut' => $request->input('date') . ' ' . $request->input('heure_debut') . ':00',
        'date_fin' => $request->input('date') . ' ' . $request->input('heure_fin') . ':00',
        'prestation_type_id' => $request->input('prestation_type_id'),
        'dogsitter_id' => $request->input('dogsitter_id'),
        'dog_id' => $request->input('dog_id'),
        'proprietaire_id' => Auth::id(),
        'prix_total' => $prix,
      ]);
      $prestation->save();
    } catch (Exception $e) {
      return redirect()->back()->withErrors(['prestation' => 'Erreur lors de l\'enregistrement de la prestation.']);
    }

    $prestation->load('dogsitter');
    $prestation->load('proprietaire');
    $prestation->load('dog');
    $prestation->load('prestationType');


    //Mail::to($prestation->proprietaire->email)->send(new Reservationconfirmee($prestation));

    return redirect()->route('proprietaires.mesprestations')->with('success', 'Prestation enregistrée.');
  }

  public function showPrestations()
  {
    $user = Auth::user();

    if ($user->role === 'proprietaire') {

      $prestations = $user->prestationsAsproprietaire()->with('dog')->get();

      $prestations = $prestations->map(function ($prestation) {
        $prestation->date_debut = Carbon::parse($prestation->date_debut)->translatedFormat('d F Y à H:i');
        $prestation->date_fin = Carbon::parse($prestation->date_fin)->translatedFormat('d F Y à H:i');
        return $prestation;
      });

    } elseif ($user->role === 'dogsitter') {

      $prestations = $user->prestationsAsdogsitter;
    } else {

      $prestations = collect();
    }

    return view('proprietaires.mesprestations', compact('prestations'));
  }

  public function show($id)
  {
    $prestation = Prestation::find($id);
    $prestation->formatted_date_debut = Carbon::parse($prestation->date_debut)->translatedFormat('d F Y à H:i');
    $prestation->formatted_date_fin = Carbon::parse($prestation->date_fin)->translatedFormat('d F Y à H:i');
    return view('prestations.show', compact('prestation'));
  }

  public function getprestations(Request $request)
  {

    $evenements = [];
    try {
      $start = Carbon::parse($request->start);
      $end = Carbon::parse($request->end);
      $prestations = Prestation::whereBetween('date_debut', [$start, $end])->get();
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

  public function destroy($id)
  {
    $prestation = Prestation::find($id);

    if ($prestation) {
      $prestation->delete();
      return redirect()->route('proprietaires.mesprestations')->with('success', 'Prestation supprimée avec succès.');
    }
    return redirect()->route('proprietaires.mesprestations')->with('success', 'Prestation supprimée avec succès.');
  }

  public function valider($id)
  {
    $prestation = Prestation::findOrFail($id);
    $prestation->statut = 'validée';
    $prestation->save();

    return back()->with('success', 'Prestation validée.');
  }

  public function annuler($id)
  {
    $prestation = Prestation::findOrFail($id);
    $prestation->statut = 'annulée';
    $prestation->save();

    return back()->with('success', 'Prestation annulée.');
  }
}
