<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PlaylistHub') }}</title>

        @include('layouts.links')
        <link rel="stylesheet" href="{{ asset('css/users/playlists.css') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased bg-black">
        <div class="font-sans text-gray-900 antialiased bg-dark">
            {{ $slot }}
        </div>

        @include('layouts.scripts')
        <script src="{{ asset('js/users/playlists.js') }}"></script>
    </body>
</html>
