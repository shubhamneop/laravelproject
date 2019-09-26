<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productcategory extends Model
    {
         protected $table = 'productcategories';
      use SoftDeletes;

      protected $dates = ['deleted_at'];
         public function products()
           {
            return $this->belongsTo('App\Product','product_id', 'id');
              }

             public function categories()
               {
             return $this->belongsTo('App\Category','category_id', 'id');
              }
    //


}
