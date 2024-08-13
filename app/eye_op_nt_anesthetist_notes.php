<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eye_op_nt_anesthetist_notes extends Model
{
    protected $table = 'eye_op_nt_anesthetist_notes';
    public $timestamps = true;    //
    protected $fillable = [
        'eye_op_nt_id', 
        'an_history', 
        'an_allergies', 
        'an_pulse', 
        'an_cardiac_history', 
        'an_bp', 
        'an_investigations', 
        'an_nbm_notnbm', 
        'an_dentition', 
        'ion_anesthesia_topical_peribular_given_by', 
        'ion_pulse', 
        'ion_o_saturation', 
        'ion_bp', 
        'pon_pulse', 
        'pon_bp', 
        'pon_o_saturation', 
        'pon_additional_note', 
        'anesthetist_name',
    ];
}