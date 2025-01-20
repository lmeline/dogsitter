<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilDogsitterController extends Controller
{
    public function index()
    {
        $dogsitters = User::where('role', 'dogsitter')->paginate(20); // Utilisation de paginate() pour récupérer 20 dogsitters par page
        return view('dogsitters.index', compact('dogsitters'));
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
    
    public function getdogsitters(Request $request)
    {
        $query = $request->input('name');
        $dogsitters = User::where('name', 'like', '%' . $query . '%')
            ->get();
        return response()->json($dogsitters);
    }
}
