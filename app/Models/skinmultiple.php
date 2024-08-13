<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class skinmultiple extends Model
{
    protected $table = 'skinmultiple';
    public $timestamps = true;    //

    protected $fillable = [
        'id',
        'case_id',
        'formFieldName',
        'formfieldCode',
        'valueData'
    ];
}