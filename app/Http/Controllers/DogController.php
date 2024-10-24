<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index()
    {
       $dogs = Dog::all();
       return view('dogs.index', compact('dogs'));
    }

    public function show($id)
    {
        $dog = Dog::find($id);
        return view('dogs.show', compact('dog'));
    }

    public function create()
    {
        return view('dogs.create');
    }


}
