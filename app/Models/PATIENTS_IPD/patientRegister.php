<?php

namespace App\Models\PATIENTS_IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class patientRegister extends Model
{
    protected $table = 'patients';
    public $timestamps = true;

    protected $fillable = [
        'registration_date_time', 
        'ipd_number', 
        'uhid_number', 
        'first_name', 
        'middle_name', 
        'last_name', 
        'date_of_birth', 
        'age', 'gender', 
        'address', 
        'area', 
        'city', 
        'district', 
        'email', 
        'contact', 
        'responsible_realtive_name', 
        'responsible_realtive_relation', 
        'admission_month',
        'relative_address', 
        'relative_contact_number', 
        'blood_group', 
        'marital_status', 
        'weight', 'height', 
        'admission_date_time', 
        'consulting_doctor', 
        'referring_doctor', 
        'ward_type', 
        'bed_number', 
        'advance_amount', 
        'payment_mode', 
        'payment_id_number', 
        'created_at', 
        'created_by', 
        'updated_at', 
        'updated_by', 
        'status', 
        'icu_out_date', 
        'discharge_date_time', 
        'provisional_diagnosis', 
        'transfered', 
        'transferred_date_time',
         'ipd_number_used', 'uhid_number_used', 'ipd_number_format', 'ipd_number_prefix', 'uhid_number_format', 'uhid_number_prefix', 'ipd_bill_number_format', 'ipd_bill_prefix', 'ipd_summary_bill_number_format', 'ipd_bill_number_used', 'ipd_summary_bill_number_used', 'ipd_summary_bill_prefix', 'estimated_bill_diagnosis', 'ipd_bill_number', 'ipd_summary_bill_number', 'ipd_bill_date_time', 'ipd_bill_summary_date_time', 'adhar_card_number', 'admission_type',
        'registration_year', 'uhid_suggested', 'ipd_number_suggested'
    ];
    
    



    public function patientMedicine(){
        return $this->hasMany('App\Models\PATIENTS_IPD\patientMedicine','register_id', 'id');
    }
    
    public function ipd_prescription(){
        return $this->hasMany('App\Models\PATIENTS_IPD\ipd_prescription','register_id', 'id');
    }

    public function patientBill(){
        return $this->hasOne('App\Models\PATIENTS_IPD\patientBill', 'register_id', 'id');
    }

    public function ipdDischarge(){
        return $this->hasOne('App\Models\PATIENTS_IPD\ipdDischarge', 'patient_id', 'id');
    }
   
    public function ipdTreatmentDailyNotes(){
        return $this->hasOne('App\Models\PATIENTS_IPD\ipd_treatment_daily_notes', 'ipd_patient_id', 'id');
    }
}