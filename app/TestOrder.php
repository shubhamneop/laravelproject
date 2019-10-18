<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestOrder extends Model
{
    protected $fillable = ['order_no','cart_id','address_id','total','status','payment_mode','user_id','payment_id'];

    public function getRouteKeyName()
     {
    return 'order_no';
     }
}
