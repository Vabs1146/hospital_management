<?php

namespace App\Models\PATIENTS_IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ipd_treatment_daily_notes extends Model
{
    protected $table = 'patients_ipd_treatment_daily_notes';
    public $timestamps = true;

    protected $fillable = [
    'ipd_patient_id',
    'time',
    'temp',
    'spo2',
    'bp',
    'rr',
    'fhs',
    'treatment',
    'morning',
    'evening',
    'night',
    'created_at',
    'updated_at'
    ];
    
    public function patientRegister(){
        return $this->belongsTo('App\Models\PATIENTS_IPD\patientRegister', 'ipd_patient_id', 'id');
    }
}

