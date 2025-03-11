<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'genre_playlist');
    }
}
