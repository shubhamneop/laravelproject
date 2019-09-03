<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'contactus';

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
  protected $fillable = ['name', 'email', 'contactno', 'subject', 'message','note'];
}
