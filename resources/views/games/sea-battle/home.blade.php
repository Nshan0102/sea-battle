@extends('layouts.app')

@section('content')
    <div class="container" id="home-page">
        <div class="d-flex flex-row justify-content-around align-items-center">

            @if($user->ownerRoom)
                <a class="btn btn-primary" href="{{route('sea-battle.enter-the-room', $user->ownerRoom)}}">
                    Join to last game
                </a>
            @elseif($user->opponentRoom)
                <a class="btn btn-primary" href="{{route('sea-battle.enter-the-room', $user->opponentRoom)}}">
                    Join to last game
                </a>
            @endif
            <a class="btn btn-info ml-1" href="{{route('sea-battle.play', ['force' => true])}}">
                Create new room
            </a>
        </div>
        <div class="row justify-content-center align-items-center">
            <h3>History list is empty</h3>
        </div>
    </div>
@endsection
