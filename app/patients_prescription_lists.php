<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patients_prescription_lists extends Model
{
    //
   public function Medical_store(){
        return $this->belongsTo('App\entmedical_store','medicine_id','id');
   }
}
