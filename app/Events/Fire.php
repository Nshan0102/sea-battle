<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Fire implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifyToUser;
    public $index;

    /**
     * Create a new event instance.
     *
     * @param $notifyToUser
     * @param $index
     */
    public function __construct($notifyToUser, $index)
    {
        $this->notifyToUser = $notifyToUser;
        $this->index = $index;
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
        return 'fire-'.$this->notifyToUser->id;
    }
}
