<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ville;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
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
        $dogsitter = $request->query('dogsitter');
        return view('auth.register', compact('proprietaire', 'villes', 'dogsitter'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //dd($request->all());
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'role' =>['required', 'string', 'max:255']
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Récupérer le fichier téléchargé
            $file = $request->file('photo');
            
            // Créer un nom unique pour la photo
            $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
    
            // Sauvegarder l'image dans le dossier 'public/profile_photos'
            $file->storeAs('storage/app/public/photo', $filename);
    
            // Enregistrer le chemin de la photo dans la variable
            $photoPath = $filename;
        };

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
            'photo' => $photoPath,  // Sauvegarde du nom de la photo dans la base
            'role' => $request->role
        ]);

        event(new Registered($user));

        Auth::login($user);

        if($request->role == 'proprietaire') {
            return redirect()->route('register.dog');
        } else {
            return redirect()->route('register.abonnement');
        }
    }

}
