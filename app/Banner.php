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
    protected $fillable = ['name', 'bannername','status'];

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

   /**
   *scope function for status equal to one
   */
 public function scopeActivebanner($query){
     return $query->where('status',1);
  }

  /**
  *scope function for status equal to one
  */
public function scopeInactivebanner($query){
    return $query->where('status',0);
 }


}
