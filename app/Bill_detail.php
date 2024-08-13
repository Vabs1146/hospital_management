<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
    //
    protected $table = 'bill_details';
    public $timestamps = true;
    
    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'case_id', 'id');
    }
}