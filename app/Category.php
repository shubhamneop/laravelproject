<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'cats';

    public $fillable = ['category_name','p_id'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

     public function childs(){

    return $this->hasMany('App\Category','p_id');
     }

    public function product(){
     return $this->belongsToMany('App\Product','productcategories');
    }

     public function parents(){
     	return $this->belongTo('App\Category','p_id');
     }

     public function parent(){
      return $this->belongsTo('App\Category', 'p_id');
        }


    public function cartproductcategory(){
      return $this->hasOne('App\Cartdetail','category');
     }


    public function scopeParentcategory($query){
        return $query->where('p_id',0);
     }
    public function scopeSubCategory($query){
     return $query->where('p_id','!=',0);
   }


}
