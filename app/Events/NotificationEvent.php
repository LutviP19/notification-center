<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $username;
    public $message;

    public function __construct($username)
    {
        $this->username = $username;
        $this->message = "{$username} send you a notification";
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'NotificationEvent';
    }

    public function broadcastOn()
    {
        //it is a broadcasting channel you need to add this route in channels.php file
        //return ['notification-send'];
        return new Channel('notification-send');
    }
}