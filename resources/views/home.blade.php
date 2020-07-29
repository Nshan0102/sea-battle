@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($user->ownerRoom)
                        <a href="{{route('enter-the-room', $user->ownerRoom)}}">
                            Join to game
                        </a>
                    @elseif($user->opponentRoom)
                        <a href="{{route('enter-the-room', $user->opponentRoom)}}">
                            Join to game
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
