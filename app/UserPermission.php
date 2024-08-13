<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useraccess extends Model
{
   protected $table='user_permission';
   
    protected $primaryKey = 'user_permission_id ';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'section_id'
    ];
    
    /*
    public function eyeform(){
        return $this->belongsTo('App\entform','eyeformid', 'id');
    }
     */
}
