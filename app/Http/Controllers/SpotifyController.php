<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Services\SpotifyService;
use Illuminate\Support\Facades\Auth;

class SpotifyController extends Controller
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

        return view('dashboard', compact('playlists'));
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

