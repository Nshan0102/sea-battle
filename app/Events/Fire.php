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
    public $roomId;

    /**
     * Create a new event instance.
     *
     * @param $notifyToUser
     * @param $index
     * @param $roomId
     */
    public function __construct($notifyToUser, $index, $roomId)
    {
        $this->notifyToUser = $notifyToUser;
        $this->index = $index;
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
        return 'fire-'.$this->notifyToUser->id;
    }
}
