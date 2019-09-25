<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productattributesassoc extends Model
{
    protected $fillable=['product_id','quantity'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
