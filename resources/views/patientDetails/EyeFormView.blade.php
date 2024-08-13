@extends('adminlayouts.master')
@section('style')
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }
	
.details-section {
    color: initial;
    text-align: center;
    margin-bottom: 7px;
    padding-top: 4px;
    padding-bottom: 1px;
    margin-top: -2px;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
 
 
@endsection
@section('content')
<div class="container">
    <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
            @if($casedata['id'] == $VisitListDateWise['id'])
                <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
            @else
                <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
            @endif
        @endforeach
    </div>
</div>
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                    <div class="card">
                        <form action="{{ url('/AddEditEyeDetails/').'/'.$casedata['id'] }}" method="GET" class="form-horizontal">
                          {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2> 
                                Patient History  View
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                             <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_9" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-pink">
                                            <div class="panel-heading" role="tab" id="headingOne_9">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_9" href="#collapseOne_9" aria-expanded="true" aria-controls="collapseOne_9">
                                                        Patient History | Case Number : {{ $casedata['case_number'] }}  | {{ 'Time :' . $casedata['visit_time']}}
                                                    </a>
                                                </h4>
                                            </div>
											<?php if(!empty($casedata['infection']) || !empty($casedata['miscellaneous_history'])) {?>
                         <div class="header bg-yellow">
                            <div class="col-md-12" style="margin-top: -10px;"><h2>
							<marquee>
                                <div class="col-md-2">Infection</div><div class="col-md-3 details-section">{{ $casedata['infection'] }}</div> 
                                <div class="col-md-3">Miscellaneous History</div><div class="col-md-4 details-section">{{ $casedata['miscellaneous_history'] }}</div></h2>
								</marquee>
                            </div>
                        </div>
                        <?php } ?>
                          <div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
                          {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
            <div class="panel-body">
            <div class="row clearfix">
            <div class="col-md-12">
              <div class="form-group">
              {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
              </div>
            </div>
            <div class="col-md-12">
                <label class="control-label">General Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
              </div>
            </div>

              <div class="col-md-12">
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
                       @foreach ($form_details->patients_systemic_history as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Systemic History
                            @endif
                        </td>
                        <td colspan="2">
                            {{$item->value}}
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
<!--                            <tr>
                                <td>
                                    PGP
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OD }}
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OS }}
                                </td>
                            </tr>-->
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


<!--          =====================================================               -->
                        @if(!$CheckField::IsFieldEmpty($form_details->perimetry_sp_od) && !$CheckField::IsFieldEmpty($form_details->perimetry_sp_os))
                            <tr>
                                <td>
                                    Perimetry
                                </td>
                                <td>
                                    {{ $form_details->perimetry_sp_od }}
                                </td>
                                <td>
                                    {{ $form_details->perimetry_sp_os }}
                                </td>
                            </tr>
                        @endif
                        
                         @if(!$CheckField::IsFieldEmpty($form_details->laser_sp_od) && !$CheckField::IsFieldEmpty($form_details->laser_sp_os))
                            <tr>
                                <td>
                                    Laser
                                </td>
                                <td>
                                    {{ $form_details->laser_sp_od }}
                                </td>
                                <td>
                                    {{ $form_details->laser_sp_os }}
                                </td>
                            </tr>
                        @endif
                        
                         @if(!$CheckField::IsFieldEmpty($form_details->oculizer_sp_od) && !$CheckField::IsFieldEmpty($form_details->oculizer_sp_os))
                            <tr>
                                <td>
                                    Oculizer
                                </td>
                                <td>
                                    {{ $form_details->oculizer_sp_od }}
                                </td>
                                <td>
                                    {{ $form_details->oculizer_sp_os }}
                                </td>
                            </tr>
                        @endif
                         @if(!$CheckField::IsFieldEmpty($form_details->ffa_sp_od) && !$CheckField::IsFieldEmpty($form_details->ffa_sp_os))
                            <tr>
                                <td>
                                    Ffa
                                </td>
                                <td>
                                    {{ $form_details->ffa_sp_od }}
                                </td>
                                <td>
                                    {{ $form_details->ffa_sp_os }}
                                </td>
                            </tr>
                        @endif
                        
<!--      ==============================================================-->
                        
                        @if(!$CheckField::IsFieldEmpty($form_details->withglasses_OD) && !$CheckField::IsFieldEmpty($form_details->withglasses_OS))
                            <tr>
                                <td>
                                    With glasses
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OD }}
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OS }}
                                </td>
                            </tr>
                        @endif
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ConjAndLids')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Conj
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Lids')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Lids
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'AC')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    AC
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'IRIS')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    IRIS
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'sac')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    sac
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Retina')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Retina
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Macula')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Macula
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ONH')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    ONH
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
                                    Orbit
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
                                    pupil
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
						@if(!$CheckField::IsFieldEmpty($form_details->lens_type_od) && !$CheckField::IsFieldEmpty($form_details->lens_type_os))
                            <tr>
                                <td>
                                    Type of Lens
                                </td>
                                <td>
                                    {{ $form_details->lens_type_od }}
                                </td>
                                <td>
                                    {{ $form_details->lens_type_os }}
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
              </div>  
              @if(!$CheckField::IsFieldEmpty($form_details->otherDetailsDiagnosis))
                <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Diagnosis :</label>   {!! nl2br($form_details->otherDetailsDiagnosis) !!} 
                        </div>
                    </div>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->systanicExamination))
                <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">ANTERIOR SEGMENT' :</label>   {!! nl2br($form_details->systanicExamination) !!} 
                        </div>
                    </div>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->treatmentAdvice))
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">POSTERIOR SEGMENT' :</label>   {!! nl2br($form_details->treatmentAdvice) !!} 
                        </div>
                    </div>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->localExamReport))
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Additional Information :</label>   {!! nl2br($form_details->localExamReport) !!} 
                        </div>
                    </div>
                @endif
                @if(!empty($casedata->appointment_dt) && !is_null($casedata->appointment_dt) && !isset($casedata->appointment_dt))
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Followup Date :</label>   {{ $casedata['appointment_dt'] }} 
                        </div>
                    </div>
                @endif
                @if(!empty($casedata->appointment_timeslot) && !is_null($casedata->appointment_timeslot) && !isset($casedata->appointment_timeslot))
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Followup Time :</label>   {{ $casedata['appointment_timeslot'] }} 
                        </div>
                    </div>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->surgery))       
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"> Surgery :</label>   {{$form_details->surgery}}  
                        </div>
                    </div>
                @endif
                
                <div class="row clearfix">
                    @if(isset($casedata['Before_file']) && $casedata['Before_file'] != null)
                        <div class="col-sm-12"> 
                            Before Image
                        </div>
                        <div class="col-sm-12"> 
                            <img src={{ Storage::disk('local')->url($casedata['Before_file'])."?".filemtime(Storage::path($casedata['Before_file'])) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                        </div>
                    @endif                
                </div>

                <div class="row clearfix">
                    @if(isset($casedata['After_file']) && $casedata['After_file'] != null)
                        <div class="col-sm-12"> 
                            After Image
                        </div>
                        <div class="col-sm-12"> 
                            <img src={{ Storage::disk('local')->url($casedata['After_file'])."?".filemtime(Storage::path($casedata['After_file'])) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                        </div>
                    @endif
                </div>
                
<!--                ==================================================-->
@if($eyform_vision_pgp_details)
    @if($eyform_vision_pgp_details->vision_pgp_dv_sph_r || $eyform_vision_pgp_details->vision_pgp_dv_cyl_r || $eyform_vision_pgp_details->vision_pgp_dv_axis_r || $eyform_vision_pgp_details->vision_pgp_dv_vision_r || $eyform_vision_pgp_details->vision_pgp_dv_sph_l || $eyform_vision_pgp_details->vision_pgp_dv_cyl_l || $eyform_vision_pgp_details->vision_pgp_dv_axis_l || $eyform_vision_pgp_details->vision_pgp_dv_vision_l || $eyform_vision_pgp_details->vision_pgp_nv_sph_r || $eyform_vision_pgp_details->vision_pgp_nv_cyl_r || $eyform_vision_pgp_details->vision_pgp_nv_axis_r || $eyform_vision_pgp_details->vision_pgp_nv_vision_r || $eyform_vision_pgp_details->vision_pgp_nv_sph_l || $eyform_vision_pgp_details->vision_pgp_nv_cyl_l || $eyform_vision_pgp_details->vision_pgp_nv_axis_l || $eyform_vision_pgp_details->vision_pgp_nv_vision_l)
 <div > 
    PGP
</div>
    @include('EyeForm.view_templates.eyform_vision_pgp_details')
@endif
@endif

@if($glass_prescription)
    @if($glass_prescription->r_dv_sph || $glass_prescription->r_dv_cyl || 
	$glass_prescription->r_dv_axi || $glass_prescription->r_dv_vision || 
	$glass_prescription->l_dv_sph || $glass_prescription->l_dv_cyl || 
	$glass_prescription->l_dv_axi || $glass_prescription->l_dv_vision || 

	$glass_prescription->r_nv_sph || $glass_prescription->r_nv_cyl || 
	$glass_prescription->r_nv_axi || $glass_prescription->r_nv_vision || 
	$glass_prescription->l_nv_sph || $glass_prescription->l_nv_cyl || 
	$glass_prescription->l_nv_axi || $glass_prescription->l_nv_vision)
 <div > 
                           Refraction
                        </div>
    @include('EyeForm.view_templates.eyform_refraction_retina_scopy_details')
@endif
    @endif



<!--                ==================================================-->
 @if($form_details->sph_r_undi || $form_details->cyl_r_undi || $form_details->Axis_r_undi || $form_details->vision_r_sa || $form_details->Add_r_sa || $form_details->Nvision_r_sa || $form_details->sph_l_undi || $form_details->cyl_l_undi || $form_details->Axis_l_undi || $form_details->vision_l_sa || $form_details->Add_l_sa || $form_details->Nvision_l_sa || $form_details->sph_r_di || $form_details->cyl_r_di || $form_details->Axis_r_di || $form_details->vision_r_pga || $form_details->Add_r_pga || $form_details->Nvision_r_pga || $form_details->sph_l_di || $form_details->cyl_l_di || $form_details->Axis_l_di || $form_details->vision_l_pga || $form_details->Add_l_pga || $form_details->Nvision_l_pga )             
                <div class="col-md-12">
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
                <div class="col-md-12">
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
                </div>
                <br>
                <br>
                <br>

                <div class="col-md-12">
                    <ul class="list-unstyled">
                        <li class="">Please bring this paper on every visit</li>
                        <li class=""> Please follow the time </li>
                        <li class=""> Please inform allergy immediately </li>
                    </ul>
                </div>
          
                <div class="col-md-12">
                    @if(count($form_details->uveiitis_bloodtests_data) > 0)
                    <div class="col-md-4">
                        <label for="uveiitis_chk"><b>Investigation For Uveiitis</b></label>
                          <ul class="list-group1">
                                            @foreach($form_details->uveiitis_bloodtests_data as $key => $uveiitis_bloodtests_row)
							<li class="list-group-item1" style="">{{$uveiitis_bloodtests_row}}</li>
						  @endforeach
                                        </ul>
                    </div>
                     @endif
                    @if(count($form_details->pre_operative_bloodtests_data) > 0)
                    <div class="col-md-4">
                    <label for="preoperative_chk"><b>Pre Operative Investigation</b></label>
                    <ul class="list-group1">
                                         @foreach($form_details->pre_operative_bloodtests_data as $key => $pre_operative_bloodtests_row)
							<li class="list-group-item1" style="">{{$pre_operative_bloodtests_row}}</li>
						  @endforeach
					</ul>
                         
                    </div>
                     @endif

                </div>
               
                <div class="row clearfix">
                  <div class="col-md-4 col-md-offset-4">
                  <div class="form-group">
                  <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> &nbsp;   
                  <button type="submit" class="btn btn-default btn-lg"> Edit </button>&nbsp;
                  <a class="btn btn-default btn-lg" href="{{ url('/PrintMedicalDetails/').'/'.$casedata['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>
                  </div>
                  </div>
                </div>

                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </form>
                </div>
                </div>
                </div>
             </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#medicine_id').select2();  
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });    
    });
</script>
 
@endsection
  