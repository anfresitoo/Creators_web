<?php

namespace App\Http\Controllers;

use App\Models\CreatorLink;
use Illuminate\Http\Request;

class CreatorLinkController extends Controller
{
    /**
     * Get links for the authenticated user's creator profile.
     */
    public function index(Request $request)
    {
        $creator = $request->user()->creator;

        if (!$creator) {
            return response()->json(['message' => 'Perfil de creador no encontrado'], 404);
        }

        return response()->json([
            'links' => $creator->links()->orderBy('position')->get(),
        ]);
    }

    /**
     * Store a new link.
     */
    public function store(Request $request)
    {
        $creator = $request->user()->creator;

        if (!$creator) {
            return response()->json(['message' => 'Perfil de creador no encontrado'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'url' => 'required|url|max:500',
        ]);

        $nextPosition = $creator->links()->max('position') ?? 0;

        $link = $creator->links()->create([
            'title' => $validated['title'],
            'url' => $validated['url'],
            'position' => $nextPosition + 1,
        ]);

        return response()->json([
            'message' => 'Enlace creado exitosamente',
            'link' => $link,
        ], 201);
    }

    /**
     * Update a link.
     */
    public function update(Request $request, CreatorLink $link)
    {
        // Manual authorization: verify the link belongs to the authenticated user's creator profile
        $creator = $request->user()->creator;
        if (!$creator || $link->creator_id !== $creator->id) {
            abort(403, 'No tienes permiso para editar este enlace.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'url' => 'required|url|max:500',
        ]);

        $link->update($validated);

        return response()->json([
            'message' => 'Enlace actualizado exitosamente',
            'link' => $link,
        ]);
    }

    /**
     * Delete a link.
     */
    public function destroy(Request $request, CreatorLink $link)
    {
        // Manual authorization: verify the link belongs to the authenticated user's creator profile
        $creator = $request->user()->creator;
        if (!$creator || $link->creator_id !== $creator->id) {
            abort(403, 'No tienes permiso para eliminar este enlace.');
        }

        $link->delete();

        return response()->json([
            'message' => 'Enlace eliminado exitosamente',
        ]);
    }
}
