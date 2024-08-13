<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eyform_vision_pgp extends Model
{
    protected $table = 'eyform_vision_pgp';
    protected $primaryKey = 'pgp_id';
    public $timestamps = true;    //
    protected $fillable = [
        'id',
        'eyeformid',
        'vision_pgp_dv_sph_r',
        'vision_pgp_dv_cyl_r',
        'vision_pgp_dv_axis_r',
        'vision_pgp_dv_vision_r',
        
        'vision_pgp_dv_sph_l',
        'vision_pgp_dv_cyl_l',
        'vision_pgp_dv_axis_l',
        'vision_pgp_dv_vision_l',
        
        'vision_pgp_nv_sph_r',
        'vision_pgp_nv_cyl_r',
        'vision_pgp_nv_axis_r',
        'vision_pgp_nv_vision_r',
        
        'vision_pgp_nv_sph_l',
        'vision_pgp_nv_cyl_l',
        'vision_pgp_nv_axis_l',
        'vision_pgp_nv_vision_l',
        'created_at',
        'updated_at'
    ];
    
    public function eyeform(){
        return $this->belongsTo('App\entform','eyeformid', 'id');
    }
}