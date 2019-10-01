<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productcategory extends Model
    {
      /**
       * The database table used by the model.
       *
       * @var string
       */
     protected $table = 'productcategories';
         /**
         *SoftDeletes declaration
         */
      use SoftDeletes;

      protected $dates = ['deleted_at'];

      public function categories()
         {
       return $this->belongsTo('App\Category','category_id', 'id');
          }



}
