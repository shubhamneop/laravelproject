<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productcategorie extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];
}
