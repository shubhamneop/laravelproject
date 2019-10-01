<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','code','type', 'discount'];

    /**
    *SoftDeletes declaration
    */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

      /**
      *Relation with used_coupon model
      */
    public function usedcoupon(){
      return $this->hasMany('App\Used_coupon','coupon_id');
    }
}
