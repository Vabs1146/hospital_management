<?php

namespace App\Models\PATIENTS_IPD;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class billItems extends Model
{
    protected $table = 'patients_ipd_patient_bill_items';
    public $timestamps = true;

    protected $fillable = [
    'bill_id',
    'particular',
    'day',
    'rate',
    'amount'
    ];
    
    public function patientBill(){
        return $this->belongsTo('App\Models\PATIENTS_IPD\patientBill', 'bill_id', 'id');
    }
}