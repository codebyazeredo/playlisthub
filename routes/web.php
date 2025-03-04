<?php

use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyAuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/playlists', [SpotifyController::class, 'showPlaylists'])->name('user.playlists');
    Route::get('/profile', [SpotifyController::class, 'showUserInfo'])->name('user.profile');
});

Route::get('auth/spotify', [SpotifyAuthController::class, 'redirectToSpotify']);
Route::get('auth/spotify/callback', [SpotifyAuthController::class, 'handleSpotifyCallback']);
