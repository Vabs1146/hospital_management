<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patients_form_dropdowns extends Model
{
    protected $table = 'patients_form_dropdowns';
    public $timestamps = true;
    protected $fillable = [
        'formName', 
        'fieldName', 
        'ddText', 
        'ddValue',
        'isdefault',
    ];
}
