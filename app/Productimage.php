<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Productimage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'productimages';

     /**
      * Attributes that should be mass-assignable.
      *
      * @var array
      */
	 protected $fillable=['product_id','image_path'];

    /**
    *Relation with Product Model
    */
    public function product()
    {
    return $this->belongsTo('App\Product','product_id');
    }

		use SoftDeletes;

 	 protected $dates = ['deleted_at'];

   public function getUrlAttribute()
    {
        return Storage::disk('s3')->url('product/'.$this->image_path);
    }


}
