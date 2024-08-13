<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class anxious_for_issue extends Model
{
    protected $table = 'anxious_for_issue';
    public $timestamps = true; 

    protected $fillable = [ 
                'case_id',
                'case_number',
                'wife_name',
                'wife_age',
                'husband_name',
                'husband_age',
                'married_since',
                'menstrual_history',
                'lmp',
                'obstetric_history',
                'other_medical_surgical_illness',
                'other_art_procedure_past',
                'hsg',
                'laproscopy',
                'hsf',
                'lh',
                'fsh',
                'tsh',
                'prolactin', 
                'amh', 
                'folliculometry', 
                'adviced'
                ];

}
