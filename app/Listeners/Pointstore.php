<?php

namespace App\Listeners;

use App\Events\Point;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
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
      $check_user = RewardsPoint::where('user_id',$event->user_id)->count();
         $rewardpoint = $event->amount/100 ;
     if($check_user==0){
         RewardsPoint::create(['user_id'=>$event->user_id,'points'=>$rewardpoint]);
      }else{
        $point = RewardsPoint::where('user_id',$event->user_id)->get();
         $data = RewardsPoint::find($point[0]->id);
         $dataupdate = array(
           'points'=> $data->points + $rewardpoint,
          );
         $data->update($dataupdate);

      }

    }
}
