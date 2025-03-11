<div class="py-12 bg-black">
    <div class="container">
        <div class="bg-dark text-white overflow-hidden shadow-lg rounded p-4">
            <h2 class="font-semibold text-xl leading-tight">Minhas Playlists</h2>
            @include('playlisthub.components.dashboard.playlists-dashboard', ['playlists' => $playlists ?? []])
        </div>
    </div>
</div>
