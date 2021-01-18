@extends('layouts.app')

@section('content')
    <div class="container" id="home-page">
        <div>
            <a href="{{ route('sea-battle.home') }}">
                <img width="20%" src="{{ asset('img/games/sea-battle/logo.png') }}" alt="Sea Battle">
            </a>
        </div>
    </div>
@endsection
