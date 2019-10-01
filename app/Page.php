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
  protected $fillable = ['name','title','slug','content','extras'];

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
    return $query->where('status','active');
  }

  /**
  *Scope function for inactive record
  */
  public function scopeStatusInctive($query){
    return $query->where('status','inactive');
  }


}
