<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User_order extends Model
{
    public function user(){

    	return $this->belongsTo('App\User','user_id');
    }

    public function orders(){

    	return $this->belongsTo('App\Order_detail','order_id');
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
