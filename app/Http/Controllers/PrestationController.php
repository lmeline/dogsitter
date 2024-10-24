<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;

class PrestationController extends Controller
{
  public function create()
  {
    return view('prestation.create');
  }

  
}
