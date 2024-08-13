<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class md_form_dropdowns extends Model
{
    protected $table = 'md_form_dropdowns';
    public $timestamps = true;
    protected $fillable = [
        'formName', 
        'fieldName', 
        'ddText', 
        'ddValue',
        'isdefault',
    ];
}
