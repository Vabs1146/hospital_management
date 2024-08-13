<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class form_master extends Model
{
    protected $table = 'form_master';
    public $timestamps = true;    //
    protected $fillable = [
        'form_name',
        'form_description',
        'view_path',
        'add_edit_path',
        'print_path',
        'index_path',
    ];

    public function form_master_form_field(){
        return $this->hasMany('App\Models\form_master_form_field','form_master_id', 'id');
    }
}