<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'bannername'];

    use SoftDeletes;

   protected $dates = ['deleted_at'];


   /**
   * Set the banner name .
   *
   * @param  string  $value
   * @return void
   */
   public function setNameAttribute($value)
   {
     $this->attributes['name'] = strtolower($value);
   }

   /**
   * get the banner name .
   *
   * @param  string  $value
   * @return void
   */
   public function getNameAttribute($value)
   {
     return ucwords($value);
   }

}
