<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class entreport_images extends Model
{
    //
    protected $table = 'entreport_images';
    public $timestamps = false;    //
    protected $fillable = [
    'reportFileName',
    'case_id',
    'filePath'
    ];

    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'id', 'case_id');
    }
}
