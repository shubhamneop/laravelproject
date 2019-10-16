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

    /**
    * Set the customer country .
    *
    * @param  string  $value
    * @return void
    */
   public function setCountryAttribute($value)
    {
        $this->attributes['country'] = strtolower($value);
    }

    /**
     * Get the customer country.
     *
     * @param  string  $value
     * @return void
     */
    public function getCountryAttribute($value){
      return ucwords($value);
    }

    /**
    * Set the customer fullname .
    *
    * @param  string  $value
    * @return void
    */
   public function setFullnameAttribute($value)
    {
        $this->attributes['fullname'] = strtolower($value);
    }

    /**
     * Get the customer fullname.
     *
     * @param  string  $value
     * @return void
     */
    public function getFullnameAttribute($value){
      return ucwords($value);
    }

    /**
    * Set the customer state .
    *
    * @param  string  $value
    * @return void
    */
   public function setStateAttribute($value)
    {
        $this->attributes['state'] = strtolower($value);
    }

    /**
     * Get the customer state.
     *
     * @param  string  $value
     * @return void
     */
    public function getStateAttribute($value){
      return ucwords($value);
    }

    /**
    * Set the customer address1 .
    *
    * @param  string  $value
    * @return void
    */
   public function setAddress1Attribute($value)
    {
        $this->attributes['address1'] = strtolower($value);
    }

    /**
     * Get the customer address1.
     *
     * @param  string  $value
     * @return void
     */
    public function getAddress1Attribute($value){
      return ucwords($value);
    }

    /**
    * Set the customer address1 .
    *
    * @param  string  $value
    * @return void
    */
   public function setAddress2Attribute($value)
    {
        $this->attributes['address2'] = strtolower($value);
    }

    /**
     * Get the customer address1.
     *
     * @param  string  $value
     * @return void
     */
    public function getAddress2Attribute($value){
      return ucwords($value);
    }




}
