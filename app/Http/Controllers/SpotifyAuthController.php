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
            $user = User::where('spotify_id', $spotifyUser->getId())->first();

            if (!$user) {
                $user = User::where('email', $spotifyUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $spotifyUser->getName() ?? 'Usuário Spotify',
                        'email' => $spotifyUser->getEmail() ?? 'spotify_' . $spotifyUser->getId() . '@noemail.com',
                        'password' => bcrypt(uniqid()),
                        'spotify_id' => $spotifyUser->getId(),
                        'spotify_avatar' => $spotifyUser->getAvatar(),
                    ]);
                } else {
                    $user->update([
                        'spotify_id' => $spotifyUser->getId(),
                        'spotify_avatar' => $spotifyUser->getAvatar(),
                    ]);
                }
            }

            Auth::login($user);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Falha na autenticação com o Spotify.');
        }
    }
}
