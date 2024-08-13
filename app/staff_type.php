<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff_type extends Model
{
    //
    protected $table = 'staff_type';
    public $timestamps = true;

    public function staff_user(){
        // Second parameter relationship column name of staff_user 
        // Third parameter relationship column name of staff_type.
        return $this->hasMany('App\Staff_user','staff_type_id', 'id');
    }
}
