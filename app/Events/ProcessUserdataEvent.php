<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Userdata;
use App\Helpers;

class ProcessUserdataEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userdata;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Userdata $userdata)
    {
        $userdata->user_id = Helpers::encrypt_decrypt_js('encrypt', $userdata->user_id);
        $this->userdata = $userdata;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'ProcessUserdataEvent';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return new Channel('process-userdata');
    }
}
