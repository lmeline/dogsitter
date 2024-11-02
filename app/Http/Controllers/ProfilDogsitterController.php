<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilDogsitterController extends Controller
{
    public function index()
    {
       $dogsitters = User::where('role', 'dogsitter')->get();
       return view('dogsitters.index', compact('dogsitters'));
    }

    public function show($id)
    {
        $dogsitter = User::find($id);
        
        if (!$dogsitter || $dogsitter->role !== 'dogsitter') {
            
            return redirect()->route('errorPage')->with('error', 'Profil non autorisé ou inexistant');
        }
        
    return view('dogsitters.show', compact('dogsitter'));

    }

    public function create()
    {
        return view('dogsitters.create');
    }
}
