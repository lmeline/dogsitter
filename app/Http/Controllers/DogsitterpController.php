<?php

namespace App\Http\Controllers;

use App\Models\Dogsitterp;
use Illuminate\Http\Request;

class DogsitterpController extends Controller
{
    public function index()
    {
        $dogsitterps = Dogsitterp::all();
        return view('posts.profileDogsitter',['dogsitterps' => $dogsitterps]);
    }
}
