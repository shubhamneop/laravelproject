<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Used_coupon extends Model
{
    public function coupon(){

      return $this->belongsTo('App\Coupon');
    }

    public function user(){
      return $this->belongsTo('App\User');
    }
    public function order_detail(){
      return $this->hasOne('App\Order_detail','coupon_id','id');
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
