<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dentistformmultipleentry extends Model
{
    protected $table = 'dentistformmultipleentry';
    public $timestamps = true;    //
    protected $fillable = [
        'id',
        'eyeformid',
        'field_name',
        'field_value_OD',
        'field_value_OS',
        'created_at',
        'updated_at'
    ];

    public function dentists(){
        return $this->belongsTo('App\Models\dentist','dentistformid', 'id');
    }
}