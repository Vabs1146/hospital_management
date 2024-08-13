<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class eyeOperationRecord extends Model
{
    protected $table = 'eye_operation_record';
    public $timestamps = true;    //
    //protected $dates = ['created_at', 'deleted_at','Date_of_Surgery'];
    
    protected $casts = [
        'admission_date_time'  => 'datetime:Y-m-d',
    ];
    /*public function setDate_of_SurgeryAttribute( $value ) {
        $this->attributes['Date_of_Surgery'] = (new Carbon($value))->format('d/M/y');// Carbon::parse($value);//Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y');//(new Carbon($value))->format('d/m/y');
    }*/
	
    /*public function getDateofSurgeryAttribute($value)
    {
        return ($value != null)? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/M/Y'): null;
    }
    public function setDateofSurgeryAttribute($value)
    {
        $this->attributes['Date_of_Surgery'] = $value;
        if(!empty($value) && !is_null($value)){
            $this->attributes['Date_of_Surgery'] = Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s');
        }
        //return ($value != null)? Carbon::createFromFormat('d/M/Y', $value)->format('Y-m-d H:i:s'): null;
    }*/
    protected $fillable = [
        'id',
        'case_id',
        'case_number',
        'IPD_no',
        'uhid',
        //'Surgery',
        'admission_date_time',
        'surgery_date_time',
        'discharge_date_time',
        'Surgeon',
        //'classes',
        'referedby',
        'discharge_sts',
        'final_diagnosis',
        'Anaesthes_name',
        //'diagnosis', 
        'upload_image'
    ];
}