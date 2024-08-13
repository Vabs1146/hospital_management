<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dentist_pain_in extends Model
{
    protected $table = 'dentist_pain_in';
    public $timestamps = true;    //
    protected $fillable = [
        'dentist_id', 
        'pain_in_teeth' 
    ];
}