<nav class="navbar navbar-expand-lg navbar-dark bg-gray-800 shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <strong>PlaylistHUB</strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
            </ul>

            @include('playlisthub.partials.navbar-dropdown')
        </div>
    </div>
</nav>
