<?php

namespace App\Events;
use App\Messages;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChat implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $chat;
    
    public function __construct($chat)
    {
        $this->chat=$chat;
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new PrivateChannel('chat.'.$this->chat->chat_id);
    }

    // public function broadcastWith()
    // {
    //     return [
    //         'msg'=>$this->chat->msg,
    //         'chat_id'=>$this->chat->user_id,
    //         'user_id'=>$this->chat->chat_id,
    //         'created_at'=>$this->chat->created_at

    //     ];
    // }
}
