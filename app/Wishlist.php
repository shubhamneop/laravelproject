<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Wishlist extends Model
{
    protected $table = "wishlists";
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public function user(){
       return $this->belongsTo('App\User');
    }

    public function product(){
       return $this->belongsTo('App\Product');
    }
}
