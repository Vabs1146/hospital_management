<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class form_field_master extends Model
{
    protected $table = 'form_field_master';
    public $timestamps = true;
    protected $fillable = [
        'formName',
        'fieldName',
        'form_field_code'
    ];
    

    public function form_field_values(){
        return $this->hasMany('App\Models\form_field_values','form_field_code', 'form_field_code');
    }

    public function form_master_form_field(){
        return $this->hasMany('App\Models\form_master_form_field','form_field_code', 'form_field_code');
    }

}