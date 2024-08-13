<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eye_operation_notes extends Model
{
    protected $table = 'eye_operation_notes';
    public $timestamps = true;    //
    protected $fillable = [ 
        'case_id',   
        'case_number',  
        'surgery_name',  
        'notes'
    ];

    public function eye_op_nt_surgery_details(){
        return $this->hasMany('App\eye_op_nt_surgery_details','eye_op_nt_id', 'id');
    }

    public function eye_op_nt_anesthetist_notes(){
        return $this->hasMany('App\eye_op_nt_anesthetist_notes','eye_op_nt_id', 'id');
    }
}