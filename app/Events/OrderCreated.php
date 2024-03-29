<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcastNow
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $order;
  public $restaurantId;
  public $userId;

  /**
   * Create a new event instance.
   *
   * @return void
   */

  public function __construct($order, $restaurantId, $userId)
  {
    $this->order = $order;
    $this->restaurantId = $restaurantId;
    $this->userId = $userId;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\PrivateChannel|string
   */
  public function broadcastOn()
  {
    return new PrivateChannel('orderCreated.' . $this->restaurantId . '.' . $this->userId);
  }

  public function broadcastWith()
  {
    return [
      'order' => $this->order
    ];
  }
}
