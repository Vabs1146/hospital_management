<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class old_register extends Model
{
    protected $table = 'old_register';
    public $timestamps = true;    //

    // public function getdateofadmissionAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setdateofadmissionAttribute($value)
    // {
    //     $this->attributes['date_of_admission'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['date_of_admission'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }
    // public function getdateofdischargeAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setdateofdischargeAttribute($value)
    // {
    //     $this->attributes['date_of_discharge'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['date_of_discharge'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }
    protected $fillable = [
        'id',
        'ipd_no',
        'patient_name',
        'patient_address',
        'date_of_admission',
        'date_of_discharge',
        'mobile_no',
        'consulting_doctor'
    ];
}