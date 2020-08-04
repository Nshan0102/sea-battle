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

    /**
     * Create a new event instance.
     *
     * @param $notifyToUser
     * @param $joinedUser
     */
    public function __construct($notifyToUser, $joinedUser)
    {
        $this->notifyToUser = $notifyToUser;
        $this->joinedUser = $joinedUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('room');
    }

    public function broadcastAs()
    {
        return 'opponent-joined-'.$this->notifyToUser->id;
    }
}
