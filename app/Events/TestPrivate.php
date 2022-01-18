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
use Illuminate\Support\Facades\Auth;

class TestPrivate implements ShouldBroadcastNow
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $order;
  public $userId;

  /**
   * Create a new event instance.
   *
   * @return void
   */

  public function __construct($order)
  {
    $this->order = $order;
    $this->userId = Auth::guard('restaurant')->user()->id;
    // $this->userId = 33;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\PrivateChannel|string
   */
  public function broadcastOn()
  {
    return new PrivateChannel('testPrivate.33');
  }

  public function broadcastWith()
  {
    return [
      'order' => $this->order
    ];
  }

  // public function broadcastAs()
  // {
  //   return 'test.private';
  // }
}
