<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productimage extends Model
{

	 protected $fillable=['product_id','image_path'];   

    public function product()
    {
    return $this->belongsTo('App\product','id');
    }






}
