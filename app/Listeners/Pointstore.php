<?php

namespace App\Listeners;

use App\Events\Point;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\Rewards;
use App\RewardsPoint;
class Pointstore
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Point  $event
     * @return void
     */
    public function handle(Point $event)
    {
      dispatch(new Rewards($event->user_id,$event->amount));
    }
}
