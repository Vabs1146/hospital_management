<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dentist extends Model
{
    protected $table = 'dentists';
    public $timestamps = true;    //
    protected $fillable = [
        'case_id', 
        'oral_examination', 
        'advised_treatment_1', 
        'advised_treatment_2', 
        'advised_treatment_3', 
        'advised_treatment_4', 
        'advised_treatment_5', 
        'is_diabetes', 
        'is_bp', 
        'is_haemophiles', 
        'any_other_disease'
    ];

    public function dentist_pain_in(){
        return $this->hasMany('App\Models\dentist_pain_in','dentist_id', 'id');
    }
}