<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff_user extends Model
{
    //
    protected $table = 'staff_users';
    public $timestamps = true;

    public function staff_type(){
        return $this->belongsTo('App\staff_type', 'staff_type_id', 'id');
    }

}