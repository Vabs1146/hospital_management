<?php

namespace App\Models\IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ipdDischarge extends Model
{
    protected $table = 'ipd_discharge';
    public $timestamps = true;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'doa',
        'doatime',
        'dod',
        'dodtime',
        'diagnosis',
        'clinical_notes',
        'investigation_findings',
        'treatment_given',
        'operative_notes',
        'treatment_advice',
        'next_visit',
        'status'
    ];


    // public function getdodAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setdodAttribute($value)
    // {
    //     $this->attributes['dod'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['dod'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }
    // public function getdoaAttribute($value)
    // {
    //     return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    // }
    // public function setdoaAttribute($value)
    // {
    //     $this->attributes['doa'] = $value;
    //     if(!empty($value) && !is_null($value)){
    //         $this->attributes['doa'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
    //     }
    // }
    
    public function patientRegister(){
        return $this->belongsTo('App\Models\IPD\patientRegister', 'patient_id', 'id');
    }
}