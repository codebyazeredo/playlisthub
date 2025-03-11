<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="spotify-token" content="{{ Auth::user()->spotify_access_token }}">

        <title>{{ config('app.name', 'PlaylistHub') }}</title>

        @include('layouts.links')

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-dark">
    <x-banner/>

    <div class="min-h-screen bg-gray-100">
        @include('playlisthub.navbar')

        <header class="bg-dark">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-white leading-tight">
                    @yield('header')
                </h2>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    @include('playlisthub.footer')

    @stack('modals')
    @include('layouts.scripts')
    </body>
</html>
