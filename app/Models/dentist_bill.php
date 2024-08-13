<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dentist_bill extends Model
{
    protected $table = 'dentist_bill';
    public $timestamps = true;    //
    protected $fillable = [ 
        'case_id', 
        'treatmentDone', 
        'date',
        'amountPaid',
        'payment_mode'
    ];
}