<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eye_op_nt_surgery_details extends Model
{
    protected $table = 'eye_op_nt_surgery_details';
    public $timestamps = true;    //
    protected $fillable = [
        'eye_op_nt_id',
        'surgery_details' 
    ];
}