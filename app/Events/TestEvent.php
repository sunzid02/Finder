<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $users;

    /**
     * Create a new event instance.
     *
     * @param $users
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

}
