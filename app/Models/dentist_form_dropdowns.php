<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dentist_form_dropdowns extends Model
{
    protected $table = 'dentist_form_dropdowns';
    public $timestamps = true;
    protected $fillable = [
        'formName', 
        'fieldName', 
        'ddText', 
        'ddValue',
        'isdefault',
    ];
}