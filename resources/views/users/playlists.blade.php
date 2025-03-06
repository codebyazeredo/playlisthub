<div class="container mt-4">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($playlists['items']) && count($playlists['items']) > 0)
        <table class="table table-striped" id="table-playlists">
            <thead>
            <tr>
                <th>#</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Músicas</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($playlists['items'] as $index => $playlist)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if(isset($playlist['images'][0]['url']))
                            <img src="{{ $playlist['images'][0]['url'] }}" alt="Playlist Image" width="50" height="50">
                        @else
                            <span>Sem imagem</span>
                        @endif
                    </td>
                    <td>{{ $playlist['name'] }}</td>
                    <td>{{ $playlist['tracks']['total'] ?? 0 }} Música(s)</td>
                    <td>
                        <div class="d-flex gap-2">
                            @if(isset($playlist['external_urls']['spotify']))
                                <a href="{{ $playlist['external_urls']['spotify'] }}" target="_blank" class="btn btn-success btn-sm d-flex align-items-center">
                                    <i class="bi bi-spotify"></i>
                                </a>
                            @else
                                <span>Sem link</span>
                            @endif

                            <button class="btn btn-primary btn-sm d-flex align-items-center compartilhar-btn">
                                <i class="bi bi-file-music-fill"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Você ainda não tem playlists no Spotify.</p>
    @endif
</div>

