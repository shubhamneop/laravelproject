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
    protected $fillable = ['name', 'value', '--view-path=admin-dash --controller-namespace=Admin-dash --route-group=admin-dash
php artisan crud:generate configurations --fields=name'];

use SoftDeletes;

protected $dates = ['deleted_at'];


}
