<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
 

 protected $fillable=['name','description','price'];   
 

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

