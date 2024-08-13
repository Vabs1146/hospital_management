<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class glass_prescription extends Model
{
    protected $table = 'glass_prescriptions';
    public $timestamps = true;    //
    protected $fillable = [
        'case_id',
        'case_number',   
        'r_dv_sph',      
        'r_dv_cyl',      
        'r_dv_axi',      
        'r_dv_vision',   
        'l_dv_sph',      
        'l_dv_cyl',      
        'l_dv_axi',      
        'l_dv_vision',   
        'r_nv_sph',      
        'r_nv_cyl',      
        'r_nv_axi',      
        'r_nv_vision',   
        'l_nv_sph',      
        'l_nv_cyl',      
        'l_nv_axi',      
        'l_nv_vision', 
        'Report_1', 
        'Report_2', 
        'Report_3',
        'retino_scopy_OD',
        'retino_scopy_OS',
        'r_add_sph',
        'l_add_sph' 
    ];
}