<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyAuthController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SpotifyController::class, 'showPlaylists'])->name('dashboard');
});

Route::get('auth/spotify', [SpotifyAuthController::class, 'redirectToSpotify']);
Route::get('auth/spotify/callback', [SpotifyAuthController::class, 'handleSpotifyCallback']);
Route::post('/playlists/store', [PlaylistController::class, 'store'])->name('playlists.store');
Route::post('spotify/store', [SpotifyController::class, 'store'])->name('spotify.store');
