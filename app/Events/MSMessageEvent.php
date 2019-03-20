<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Mqtt\MSMessage;

class MSMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $valeur;
    public $node_address;
    public $sensor_adress;
    public $commande;
    public $ack;
    public $type;
    public $date;
    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
//    public function __construct(MSMessage $message)
//    {
//        $this->message = $message;
//    }
    public function __construct(MSMessage $message, $id=0)
    {
        $this->message = $message;
        $this->valeur = $message->getMessage();
        $this->node_address = $message->getNodeId();
        $this->sensor_adress = $message->getChildId();
        $this->commande = $message->getCommand();
        $this->ack = $message->getAck();
        $this->type = $message->getType();
        $this->date= Carbon::now()->format('d/m/Y H:i:s');
        $this->id = $id;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('msmessage-out');
    }
}
