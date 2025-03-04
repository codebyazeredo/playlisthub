@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Meu Perfil</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $userInfo['display_name'] ?? 'Nome não disponível' }}</h5>
                <p class="card-text">{{ $userInfo['email'] ?? 'Email não disponível' }}</p>
                <img src="{{ $userInfo['images'][0]['url'] ?? '' }}" alt="Avatar" width="100" class="rounded-circle">
            </div>
        </div>
    </div>
@endsection
