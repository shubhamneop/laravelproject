<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'cats';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    public $fillable = ['category_name','p_id'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
    *Relation with category model for child category
    */
     public function childs(){

    return $this->hasMany('App\Category','p_id');
     }
      /**
      *Relation with product model many to many
      */
    public function product(){
     return $this->belongsToMany('App\Product','productcategories');
    }


     /**
     *Relation with category model for parent category
     */
     public function parent(){
      return $this->belongsTo('App\Category', 'p_id');
        }

        /**
        *Relation with Cartdetail model
        */
    public function cartproductcategory(){
      return $this->hasOne('App\Cartdetail','category');
     }

      /**
      *scope function for p_id equal to zero
      */
    public function scopeParentcategory($query){
        return $query->where('p_id',0);
     }
     
     /**
     *scope function for p_id not equal to zero
     */
    public function scopeSubCategory($query){
     return $query->where('p_id','!=',0);
   }


}
