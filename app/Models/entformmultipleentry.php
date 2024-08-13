<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class entformmultipleentry extends Model
{
    protected $table = 'entformmultipleentry';
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

    public function eyeform(){
        return $this->belongsTo('App\entform','eyeformid', 'id');
    }
}