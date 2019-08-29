<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
  public function user(){

    	return $this->belongsTo('App\User');
    }

    public function order(){

    	return $this->belongsTo('App\User_order');
    }

}
