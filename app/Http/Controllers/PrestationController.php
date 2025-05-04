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
  public function createold($id)
  {
    $proprietaire = Auth::user($id);

    $dogsitter = User::find($id);

    $prestations = $proprietaire->prestationsAsproprietaire()->with(['dog', 'prestationType', 'dogsitter'])->get();

    $prestationsDogsitter = $dogsitter->prestationsAsDogsitter()->with(['dog', 'prestationType', 'proprietaire'])->get();

    $dogs = Dog::where('proprietaire_id', $proprietaire->id)->get();

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

    return view('prestations.create', compact('dogsitter', 'proprietaire', 'dogs', 'disponibilites', 'prestations', 'prestationsDogsitter'));
  }

  public function create($id)
  {
    $proprietaire = Auth::user($id);
    $dogsitter = User::find($id);

    $prestations = $proprietaire->prestationsAsproprietaire()->with(['dog', 'prestationType', 'dogsitter'])->get();
    $prestationsDogsitter = $dogsitter->prestationsAsDogsitter()->with(['dog', 'prestationType', 'proprietaire'])->get();
    $dogs = Dog::where('proprietaire_id', $proprietaire->id)->get();

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

    $disponibilitesFormatees = [];
    $today = Carbon::now();
    $endDate = Carbon::now()->addMonths(3);
    $creneauxDisponibles = []; // ✅ Bien placé ici, avant la boucle

    foreach ($disponibilites as $disponibilite) {
      $jour = $disponibilite->jour_semaine;

      if (isset($joursSemaine[$jour])) {
        $jourAnglais = $joursSemaine[$jour];

        $date = Carbon::now()->next($jourAnglais);
        if ($date->isBefore($today)) {
          $date = $date->addWeek();
        }

        while ($date->isBefore($endDate)) {
          $disponibilitesFormatees[] = [
            'jour' => $jour,
            'heure_debut' => $disponibilite->heure_debut,
            'heure_fin' => $disponibilite->heure_fin,
            'date' => $date->format('Y-m-d'),
          ];
          $date = $date->addWeek();
        }
      }
    }

    foreach ($disponibilitesFormatees as $disponibilite) {
      $date = $disponibilite['date'];
      $heureDebut = Carbon::parse($disponibilite['heure_debut']);
      $heureFin = Carbon::parse($disponibilite['heure_fin']);

      while ($heureDebut->lessThan($heureFin)) {
        $heureCreneau = $heureDebut->format('H:i:s');

        $creneauxDisponibles[$date][] = [
          'heure' => $heureCreneau,
        ];

        $heureDebut->addHour();
      }
    }

    return view('prestations.create', compact('dogsitter', 'proprietaire', 'dogs', 'disponibilites', 'prestations', 'prestationsDogsitter', 'disponibilitesFormatees', 'creneauxDisponibles'));
  }


  public function store(Request $request)
  {

    $output = new ConsoleOutput();
    $output->writeln($request->all());

    $request->validate([
      'date_debut' => ['required', 'date', 'before:date_fin'],
      'date_fin' => ['required', 'date', 'after:date_debut'],
      'dog_id' => ['required', 'exists:dogs,id'],
      'prestation_type_id' => ['required', 'exists:prestations_types,id'],
      'dogsitter_id' => ['required', 'exists:users,id'],
    ]);

    $proprietaire = Auth::user();
    if (!$proprietaire->dogs->contains($request->input('dog_id'))) {
      return redirect()->back()->withErrors(['dog' => 'Le chien sélectionné ne vous appartient pas.']);
    }

    $prix = Userprestationtype::where('dogsitter_id', $request->input('dogsitter_id'))
      ->where('prestation_type_id', $request->input('prestation_type_id'))
      ->first()
      ->prix;
    try {
      $prestation = Prestation::create([
        'date_debut' => $request->input('date') . ' ' . $request->input('date_debut'),
        'date_fin' => $request->input('date') . ' ' . $request->input('date_fin'),
        'prestation_type_id' => $request->input('prestation_type_id'),
        'dogsitter_id' => $request->input('dogsitter_id'),
        'dog_id' => $request->input('dog_id'),
        'proprietaire_id' => Auth::id(),
        'prix_total' => $prix,
      ]);
      $prestation->save();
    } catch (Exception $e) {
      $output->writeln("Erreur lors de l'enregistrement de la prestation : " . $e->getMessage());
      return redirect()->back()->withErrors(['prestation' => 'Erreur lors de l\'enregistrement de la prestation.']);
    }

    $prestation->load('dogsitter');
    $prestation->load('proprietaire');
    $prestation->load('dog');
    $prestation->load('prestationType');

    $output->writeln($prestation->dogsitter);

    //Mail::to($prestation->proprietaire->email)->send(new Reservationconfirmee($prestation));

    return response()->json([
      'success' => true,
      'message' => 'Prestation créée avec succès',
      'prestation' => $prestation,
    ]);
  }

  public function showPrestations()
  {
    $user = Auth::user();

    if ($user->role === 'proprietaire') {

      $prestations = $user->prestationsAsproprietaire()->with('dog')->get();
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
}
