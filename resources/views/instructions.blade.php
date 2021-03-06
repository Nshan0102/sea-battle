@extends('layouts.app')

@section('content')
    <div class="container" id="instructions-page">
        <div class="row justify-content-center align-items-center w-100">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Instructions</div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-around align-items-center">
                            <ul>
                                <li>
                                    1. Create room
                                </li>
                                <li>
                                    2. Copy the room join link by mouse left click ( <i class="fas fa-mouse"></i> ), and send it whoever you want to play
                                </li>
                                <li>
                                    3. Use arrows ( <i class="fas fa-arrow-right"></i> <i class="fas fa-arrow-down"></i>) to <b>set ships horizontal or vertical</b>
                                </li>
                                <li>
                                    4. After shot, if the <b>ship wasn't found</b>, the cell will be color of green
                                    <i style="color: green" class="fas fa-square"></i>
                                    <i style="color: green" class="fas fa-square"></i>
                                    <i style="color: green" class="fas fa-square"></i>
                                </li>
                                <li>
                                    5. After shot, if the <b>ship is destroyed fully</b> it will be color of red
                                    <i style="color: red" class="fas fa-square"></i>
                                    <i style="color: red" class="fas fa-square"></i>
                                    <i style="color: red" class="fas fa-square"></i>
                                </li>
                                <li>
                                    6. If you shot the opponent ship but <b>it's not fully destroyed</b>
                                    <i style="color: #ff00006b" class="fas fa-square"></i>
                                    <i style="color: #ff00006b" class="fas fa-square"></i>
                                    <i style="color: #ff00006b" class="fas fa-square"></i>
                                </li>
                                <li>
                                    7. You can make cells checked by <b>right click</b> of mouse ( <i class="fas fa-mouse"></i> )
                                    <i style="color: #008000ad" class="fas fa-square"></i>
                                    <i style="color: #008000ad" class="fas fa-square"></i>
                                    <i style="color: #008000ad" class="fas fa-square"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
