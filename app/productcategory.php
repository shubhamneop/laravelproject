<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productcategory extends Model
    {
      use SoftDeletes;

      protected $dates = ['deleted_at'];
         public function products()
           {
            return $this->belongsTo('App\product','product_id', 'id');
              }

             public function categories()
               {
             return $this->belongsTo('App\cat','category_id', 'id');
              }
    //


}
