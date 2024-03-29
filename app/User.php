<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname', 'email', 'password','status'
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
    /**
    *Relation with Order_detail model with pivot table user_orders
    */
    public function orderDetails(){
        return $this->belongsToMany('App\Order_detail','user_orders','user_id','order_id');
    }
    // public function orderDetails(){
    //     return $this->hasMany('App\Order_detail','user_id');
    // }

    /**
    *Relation with wishlist model
    */
    public function userwishlist(){
       return $this->belongsToMany('App\Product','wishlists');
    }

    /**
    *Relation with Used_coupon model
    */
    public function usercoupon(){
      return $this->hasMany('App\Used_coupon','user_id');
    }

    /**
    *Relation with adddress model
    */
    public function useraddress(){
      return $this->hasMany('App\Address');
    }
    /**
    * Set the user's email .
    *
    * @param  string  $value
    * @return void
    */
   public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     *Get fullname from user's firstname and lastname
     *
     *@return string
     */
     public function getFullnameAttribute(){
       return ucwords("{$this->name} {$this->lastname}");
     }


}
