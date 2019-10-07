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
    protected $fillable = ['fullname','address1', 'address2', 'zipcode', 'country', 'state', 'phoneno', 'mobileno', 'user_id'];

     //soft detele function
    use SoftDeletes;

    protected $dates = ['deleted_at'];

     /**
     * Relation with user model
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * Relation with Order_detail model
    */
    public function orderaddress(){
      return $this->belongsTo('App\Order_detail');
    }

}
