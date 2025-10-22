<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewSensorData implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $data; // berisi model / array sensor

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('sensor-data'); // publik channel
    }

    public function broadcastWith()
    {
        return ['data' => $this->data];
    }
}
