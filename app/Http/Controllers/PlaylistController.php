<?php

namespace App\Http\Controllers;

use App\Models\Genre;
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
        $genres = Genre::all();

        if (!$playlists || !isset($playlists['items'])) {
            return view('dashboard', ['playlists' => []])->with('error', 'Nenhuma playlist encontrada.');
        }

        foreach ($playlists['items'] as &$playlist) {
            $existe = Playlist::where('spotify_playlist_id', $playlist['id'])
                ->where('user_id', Auth::id())
                ->exists();

            $playlist['compartilhado'] = $existe;

            $tracks = $this->spotifyService->getPlaylistTracks($playlist['id']);
            $playlist['tracks'] = isset($tracks['items']) && is_array($tracks['items']) ? $tracks['items'] : [];
        }

        return view('dashboard', compact('playlists', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'rating' => 'required|integer|min:1|max:5',
            'observation' => 'nullable|string',
        ]);

        $playlist = Playlist::find($request->playlist_id);
        $playlist->genres()->sync($request->genres);

        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->playlist_id = $playlist->id;
        $comment->rating = $request->rating;
        $comment->observation = $request->observation;
        $comment->save();

        return redirect()->route('playlists.index')->with('success', 'Playlist compartilhada com sucesso!');
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
