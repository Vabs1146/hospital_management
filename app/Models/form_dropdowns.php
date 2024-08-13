<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class form_dropdowns extends Model
{
    protected $table = 'form_dropdowns';
    public $timestamps = true;
    protected $fillable = [
        'formName', 
        'fieldName', 
        'ddText', 
        'ddValue',
        'isdefault',
    ];
}