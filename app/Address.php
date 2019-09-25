<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

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
    protected $fillable = ['address1', 'address2', 'zipcode', 'country', 'state', 'phoneno', 'mobileno', 'user_id'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderaddress(){
      return $this->belongsTo('App\Order_detail');
    }

}
