<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productcategory extends Model
    {
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
