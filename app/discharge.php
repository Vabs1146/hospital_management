<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discharge extends Model
{
    protected $table = 'discharge';
    public $timestamps = true;    //
    protected $fillable = [
        'id',
        'case_id',
        'case_number',
        'IPD_no',
        'address',
        'admission_date_time',
        'discharge_date_time',
        'surgery_date_time',
       // 'diagnosis',
        'surgery',
        'systemic_diseases',
        'general_condition',
        'anesthesia_procedure',
        'procedures',
        'name_of_iol',
        'post_operative',
        //'advice',
        'review',
        'surgeon_name',
        'brief_history',
        'cataract_thru',
        'diminished_vision_in',
        're_dv',
        'lf_dv',
        're_iop',
        'lf_iop',
        're_io',
        'lf_io',
        'bsf',
        'bspp',
        'hb',
        'cbc',
        'esr',
        'hiv',
        'hbsag',
        'urinal_analysis',
        'ecg',
        'medical_fitness',
        'treatment_advised',
        'investigation',
        'followup',
		'dischargeimg',
		'discharge_history'
    ];



}