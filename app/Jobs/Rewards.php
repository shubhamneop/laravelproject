<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\RewardsPoint;
use App\Listeners\Pointstore;

class Rewards implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
      public $user_id;
      public $amount;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id,$amount)
    {
        $this->user_id=$user_id;
        $this->amount =$amount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

      $check_user = RewardsPoint::where('user_id',$this->user_id)->count();
         $rewardpoint = $this->amount/100 ;
     if($check_user==0){
         RewardsPoint::create(['user_id'=>$this->user_id,'points'=>$rewardpoint]);
      }else{
        $point = RewardsPoint::where('user_id',$this->user_id)->get();
         $data = RewardsPoint::find($point[0]->id);
         $dataupdate = array(
           'points'=> $data->points + $rewardpoint,
          );
         $data->update($dataupdate);

      }

    }
}
