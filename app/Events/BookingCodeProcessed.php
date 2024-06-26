<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingCodeProcessed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transactionData;
    public $key;
    /**
     * Create a new event instance.
     */
    public function __construct($transactionData, $key)
    {
        $this->transactionData = $transactionData;
        $this->key = $key;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        // return new Channel('booking-monitor');
        return ['booking-monitor'];
    }

    public function broadcastAs()
    {
        return 'booking-monitor';
    }
}
