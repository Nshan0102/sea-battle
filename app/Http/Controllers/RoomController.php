<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomUpdateRequest;
use App\Room;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->opponentRoom) {
            $user->opponentRoom->update([
                'opponent_id' => NULL
            ]);
        }
        if ($user->ownerRoom) {
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

    /**
     * @param Room $room
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function enterTheRoom(Room $room)
    {
        $user = auth()->user();
        event(new \App\Events\UserEvent("hello"));
        if (($user->opponentRoom && $user->opponentRoom->id === $room->id) || ($user->ownerRoom && $user->ownerRoom->id === $room->id)) {
            return view('room.room')->with([
                'room' => $room
            ]);
        }
        return redirect('home');
    }

    /**
     * @param Room $room
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function join(Room $room)
    {
        $user = auth()->user();
        // when room is full
        if (!$room || is_null($room->owner_id) || (!is_null($room->opponent_id) && $room->opponent_id != $user->id)) {
            return redirect('home');
        }
        // when user has own room
        if ($user->ownerRoom) {
            // delete old room
            if ($user->ownerRoom->id !== $room->id) {
                $user->ownerRoom->delete();
            } else {
                // enter the room
                return redirect()->route('enter-the-room', $room);
            }
        }
        // when user was opponent in other room
        if ($user->opponentRoom && $user->opponentRoom->id !== $room->id) {
            $user->opponentRoom->update([
                'opponent_id' => NULL
            ]);
        }
        // set user as opponent for this room
        $room->update([
            'opponent_id' => $user->id
        ]);
        return view('room.room')->with([
            'room' => $room
        ]);
    }

    /**
     * @param RoomUpdateRequest $request
     * @param Room $room
     * @return JsonResponse
     */
    public function updateRoomAsOwner(RoomUpdateRequest $request, Room $room)
    {
        $user = auth()->user();
        if (!$user || $room->owner_id != auth()->user()->id) {
            return response()->json([
                'error' => 'Access denied!'
            ], 403);
        }
        $room->update($request->validated());
        return response()->json([
            'ships' => $room->owner_ships
        ], 200);
    }

    /**
     * @param Room $room
     * @return JsonResponse
     */
    public function getMyShips(Room $room)
    {
        $user = auth()->user();
        if (!$user || $room->owner_id != $user->id && $room->opponent_id != $user->id) {
            return response()->json([
                'error' => 'Access denied!'
            ], 403);
        }
        return response()->json([
            'ships' => $user->id == $room->owner_id ? json_decode($room->owner_ships) : json_decode($room->opponent_ships)
        ], 200);
    }
}
