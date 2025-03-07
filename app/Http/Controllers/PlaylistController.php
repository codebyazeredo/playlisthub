<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PlaylistController extends Controller
{
    public function store(Request $request)
    {
        $selectedPlaylists = $request->input('selected_playlists');


        foreach ($selectedPlaylists as $playlistId) {

            $spotifyPlaylist = $this->getSpotifyPlaylistDetails($playlistId);

            if ($spotifyPlaylist) {
                Playlist::updateOrCreate(
                    [
                        'spotify_playlist_id' => $playlistId,
                        'user_id' => Auth::id(),
                    ],
                    [
                        'name' => $spotifyPlaylist['name'],
                        'description' => $spotifyPlaylist['description'] ?? 'Descrição não disponível',
                        'image_url' => $spotifyPlaylist['images'][0]['url'] ?? null,
                        'track_count' => $spotifyPlaylist['tracks']['total'],
                        'external_url' => $spotifyPlaylist['external_urls']['spotify'],
                        'owner' => $spotifyPlaylist['owner']['display_name'],
                    ]
                );
            }
        }

        return redirect()->route('dashboard')->with('success', 'Playlists selecionadas salvas com sucesso!');
    }

    private function getSpotifyPlaylistDetails($playlistId)
    {

        $accessToken = Auth::user()->spotify_access_token;

        if (!$accessToken) {
            return null;
        }

        $response = Http::withToken($accessToken)->get("https://api.spotify.com/v1/playlists/{$playlistId}");
        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
