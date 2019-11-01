<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['name','title','slug','content','status'];

  /**
  *SoftDeletes declaration
  */
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  /**
  * Scope function for page slug
  */
  public function scopeSlug($query,$slug){
    return $query->where('slug',$slug);
  }

   /**
   *Scope function for active record
   */
  public function scopeStatusActive($query){
    return $query->where('status',1);
  }

  /**
  *Scope function for inactive record
  */
  public function scopeStatusInctive($query){
    return $query->where('status',0);
  }

  /**
  * Set the page slug .
  *
  * @param  string  $value
  * @return void
  */
 public function setSlugAttribute($value)
  {
      $this->attributes['slug'] = strtoupper($value);
  }


}
