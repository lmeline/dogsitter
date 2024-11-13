<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {     
        $proprietaire = $request->query('proprietaire');
        return view('auth.register',compact('proprietaire'));   
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telephone' => ['required', 'string', 'max:15'],
            'adresse' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'string', 'max:20'],
            'ville' => ['required', 'string', 'max:70'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_naissance' => ['required','date','before:18 year ago'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'numero_telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('register.dog'));
    }

    public function storedogsitter(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:70'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telephone' => ['required', 'string', 'max:15'],
            'adresse' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'string', 'max:20'],
            'ville' => ['required', 'string', 'max:70'],
            'experience' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_naissance' => ['required','date','before:18 year ago'],
           
        ]);

        $role = 'dogsitter';

        $user = User::create([
            'role' => $role,
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'numero_telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'experience' => $request->experience,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dogsitters.accueilDogsitter', Auth::user()));
    }
}
