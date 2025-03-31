<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function create()
    {
        return view('avis.create');
    }
    public function store(Request $request)
    {
        try{
            $request->validate([
                'rating' => 'required|integer|between:1,5',
                'commentaire' => 'required|string|max:1000',
            ]);
            Avis::create([
                'user_id' => Auth::id(),
                'rating' => $request->input('rating'),
                'commentaire' => $request->input('commentaire'),
            ]);
            return back()->with('success', 'Merci pour votre avis!');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement de votre avis.');
        }
    }
        

    public function show(){
        $avis = Avis::all();
        return view('prestations.show', compact('avis'));
          
    }
}
