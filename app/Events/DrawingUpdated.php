<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class DrawingUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $data;
    public $identifier;

    public function __construct($data, $identifier)
    {
        $this->data = $data;
        $this->identifier = $identifier;
    }

    public function broadcastOn()
    {
        return new Channel($this->identifier);
    }

    public function broadcastAs()
    {
        return 'DrawingUpdated';
    }
}
