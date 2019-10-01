<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable=['name','description','price'];

  /**
  *SoftDeletes declaration
  */
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  public function productimage(){


    return $this->hasOne('App\Productimage');

      }



  /**
  *Relation with category model with pivot productcategories
  */
  public function category()
   {
    return $this->belongsToMany('App\Category','productcategories');
   }

   /**
   *Relation with Productattributesassoc model
   */
  public function attribute()
   {
    return $this->hasOne('App\Productattributesassoc');
   }

   /**
   *Relation with Productimage model
   */
  public function image()
   {
    return $this->hasMany('App\Productimage','product_id');
   }
   /**
   *Relation with wishlist model
   */
   public function wishlist(){
       return $this->hasMany('App\wishlist');
    }




}
