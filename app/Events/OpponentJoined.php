<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OpponentJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifyToUser;
    public $joinedUser;
    public $roomId;

    /**
     * Create a new event instance.
     *
     * @param $notifyToUser
     * @param $joinedUser
     * @param $roomId
     */
    public function __construct($notifyToUser, $joinedUser, $roomId)
    {
        $this->notifyToUser = $notifyToUser;
        $this->joinedUser = $joinedUser;
        $this->roomId = $roomId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('room.'.$this->roomId);
    }

    public function broadcastAs()
    {
        return 'opponent-joined-'.$this->notifyToUser->id;
    }
}
