<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname', 'email', 'password',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orderDetails(){
        return $this->belongsToMany('App\Order_detail','user_orders','user_id','order_id');
    }


    public function wishlist(){
       return $this->hasMany('App\wishlist');
    }
    public function usercoupon(){
      return $this->hasMany('App\Used_coupon','user_id');
    }

}
