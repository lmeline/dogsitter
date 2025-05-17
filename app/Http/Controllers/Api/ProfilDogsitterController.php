<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
class ProfilDogsitterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $output = new ConsoleOutput();
        $output->writeln("Get all dogsitters");

        $users = User::with('prestationtypes')
            ->whereIn('role', ['dogsitter', 'proprietaire'])
            ->get();

        // Retourne un tableau "plat", sans "data"
        $formatted = $users->map(fn($user) => new UserResource($user));

        return response()->json($formatted);
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
    public function store(Request $request)
    {
        //
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
            $output = new ConsoleOutput();
            $output->writeln("Update dogsitters :" . $request->nom);
            $output->writeln("Update dogsitters :" . $request->prenom);
            $output->writeln("Update dogsitters :" . $request->email);
            $output->writeln("Update dogsitters :" . $request->date_naissance);

            $dogsitter = User::find($id);
            $dogsitter->name = $request->nom;
            $dogsitter->prenom = $request->prenom;
            $dogsitter->email = $request->email;
            $dogsitter->date_naissance = $request->date_naissance;
            //$dogsitter->code_postal = $request->code_postal;
            //$dogsitter->ville = $request->ville;
            $dogsitter->save();

            return response()->json($dogsitter);
        } catch (\Exception $e) {
            $output->writeln("Error: " . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la mise à jour du dogsitter'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $dogsitter = User::find($id);
            if (!$dogsitter) {
                return response()->json(['error' => 'dogsitter non trouvée'], 404);
            }

            $dogsitter->delete();
            return response()->json(['message' => 'dogsitter supprimée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
