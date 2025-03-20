<?php

namespace App\Events;

use App\Models\Bidder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BidderPlacedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bid;

    public function __construct(Bidder $bid)
    {

        $this->bid = $bid->load(['product', 'user']);
    }

      /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    // public function broadcastOn(): array
    // {
    //     return [new Channel('bidder-channel')];
    // }
    public function broadcastOn()
    {
        return ['bidder-channel'];
    }

    public function broadcastAs()
  {
      return 'bidder-event';
  }

    /**
     * Get the data that should be broadcasted.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'bid_id' => $this->bid->id,
            'amount' => $this->bid->amount,
            'user' => [
                'id' => $this->bid->user->id,
                'name' => $this->bid->user->name,
                'email' => $this->bid->user->email,
            ],
            'product' => [
                'id' => $this->bid->product->id,
                'title' => $this->bid->product->title,
                'description' => $this->bid->product->description,
                'price' => $this->bid->product->price,
                'image' => $this->bid->product->image,
            ],
        ];
    }
}
