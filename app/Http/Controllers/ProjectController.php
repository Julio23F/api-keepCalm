<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Lister tous les projets.
     */
    public function index()
    {
        return response()->json(Project::with('entreprise', 'users')->get());
    }

    /**
     * Afficher un projet spécifique.
     */
    public function show($id)
    {
        $project = Project::with('entreprise', 'users')->find($id);
        if (!$project) {
            return response()->json(['message' => 'Projet non trouvé'], 404);
        }
        return response()->json($project);
    }

    /**
     * Créer un nouveau projet.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:projects,name',
            'entreprise_id' => 'required|exists:entreprises,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'entreprise_id' => $validated['entreprise_id'],
        ]);

        // Attacher plusieurs utilisateurs au projet
        $project->users()->attach($validated['user_ids']);

        return response()->json([
            'message' => 'Projet créé avec succès',
            'project' => $project->load('users')
        ], 201);
    }

    /**
     * Mettre à jour un projet existant.
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Projet non trouvé'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|unique:projects,name,' . $id,
            'entreprise_id' => 'required|exists:entreprises,id',
            'users' => 'array',
            'users.*' => 'exists:users,id',
        ]);

        $project->update([
            'name' => $validated['name'],
            'entreprise_id' => $validated['entreprise_id'],
        ]);

        if (isset($validated['users'])) {
            $project->users()->sync($validated['users']);
        }

        return response()->json([
            'message' => 'Projet mis à jour avec succès',
            'project' => $project->load('entreprise', 'users'),
        ]);
    }

    /**
     * Supprimer un projet.
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Projet non trouvé'], 404);
        }

        $project->delete();
        return response()->json(['message' => 'Projet supprimé avec succès']);
    }
}
