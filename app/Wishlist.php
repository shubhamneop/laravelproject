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
    *Relation with users model for wishlist
    */
    public function users(){
      return $this->belongsTo('App\User','user_id');
    }

    /**
    *Relation with product model for wishlists
    */
    public function products(){
      return $this->belongsTo('App\Product','product_id');
    }

}
