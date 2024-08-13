<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class back_record extends Model
{
    protected $table = 'back_record_tbl';
    
    public $timestamps = true;
    protected $fillable = ['recorddata','rec_date','case_id'];

}
