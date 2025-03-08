<div class="modal fade" id="playlistModal{{ $playlist['id'] }}" tabindex="-1" aria-labelledby="playlistModalLabel{{ $playlist['id'] }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playlistModalLabel{{ $playlist['id'] }}">{{ $playlist['name'] }} - Músicas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(isset($playlist['tracks']) && is_array($playlist['tracks']) && count($playlist['tracks']) > 0)
                    <div class="list-group">
                        @foreach($playlist['tracks'] as $track)
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-3">
                                    @if(isset($track['track']['album']['images'][0]['url']))
                                        <img src="{{ $track['track']['album']['images'][0]['url'] }}" alt="Imagem do álbum" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <img src="https://placehold.co/50x50" alt="Imagem padrão" style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                </div>
                                <div>
                                    <p class="mb-0">{{ $track['track']['name'] ?? 'Nome desconhecido' }}</p>
                                    <small>{{ implode(', ', array_map(fn($artist) => $artist['name'] ?? 'Artista desconhecido', $track['track']['artists'] ?? [])) }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Não há músicas nesta playlist.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
