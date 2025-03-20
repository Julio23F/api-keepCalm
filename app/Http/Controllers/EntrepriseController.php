<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

class EntrepriseController extends Controller
{
    public function index()
    {
        return response()->json(Entreprise::all());
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string',
    //         'nombreEmployes' => 'required|string',
    //     ]);

    //     $entreprise = Entreprise::create($validated);

    //     return response()->json([
    //         'message' => 'Entreprise créée avec succès',
    //         'entreprise' => $entreprise
    //     ], 201);
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nombreEmployes' => 'required|string',
        ]);

        $entreprise = Entreprise::create($validated);

        $user = auth()->user();
        $user->entreprise_id = $entreprise->id;
        $user->save();

        return response()->json([
            'message' => 'Entreprise créée avec succès',
            'entreprise' => $entreprise
        ], 201);
    }


    public function show($id)
    {
        return response()->json(Entreprise::findOrFail($id));
    }

    public function update(Request $request, Entreprise $entreprise) {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|string,' . $entreprise->id,
            ]);

            $entreprise->update($validated);

            return response()->json([
                'message' => 'Entreprise mise à jour avec succès',
                'entreprise' => $entreprise
            ]);
        } catch (Exception $e) {
            Log::error('Erreur inconnue: ' . $e->getMessage());
            return response()->json([
                'error' => 'Erreur interne du serveur',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Entreprise $entreprise)
    {
        $entreprise->delete();

        return response()->json(['message' => 'Entreprise supprimée avec succès']);
    }
}
