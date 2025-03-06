<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'spotify_id' => 'required|unique:playlists,spotify_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_url' => 'nullable|url',
            'is_public' => 'boolean'
        ]);

        $playlist = Playlist::create([
            'user_id' => Auth::id(),
            'spotify_id' => $request->spotify_id,
            'name' => $request->name,
            'description' => $request->description ?? null,
            'cover_url' => $request->cover_url ?? null,
            'is_public' => $request->is_public ?? false,
        ]);

        return response()->json([
            'message' => 'Playlist compartilhada com sucesso!',
            'playlist' => $playlist
        ]);
    }
}
