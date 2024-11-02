<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function showDashboard()
{

    if (Auth::user()->role === 'dogsitter') {
        return view('dashboard', ['layout' => 'layouts.dogsitter-layout']);
    } else if (Auth::user()->role === 'proprietaire') {
        return view('dashboard', ['layout' => 'layouts.proprietaire-layout']);
    }
    return abort(403, 'Accès non autorisé');
}

}
