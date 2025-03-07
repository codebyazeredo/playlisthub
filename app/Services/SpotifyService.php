<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class SpotifyService
{
    protected $baseUrl = 'https://api.spotify.com/v1/';

    public function getUserPlaylists()
    {
        $user = Auth::user();

        if (!$user || !$user->spotify_access_token) {
            return null;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->spotify_access_token,
        ])->get($this->baseUrl . 'me/playlists');

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function getUserInfo()
    {
        $user = Auth::user();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->spotify_access_token,
        ])->get($this->baseUrl . 'me');

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function getPlaylistTracks($playlistId)
    {
        $user = Auth::user();

        if (!$user || !$user->spotify_access_token) {
            return null;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $user->spotify_access_token,
        ])->get($this->baseUrl . "playlists/{$playlistId}/tracks");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
