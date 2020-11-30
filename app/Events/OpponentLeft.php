<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OpponentLeft implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $userLeft;
    public $roomId;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $userLeft
     * @param $roomId
     */
    public function __construct($user, $userLeft, $roomId)
    {
        $this->user = $user;
        $this->userLeft = $userLeft;
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
        return 'opponent-left-' . $this->user->id;
    }
}
