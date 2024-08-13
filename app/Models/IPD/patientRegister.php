<?php

namespace App\Models\IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class patientRegister extends Model
{
    protected $table = 'ipd_patient_register';
    public $timestamps = true;

    protected $fillable = [
        'name', 
        'guardian_name', 
        'address', 
        'mobile_no', 
        'phone_no', 
        'email_id', 
        'blood_group', 
        'gender', 
        'date_of_birth', 
        'age', 
        'weight', 
        'maritial_status', 
        'registration_date', 
        'registration_time', 
        'discharge_date', 
        'discharge_time', 
        'room_no', 
        'package', 
        'uhid_no', 
        'ipd_no', 
        'case', 
        'ref_doctor', 
        'consultant_doctor', 
        'department', 
        'specialisation', 
        'presenting_complaint', 
        'drug_sensitivity', 
        'family_history',
        'past_history',
        'remark', 
        'advance', 
        'payment_mode', 
        'debit_ac', 
        'status',

    ];



    public function patientMedicine(){
        return $this->hasMany('App\Models\IPD\patientMedicine','register_id', 'id');
    }
    
    public function ipd_prescription(){
        return $this->hasMany('App\Models\IPD\ipd_prescription','register_id', 'id');
    }

    public function patientBill(){
        return $this->hasOne('App\Models\IPD\patientBill', 'register_id', 'id');
    }

    public function ipdDischarge(){
        return $this->hasOne('App\Models\IPD\ipdDischarge', 'patient_id', 'id');
    }
   
    public function ipdTreatmentDailyNotes(){
        return $this->hasOne('App\Models\IPD\ipd_treatment_daily_notes', 'ipd_patient_id', 'id');
    }
}