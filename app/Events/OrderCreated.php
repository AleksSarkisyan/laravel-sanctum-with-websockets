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

  public $order;
  public $message;
  /**
   * Create a new event instance.
   *
   * @return void
   */

  public function __construct()
  {
    $this->message = 'HELLO WORLD';
    $this->order = Order::where('id', 1)->get();
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
    return [
      'message' => $this->message,
      'order' => $this->order
    ];
  }

  // public function broadcastAs()
  // {
  //   return 'order.created';
  // }
}
