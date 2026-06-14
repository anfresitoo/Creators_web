<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Get supports for the authenticated user's creator.
     */
    public function index(Request $request)
    {
        $creator = $request->user()->creator;
        
        if (!$creator) {
            return response()->json(['message' => 'Perfil de creador no encontrado'], 404);
        }

        $supports = $creator->supports()->latest()->paginate(15);

        return response()->json($supports);
    }

    /**
     * Store a new support.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'creator_id' => 'required|exists:creators,id',
            'supporter_name' => 'required|string|max:100',
            'message' => 'nullable|string|max:1000',
            'amount' => 'required|numeric|min:1|max:100',
        ]);

        $support = Support::create($validated);

        return response()->json([
            'message' => 'Apoyo recibido exitosamente',
            'support' => $support,
        ], 201);
    }
}
