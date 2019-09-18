<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Used_coupon extends Model
{
    public function coupon(){

      return $this->belongsTo('App\coupon');
    }

    public function user(){
      return $this->belongsTo('App\User');
    }
    public function order_detail(){
      return $this->hasOne('App\Order_detail','coupon_id','id');
    }
}
