<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eye_Blood_Investigation extends Model
{
    //
    protected $table = 'eye_blood_investigation';
    public $timestamps = true;
     protected $fillable = [
        'id',
        'blood_title_id',
        'blood_value',
     
    ];   
    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'case_id', 'id');
    }
}