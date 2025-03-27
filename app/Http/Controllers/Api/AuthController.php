<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{  
            $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $user = User::where('email', $request->email)->first();

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
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
       
    }
}

