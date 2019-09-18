<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){

        return $this->hasMany('App\User_order','user_id');
    }
    public function orderDetails(){
        return $this->hasMany('App\Order_detail','user_id');
    }


    public function wishlist(){
       return $this->hasMany('App\wishlist');
    }
    public function usercoupon(){
      return $this->hasMany('App\Used_coupon','user_id');
    }

}
