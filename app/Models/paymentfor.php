<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paymentfor extends Model
{
    protected $table = 'paymentfor';
    public $timestamps = true;    //
    protected $fillable = [ 
        'case_id', 
        'treatmentDone', 
        'date',
        'amountPaid'
    ];  //
  
}