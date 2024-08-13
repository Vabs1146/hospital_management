<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class form_master_form_field extends Model
{
    protected $table = 'form_master_form_field';
    public $timestamps = false;    //
    protected $fillable = [
        'id',
        'form_master_id',
        'form_field_code',
    ];

    public function form_field_master(){
        return $this->belongsTo('App\Models\form_field_master', 'form_field_code', 'form_field_code');
    }
    public function form_master(){
        return $this->belongsTo('App\Models\form_master','form_master_id', 'id');
    }

}