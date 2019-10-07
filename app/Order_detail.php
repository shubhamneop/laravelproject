<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_detail extends Model
{
     /**
      * The database table used by the model.
      *
      * @var string
      */
    protected $table = 'order_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart', 'address_id', 'total', 'status', 'payment_id', 'payment_mode', 'user_id'];

    /**
    *SoftDeletes declaration
    */
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
    *Relation with user model using pivot user_orders
    */
  public function user(){

    	return $this->belongsToMany('App\User','user_orders','order_id','user_id');
    }

      /**
      *Relation with address model
      */
     public function address(){
       return $this->belongsTo('App\Address','address_id');
     }

     /**
     *Relation with Used_coupon model
     */
     public function used_coupon(){
       return $this->belongsTo('App\Used_coupon','coupon_id','id');
     }

     /**
     *Relation with Cartdetail model
     */
     public function cartdetail(){
       return $this->hasMany('App\Cartdetail','order_id');
     }

     /**
      * Set the cart column as serialize
      *
      * @param  string  $value
      * @return void
     */
     public function setCartAttribute($value) {
        $this->attributes['cart'] = serialize($value);
     }

     /**
      * get cart column unserialize when retrieved from the database
      *
      * @param $value
      * @return string
      */
     public function getCartAttribute($value){
       return unserialize($value);
     }
}
