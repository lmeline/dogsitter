<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProprietaireController extends Controller
{
    public function index()
    {
       $proprietaires = User::all();
       return view('proprietaires.index', compact('proprietaires'));
    }

    public function show($id)
    {
        $proprietaire = User::find($id);
        return view('proprietaires.show', compact('proprietaire'));
    }

    public function create()
    {
        return view('proprietaires.create');
    }

    public function updateDescription(Request $request){
        $request->validate([
            'description' => ['required', 'string', 'max:255']
        ]);
        $proprietaire = Auth::user();
        $proprietaire->description = $request->description;
        $proprietaire->save();
        return redirect()->back()->with('success', 'Description mise à jour avec succès');
    }
}

