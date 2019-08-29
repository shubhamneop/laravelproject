<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Used_coupon extends Model
{
    public function coupon(){

      return $this->belongsTo('App\coupon');
    }
}
