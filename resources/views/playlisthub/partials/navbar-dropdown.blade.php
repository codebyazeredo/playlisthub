<style>
    .dropdown-item {
        transition: color 0.3s ease;
    }

    .dropdown-item:hover {
        color: black !important;
        background-color: white !important;
    }
</style>

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ \Illuminate\Support\Facades\Auth::user()->spotify_avatar }}" alt="User  Avatar" width="30" height="30" class="rounded-circle me-2">
        {{ Auth::user()->name }}
    </button>
    <ul class="dropdown-menu dropdown-menu-end bg-dark text-white" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item text-white hover-text-black" href="{{ route('profile.show') }}">Perfil</a></li>
        <li><a class="dropdown-item text-white hover-text-black" href="{{ route('api-tokens.index') }}">Tokens API</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-white hover-text-black">Sair</button>
            </form>
        </li>
    </ul>
</div>
