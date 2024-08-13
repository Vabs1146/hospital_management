<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blnc_test extends Model
{
    protected $table = 'blnc_test';
    public $timestamps = true;
    protected $fillable = [
        'case_id', 
        'case_number', 
        'blncetestname',
        'sts'
    ];
}