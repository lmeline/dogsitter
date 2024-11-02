<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}

