<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productattributesassoc extends Model
{
     protected $table = 'productattributesassocs';
    protected $fillable=['product_id','quantity'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
