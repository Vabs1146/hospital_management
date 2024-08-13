<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report_image extends Model
{
    //
    protected $table = 'report_images';
    public $timestamps = false;    //
    protected $fillable = [
    'reportFileName',
    'case_id',
    'filePath',
    'title'
    ];

    public function Case_master(){
        return $this->belongsTo('App\Case_master', 'id', 'case_id');
    }
}
