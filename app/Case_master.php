<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_master extends Model
{
    //
    protected $table = 'case_master';
    public $timestamps = true;

    public function Report_file(){
        return $this->hasMany('App\Report_file','case_id', 'id');
    }
    public function Bill_detail(){
        return $this->hasMany('App\Bill_detail','case_id', 'id');
    }

     public function pay(){
        return $this->hasMany('App\Case_master','id');
    }


    public function Opd_bill(){
        return $this->hasMany('App\Opd_bill','case_id', 'id');
    }

    public function DoctorBill(){
        return $this->hasMany('App\DoctorBill','case_id', 'id');
    }

    public function insurance_bill(){
        return $this->hasOne('App\insurance_bill', 'case_id', 'id');
    }

    public function discharge(){
        return $this->hasOne('App\discharge', 'case_id', 'id');
    }
	
	 public function discharge2(){
        return $this->hasOne('App\discharge2', 'case_id', 'id');
    }

    public function eyeOperationRecord(){
        return $this->hasOne('App\Models\eyeOperationRecord', 'case_id', 'id');
    }
    
    public function skin(){
        return $this->hasOne('App\Models\skin', 'case_id', 'id');
    }

    public function glass_prescription(){
        return $this->hasOne('App\glass_prescription', 'case_id', 'id');
    }

    public function doctor(){
        return $this->hasOne('App\doctor', 'id', 'doctor_id');
    }

}