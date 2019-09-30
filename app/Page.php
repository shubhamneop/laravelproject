<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
  protected $fillable = ['name','title','slug','content','extras'];
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  public function scopeSlug($query,$slug){
    return $query->where('slug',$slug);
  }
  public function scopeStatusActive($query){
    return $query->where('status','active');
  }

  public function scopeStatusInctive($query){
    return $query->where('status','inactive');
  }


}
