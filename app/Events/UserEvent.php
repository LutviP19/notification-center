<?php

namespace App\Events;

use App\Models\Userdata;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use stdClass;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    /**
     * Create a new event instance.
     *
     * @param stdClass $data
     */
    public function __construct(stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'UserEvent';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user-channel');
    }

    /**
     * The event's broadcast name.
     *
     * @return array
     */
    public function broadcastWith()
    {
        /*return [
            'title' => $this->data
        ];*/
        return Userdata::formatNotificationData($this->data);
    }
}
