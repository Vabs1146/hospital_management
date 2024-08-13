<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eyeform extends Model
{
    protected $table = 'eyeform';
    public $timestamps = true;    //
    protected $fillable = [
    'case_id',
    'case_number',
    'dvn_od',
    'dvn_os',
    'nvn_od',
    'nvn_os',
    'lids_od',
    'lids_os',
    'conjunctive_od',
    'conjunctive_os',
    'iris_od',
    'iris_os',
    'pupil_od',
    'pupil_os',
    'fundus_od',
    'fundus_os',
    'k1_od',
    'k1_os',
    'k2_od',
    'k2_os',
    'lenspower_od',
    'lenspower_os',
    'axial_length_OD',
    'axial_length_OS',
    'sac_od',
    'sac_os',
    'generalExamination',
    'Other',
    'otherDetailsDiagnosis',
	//'otherDetailsAnteriorSegment',
	//'otherDetailsPosteriorSegment',
    'systanicExamination',
    'CNS',
    'localExamReport',
    'treatmentAdvice',
    'OdImg1',
    'OsImg1',
    'OdImg2',
    'OsImg2',
        
        'OdImg1_comment',
'OsImg1_comment',

'OdImg2_comment',
'OsImg2_comment',
        
    'opticdisc_OD',
    'opticdisc_OS',
    'withglasses_OD',
    'withglasses_OS',
    'withpinhole_OD',
    'withpinhole_OS',
    'colour_vision_OD',
    'colour_vision_OS',  
        
    //'perimetry_sp_od',
    //'perimetry_sp_os', 
        
    //'laser_sp_od',
    //'laser_sp_os', 
        
    //'oculizer_sp_od',
    //'oculizer_sp_os', 
        
    //'ffa_sp_od',
    //'ffa_sp_os', 
        
    'visualacuity_OD',
    'visualacuity_OS',
    //'colour_OD',
    //'colour_OS',
    'shape_OD',
    'shape_OS',
    'size_OS',
    'size_OD',
    'Ratio_OD',
    'Ratio_OS',
    'Pachymetry_OD',
    'Pachymetry_OS',
    //'schimerTest1_OD',
    //'schimerTest1_OS',
    //'schimerTest2_OD',
    //'schimerTest2_OS',
    //'surgery',
	'advance_amount',
	'advance_payment_type',
	'advance_payment_reference',
	'advance_date',
    'sph_r_undi',
    'sph_r_di',
    'sph_l_undi',
    'sph_l_di',
    'cyl_r_undi',
    'cyl_r_di',
    'cyl_l_undi',
    'cyl_l_di',
    'Axis_r_undi',
    'Axis_r_di',
    'Axis_l_undi',
    'Axis_l_di',
    'retino_scopy_OD',
    'retino_scopy_OS',
    'CCT_OD',
    'CCT_OS',
    'Advice_OD',
    'Advice_OS',
    'BloodInvestigation',
    'KC_OD',
    'KC_OS',
    'vision_l_sa',
    'vision_r_sa',
    'vision_l_pga',
    'vision_r_pga',
    'Add_l_sa',
    'Add_r_sa',
    'Add_l_pga',
    'Add_r_pga',
    'Nvision_l_sa',
    'Nvision_r_sa',
    'Nvision_l_pga',
    'Nvision_r_pga',
    'gonio_od',
    'gonio_os',
    'IOP_OD',
    'IOP_OS',
    'familyHistory',
    'birthHistory',
    'lens_type_OD',
    'lens_type_OS',

	'sph_r_undi_sub',
'cyl_r_undi_sub',
'Axis_r_undi_sub',

'sph_l_undi_sub',
'cyl_l_undi_sub',
'Axis_l_undi_sub',

'sph_r_di_sub',
'cyl_r_di_sub',
'Axis_r_di_sub',

'sph_l_di_sub',
'cyl_l_di_sub',
'Axis_l_di_sub',
	'iop_od_time',
	'iop_os_time',
        'Vision_r_undi',
'Vision_l_undi',
'Vision_r_undi_sub',
'Vision_l_undi_sub',
'Vision_r_di',
'Vision_l_di',
'Vision_r_di_sub',
'Vision_l_di_sub',
'r_retinoscopy_sph',
'r_retinoscopy_cyl',
'r_retinoscopy_axi',
'r_retinoscopy_vision',
'l_retinoscopy_sph',
'l_retinoscopy_cyl',
'l_retinoscopy_axi',
'l_retinoscopy_vision',
'pastTreatmentHistory',
        'other_details_comment',
'with_glass_dilated_os',
        'with_glass_dilated_od'
    ];

    public function eyeformmultipleentry(){
        return $this->hasMany('App\Models\eyeformmultipleentry', 'eyeformid', 'id');
    }
    
    public function eyform_refraction_retina_scopy(){
        return $this->hasOne('App\Models\eyform_refraction_retina_scopy', 'eyeformid', 'id');
    }
    
    public function eyform_vision_pgp(){
        return $this->hasOne('App\Models\eyform_vision_pgp', 'eyeformid', 'id');
    }

}