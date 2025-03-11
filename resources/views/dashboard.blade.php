@extends('layouts.app')
@section('header')
    @include('playlisthub.components.dashboard.header-dashboard')
@endsection

@section('content')
    @include('playlisthub.components.dashboard.main-dashboard')
@endsection
