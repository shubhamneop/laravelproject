<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Used_coupon extends Model
{

      /**
       * Attributes that should be mass-assignable.
       *
       * @var array
       */
   protected $fillable = ['coupon_id','user_id'];
     /**
     *Relation with Coupon model
     */
    public function coupon(){

      return $this->belongsTo('App\Coupon');
    }
    /**
    *Relation with User model
    */
    public function user(){
      return $this->belongsTo('App\User');
    }

    /**
    *Relation with Order_detail model
    */
    public function order_detail(){
      return $this->hasOne('App\Order_detail','coupon_id','id');
    }
     //SoftDeletes declaration
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
