<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        return response()->json(Entreprise::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:entreprises,name',
        ]);

        $entreprise = Entreprise::create($validated);

        return response()->json([
            'message' => 'Entreprise créée avec succès',
            'entreprise' => $entreprise
        ], 201);
    }

    public function show($id)
    {
        return response()->json(Entreprise::findOrFail($id));
    }

    public function update(Request $request, Entreprise $entreprise)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|unique:entreprises,name,' . $entreprise->id,
        ]);

        $entreprise->update($validated);

        return response()->json([
            'message' => 'Entreprise mise à jour avec succès',
            'entreprise' => $entreprise
        ]);
    }

    public function destroy(Entreprise $entreprise)
    {
        $entreprise->delete();

        return response()->json(['message' => 'Entreprise supprimée avec succès']);
    }
}
