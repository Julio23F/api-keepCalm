<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Foyer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Register
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => "ADMIN",
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 201);
    }



    public function member(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'birth_date' => 'required|integer|min:16|max:60',
            'status' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $email = $request->filled('email') ? $request->email : "keepCalm@gmail.com";

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name, 
            'email' => $email,
            'password' => bcrypt(Str::random(10)),
        ]);

        return response()->json([
            'user' => $user,
        ], 201);
    }


    // Login
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants fournis sont incorrects.'],
            ]);
        }
    
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 200);
    }

    // logout
    public function logout(Request $request) {
        $user = $request->user();
    
        // Révoquer tous les tokens de l'utilisateur
        $user->tokens()->delete();
    
        return response()->json([
            'message' => 'Déconnexion réussie.'
        ], 200);
    }
}
