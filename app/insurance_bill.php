<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class insurance_bill extends Model
{
    protected $table = 'insurance_bill';
    public $timestamps = true;    //
    protected $fillable = [
        'case_id',
        'case_number',
        'name_of_patient',
        'procedure_surgery_done',
        'ipd_no',
        'bill_no',
        'uhid_no',
        'bill_date',
        'admission_date_time',
        'classes',
        'discharge_date_time',
        'surgon_name',
		'left_eye',
        'right_eye',
        'tpa_company',
        'referedby',
        'final_diagnosis',
        'discharge_sts',
        'surgery_date_time',
        'insurance_company',
        'advance_amount',
        'discount_amount',
        'total_bill_amount',
        'amount_senction_by_tpa',
        'balance_amount_by_patient',
        'declaration_patient_balance_amt',
        'balance_paid_by_patient',
    ];
}