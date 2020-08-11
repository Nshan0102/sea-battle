<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OpponentReady implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifyToUser;
    public $readyUser;

    /**
     * Create a new event instance.
     *
     * @param $notifyToUser
     * @param $readyUser
     */
    public function __construct($notifyToUser, $readyUser)
    {
        $this->notifyToUser = $notifyToUser;
        $this->readyUser = $readyUser;
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
        return 'opponent-ready-'.$this->notifyToUser->id;
    }
}
