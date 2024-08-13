<?php

namespace App\Models\PATIENTS_IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payments extends Model
{
    protected $table = 'patients';
    public $timestamps = true;

    
    protected $fillable = [
        'id', 'registration_date_time', 'ipd_number', 'uhid_number', 'first_name', 'middle_name', 'last_name', 'date_of_birth', 'age', 'gender', 'address', 'area', 'city', 'district', 'email', 'contact', 'responsible_realtive_name', 'responsible_realtive_relation', 'relative_address', 'relative_contact_number', 'blood_group', 'marital_status', 'weight', 'height', 'admission_date_time', 'consulting_doctor', 'referring_doctor', 'ward_type', 'bed_number', 'advance_amount', 'payment_mode', 'payment_id_number', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status', 'icu_out_date', 'discharge_date_time', 'provisional_diagnosis', 'transfered', 'transferred_date_time'

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
    
    public function patientWard(){
        return $this->hasOne('App\IpdPatientsDropdowns', 'ward_type', 'id');
    }
    
    public function patientBed(){
        return $this->hasOne('App\IpdPatientsDropdowns', 'bed_number', 'id');
    }
}