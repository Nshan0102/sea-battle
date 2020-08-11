<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OpponentLeft implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $userLeft;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $userLeft
     */
    public function __construct($user,$userLeft)
    {
        $this->user = $user;
        $this->userLeft = $userLeft;
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
        return 'opponent-left-'.$this->user->id;
    }
}
