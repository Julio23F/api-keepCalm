<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Foyer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'sex' => 'required|string|max:255',
                'birth_date' => 'required|integer|min:16|max:60',
                'status' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
            ]);
    
            $email = $request->filled('email') ? $request->email : "keepcalm" . Str::random(5) . "@gmail.com";
    
            if (!auth()->check()) {
                return response()->json(['error' => 'Utilisateur non authentifié'], 401);
            }
    
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $email,
                'entreprise_id' => auth()->user()->entreprise_id,
                'password' => bcrypt(Str::random(10)),
            ]);
    
            return response()->json([
                'message' => 'Utilisateur créé avec succès',
                'user' => $user,
            ], 201);
    
        } catch (Exception $e) {
            Log::error('Erreur inconnue: ' . $e->getMessage());
            return response()->json([
                'error' => 'Erreur interne du serveur',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function update(Request $request, User $user) {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|string,' . $user->id,
            ]);

            $user->update($validated);

            return response()->json([
                'message' => 'Membre mise à jour avec succès',
                'user' => $user
            ]);
        } catch (Exception $e) {
            Log::error('Erreur inconnue: ' . $e->getMessage());
            return response()->json([
                'error' => 'Erreur interne du serveur',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Membre supprimée avec succès']);
    }


    
}
