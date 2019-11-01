<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
    protected $table = 'products';
  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable=['name','description','price','status'];

  /**
  *SoftDeletes declaration
  */
  use SoftDeletes;

  protected $dates = ['deleted_at'];

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
       return $this->belongsToMany('App\User','wishlists');
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
        $this->attributes['description'] = strtolower($value);
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

    /**
    *scope function for status equal to one
    */
  public function scopeActiveproduct($query){
      return $query->where('status',1);
   }

   /**
   *scope function for status equal to one
   */
 public function scopeInactiveproduct($query){
     return $query->where('status',0);
  }


}
