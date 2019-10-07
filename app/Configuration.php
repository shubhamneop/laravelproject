<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'configurations';

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
    protected $fillable = ['name', 'value'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
    * Set the configurations value .
    *
    * @param  string  $value
    * @return void
    */
   public function setValueAttribute($value)
    {
        $this->attributes['value'] = strtolower($value);
    }

    /**
    * Set the configurations name .
    *
    * @param  string  $value
    * @return void
    */
    public function setNameAttribute($value)
     {
         $this->attributes['name'] = strtolower($value);
     }

     /**
     * get the configurations name .
     *
     * @param  string  $value
     * @return void
     */
     public function getNameAttribute($value){
       return ucwords($value);
     }

}
