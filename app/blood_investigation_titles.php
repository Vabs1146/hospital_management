<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blood_investigation_titles extends Model
{
    //
    protected $table = 'blood_investigation_titles';
    public $timestamps = true;
     protected $fillable = [
        'id',
        'blood_title',
     
    ];   
    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'case_id', 'id');
    }
}