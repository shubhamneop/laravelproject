<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_order extends Model
{
    public function user(){

    	return $this->belongsTo('App\User','user_id');
    }

    public function orderd(){

    	return $this->belongsTo('App\Order_detail','id');
    }


}
