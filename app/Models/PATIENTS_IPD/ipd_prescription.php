<?php

namespace App\Models\PATIENTS_IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ipd_prescription extends Model
{
    protected $table = 'patients_ipd_prescription';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'register_id',
        'medicine_id',
        'medicine_Quntity',
        'per_unit_cost',
        'numberoftimes',
        'no_of_days',
        'strength',
        'created_at',
        'updated_at'
    ];
    
    public function patientRegister(){
        return $this->belongsTo('App\Models\PATIENTS_IPD\patientRegister', 'register_id', 'id');
    }

    public function Medical_store(){
        return $this->belongsTo('App\Medical_store','medicine_id','id');
   }

}