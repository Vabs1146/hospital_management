<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
    /* Print styling */
 
    @media print {
        [class*="col-sm-"] {
            float: left;
        }
        [class*="col-xs-"] {
            float: left;
        }
        .col-sm-12,
        .col-xs-12 {
            width: 100% !important;
        }
        .col-sm-11,
        .col-xs-11 {
            width: 91.66666667% !important;
        }
        .col-sm-10,
        .col-xs-10 {
            width: 83.33333333% !important;
        }
        .col-sm-9,
        .col-xs-9 {
            width: 75% !important;
        }
        .col-sm-8,
        .col-xs-8 {
            width: 66.66666667% !important;
        }
        .col-sm-7,
        .col-xs-7 {
            width: 58.33333333% !important;
        }
        .col-sm-6,
        .col-xs-6 {
            width: 50% !important;
        }
        .col-sm-5,
        .col-xs-5 {
            width: 41.66666667% !important;
        }
        .col-sm-4,
        .col-xs-4 {
            width: 33.33333333% !important;
        }
        .col-sm-3,
        .col-xs-3 {
            width: 25% !important;
        }
        .col-sm-2,
        .col-xs-2 {
            width: 16.66666667% !important;
        }
        .col-sm-1,
        .col-xs-1 {
            width: 8.33333333% !important;
        }
        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-xs-1,
        .col-xs-2,
        .col-xs-3,
        .col-xs-4,
        .col-xs-5,
        .col-xs-6,
        .col-xs-7,
        .col-xs-8,
        .col-xs-9,
        .col-xs-10,
        .col-xs-11,
        .col-xs-12 {
            float: left !important;
        }
        body {
            margin: 0;
            padding: 0 !important;
            min-width: 768px;
        }
        .container {
            width: auto;
            min-width: 750px;
        }
        body {
            font-size: 10px;
        }
        a[href]:after {
            content: none;
        }
        .noprint,
        div.alert,
        header,
        .group-media,
        .btn,
        .footer,
        form,
        #comments,
        .nav,
        ul.links.list-inline,
        ul.action-links {
            display: none !important;
        }
    }
 
    </style>
</head>
<body>
 <div class="container-fluid">
     @php
     extract($mailContent);    
     @endphp
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-sm-6">
            <label for="date" class="control-label">Time :</label>   
            {{ $casedata['visit_time'] }}
        </div>
    </div>
    <div class="row">
            <div class="col-sm-6">
                <label for="case_number" class="control-label">Case Number :</label>   {{ $casedata['case_number'] }} 
            </div>
            <div class="col-sm-6">
                 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $casedata['patient_name'] }} 
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <label class="control-label">Age :</label>   {{ $casedata['patient_age'] }}
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Gender :</label>   {{ $casedata['male_female'] }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Address :</label>   {{ $casedata['patient_address'] }} 
            </div>
            <div class="col-sm-6">
                <label class="control-label">Contact No. :</label>   {{ $casedata['patient_mobile'] }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Appointment Dt :</label>   {{ $casedata['appointment_dt'] }} 
            </div>
            <div class="col-sm-6">
                <label class="control-label">Appointment Time. :</label>   {{ $casedata['appointment_timeslot'] }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label"></label>   {{ $form_details->ChiefComplaint }} 
            </div>
        </div>
        <br>
        <br>
        @if(!$CheckField::IsFieldEmpty($form_details->CNS))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Genral Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
                </div>
            </div>
        @endif
        <br>
        <br>
        <div class="table-responsive">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <td >
                             
                        </td>
                        <td >
                            <strong>OD</strong>
                        </td>
                        <td >
                            <strong>OS</strong>
                        </td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ChiefComplaint')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Chief Complaint
                            @endif  
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach 
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OpthalHistory')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Opthal History
                            @endif  
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'SystemicHistory')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Systemic History
                            @endif
                        </td>
                        <td colspan="2">
                            {{$item->field_value_OD}}
                        </td>
                    </tr>
                @endforeach
                @if(!$CheckField::IsFieldEmpty($form_details->familyHistory))
                <tr>
                    <td>
                        Family History
                    </td>
                    <td colspan="2">
                        {{ nl2br($form_details->familyHistory) }}
                    </td>
                </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->birthHistory))
                <tr>
                    <td>
                        Birth History
                    </td>
                    <td colspan="2">
                        {{ nl2br($form_details->birthHistory) }}
                    </td>
                </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->dvn_od) && !$CheckField::IsFieldEmpty($form_details->dvn_os))
                    <tr>
                        <td>
                            Distant Vision UNAIDED
                        </td>
                        <td>
                            {{ $form_details->dvn_od }}
                        </td>
                        <td>
                            {{ $form_details->dvn_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->nvn_od) && !$CheckField::IsFieldEmpty($form_details->nvn_os))
                    <tr>
                        <td>
                            Near Vision UNAIDED
                        </td>
                        <td>
                            {{ $form_details->nvn_od }}
                        </td>
                        <td>
                            {{ $form_details->nvn_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->visualacuity_OD) && !$CheckField::IsFieldEmpty($form_details->visualacuity_OS))
                    <tr>
                        <td>
                            Distant Vision Aided
                        </td>
                        <td>
                            {{ $form_details->visualacuity_OD }}
                        </td>
                        <td>
                            {{ $form_details->visualacuity_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->withglasses_OD) && !$CheckField::IsFieldEmpty($form_details->withglasses_OS))
                    <tr>
                        <td>
                            Near Vision Aided
                        </td>
                        <td>
                            {{ $form_details->withglasses_OD }}
                        </td>
                        <td>
                            {{ $form_details->withglasses_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->withpinhole_OD) && !$CheckField::IsFieldEmpty($form_details->withpinhole_OS))
                    <tr>
                        <td>
                            With Pinhole
                        </td>
                        <td>
                            {{ $form_details->withpinhole_OD }}
                        </td>
                        <td>
                            {{ $form_details->withpinhole_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->colour_vision_OD) && !$CheckField::IsFieldEmpty($form_details->colour_vision_OS))
                    <tr>
                        <td>
                            Colour vision
                        </td>
                        <td>
                            {{ $form_details->colour_vision_OD }}
                        </td>
                        <td>
                            {{ $form_details->colour_vision_OS }}
                        </td>
                    </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ConjAndLids')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Conj And Lids
                            @endif
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OrbitSacsEyeMotility')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Orbit Sacs & Eye Motility
                            @endif
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'cornia')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            CORNEA
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1) && !empty($form_details->OsImg1) && !is_null($form_details->OsImg1))
                <tr>
                   <td></td>
                   <td>
                        @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1))
                            <p>&nbsp;</p>
                            <center id="wPaint-OdImg1"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OdImg1)."?".filemtime(Storage::path($form_details->OdImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                            </center>
                        @endif
                   </td>
                   <td>
                        @if (!empty($form_details->OsImg1) && !is_null($form_details->OsImg1))                        
                            <p>&nbsp;</p>
                            <center id="wPaint-OsImg1"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OsImg1)."?".filemtime(Storage::path($form_details->OsImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />  
                            </center>
                        @endif
                   </td>
                </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pupilIrisac')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            pupil Iris a.c.
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'lens')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            LENS
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2) && !empty($form_details->OsImg2) && !is_null($form_details->OsImg2))
                <tr>
                   <td></td>
                   <td>
                        @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2))
                            <p>&nbsp;</p>
                            <center id="wPaint-OdImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OdImg2)."?".filemtime(Storage::path($form_details->OdImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                            </center>
                        @endif
                   </td>
                   <td>
                        @if (!empty($form_details->OsImg2) && !is_null($form_details->OsImg2))                        
                            <p>&nbsp;</p>
                            <center id="wPaint-OsImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OsImg2)."?".filemtime(Storage::path($form_details->OsImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />  
                            </center>
                        @endif
                   </td>
                </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'vitreoretinal')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            vitreo retinal
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if(!$CheckField::IsFieldEmpty($form_details->IOP_OD) && !$CheckField::IsFieldEmpty($form_details->IOP_OS))
                    <tr>
                        <td>
                            IOP
                        </td>
                        <td>
                            {{ $form_details->IOP_OD }}
                        </td>
                        <td>
                            {{ $form_details->IOP_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->Ratio_OD) && !$CheckField::IsFieldEmpty($form_details->Ratio_OS))
                    <tr>
                        <td>
                           CD Ratio
                        </td>
                        <td>
                            {{ $form_details->Ratio_OD }}
                        </td>
                        <td>
                            {{ $form_details->Ratio_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->Pachymetry_OD) && !$CheckField::IsFieldEmpty($form_details->Pachymetry_OS))
                    <tr>
                        <td>
                            Pachymetry
                        </td>
                        <td>
                            {{ $form_details->Pachymetry_OD }}
                        </td>
                        <td>
                            {{ $form_details->Pachymetry_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->CCT_OD) && !$CheckField::IsFieldEmpty($form_details->CCT_OS))
                    <tr>
                        <td>
                            CCT
                        </td>
                        <td>
                            {{ $form_details->CCT_OD }}
                        </td>
                        <td>
                            {{ $form_details->CCT_OS }}
                        </td>
                    </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'diagno')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Diagnosis
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if(!$CheckField::IsFieldEmpty($form_details->Advice_OD) && !$CheckField::IsFieldEmpty($form_details->Advice_OS))
                    <tr>
                        <td>
                            Advice
                        </td>
                        <td>
                            {{ nl2br($form_details->Advice_OD) }}
                        </td>
                        <td>
                            {{ nl2br($form_details->Advice_OS) }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->BloodInvestigation))
                    <tr>
                        <td>
                            Blood Investigation
                        </td>
                        <td colspan="2">
                            {{ nl2br($form_details->BloodInvestigation) }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->k1_od) && !$CheckField::IsFieldEmpty($form_details->k1_os))
                    <tr>
                        <td>
                            K1
                        </td>
                        <td>
                            {{ $form_details->k1_od }}
                        </td>
                        <td>
                            {{ $form_details->k1_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->k2_od) && !$CheckField::IsFieldEmpty($form_details->k2_os))
                    <tr>
                        <td>
                            K2
                        </td>
                        <td>
                            {{ $form_details->k2_od }}
                        </td>
                        <td>
                            {{ $form_details->k2_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->lenspower_od) && !$CheckField::IsFieldEmpty($form_details->lenspower_os))
                    <tr>
                        <td>
                            Lens Power
                        </td>
                        <td>
                            {{ $form_details->lenspower_od }}
                        </td>
                        <td>
                            {{ $form_details->lenspower_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->axial_length_OD) && !$CheckField::IsFieldEmpty($form_details->axial_length_OS))
                    <tr>
                        <td>
                            Axial Lenght
                        </td>
                        <td>
                            {{ $form_details->axial_length_OD }}
                        </td>
                        <td>
                            {{ $form_details->axial_length_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->KC_OD) && !$CheckField::IsFieldEmpty($form_details->KC_OS))
                    <tr>
                        <td>
                            KC
                        </td>
                        <td>
                            {{ $form_details->KC_OD }}
                        </td>
                        <td>
                            {{ $form_details->KC_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->colour_OD) && !$CheckField::IsFieldEmpty($form_details->colour_OS))
                    <tr>
                        <td>
                            colour  Vision
                        </td>
                        <td>
                            {{ $form_details->colour_OD }}
                        </td>
                        <td>
                            {{ $form_details->colour_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->schimerTest1_OD) && !$CheckField::IsFieldEmpty($form_details->schimerTest1_OS))
                    <tr>
                        <td>
                            Schimer Test 1
                        </td>
                        <td>
                            {{ $form_details->schimerTest1_OD }}
                        </td>
                        <td>
                            {{ $form_details->schimerTest1_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->schimerTest2_OD) && !$CheckField::IsFieldEmpty($form_details->schimerTest2_OS))
                    <tr>
                        <td>
                            Schimer Test 2
                        </td>
                        <td>
                            {{ $form_details->schimerTest2_OD }}
                        </td>
                        <td>
                            {{ $form_details->schimerTest2_OS }}
                        </td>
                    </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Optical Coherence tomography (OCT)
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                        Extra Ocular Movement (EOM)
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if(!$CheckField::IsFieldEmpty($form_details->systanicExamination))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">ANTERIOR SEGMENT :</label>   {!! nl2br($form_details->systanicExamination) !!} 
                </div>
            </div>
        @endif
        @if(!$CheckField::IsFieldEmpty($form_details->treatmentAdvice))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">POSTERIOR SEGMENT :</label>   {!! nl2br($form_details->treatmentAdvice) !!} 
                </div>
            </div>
        @endif
        @if(!$CheckField::IsFieldEmpty($form_details->localExamReport))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Additional Information :</label>   {!! nl2br($form_details->localExamReport) !!} 
                </div>
            </div>
        @endif
        @if(!empty($casedata->appointment_dt) && !is_null($casedata->appointment_dt) && !isset($casedata->appointment_dt))
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Followup Date :</label>   {{ $casedata['appointment_dt'] }} 
                </div>
            </div>
        
            <br>
            <br>
            <br>
        @endif
        @if(!$CheckField::IsFieldEmpty($form_details->surgery))       
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label"> Surgery :</label>   {{$form_details->surgery}}  
            </div>
        </div>
        @endif
        @if (!$CheckField::IsFieldEmpty($form_details->sph_r_undi) ||
        !$CheckField::IsFieldEmpty($form_details->sph_r_di) ||
        !$CheckField::IsFieldEmpty($form_details->sph_l_undi) ||
        !$CheckField::IsFieldEmpty($form_details->sph_l_di) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_r_undi) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_r_di) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_l_undi) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_l_di) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_r_undi) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_r_di) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_l_undi) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_l_di) ||       
        !$CheckField::IsFieldEmpty($form_details->vision_l_sa) ||
        !$CheckField::IsFieldEmpty($form_details->vision_r_sa) ||
        !$CheckField::IsFieldEmpty($form_details->vision_l_pga) ||
        !$CheckField::IsFieldEmpty($form_details->vision_r_pga) ||       
        !$CheckField::IsFieldEmpty($form_details->Add_l_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Add_r_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Add_l_pga) ||
        !$CheckField::IsFieldEmpty($form_details->Add_r_pga) ||       
        !$CheckField::IsFieldEmpty($form_details->Nvision_l_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Nvision_r_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Nvision_l_pga) ||
        !$CheckField::IsFieldEmpty($form_details->Nvision_r_pga)       
        )
            <br/>
            <br/>
            <br/>
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Refraction</label>
                </div>
            </div>
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th colspan="6" class="text-center">Right</th>
                                <th colspan="6" class="text-center">Left</th>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                                <th>SPH</th>
                                <th>CYL</th>
                                <th>Axis</th>
                                <th>Vision</th>
                                <th>Add</th>
                                <th>N Vision</th>
                                <th>SPH</th>
                                <th>CYL</th>
                                <th>Axis</th>
                                <th>Vision</th>
                                <th>Add</th>
                                <th>N Vision</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>S/A</td>
                                <td>
                                    {{ $form_details->sph_r_undi }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_r_undi }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_r_undi }}
                                </td>
                                <td>
                                    {{ $form_details->vision_r_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Add_r_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_r_sa }}
                                </td>
                                <td>
                                    {{ $form_details->sph_l_undi }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_l_undi }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_l_undi }}
                                </td>
                                <td>
                                    {{ $form_details->vision_l_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Add_l_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_l_sa }}
                                </td>
                            </tr>
                            <tr>
                                <td>PGP</td>
                                <td>
                                    {{ $form_details->sph_r_di }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_r_di }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_r_di }}
                                </td>
                                <td>
                                    {{ $form_details->vision_r_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Add_r_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_r_pga }}
                                </td>
                                <td>
                                    {{ $form_details->sph_l_di }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_l_di }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_l_di }}
                                </td>
                                <td>
                                    {{ $form_details->vision_l_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Add_l_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_l_pga }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD) && !empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))
            <div class="table-responsive">    
                <table width="100%">
                    <tr>
                        <td class="col-md-2">&nbsp;</td>
                        <td class="col-md-5" colspan="4" >
                            @if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD))
                                <p>&nbsp;</p>
                                <center id="wPaint-retino_scopy_OD"> 
                                        <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OD)."?".filemtime(Storage::path($form_details->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />
                                </center>
                            @endif
                        </td>
                        <td class="col-md-5" colspan="4" >
                            @if (!empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))                        
                                <p>&nbsp;</p>
                                <center id="wPaint-retino_scopy_OS"> 
                                        <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OS)."?".filemtime(Storage::path($form_details->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />  
                                </center>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        @endif


        @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Prescription</label>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>
                    Medicine
                </th>
                <th>
                    Strength
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Times a Day
                </th>
            </tr>
            @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
            <tr>
                <td>
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                <td>
                    {{ $prescption->strength }}
                </td>
                <td>
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td>
                    {{ $prescption->numberoftimes }}
                </td>
            <tr>
            @endforeach
        </table>
        @endif
        <br>
        <br>
        <BR/>
        @if (!$CheckField::IsFieldEmpty($glass_prescription->r_dv_sph) || 
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_vision)
        )
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Glass Prescription</label>
            </div>
        </div>
        <div class="table-responsive">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="5" align="center">
                                    <strong>Right</strong>
                                </td>
                                <td colspan="4" align="center">
                                <strong>Left Eye</strong>
                                </td>                           
                            </tr>
                            <tr>
                                <td>
                                    <strong>&nbsp;</strong>
                                </td>
                                <td align="center">
                                <strong>SPH</strong>
                                </td>                           
                                <td align="center">
                                    <strong>CYL</strong>
                                </td>
                                <td align="center">
                                <strong>AXI</strong>
                                </td>                           
                                <td align="center">
                                <strong>VISION</strong>
                                </td>
                                <td align="center">
                                <strong>SPH</strong>
                                </td>                           
                                <td align="center">
                                    <strong>CYL</strong>
                                </td>
                                <td align="center">
                                    <strong>AXI</strong>
                                </td>                           
                                <td align="center">
                                    <strong>VISION</strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>D.V.</strong>
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->r_dv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_dv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->r_dv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_dv_vision }}
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->l_dv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_dv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->l_dv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_dv_vision }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>N.V.</strong>
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->r_nv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_nv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->r_nv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_nv_vision }}
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->l_nv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_nv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->l_nv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_nv_vision }}
                                </td>
                            </tr>
                        </tbody>
                </table>
                @if (!empty($glass_prescription->retino_scopy_OD) && !is_null($glass_prescription->retino_scopy_OD) && !empty($glass_prescription->retino_scopy_OS) && !is_null($glass_prescription->retino_scopy_OS))
                    <div class="table-responsive">    
                        <table width="100%">
                            <tr>
                                <td class="col-md-2">&nbsp;</td>
                                <td class="col-md-5" colspan="4" >
                                    @if (!empty($glass_prescription->retino_scopy_OD) && !is_null($glass_prescription->retino_scopy_OD))
                                        <p>&nbsp;</p>
                                        <center id="wPaint-retino_scopy_OD"> 
                                                <img src={{ Storage::disk('local')->url($glass_prescription->retino_scopy_OD)."?".filemtime(Storage::path($glass_prescription->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />
                                        </center>
                                    @endif
                                </td>
                                <td class="col-md-5" colspan="4" >
                                    @if (!empty($glass_prescription->retino_scopy_OS) && !is_null($glass_prescription->retino_scopy_OS))                        
                                        <p>&nbsp;</p>
                                        <center id="wPaint-retino_scopy_OS"> 
                                                <img src={{ Storage::disk('local')->url($glass_prescription->retino_scopy_OS)."?".filemtime(Storage::path($glass_prescription->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />  
                                        </center>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
        </div>
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_1))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 1 :</label>   {{ $glass_prescription->Report_1 }} 
                    </div>
                </div>
            @endif
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_2))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 2 :</label>   {{ $glass_prescription->Report_2 }} 
                    </div>
                </div>
            @endif
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_3))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 3 :</label>   {{ $glass_prescription->Report_3 }} 
                    </div>
                </div>
            @endif
        @endif
        <br>
        <br>
        <div class="form-group">
                <ul class="list-unstyled">
                    <li class="">Please bring this paper on every visit</li>
                    <li class=""> Please follow the time </li>
                    <li class=""> Please inform allergy immediately </li>
                </ul>
            </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <img src={{ Storage::disk('local')->url($FooterUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { window.print(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>
 
</body>
</html>