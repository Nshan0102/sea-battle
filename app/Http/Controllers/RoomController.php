<?php

namespace App\Http\Controllers;

use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function create(){
        $user = auth()->user();
        if ($user->opponentRoom){
            $user->opponentRoom->update([
                'opponent_id' => NULL
            ]);
        }
        if ($user->ownerRoom){
            $user->ownerRoom->update([
                'owner_id' => $user->id,
                'opponent_id' => NULL,
                'turn' => $user->id,
                'owner_ships' => NULL,
                'opponent_ships' => NULL,
                'owner_fires' => NULL,
                'opponent_fires' => NULL,
                'owner_shots' => NULL,
                'opponent_shots' => NULL,
                'started_at' => Carbon::now()
            ]);
            return view('room.room')->with([
                'room' => $user->ownerRoom
            ]);
        }
        $joinHash = strtolower(Str::random(16));
        $room = Room::create([
            'join_hash' => $joinHash,
            'owner_id' => $user->id,
            'turn' => $user->id,
            'started_at' => Carbon::now()
        ]);
        return view('room.room')->with([
            'room' => $room
        ]);
    }

    public function join(Room $room){
        $user = auth()->user();
        if (!$room || is_null($room->owner_id) || (!is_null($room->opponent_id) && $room->opponent_id != $user->id)){
            return redirect('home');
        }
        if ($user->ownerRoom && $user->ownerRoom->id !== $room->id){
            $user->ownerRoom->delete();
        }
        if ($user->opponentRoom && $user->opponentRoom->id !== $room->id){
            $user->opponentRoom->update([
                'opponent_id' => NULL
            ]);
        }
        $room->update([
            'opponent_id' => $user->id
        ]);
        return view('room.room')->with([
            'room' => $room
        ]);
    }
}
