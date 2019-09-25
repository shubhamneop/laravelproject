<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
  protected $fillable = ['name','title','slug','content','extras'];
  use SoftDeletes;

  protected $dates = ['deleted_at'];
}
