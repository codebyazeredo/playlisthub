<div class="container mt-4">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('playlists.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-share"></i> Compartilhar Playlists Selecionadas</button>
        </div>

        @if(isset($playlists['items']) && count($playlists['items']) > 0)
            <table class="table table-bordered table-hover align-middle justify-center" id="table-playlists">
                <thead>
                <tr>
                    <th><input type="checkbox" id="select-all" class="form-check-input"></th>
                    <th>Capa</th>
                    <th colspan="2">Nome</th>
                    <th>Músicas</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($playlists['items'] as $index => $playlist)
                    <tr>
                        <td><input type="checkbox" name="selected_playlists[]" value="{{ $playlist['id'] }}" class="form-check-input" disabled="{{ $playlist['compartilhado'] ? 'true' : '' }}"></td>
                        <td>
                            @if(isset($playlist['images'][0]['url']))
                                <img src="{{ $playlist['images'][0]['url'] }}" alt="Playlist Image" width="50" height="50">
                            @else
                                <span>Sem imagem</span>
                            @endif
                        </td>
                        <td>{{ $playlist['name'] }}</td>
                        <td>
                            @if($playlist['compartilhado'])
                                <span><button class="btn btn-success btn-sm" disabled="true"><i class="bi bi-check-circle"></i> Já compartilhado</button></span>
                            @else
                                <span><button class="btn btn-warning btn-sm" disabled="true"><i class="bi bi-x-circle"></i> Não compartilhada</button></span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm d-flex align-items-center compartilhar-btn">
                                <span>
                                    <i class="bi bi-file-music-fill"></i> {{ $playlist['tracks']['total'] ?? 0 }} Música(s)
                                </span>
                            </button>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                @if(isset($playlist['external_urls']['spotify']))
                                    <a href="{{ $playlist['external_urls']['spotify'] }}" target="_blank" class="btn btn-success btn-sm d-flex align-items-center">
                                        <i class="bi bi-spotify"></i>
                                    </a>
                                @else
                                    <span>Sem link</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem playlists no Spotify.</p>
        @endif
    </form>
</div>
