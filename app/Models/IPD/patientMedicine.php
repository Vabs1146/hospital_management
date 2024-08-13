<?php

namespace App\Models\IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class patientMedicine extends Model
{
    protected $table = 'ipd_patient_medicine';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'medicine_id',
        'date_of_mgf',
        'date_of_exp',
        'batch_no',
        'price',
        'quantity'
    ];
    
    // public function getdateofmgfAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setdateofmgfAttribute($value)
    // {
    //     $this->attributes['date_of_mgf'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['date_of_mgf'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }
    // public function getdateofexpAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setdateofexpAttribute($value)
    // {
    //     $this->attributes['date_of_exp'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['date_of_exp'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }

    public function patientRegister(){
        return $this->belongsTo('App\Models\IPD\patientRegister', 'register_id', 'id');
    }

    public function medical_store(){
        return $this->belongsTo('App\Medical_store', 'medicine_id', 'id');
    }
}