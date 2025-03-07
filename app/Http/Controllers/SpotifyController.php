<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SpotifyController extends Controller
{
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

