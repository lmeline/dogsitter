<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ville;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use League\Csv\Reader;
use Exception;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */

    public function create(Request $request): View
    {
        $villes = Ville::all();
        $proprietaire = $request->query('proprietaire');
        return view('auth.register', compact('proprietaire', 'villes'));
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephone' => ['required', 'string', 'max:15'],
            'adresse' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'string', 'max:20'],
            'ville_id' => ['required', 'exists:villes,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_naissance' => ['required', 'date', 'before:18 year ago'],
            'photo' => ['nullable', 'string', 'max:255']
        ]);

        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'numero_telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'code_postal' => $request->code_postal,
            'ville_id' => $request->ville_id,
            'password' => Hash::make($request->password),
            'photo' => $request->photo
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephone' => ['required', 'string', 'max:15'],
            'adresse' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'string', 'max:20'],
            'ville_id' => ['required', 'exists:villes,id'],
            'experience' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_naissance' => ['required', 'date', 'before:18 year ago'],
            'description' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']

        ]);

        $role = 'dogsitter';

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null; 
        }

        $user = User::create([
            'role' => $role,
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'numero_telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'code_postal' => $request->code_postal,
            'ville_id' => $request->ville_id,
            'experience' => $request->experience,
            'password' => Hash::make($request->password),
            'description' => $request->description,
            'photo' => $photoPath
        ]);

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($user->photo); 
            $user->photo = $request->file('photo')->store('photos', 'public');
            $user->save();
        }
        

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('register.abonnement'));
    }
}
