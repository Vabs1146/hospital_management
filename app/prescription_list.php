<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prescription_list extends Model
{
    //
   public function Medical_store(){
        return $this->belongsTo('App\Medical_store','medicine_id','id');
   }
}
