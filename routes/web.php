<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyAuthController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PlaylistController::class, 'showPlaylists'])->name('dashboard');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('auth/spotify', [SpotifyAuthController::class, 'redirectToSpotify']);
Route::get('auth/spotify/callback', [SpotifyAuthController::class, 'handleSpotifyCallback']);

Route::post('/playlists/store', [PlaylistController::class, 'store'])->name('playlists.store');
Route::post('/playlists/remove', [PlaylistController::class, 'removePlaylist'])->name('playlists.remove');

Route::post('spotify/store', [SpotifyController::class, 'store'])->name('spotify.store');

Route::get('/entrar-como-convidado', function () {
    return redirect()->route('welcome');
})->name('entrar-como-convidado');

Route::post('/playlists/{playlist}/comment', [CommentController::class, 'store'])->name('comments.store');

Route::get('/profile', [SpotifyController::class, 'showUserProfile'])->name('profile');
