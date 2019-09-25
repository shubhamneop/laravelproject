<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productimage extends Model
{

	 protected $fillable=['product_id','image_path'];

    public function product()
    {
    return $this->belongsTo('App\product','id');
    }

		use SoftDeletes;

 	 protected $dates = ['deleted_at'];




}
