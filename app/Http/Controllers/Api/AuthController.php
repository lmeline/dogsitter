<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Output\ConsoleOutput;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $output = new ConsoleOutput();
        //$output->writeln("Login attempt with email: " . $request->email);
        //$output->writeln("Login attempt with password: " . $request->password);

        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['identifiant et/ou mot de passe manquant ou incorrect' => $validator->errors()], 400);
            }
            $output->writeln("Validation passed");

            // Vérifiez si l'utilisateur existe et si le mot de passe est correct
            //$user = User::where('email', $request->email)->first();
            $user = User::where('email', "admin@gmail.com")->first();

            $output->writeln("User found: " . ($user ? 'yes' : 'no'));
            $output->writeln("User email: " . $request->email);

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Vérifiez si l'utilisateur est un administrateur (ajustez selon votre logique)
            if ($user->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Créez un token pour l'utilisateur
            $token = $user->createToken('DogsitterCRUD')->plainTextToken;

            return response()->json(['token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}

