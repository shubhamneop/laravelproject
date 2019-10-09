<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardsPoint extends Model
{
    protected $table = 'rewards_points';

    protected $fillable = ['user_id','points'];

    public function userreward(){
      return $this->belongsTo('App\User','user_id');
    }

}
