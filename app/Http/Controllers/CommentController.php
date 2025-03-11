<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $playlistId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:0|max:5',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'playlist_id' => $playlistId,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Comentário adicionado com sucesso!');
    }
}
