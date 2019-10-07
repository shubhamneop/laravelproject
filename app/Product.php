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

    /**
    * Set the product name .
    *
    * @param  string  $value
    * @return void
    */
   public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
    * Get the Product name .
    *
    * @param  string  $value
    * @return void
    */
   public function getNameAttribute($value)
    {
          return ucwords($value);
    }

    /**
    * Set the product description .
    *
    * @param  string  $value
    * @return void
    */
   public function setDescriptionAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
    * Get the Product description .
    *
    * @param  string  $value
    * @return void
    */
   public function getDescriptionAttribute($value)
    {
          return ucwords($value);
    }



}
