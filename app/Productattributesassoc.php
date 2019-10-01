<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productattributesassoc extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
    protected $table = 'productattributesassocs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable=['product_id','quantity'];

    /**
    *SoftDeletes declaration
    */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
