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

        return view('dogsitters.index', compact('dogsitters','villes'));
    }
    

    public function show($id)
    {
        $dogsitter = User::find($id);
        
        if (!$dogsitter || $dogsitter->role !== 'dogsitter') {
            
            return redirect()->route('index');
            
        }
    
        
    $prestations = Prestation::where('dogsitter_id', $id)->with('avis')->get();
        
    return view('dogsitters.show', compact('dogsitter','prestations'));

    }

    public function create()
    {
        return view('dogsitters.create');
    }
    
    // public function getdogsitters(Request $request)
    // {
    //     $query = $request->input('name');
    //     $dogsitters = User::where('name', 'like', '%' . $query . '%')
    //         ->get();
    //     return response()->json($dogsitters);
    // }

    public function search(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        if ($request->filled('ville')) {
            $query->where('ville', 'LIKE', "%{$request->ville}%");
        }

        return response()->json($query->get());
    }
    
}
