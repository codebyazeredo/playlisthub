<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SpotifyAuthController extends Controller
{
    public function redirectToSpotify()
    {
        return Socialite::driver('spotify')->redirect();
    }

    public function handleSpotifyCallback()
    {
        try {
            $spotifyUser = Socialite::driver('spotify')->user();

            $accessToken = $spotifyUser->token;
            $refreshToken = $spotifyUser->refreshToken;

            $user = User::where('spotify_id', $spotifyUser->getId())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $spotifyUser->getName() ?? 'Usuário Spotify',
                    'email' => $spotifyUser->getEmail() ?? 'spotify_' . $spotifyUser->getId() . '@noemail.com',
                    'spotify_id' => $spotifyUser->getId(),
                    'spotify_avatar' => $spotifyUser->getAvatar(),
                    'spotify_access_token' => $accessToken,
                    'spotify_refresh_token' => $refreshToken,
                ]);
            } else {
                $user->update([
                    'spotify_access_token' => $accessToken,
                    'spotify_refresh_token' => $refreshToken,
                ]);
            }

            Auth::login($user);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Falha na autenticação com o Spotify.');
        }
    }
}
