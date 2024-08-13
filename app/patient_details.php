<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient_details extends Model
{
    protected $table = 'patient_details';
    public $timestamps = true;    //
    protected $fillable = [ 
                'case_id',
                'case_number',
                'Complaints',
                'History',
                'PastPersonalHistory',
                'ObstetricMenstruution',
                'ObstetricMarriedSice',
                'ObstetricCMP',
                'ObstetricEDD',
                'MensturationHistory',
                'menarch',
                'menarch_two',
                'ObstetricG',
                'ObstetricP',
                'ObstetricL',
                'ObstetricA',
                'ObstetricD',
                'ObstetricText',
                'presentPregnecyLMP', 
                'presentPregnencyEDD', 
                'presentPregnencyUSG', 
                'presentPregnencyDate',
                'Education',
                'GenExamBuild',
                'GenExamHeight',
                'GenExamWeight',
                'GenExamPulse',
                'GenExamBP',
                'GenExamBP_lower',
                'GenExamRR',
                'GenExamPallor',
                'GenExamCyanosis',
                'GenExamIcterus',
                'GenExamEdema',
                'GenExamSkin',
                'SysExamCVS',
                'SysExamRS',
                'SysExamPA',
                'SysExamLocalExam',
                'ProvisionalDiagnosis',
                'InvestigationAdvice',
                'TreatmentAdvice',
                'Remark',
                'Text',
                'BMI',
                'Temp',
                'AG'
                ];

}
