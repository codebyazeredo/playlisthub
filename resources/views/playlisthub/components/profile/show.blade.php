@extends('layouts.app')
    @section('header')
        @include('playlisthub.components.profile.header-profile')
    @endsection

    @section('content')
        @include('playlisthub.components.profile.user-info')
    @endsection
