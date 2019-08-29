<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
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

    public function usedcoupon(){
      return $this->hasMany('App\Used_coupon','coupon_id');
    }
}
