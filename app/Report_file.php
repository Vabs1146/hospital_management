<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_file extends Model
{
    //
    protected $table = 'report_file';

    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'id', 'case_id');
    }
}