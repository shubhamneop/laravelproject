<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{


 protected $fillable=['name','description','price'];
 use SoftDeletes;

 protected $dates = ['deleted_at'];

public function productimage(){


   return $this->hasOne('App\productimage');

      }




public function category()
{
    return $this->hasone('App\productcategory','product_id');
}
public function attribute()
{
    return $this->hasOne('App\productattributesassoc');
}
public function image()
{
    return $this->hasMany('App\productimage','product_id');
}

public function wishlist(){
       return $this->hasMany('App\wishlist');
    }




}
