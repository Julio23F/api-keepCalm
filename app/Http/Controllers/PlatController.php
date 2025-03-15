<?php

namespace App\Http\Controllers;

use App\Models\Plat;
use Illuminate\Http\Request;

class PlatController extends Controller
{
    /**
     * Créer un nouveau plat.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:plats,name',
            'description' => 'nullable|string',
            'type' => 'required|string|max:100',
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);

        $plat = Plat::create($validated);

        return response()->json([
            'message' => 'Plat créé avec succès',
            'plat' => $plat
        ], 201);
    }

    /**
     * Mettre à jour un plat existant.
     */
    public function update(Request $request, $id)
    {
        $plat = Plat::find($id);

        if (!$plat) {
            return response()->json(['message' => 'Plat non trouvé'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:plats,name,' . $id,
            'description' => 'nullable|string',
            'type' => 'required|string|max:100',
            'entreprise_id' => 'required|exists:entreprises,id',
        ]);

        $plat->update($validated);

        return response()->json([
            'message' => 'Plat mis à jour avec succès',
            'plat' => $plat
        ]);
    }

    /**
     * Supprimer un plat.
     */
    public function destroy($id)
    {
        $plat = Plat::find($id);

        if (!$plat) {
            return response()->json(['message' => 'Plat non trouvé'], 404);
        }

        $plat->delete();

        return response()->json(['message' => 'Plat supprimé avec succès']);
    }
}
