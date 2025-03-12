<link rel="stylesheet" href="{{ asset('css/dashboard/playlists.css') }}">

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
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-hover align-middle justify-center" id="table-playlists">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all" class="form-check-input"></th>
                        <th>Capa</th>
                        <th>Nome</th>
                        <th>Músicas</th>
                        <th style="min-width: 140px">Avaliação</th>
                        <th>Observação</th>
                        <th>Gêneros</th>
                        <th colspan="2">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($playlists['items'] as $index => $playlist)
                        <tr>
                            <td><input type="checkbox" name="selected_playlists[]" value="{{ $playlist['id'] }}" class="form-check-input playlist-checkbox" {{ $playlist['compartilhado'] ? 'disabled' : '' }}></td>
                            <td>
                                @if(isset($playlist['images'][0]['url']))
                                    <img src="{{ $playlist['images'][0]['url'] }}" alt="Playlist Image" width="50" height="50">
                                @else
                                    <span>Sem imagem</span>
                                @endif
                            </td>
                            <td>{{ $playlist['name'] }}</td>
                            <td>
                                <span>
                                    <i class="bi bi-file-music-fill"></i> {{ count($playlist['tracks']) }} Música(s)
                                </span>
                            </td>
                            <td>
                                <div class="rating">
                                    <input type="radio" id="star5-{{ $playlist['id'] }}" name="rate[{{ $playlist['id'] }}]" value="5" />
                                    <label for="star5-{{ $playlist['id'] }}" title="5"></label>

                                    <input type="radio" id="star4-{{ $playlist['id'] }}" name="rate[{{ $playlist['id'] }}]" value="4" />
                                    <label for="star4-{{ $playlist['id'] }}" title="4"></label>

                                    <input type="radio" id="star3-{{ $playlist['id'] }}" name="rate[{{ $playlist['id'] }}]" value="3" />
                                    <label for="star3-{{ $playlist['id'] }}" title="3"></label>

                                    <input type="radio" id="star2-{{ $playlist['id'] }}" name="rate[{{ $playlist['id'] }}]" value="2" />
                                    <label for="star2-{{ $playlist['id'] }}" title="2"></label>

                                    <input type="radio" id="star1-{{ $playlist['id'] }}" name="rate[{{ $playlist['id'] }}]" value="1" />
                                    <label for="star1-{{ $playlist['id'] }}" title="1"></label>
                                </div>
                            </td>
                            <td>
                                <textarea name="observation[{{ $playlist['id'] }}]" class="form-control form-control-sm bg-light" rows="1"></textarea>
                            </td>
                            <td>
                                <select name="genres[{{ $playlist['id'] }}][]" class="form-control form-control-sm genres-select" id="genres{{ $playlist['id'] }}" multiple="multiple" style="max-width: 150px">
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
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
                            <td>
                                @if($playlist['compartilhado'])
                                    <button class="btn btn-success btn-sm" disabled><span><i class="bi bi-check-circle"></i> Já compartilhada</span></button>
                                @else
                                    <button class="btn btn-danger btn-sm" disabled><span><i class="bi bi-x-circle"></i> Não Compartilhada</span></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-white">Você ainda não tem playlists no Spotify.</p>
        @endif
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#select-all').on('change', function() {
            var isChecked = $(this).prop('checked');

            $('input[name="selected_playlists[]"]:not(:disabled)').each(function() {
                $(this).prop('checked', isChecked);

                var playlistId = $(this).val();
                if (isChecked) {
                    $('#genres' + playlistId).prop('required', true);
                } else {
                    $('#genres' + playlistId).prop('required', false);
                }
            });
        });

        $('input[name="selected_playlists[]"]').on('change', function() {
            var playlistId = $(this).val();
            var isChecked = $(this).prop('checked');

            if (isChecked) {
                $('#genres' + playlistId).prop('required', true);
            } else {
                $('#genres' + playlistId).prop('required', false);
            }
        });

        @foreach($playlists['items'] as $playlist)
            $('#genres{{ $playlist['id'] }}').select2();
        @endforeach
    });
</script>
