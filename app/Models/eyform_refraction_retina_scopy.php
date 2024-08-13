<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eyform_refraction_retina_scopy extends Model
{
    protected $table = 'eyform_refraction_retina_scopy';
    protected $primaryKey = 'refraction_id';
    public $timestamps = true;    //
    protected $fillable = [
        'id',
        'eyeformid',
        'retinaCopy_refraction_dv_sph_r',
        'retinaCopy_refraction_dv_cyl_r',
        'retinaCopy_refraction_dv_axis_r',
        'retinaCopy_refraction_dv_vision_r',
        
        'retinaCopy_refraction_dv_sph_l',
        'retinaCopy_refraction_dv_cyl_l',
        'retinaCopy_refraction_dv_axis_l',
        'retinaCopy_refraction_dv_vision_l',
        
        'retinaCopy_refraction_nv_sph_r',
        'retinaCopy_refraction_nv_cyl_r',
        'retinaCopy_refraction_nv_axis_r',
        'retinaCopy_refraction_nv_vision_r',
        
        'retinaCopy_refraction_nv_sph_l',
        'retinaCopy_refraction_nv_cyl_l',
        'retinaCopy_refraction_nv_axis_l',
        'retinaCopy_refraction_nv_vision_l',
        'created_at',
        'updated_at'
    ];
    
    public function eyeform(){
        return $this->belongsTo('App\entform','eyeformid', 'id');
    }
}