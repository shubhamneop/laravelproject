<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartdetail extends Model
{
  protected $fillable =  ['order_id','product_id', 'product_name', 'quantity','price','category'];

  public function categoryname(){
    return $this->belongsTo('App\Category','category','id');
  }
  public function order_detail(){
    return $this->belongsTo('App\Order_detail','id');
  }


}
