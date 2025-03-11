<x-guest-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100 bg-black">
        <x-authentication-card class="w-full sm:w-96">
            <x-validation-errors class="mb-4"/>

            @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
            @endsession

            <div class="text-center mb-6 ">
                <h2 class="text-2xl font-bold text-white">Bem-vindo(a) ao PlaylistHub!</h2>
                <p class="text-sm text-white">Descubra aqui a sua nova música favorita.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <input type="hidden" id="login_via_spotify" name="login_via_spotify" value="false">

                <div class="flex flex-col items-center gap-4 mt-4">
                    <a class="align-middle" href="#"
                       onclick="event.preventDefault(); window.location.href='{{ url('auth/spotify') }}';"
                       class="w-full text-center">
                        @include('playlisthub.components.welcome.spotify-button')
                    </a>

                    <span class="text-white">ou, se preferir</span>

                    <button class="btn btn-warning text-white"
                            onclick="event.preventDefault(); window.location.href='{{ route('entrar-como-convidado') }}';"
                            class="w-full">
                        <i class="bi bi-person-walking"></i> {{ __('Entrar como Convidado') }}
                    </button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
