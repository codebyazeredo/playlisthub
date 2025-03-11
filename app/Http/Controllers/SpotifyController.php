<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class SpotifyController extends Controller
{
    public function showUserProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuário não autenticado.');
        }

        $playlists = (new \App\Services\SpotifyService)->getUserPlaylists();

        return view('playlisthub.components.profile.show', compact('user', 'playlists'));
    }
}

