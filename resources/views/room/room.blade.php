@extends('layouts.app')
@section('content')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div id="actions-section" class="container">
            <div class="row d-flex justify-content-center mb-2 width-100">
                <div class="d-flex justify-content-center align-items-center flex-column mb-3 mr-3">
                    <div>
                        <button title="Set ship direction from LEFT to RIGHT" data-used="false"
                                class="orientation btn btn-primary" data-orientation="right">
                            <i class="fas fa-arrow-right" style="color: black"></i>
                        </button>
                        <button title="Set ship direction from UP to DOWN" data-used="false"
                                class="orientation btn btn-outline-primary mr-2" data-orientation="down">
                            <i class="fas fa-arrow-down" style="color: black"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3 mr-3">
                    <button class="btn btn-success" data-used="false" onclick="choose(1, 'one-0')" id="one-0">
                        <i class="fas fa-ship"></i>
                    </button>
                    <button class="btn btn-success" data-used="false" onclick="choose(1, 'one-1')" id="one-1">
                        <i class="fas fa-ship"></i>
                    </button>
                    <button class="btn btn-success" data-used="false" onclick="choose(1, 'one-2')" id="one-2">
                        <i class="fas fa-ship"></i>
                    </button>
                    <button class="btn btn-success" data-used="false" onclick="choose(1, 'one-3')" id="one-3">
                        <i class="fas fa-ship"></i>
                    </button>
                </div>
                <div class="mb-3 mr-3">
                    <button class="btn btn-success" data-used="false" onclick="choose(2, 'two-0')" id="two-0">
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                    </button>
                    <button class="btn btn-success" data-used="false" onclick="choose(2, 'two-1')" id="two-1">
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                    </button>
                    <button class="btn btn-success" data-used="false" onclick="choose(2, 'two-2')" id="two-2">
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                    </button>
                </div>
                <div class="mb-3 mr-3">
                    <button class="btn btn-success" data-used="false" onclick="choose(3, 'three-0')" id="three-0">
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                    </button>
                    <button class="btn btn-success" data-used="false" onclick="choose(3, 'three-1')" id="three-1">
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                    </button>
                </div>
                <div class="mb-3 mr-3">
                    <button class="btn btn-success" data-used="false" onclick="choose(4, 'four-0')" id="four-0">
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                        <i class="fas fa-ship"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="container">
            <div id="join-link-section" class="row d-flex justify-content-around align-items-center m-3">
                @if($room->owner->id == $authUser->id)
                    <a href="{{route('join', $room)}}">
                        <h5 class="join-link">{{route('join', $room)}}</h5>
                    </a>
                @endif
            </div>
            <div class="row d-flex justify-content-around align-items-center">
                <div id="auth-section" class="d-flex justify-content-start align-items-center flex-column">
                    <h4>{{$authUser->name}}</h4>
                    ({{$authUser->email}})
                    <table id="owner">
                        <tr>
                            <td data-used="false" data-index=""></td>
                            <td data-used="false" data-index="">1</td>
                            <td data-used="false" data-index="">2</td>
                            <td data-used="false" data-index="">3</td>
                            <td data-used="false" data-index="">4</td>
                            <td data-used="false" data-index="">5</td>
                            <td data-used="false" data-index="">6</td>
                            <td data-used="false" data-index="">7</td>
                            <td data-used="false" data-index="">8</td>
                            <td data-used="false" data-index="">9</td>
                            <td data-used="false" data-index="">10</td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">A</td>
                            <td data-used="false" data-index="1-1"></td>
                            <td data-used="false" data-index="1-2"></td>
                            <td data-used="false" data-index="1-3"></td>
                            <td data-used="false" data-index="1-4"></td>
                            <td data-used="false" data-index="1-5"></td>
                            <td data-used="false" data-index="1-6"></td>
                            <td data-used="false" data-index="1-7"></td>
                            <td data-used="false" data-index="1-8"></td>
                            <td data-used="false" data-index="1-9"></td>
                            <td data-used="false" data-index="1-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">B</td>
                            <td data-used="false" data-index="2-1"></td>
                            <td data-used="false" data-index="2-2"></td>
                            <td data-used="false" data-index="2-3"></td>
                            <td data-used="false" data-index="2-4"></td>
                            <td data-used="false" data-index="2-5"></td>
                            <td data-used="false" data-index="2-6"></td>
                            <td data-used="false" data-index="2-7"></td>
                            <td data-used="false" data-index="2-8"></td>
                            <td data-used="false" data-index="2-9"></td>
                            <td data-used="false" data-index="2-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">C</td>
                            <td data-used="false" data-index="3-1"></td>
                            <td data-used="false" data-index="3-2"></td>
                            <td data-used="false" data-index="3-3"></td>
                            <td data-used="false" data-index="3-4"></td>
                            <td data-used="false" data-index="3-5"></td>
                            <td data-used="false" data-index="3-6"></td>
                            <td data-used="false" data-index="3-7"></td>
                            <td data-used="false" data-index="3-8"></td>
                            <td data-used="false" data-index="3-9"></td>
                            <td data-used="false" data-index="3-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">D</td>
                            <td data-used="false" data-index="4-1"></td>
                            <td data-used="false" data-index="4-2"></td>
                            <td data-used="false" data-index="4-3"></td>
                            <td data-used="false" data-index="4-4"></td>
                            <td data-used="false" data-index="4-5"></td>
                            <td data-used="false" data-index="4-6"></td>
                            <td data-used="false" data-index="4-7"></td>
                            <td data-used="false" data-index="4-8"></td>
                            <td data-used="false" data-index="4-9"></td>
                            <td data-used="false" data-index="4-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">E</td>
                            <td data-used="false" data-index="5-1"></td>
                            <td data-used="false" data-index="5-2"></td>
                            <td data-used="false" data-index="5-3"></td>
                            <td data-used="false" data-index="5-4"></td>
                            <td data-used="false" data-index="5-5"></td>
                            <td data-used="false" data-index="5-6"></td>
                            <td data-used="false" data-index="5-7"></td>
                            <td data-used="false" data-index="5-8"></td>
                            <td data-used="false" data-index="5-9"></td>
                            <td data-used="false" data-index="5-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">F</td>
                            <td data-used="false" data-index="6-1"></td>
                            <td data-used="false" data-index="6-2"></td>
                            <td data-used="false" data-index="6-3"></td>
                            <td data-used="false" data-index="6-4"></td>
                            <td data-used="false" data-index="6-5"></td>
                            <td data-used="false" data-index="6-6"></td>
                            <td data-used="false" data-index="6-7"></td>
                            <td data-used="false" data-index="6-8"></td>
                            <td data-used="false" data-index="6-9"></td>
                            <td data-used="false" data-index="6-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">G</td>
                            <td data-used="false" data-index="7-1"></td>
                            <td data-used="false" data-index="7-2"></td>
                            <td data-used="false" data-index="7-3"></td>
                            <td data-used="false" data-index="7-4"></td>
                            <td data-used="false" data-index="7-5"></td>
                            <td data-used="false" data-index="7-6"></td>
                            <td data-used="false" data-index="7-7"></td>
                            <td data-used="false" data-index="7-8"></td>
                            <td data-used="false" data-index="7-9"></td>
                            <td data-used="false" data-index="7-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">H</td>
                            <td data-used="false" data-index="8-1"></td>
                            <td data-used="false" data-index="8-2"></td>
                            <td data-used="false" data-index="8-3"></td>
                            <td data-used="false" data-index="8-4"></td>
                            <td data-used="false" data-index="8-5"></td>
                            <td data-used="false" data-index="8-6"></td>
                            <td data-used="false" data-index="8-7"></td>
                            <td data-used="false" data-index="8-8"></td>
                            <td data-used="false" data-index="8-9"></td>
                            <td data-used="false" data-index="8-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">I</td>
                            <td data-used="false" data-index="9-1"></td>
                            <td data-used="false" data-index="9-2"></td>
                            <td data-used="false" data-index="9-3"></td>
                            <td data-used="false" data-index="9-4"></td>
                            <td data-used="false" data-index="9-5"></td>
                            <td data-used="false" data-index="9-6"></td>
                            <td data-used="false" data-index="9-7"></td>
                            <td data-used="false" data-index="9-8"></td>
                            <td data-used="false" data-index="9-9"></td>
                            <td data-used="false" data-index="9-10"></td>
                        </tr>
                        <tr>
                            <td data-used="false" data-index="">J</td>
                            <td data-used="false" data-index="10-1"></td>
                            <td data-used="false" data-index="10-2"></td>
                            <td data-used="false" data-index="10-3"></td>
                            <td data-used="false" data-index="10-4"></td>
                            <td data-used="false" data-index="10-5"></td>
                            <td data-used="false" data-index="10-6"></td>
                            <td data-used="false" data-index="10-7"></td>
                            <td data-used="false" data-index="10-8"></td>
                            <td data-used="false" data-index="10-9"></td>
                            <td data-used="false" data-index="10-10"></td>
                        </tr>
                    </table>
                </div>
                <div class="d-block d-md-none width-100">
                    <hr>
                </div>
                <div id="opponent-section"
                     class="justify-content-start align-items-center flex-column {{$room->owner->id == $authUser->id && !$room->opponent ? 'd-none' : "d-flex"}}"
                >
                    @if($room->owner->id == $authUser->id && $room->opponent)
                        <h4 id="opponent-name">{{$room->opponent->name}}</h4>
                        <div>
                            <span id="opponent-email">({{$room->opponent->email}})</span>
                            <a id="add-friend" href="">Add Friend</a>
                        </div>
                    @elseif($room->opponent_id == $authUser->id && $room->owner)
                        <h4 id="opponent-name">{{$room->owner->name}}</h4>
                        <div>
                            <span id="opponent-email">({{$room->owner->email}})</span>
                            <a id="add-friend" href="">Add Friend</a>
                        </div>
                    @else
                        <h4 id="opponent-name"></h4>
                        <div>
                            <span id="opponent-email"></span>
                            <a id="add-friend" class="d-none" href="">Add Friend</a>
                        </div>
                    @endif
                    <table id="opponent">
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent=""></td>
                            <td data-fired="false" data-clean="false" data-opponent="">1</td>
                            <td data-fired="false" data-clean="false" data-opponent="">2</td>
                            <td data-fired="false" data-clean="false" data-opponent="">3</td>
                            <td data-fired="false" data-clean="false" data-opponent="">4</td>
                            <td data-fired="false" data-clean="false" data-opponent="">5</td>
                            <td data-fired="false" data-clean="false" data-opponent="">6</td>
                            <td data-fired="false" data-clean="false" data-opponent="">7</td>
                            <td data-fired="false" data-clean="false" data-opponent="">8</td>
                            <td data-fired="false" data-clean="false" data-opponent="">9</td>
                            <td data-fired="false" data-clean="false" data-opponent="">10</td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">A</td>
                            <td data-fired="false" data-clean="false" data-opponent="1-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="1-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">B</td>
                            <td data-fired="false" data-clean="false" data-opponent="2-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="2-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">C</td>
                            <td data-fired="false" data-clean="false" data-opponent="3-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="3-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">D</td>
                            <td data-fired="false" data-clean="false" data-opponent="4-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="4-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">E</td>
                            <td data-fired="false" data-clean="false" data-opponent="5-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="5-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">F</td>
                            <td data-fired="false" data-clean="false" data-opponent="6-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="6-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">G</td>
                            <td data-fired="false" data-clean="false" data-opponent="7-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="7-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">H</td>
                            <td data-fired="false" data-clean="false" data-opponent="8-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="8-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">I</td>
                            <td data-fired="false" data-clean="false" data-opponent="9-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="9-10"></td>
                        </tr>
                        <tr>
                            <td data-fired="false" data-clean="false" data-opponent="">J</td>
                            <td data-fired="false" data-clean="false" data-opponent="10-1"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-2"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-3"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-4"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-5"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-6"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-7"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-8"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-9"></td>
                            <td data-fired="false" data-clean="false" data-opponent="10-10"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
    @if($room->owner_id == $authUser->id)
        <input type="hidden" id="room_update_url" value="{{route('update-room-as-owner', $room)}}">
    @elseif($room->opponent_id == $authUser->id)
        <input type="hidden" id="room_update_url" value="{{route('update-room-as-opponent', $room)}}">
    @endif
    <input type="hidden" id="fire_url" value="{{route('fire', $room)}}">
@endsection
@push('js')
    <script src="{{asset('js/events.js')}}"></script>
    <script>
        window.Echo.channel('room')
            .listen('.opponent-joined-{{$authUser->id}}', (e) => {
                let name = e.joinedUser.name ? e.joinedUser.name : "";
                let email = e.joinedUser.email ? e.joinedUser.email : "";
                toastr["success"](`Player ${name} has joined!`, 'Hey!', {'progressBar': true});
                $("#opponent-name").html(name);
                $("#opponent-email").html(`( ${email} )`);
                $("#add-friend").removeClass('d-none');
                $("#opponent-section").removeClass('d-none').addClass('d-flex');
            }).listen('.opponent-left-{{$authUser->id}}', (e) => {
            let name = e.userLeft.name ? e.userLeft.name : "";
            toastr["error"](`Player ${name} has left the room!`, 'Oh no!', {'progressBar': true});
            $("#opponent-section").removeClass('d-flex').addClass('d-none');
            $("#opponent-email").html("");
            $("#opponent-name").html("");
            $("#add-friend").addClass('d-none');
        }).listen('.opponent-ready-{{$authUser->id}}', (e) => {
            toastr["success"]('Your opponent is ready to play!', 'Yeah', {'progressBar': true});
        }).listen('.game-ready-{{$room->id}}', (e) => {
            $('#actions-section').hide();
            $('#join-link-section').removeClass('d-flex').addClass('d-none');
            toastr["success"]('You are all done. Lets play', 'Yeah', {'progressBar': true});
        }).listen('.room-deleted-{{$authUser->id}}', (e) => {
            toastr["error"]('Owner deleted this room', 'Oops!', {'progressBar': true});
            setTimeout(function () {
                window.location.reload();
            }, 3000);
        }).listen('.fire-{{$authUser->id}}', (e) => {
            console.log(e);
        });

        $(window).ready(function () {
            $.ajax({
                type: 'GET',
                url: "{{route('get-my-ships', $room)}}",
                dataType: 'JSON',
                success: function (res) {
                    if (res.ships) {
                        ships = res.ships;
                        setAllShips();
                    }
                },
                error: function (error) {
                    toastr["error"]('Error', 'Oops! Something went wrong', {'progressBar': true});
                },
            });
        });

        function updateShips() {
            $.ajax({
                type: 'PUT',
                url: $('#room_update_url').val(),
                dataType: 'JSON',
                data: {
                    @if($authUser->id == $room->owner->id)
                    owner_ships: ships,
                    @elseif($authUser->id == $room->opponent->id)
                    opponent_ships: ships,
                    @endif
                },
                success: function (res) {
                    toastr["success"]('Success', 'You are ready', {'progressBar': true});
                },
                error: function (xhr, status, error) {
                    let message = 'Oops! Something went wrong';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        message = xhr.responseJSON.error;
                    }
                    toastr["error"](message, 'Oops!', {'progressBar': true});
                }
            });
        }
    </script>
@endpush
