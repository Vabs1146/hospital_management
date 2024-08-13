<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entmedical_store extends Model
{
    //
    protected $table = 'entmedical_store';
    public $timestamps = false;

    public function prescription_list(){
        return $this->hasMany('App\prescription_list','medicine_id', 'id');
    }
    public function patientMedicine(){
        return $this->hasMany('App\Models\IPD\patientMedicine','medicine_id', 'id');
    }
}