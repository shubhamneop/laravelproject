<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{


 protected $fillable=['name','description','price'];
 use SoftDeletes;

 protected $dates = ['deleted_at'];

public function productimage(){


   return $this->hasOne('App\Productimage');

      }




public function category()
{
    return $this->hasone('App\Productcategory','product_id');
}
public function attribute()
{
    return $this->hasOne('App\Productattributesassoc');
}
public function image()
{
    return $this->hasMany('App\Productimage','product_id');
}

public function wishlist(){
       return $this->hasMany('App\wishlist');
    }




}
