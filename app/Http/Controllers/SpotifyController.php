<?php

namespace App\Http\Controllers;

use App\Services\SpotifyService;
use Illuminate\Support\Facades\Auth;

class SpotifyController extends Controller
{
    protected $spotifyService;

    public function __construct(SpotifyService $spotifyService)
    {
        $this->spotifyService = $spotifyService;
    }

    public function showPlaylists()
    {
        $user = Auth::user();

        $playlists = $this->spotifyService->getUserPlaylists($user->spotify_access_token);

        if (!$playlists) {
            return redirect()->route('dashboard')->with('error', 'Falha ao buscar playlists.');
        }

        return view('users.playlists', compact('playlists'));
    }

    public function showUserInfo()
    {
        $user = Auth::user();

        $userInfo = $this->spotifyService->getUserInfo($user->spotify_access_token);

        if (!$userInfo) {
            return redirect()->route('dashboard')->with('error', 'Falha ao buscar informações do usuário.');
        }

        return view('users.profile', compact('userInfo'));
    }
}

