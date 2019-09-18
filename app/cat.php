<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat extends Model
{
    public $fillable = ['category_name','p_id'];

     public function childs(){

    return $this->hasMany('App\cat','p_id');
     }
    public function categoryproduct ()
        {
         return $this->hasOne('App\productcategory');
       }

     public function parents(){
     	return $this->belongTo('App\cat','p_id');
     }

     public function parent()
       {
    return $this->belongsTo('App\cat', 'p_id');
            }

public function getParentsNames() {
    if($this->parent) {
        return $this->parent->getParentsNames(). " > " . $this->name;
    } else {
        return $this->name;
    }
}
}