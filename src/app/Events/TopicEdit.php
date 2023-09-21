<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TopicEdit implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $topic;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Topic.Edit.' . $this->topic['team_id']);
    }
}
