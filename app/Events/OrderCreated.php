<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $orders;
  public $message;
  /**
   * Create a new event instance.
   *
   * @return void
   */

  public function __construct()
  {
    // return response()->json([
    //   'orders' =>  Order::all()
    // ]);
    //die('xxxx');
    //$this->orders = Order::all();
    $this->message =  'HELLO WORLD';
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|string
   */
  public function broadcastOn()
  {
    return new Channel('orders');
  }

  public function broadcastWith()
  {
    return ['message' => 'NE MI GOVORI WE...'];
  }

  public function broadcastAs()
  {
    return 'order.created';
  }
}
