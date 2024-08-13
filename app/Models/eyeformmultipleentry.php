<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eyeformmultipleentry extends Model
{
    protected $table = 'eyeformmultipleentry';
    public $timestamps = true;    //
    protected $fillable = [
        'id',
        'eyeformid',
        'field_name',
        'field_value_OD',
        'field_value_OS',
        'duration_OD',
        'duration_OS',
        'created_at',
        'updated_at'
    ];

    public function eyeform(){
        return $this->belongsTo('App\eyeform','eyeformid', 'id');
    }
}