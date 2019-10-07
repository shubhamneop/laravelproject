<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cartdetail extends Model
{
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable =  ['order_id','product_id', 'product_name', 'quantity','price','category'];

  //SoftDeletes declaration
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  /**
  * Relation with Category model
  */
  public function categoryname(){
    return $this->belongsTo('App\Category','category','id');
  }

  /**
  * Relation with Order_detail model
  */
  public function order_detail(){
    return $this->belongsTo('App\Order_detail','id');
  }

  /**
  * Set the cart product name .
  *
  * @param  string  $value
  * @return void
  */
  public function setProductNameAttribute($value)
  {
    $this->attributes['product_name'] = strtolower($value);
  }

  /**
  * Get the cart product name .
  *
  * @param  string  $value
  * @return void
  */
  public function getProductNameAttribute($value){
    return strtoupper($value);
  }

}
