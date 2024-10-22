<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
       $clients = User::all();
       return view('clients.index', compact('clients'));
    }

    public function show($id)
    {
        $client = User::find($id);
        return view('clients.show', compact('client'));
    }

    public function create()
    {
        return view('clients.create');
    }
}

