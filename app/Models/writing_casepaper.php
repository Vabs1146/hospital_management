<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class writing_casepaper extends Model
{
    protected $table = 'writing_casepaper';
    public $timestamps = true;    //
    protected $fillable = [ 
        'case_id', 
        'image_data'
    ];
}