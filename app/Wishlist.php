<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Wishlist extends Model
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
    protected $table = "wishlists";
    /**
    *SoftDeletes declaration
    */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
    *Realtion with user model
    */
    public function user(){
       return $this->belongsTo('App\User');
    }


     /**
     *Relation with product model
     */
    public function product(){
       return $this->belongsTo('App\Product');
    }
}
