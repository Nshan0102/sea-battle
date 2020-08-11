@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="d-flex flex-row justify-content-around align-items-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($user->ownerRoom)
                            <a class="btn btn-primary" href="{{route('enter-the-room', $user->ownerRoom)}}">
                                Join to last game
                            </a>
                        @elseif($user->opponentRoom)
                            <a class="btn btn-primary" href="{{route('enter-the-room', $user->opponentRoom)}}">
                                Join to last game
                            </a>
                        @endif
                        <a class="btn btn-info" href="{{route('play', ['force' => true])}}">Create new room</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
