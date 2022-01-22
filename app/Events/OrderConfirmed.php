<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmed implements ShouldBroadcastNow
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $orderDetails;

  /**
   * Create a new event instance.
   *
   * @return void
   */

  public function __construct($orderDetails)
  {
    $this->orderDetails = $orderDetails;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\PrivateChannel|string
   */
  public function broadcastOn()
  {
    return new PrivateChannel('orderConfirmed.' . $this->orderDetails['userId']);
  }

  public function broadcastWith()
  {
    return [
      'confirmed' => true,
      'restaurantName' => $this->orderDetails['restaurantName']
    ];
  }
}
