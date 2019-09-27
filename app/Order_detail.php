<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_detail extends Model
{

  protected $table = 'order_details';


    protected $fillable = ['cart', 'address_id', 'total', 'status', 'payment_id', 'payment_mode', 'user_id'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];
  public function user(){

    	return $this->belongsToMany('App\User','user_orders','order_id','user_id');
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
