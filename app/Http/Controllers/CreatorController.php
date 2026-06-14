<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CreatorController extends Controller
{
    /**
     * Show the creator's public page.
     */
    public function show(string $slug)
    {
        $creator = Creator::where('slug', $slug)
            ->with(['links' => function ($query) {
                $query->orderBy('position');
            }, 'supports' => function ($query) {
                $query->latest();
            }])
            ->firstOrFail();

        return Inertia::render('Creator/PublicPage', [
            'creator' => [
                'id' => $creator->id,
                'name' => $creator->display_name ?: $creator->user->name,
                'slug' => $creator->slug,
                'bio' => $creator->bio,
                'avatar_url' => $creator->avatar_url,
                'links' => $creator->links->toArray(),
                'supports' => $creator->supports->toArray(),
                'total_supports' => $creator->getTotalSupports(),
                'total_amount' => $creator->getTotalAmount(),
            ],
        ]);
    }

    /**
     * Update the creator's profile.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        
        $validated = $request->validate([
            'slug' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-z0-9_-]+$/',
                'unique:creators,slug,' . ($user->creator?->id ?? 'NULL') . ',id',
            ],
            'display_name' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:500',
            'avatar_url' => 'nullable|url',
        ]);

        if (!$user->creator) {
            $user->creator()->create([
                'slug' => $validated['slug'],
                'display_name' => $validated['display_name'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'avatar_url' => $validated['avatar_url'] ?? null,
            ]);

            // Marcar al usuario como creador
            $user->update(['is_creator' => true]);
        } else {
            $user->creator->update($validated);
        }

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Show the creator dashboard.
     */
    public function dashboard()
    {
        $user = auth()->user();
        $creator = $user->creator;

        if (!$creator) {
            return Inertia::render('Creator/SetupCreator');
        }

        return Inertia::render('Creator/DashboardCreator', [
            'creator' => [
                'id' => $creator->id,
                'slug' => $creator->slug,
                'display_name' => $creator->display_name,
                'bio' => $creator->bio,
                'avatar_url' => $creator->avatar_url,
            ],
            'links' => $creator->links()->orderBy('position')->get()->toArray(),
            'supports' => $creator->supports()->latest()->get()->toArray(),
            'total_supports' => $creator->getTotalSupports(),
            'total_amount' => $creator->getTotalAmount(),
        ]);
    }
}
