@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Minhas Playlists</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($playlists && count($playlists['items']) > 0)
            <ul class="list-group">
                @foreach($playlists['items'] as $playlist)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <img src="{{ $playlist['images'][0]['url'] ?? '' }}" alt="Playlist Image" width="50" height="50">
                        <span>{{ $playlist['name'] }}</span>
                        <a href="{{ $playlist['external_urls']['spotify'] }}" class="btn btn-primary" target="_blank">Abrir no Spotify</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Você ainda não tem playlists no Spotify.</p>
        @endif
    </div>
@endsection
