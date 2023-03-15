<?php

namespace MyCustom\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class BaseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected string $channelName;

    function __construct(string $channelName)
    {
        $this->channelName = $channelName;
    }

    public function broadcastOn(): Channel
    {
        return new Channel($this->channelName);
    }

    abstract public function params(): array;
}
