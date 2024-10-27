<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function registerdog()
    {
        $user = Auth::user();
        if ($user == null) {
            return redirect(route('login'));
        } 
        return view('auth.registerdog', compact('user'));
    }

}
