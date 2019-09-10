<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{


    protected $fillable = ['cart', 'address_id', 'total', 'status', 'payment_id',  'user_id'];

  public function user(){

    	return $this->belongsTo('App\User');
    }

    public function order(){

    	return $this->belongsTo('App\User_order');
    }
     public function address(){
       return $this->belongsTo('App\Address','address_id');
     }
}
