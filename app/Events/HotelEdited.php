<?php

namespace App\Events;

use App\Models\Hotel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HotelEdited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     * @param Hotel $hotel
     */
    public function __construct(public Hotel $hotel)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(): \Illuminate\Broadcasting\Channel|PrivateChannel|array
    {
        return new PrivateChannel('channel-name');
    }
}
