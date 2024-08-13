<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entform extends Model
{
    protected $table = 'entform';
    public $timestamps = true;    //
    protected $fillable = [
    'case_id',
    'case_number',
    'leftear',
    'rightear',
    'nose',
    'neck',
    'throat'
    
    ];

    public function entformmultipleentry(){
        return $this->hasMany('App\Models\entformmultipleentry', 'eyeformid', 'id');
    }

}