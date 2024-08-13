<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dentistformmultiple extends Model
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

    public function dentistsform(){
        return $this->belongsTo('App\Models\dentist','dentistformid', 'id');
    }
}
