<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DoctorBill extends Model
{
    //
    protected $table = 'doctorbill';
    public $timestamps = true;
    
    protected $fillable = [
        'case_id',
        'case_number',
        'doctor_Id',
        'bill_item',
        'bill_Amount',
        // 'billed_date',
        // 'created_at',
        // 'updated_at'
    ];

    public function getBilledDateAttribute($value)
    {
        return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    }

    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'case_id', 'id');
    }
}