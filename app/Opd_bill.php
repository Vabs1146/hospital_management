<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opd_bill extends Model
{
   protected $table = 'opd_bill';
    public $timestamps = true;
    
    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'case_id', 'id');
    }
}
