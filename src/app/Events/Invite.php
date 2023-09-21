<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Invite implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $invite_info;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($invite_info)
    {
       //["team_id"=>2,"recipient"=>3]
        $this->invite_info = $invite_info;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('User.Message.box.' . $this->invite_info['recipient']);
    }
}
