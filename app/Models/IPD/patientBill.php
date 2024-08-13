<?php

namespace App\Models\IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class patientBill extends Model
{
    protected $table = 'ipd_patient_bill';
    public $timestamps = true;

    protected $fillable = [
    'register_id',
    'tpa_company',
    'insurance_company',
    'bill_no',
    'bill_towards',
    'room_no',
    'advance_amount',
    'discount_amount',
    'bill_date',
    'admit_date',
    'discharge_date',
    ];

    
    // public function getbilldateAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setbilldateAttribute($value)
    // {
    //     $this->attributes['bill_date'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['bill_date'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }
    // public function getadmitdateAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setadmitdateAttribute($value)
    // {
    //     $this->attributes['admit_date'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['admit_date'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }
    // public function getdischargedateAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setdischargedateAttribute($value)
    // {
    //     $this->attributes['discharge_date'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['discharge_date'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }

    public function billItems(){
        return $this->hasMany('App\Models\IPD\billItems','bill_id', 'id');
    }
    public function patientRegister(){
        return $this->belongsTo('App\Models\IPD\patientRegister', 'register_id', 'id');
    }

}