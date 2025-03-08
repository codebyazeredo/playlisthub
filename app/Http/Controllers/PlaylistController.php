<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Services\SpotifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PlaylistController extends Controller
{
    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }

    public function showPlaylists(): View
    {
        $playlists = $this->spotifyService->getUserPlaylists();

        if (!$playlists || !isset($playlists['items'])) {
            return view('dashboard', ['playlists' => []])->with('error', 'Nenhuma playlist encontrada.');
        }

        foreach ($playlists['items'] as &$playlist) {
            $existe = Playlist::where('spotify_playlist_id', $playlist['id'])->where('user_id', Auth::id())->exists();
            $playlist['compartilhado'] = $existe;

            $tracks = $this->spotifyService->getPlaylistTracks($playlist['id']);
            $playlist['tracks'] = isset($tracks['items']) && is_array($tracks['items']) ? $tracks['items'] : [];
        }

        return view('dashboard', compact('playlists'));
    }

    public function store(Request $request)
    {
        $selectedPlaylists = $request->input('selected_playlists');

        if (is_array($selectedPlaylists) && count($selectedPlaylists) > 0) {
            foreach ($selectedPlaylists as $playlistId) {
                $spotifyPlaylist = $this->spotifyService->getPlaylistTracks($playlistId);

                if ($spotifyPlaylist) {
                    Playlist::updateOrCreate(
                        [
                            'spotify_playlist_id' => $playlistId,
                            'user_id' => Auth::id(),
                        ],
                        [
                            'name' => $spotifyPlaylist['name'],
                            'description' => $spotifyPlaylist['description'] ?? 'Descrição não disponível',
                        ]
                    );
                }
            }

            return redirect()->route('playlists.index')->with('success', 'Playlists adicionadas com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Nenhuma playlist selecionada!');
        }
    }

    public function removePlaylist(Request $request)
    {
        $selectedPlaylists = $request->input('selected_playlists');

        foreach ($selectedPlaylists as $playlistId) {
            Playlist::where('spotify_playlist_id', $playlistId)
                ->where('user_id', Auth::id())
                ->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Playlist removida com sucesso!');
    }
}
