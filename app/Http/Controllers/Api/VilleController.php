<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Ville;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return response()->json(Ville::all());
        return response()->json(Ville::with('users')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['error' => 'Non autorisé'], 401);
            }

            // Validation et création de la race
            $request->validate([
                'nom_de_la_commune' => 'required|string|unique:villes',
                'code_postal' => 'required|string|unique:villes',
            ]);

            $ville = Ville::create([
                'nom_de_la_commune' => $request->nom_de_la_commune,
                'code_postal' => $request->code_postal
            ]);

            $output = new ConsoleOutput();
            $output->writeln($ville);

            return response()->json(['message' => 'Ville ajoutée avec succès', 'ville' => $ville], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


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
    public function update(Request $request, string $id)
    {
        try {
            // if (!$request->user()) {
            //     return response()->json(['error' => 'Non autorisé'], 401);
            // }

            $ville = Ville::find($id);
            if (!$ville) {
                return response()->json(['error' => 'Ville non trouvée'], 404);
            }

            $request->validate([
                'nom_de_la_commune' => 'required|string|unique:villes,nom_de_la_commune,' . $id,
                'code_postal' => 'required|string',
            ]);

            $ville->update([
                'nom_de_la_commune' => $request->nom_de_la_commune,
                'code_postal' => $request->code_postal
            ]);

            return response()->json(['message' => 'Ville mise à jour avec succès', 'ville' => $ville], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $ville = Ville::find($id);
            if (!$ville) {
                return response()->json(['error' => 'Ville non trouvée'], 404);
            }
            // Vérifiez si la ville est associée à des utilisateurs
            if ($ville->users()->exists()) {
                return response()->json(['error' => 'Impossible de supprimer cette ville car elle est associée à des utilisateurs'], 400);
            }

            $ville->delete();
            return response()->json(['message' => 'Ville supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
