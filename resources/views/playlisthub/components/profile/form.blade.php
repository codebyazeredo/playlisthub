<div class="card-body mt-10">
    <div class="row align-items-center">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nome do perfil</label>
                    <input type="text" class="form-control bg-secondary text-white" id="name"
                           value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail de registro</label>
                    <input type="text" class="form-control bg-secondary text-white" id="email"
                           value="{{ Auth::user()->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="spotify_id" class="form-label">ID do Spotify</label>
                    <div class="input-group">
                        <input type="password" class="form-control bg-secondary text-white" id="spotify_id"
                               value="{{ Auth::user()->spotify_id }}" readonly>
                        <button type="button" class="btn btn-outline-secondary" id="toggleSpotifyId">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="playlists" class="form-label">Quantidade de Playlists</label>
                    <input type="text" class="form-control bg-secondary text-white" id="playlists"
                           value="{{ count($playlists['items'] ?? []) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="created_at" class="form-label">Data de Cadastro</label>
                    <input type="text" class="form-control bg-secondary text-white" id="created_at"
                           value="{{ Auth::user()->created_at->format('d/m/Y') }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="spotify_token" class="form-label">Token de Acesso</label>
                    <div class="input-group">
                        <input type="password" class="form-control bg-secondary text-white text-center" id="spotify_token"
                               value="{{ Auth::user()->spotify_access_token }}" readonly>
                        <button type="button" class="btn btn-outline-secondary" id="toggleSpotifyToken">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
            <span class="mb-3"><strong>Imagem do Avatar</strong></span>

            <img src="{{ Auth::user()->spotify_avatar }}" alt="Avatar do Usuário" class="rounded-circle mb-3"
                 width="250" height="250">

            <a href="https://open.spotify.com/user/{{ Auth::user()->spotify_id }}" target="_blank" class="btn btn-success">
                <span>
                    Ver Perfil no Spotify <i class="bi bi-box-arrow-up-right"></i>
                </span>
            </a>
        </div>

    </div>
</div>

<script src="{{ asset('js/profile/form.js') }}"></script>
