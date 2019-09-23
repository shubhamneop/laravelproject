<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{


    protected $fillable = ['cart', 'address_id', 'total', 'status', 'payment_id', 'payment_mode', 'user_id'];

  public function user(){

    	return $this->belongsTo('App\User');
    }

    public function order(){

    	return $this->belongsTo('App\User_order');
    }
     public function address(){
       return $this->belongsTo('App\Address','address_id');
     }
     public function used_coupon(){
       return $this->belongsTo('App\Used_coupon','coupon_id','id');
     }
     public function cartdetail(){
       return $this->hasMany('App\Cartdetail','order_id');
     }
}
