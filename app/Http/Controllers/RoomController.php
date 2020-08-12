<?php

namespace App\Http\Controllers;

use App\Events\GameReady;
use App\Events\OpponentJoined;
use App\Events\OpponentReady;
use App\Http\Requests\FireRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Room;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        if ($user->opponentRoom) {
            $user->opponentRoom->update([
                'opponent_id' => NULL
            ]);
        }
        if ($user->ownerRoom && $request->force) {
            $user->ownerRoom->delete();
        } elseif ($user->ownerRoom) {
            return redirect(route('enter-the-room', $user->ownerRoom));
        }
        $joinHash = strtolower(Str::random(16));
        $room = Room::create([
            'join_hash' => $joinHash,
            'owner_id' => $user->id,
            'turn' => $user->id,
            'started_at' => Carbon::now()
        ]);
        return redirect(route('enter-the-room', $room));
    }

    /**
     * @param Room $room
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function enterTheRoom(Room $room)
    {
        $user = auth()->user();
        if (($user->opponentRoom && $user->opponentRoom->id === $room->id) || ($user->ownerRoom && $user->ownerRoom->id === $room->id)) {
            if ($room->owner->id !== $user->id) {
                event(new OpponentJoined($room->owner, $user));
            } else {
                event(new OpponentJoined($user, $room->owner));
            }
            return view('room.room')->with([
                'authUser' => $user,
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
            return redirect('home')->with([
                'error' => [
                    'header' => 'Oops!',
                    'message' => 'This room is full!'
                ]
            ]);
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
        event(new OpponentJoined($room->owner, $user));
        return view('room.room')->with([
            'authUser' => $user,
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
        if (!$user || $room->owner_id != $user->id || $room->ready) {
            return response()->json([
                'error' => 'Access denied!'
            ], 403);
        }
        $room->update($request->validated());
        if ($room->opponent_ships) {
            $room->update(['ready' => true]);
            event(new GameReady($room));
        }
        return response()->json([
            'ships' => $room->owner_ships
        ], 200);
    }

    /**
     * @param RoomUpdateRequest $request
     * @param Room $room
     * @return JsonResponse
     */
    public function updateRoomAsOpponent(RoomUpdateRequest $request, Room $room)
    {
        $user = auth()->user();
        if (!$user || $room->opponent_id != $user->id || $room->ready) {
            return response()->json([
                'error' => 'Access denied!'
            ], 403);
        }
        $room->update($request->validated());
        event(new OpponentReady($room->owner, $user));
        if ($room->owner_ships) {
            $room->update(['ready' => true]);
            event(new GameReady($room));
        }
        return response()->json([
            'ships' => $room->opponent_ships
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

    public function fire(FireRequest $request, Room $room)
    {
        dd($request->validated());
    }
}
