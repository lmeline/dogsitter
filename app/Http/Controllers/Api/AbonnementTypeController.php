<?php

namespace App\Http\Controllers\Api;

use App\Models\Abonnement;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;

class AbonnementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $output = new ConsoleOutput();
        $output->writeln("Get all abonnement_types");

        $abonnements_types = Abonnement::all();
        $output->writeln("After all()");

        return response()->json($abonnements_types);
    }

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     if (!$request->user()) {
    //         return response()->json(['error' => 'Non autorisé'], 401);
    //     }

    //     // Validation et création du type de prestation
    //     $request->validate([
    //         'nom' => 'required|string|unique:prestations_types',
    //     ]);

    //     $prestationType = Prestationtype::create([
    //         'nom' => $request->nom,
    //     ]);

    //     return response()->json(['message' => 'Type de prestation ajouté avec succès', 'prestationType' => $prestationType], 201);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     try {
    //         $prestationType = Prestationtype::find($id);

    //         if (!$prestationType) {
    //             return response()->json(['error' => 'Type de prestation non trouvé'], 404);
    //         }

    //         $request->validate([
    //             'nom' => 'required|string|unique:prestationtype,nom,' . $id
    //         ]);

    //         $prestationType->update([
    //             'nom' => $request->nom
    //         ]);

    //         return response()->json(['message' => 'Type de prestation mis à jour avec succès', 'prestationType' => $prestationType], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     try {
    //         $prestationType = Prestationtype::find($id);
    //         if (!$prestationType) {
    //             return response()->json(['error' => 'Type de prestation non trouvé'], 404);
    //         }

    //         $prestationType->delete();
    //         return response()->json(['message' => 'Type de prestation supprimé avec succès'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
}
