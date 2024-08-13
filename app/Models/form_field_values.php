<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class form_field_values extends Model
{
    protected $table = 'form_field_values';
    public $timestamps = true;    //
    protected $fillable = [
        'register_id',
        'form_field_code',
        'field_data',
    ];

    public function form_field_master(){
        return $this->belongsTo('App\Models\form_field_master', 'form_field_code', 'form_field_code');
    }

}