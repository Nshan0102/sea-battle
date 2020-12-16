<?php

namespace App\Http\Controllers;

use App\Events\Fire;
use App\Events\GameReady;
use App\Events\Message;
use App\Events\OpponentJoined;
use App\Events\OpponentReady;
use App\Http\Requests\FireRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Room;
use App\Traits\RoomTrait;
use App\User;
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
    use RoomTrait;

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        if ($user->opponentRoom) {
            $user->opponentRoom->update([
                'opponent_id' => null
            ]);
        }
        if ($user->ownerRoom && $request->force) {
            $user->ownerRoom->delete();
        } elseif ($user->ownerRoom) {
            return redirect(route('enter-the-room', $user->ownerRoom));
        }
        $room = Room::create([
            'opponent_fires' => '[]',
            'owner_fires' => '[]',
            'opponent_succeeds' => '[]',
            'owner_succeeds' => '[]',
            'join_hash' => strtolower(Str::random(16)),
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
                event(new OpponentJoined($room->owner, $user, $room->id));
            } else {
                if ($room->opponent) {
                    event(new OpponentJoined($room->opponent, $user, $room->id));
                }
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
                'opponent_id' => null
            ]);
        }
        // set user as opponent for this room
        $room->update([
            'opponent_id' => $user->id
        ]);
        event(new OpponentJoined($room->owner, $user, $room->id));
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
        event(new OpponentReady($room->owner, $user, $room->id));
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

    /**
     * @param FireRequest $request
     * @param Room $room
     * @return JsonResponse
     */
    public function fire(FireRequest $request, Room $room)
    {
        $index = $request->x_coordinate . '-' . $request->y_coordinate;
        $userIsOwner = auth()->user()->id === $room->owner_id;
        if ($room->turn !== auth()->user()->id) {
            return response()->json([
                'error' => 'Not your turn!'
            ], 403);
        }
        if ($room->finished) {
            return response()->json([
                'error' => 'Game has finished!'
            ], 403);
        }
        $notifyTo = $userIsOwner ? User::find($room->opponent_id) : User::find($room->owner_id);
        $opponentShips = $userIsOwner ? json_decode($room->opponent_ships) : json_decode($room->owner_ships);
        $fires = $userIsOwner ? json_decode($room->owner_fires) : json_decode($room->opponent_fires);
        $shots = $userIsOwner ? $room->opponent_shots : $room->owner_shots;
        $succeeds = $userIsOwner ? json_decode($room->owner_succeeds) : json_decode($room->opponent_succeeds);
        if (in_array($index, $fires)) {
            return response()->json([
                'index' => $index,
                'status' => 'fail',
                'message' => 'This cell was already fired'
            ]);
        }
        $shot = $this->shoot($opponentShips, $index);
        is_array($fires) ? array_push($fires, $index) : $fires = [$index];
        if ($shot['status'] == 'success') {
            array_push($succeeds, $index);
            event(new Fire($notifyTo, $index, $room->id));
            if (count($succeeds) === 20) {
                event(new Fire($notifyTo, 'win', $room->id));
                event(new Fire(auth()->user(), 'winner', $room->id));
                $room->update([
                    'finished' => true
                ]);
            }
            is_numeric($shots) ? $shots += 1 : $shots = 1;
        } elseif ($shot['status'] == 'empty') {
            event(new Fire($notifyTo, $index, $room->id));
            $room->update([
                'turn' => $userIsOwner ? $room->opponent_id : $room->owner_id
            ]);
        }

        if ($userIsOwner) {
            $room->update([
                'opponent_ships' => json_encode($shot['ships']),
                'owner_fires' => $fires,
                'owner_shots' => $shots,
                'owner_succeeds' => $succeeds
            ]);
        } else {
            $room->update([
                'owner_ships' => json_encode($shot['ships']),
                'opponent_fires' => $fires,
                'opponent_shots' => $shots,
                'opponent_succeeds' => $succeeds
            ]);
        }

        return response()->json([
            'index' => $index,
            'status' => $shot['status'],
            'ship' => isset($shot['isShipBroken']) && $shot['isShipBroken'] ? $shot['ship'] : [],
            'message' => $shot['message']
        ]);
    }

    public function message(MessageRequest $request, Room $room)
    {
        $message = $request->message;
        if (!$room->opponent){
            return response()->json([
                'error' => 'You can send messages only during of game!',
                'message' => $message
            ], 403);
        }
        $notifyTo = auth()->user()->id === $room->owner->id ? $room->opponent : $room->owner;
        event(new Message($notifyTo, $message, $room->id));
        return response()->json([
            'message' => $message
        ], 200);
    }
}
