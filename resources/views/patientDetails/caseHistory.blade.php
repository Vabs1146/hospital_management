@extends('adminlayouts.master')

@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">
<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">
<style>
        /*
        * drawingboards styles: set the board dimensions you want with CSS
        */

        .board {
            margin: 0 auto;
            width: 200px;
            height: 150px;
        }

        .panel-title .trigger:before {
        content: '\f151';
        /* '\f056'; */
        font-family: 'FontAwesome';
        vertical-align: text-bottom;
        }

        .panel-title .trigger.collapsed:before {
        content: '\f150'; 
        /* '\f055'; */
        font-family: 'FontAwesome';
        }
        .HistoryremoveButton,.PastPersonalHistoryremoveButton,.menarchremoveButton,.ObstetricTextremoveButton,.EducationremoveButton,.SysExamCVSremoveButton,.SysExamRSremoveButton,.ProvisionalDiagnosisremoveButton,.InvestigationAdvicebtnremoveButton
                {
          color: #700;
          cursor: pointer;
        }
        .HistoryremoveButton,.PastPersonalHistoryremoveButton,.menarchremoveButton,.ObstetricTextremoveButton,.EducationremoveButton,.SysExamCVSremoveButton,.SysExamRSremoveButton,.ProvisionalDiagnosisremoveButton,.InvestigationAdvicebtnremoveButton:hover {
          color: #f00;
        }

</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
            <form action="{{ url('/patientDetails/SaveCaseHistory') }}" method="POST" class="form-horizontal" id="mdform">
            {{--  {{ Form::model($casedata, array('route' => array('case_masters.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}  --}}
                {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2>
                               Patient History
                            </h2>
                          
                        </div>
                        <div class="body">
                          {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
                          <div class="row clearfix">
                          <div class="col-md-12">
                            {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
							  {{ Form::hidden('patient_emailId', Request::old('patient_emailId',$casedata['patient_emailId']), array('class'=> 'form-control')) }}
                            <h3> Case Number : {{ $casedata['case_number'] }} </h3>
                          </div>
                          <div class="col-md-12">
                            {{ Form::label('Complaints','Presenting Complaints with duration') }} 
                            {{ Form::textarea('Complaints', Request::old('Complaints',$patient_details->Complaints), array('class'=> 'form-control')) }}
                          </div>


<!---------------------------------------------------------------------------->


                                    <div id="History" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> History</label> 
                                            </div>
                                            <input type="hidden" id="History" name="History" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                          {{ Form::select('History', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'History')->pluck('ddText','ddText')->toArray(), $patient_details->History, array('class'=> 'form-control select2','data-live-search'=>'true')) }}


                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='Historybtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='Historybtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='HistoryTextBoxesGroup' class="col-md-12"></div>

                                      <!------PastPersonalHistory---->
                                         <div id="PastPersonalHistory" class="ContainerToAppend">
                                         <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> PastPersonalHistory</label> 
                                            </div>
                                            <input type="hidden" id="PastPersonalHistory" name="PastPersonalHistory" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                          {{ Form::select('PastPersonalHistory', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'PastPersonalHistory')->pluck('ddText','ddText')->toArray(), $patient_details->PastPersonalHistory, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='PastPersonalHistorybtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='PastPersonalHistorybtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='PastPersonalHistoryTextBoxesGroup' class="col-md-12"></div>


<!---------------------------------------------------------------------------->
                         
                          <div class="col-md-12">
                          <label for="MensturationHistory" class="control-label"><ul>Obstretic History</ul> </label>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="ObstetricMarriedSice" class="">Married Since</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="ObstetricMarriedSice" name="ObstetricMarriedSice" value="{{ $patient_details->ObstetricMarriedSice }}"/>
                              </div>
                              </div>
                              </div>  

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="ObstetricCMP" class="">Year</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="ObstetricCMP" name="ObstetricCMP" value="{{ $patient_details->ObstetricCMP }}"/>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="ObstetricEDD" class=""></label>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group">
                              </div>
                              </div>
                              
                          </div>

                          <div class="col-md-12">
                            <div class="col-md-1">&nbsp;</div>
                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="ObstetricG" class="">G</label>
                              </div>
                              </div>

                              <div class="col-md-1" style="padding: 0px !important;">
                              <input type="text" class="form-control" name="ObstetricG" id="ObstetricG" value="{{ $patient_details->ObstetricG }}" />
                              </div>  

                              <div class="col-md-1" >
                              <div class="form-group labelgrp">
                              <label for="ObstetricP" class="">P</label>
                              </div>
                              </div>

                              <div class="col-md-1" style="padding: 0px !important;">
                              <input type="text" class="form-control" id="ObstetricP" name="ObstetricP" value="{{ $patient_details->ObstetricP }}" />
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="ObstetricL" class="">L</label>
                              </div>
                              </div>

                              <div class="col-md-1" style="padding: 0px !important;">
                               <input type="text" class="form-control" id="ObstetricL" name="ObstetricL" value="{{ $patient_details->ObstetricL }}" />
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="ObstetricA" class="">A</label>
                              </div>
                              </div>

                              <div class="col-md-1" style="padding: 0px !important;">
                               <input type="text" class="form-control" id="ObstetricA" name="ObstetricA" value="{{ $patient_details->ObstetricA }}" />
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="ObstetricD" class="">D</label>
                              </div>
                              </div>

                              <div class="col-md-1" style="padding: 0px !important;">
                               <input type="text" class="form-control" id="ObstetricD" name="ObstetricD" value="{{ $patient_details->ObstetricD }}" />
                              </div>
                              
                          </div>

                          <!---------------------------------------------------->
                           
                                         <div id="ObstetricText" class="ContainerToAppend">
                                         <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> Text</label> 
                                            </div>
                                            <input type="hidden" id="ObstetricText" name="ObstetricText" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                          {{ Form::select('ObstetricText', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'ObstetricText')->pluck('ddText','ddText')->toArray(), $patient_details->ObstetricText, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

                                         
                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='ObstetricTextbtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='ObstetricTextbtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='ObstetricTextTextBoxesGroup' class="col-md-12"></div>

                  <!---------------------end--ObstetricText------------------------------>
                       
                          <div class="col-md-12">
                            <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="presentPregnecyLMP" class="form-control">LMP :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             
                                 
                                      <input type="text" class="form-control datepicker" id="presentPregnecyLMP" name="presentPregnecyLMP" value="{{ $patient_details->presentPregnecyLMP }}"/> 

                              </div>
                              </div>
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="presentPregnencyEDD" class="form-control">EDD</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control datepicker" id="presentPregnencyEDD" name="presentPregnencyEDD" value="{{ $patient_details->presentPregnencyEDD }}"/>                            
                              </div>
                              </div>
                              </div>
                            
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-2">
                              <div class="form-group labelgrp">
                                <label for="presentPregnencyUSG" class="">Edd by USG</label>
                              </div>
                            </div>
                            <div class="col-md-10">
                              {{ Form::textarea('presentPregnencyUSG', Request::old('presentPregnencyUSG',$patient_details->presentPregnencyUSG), array('class'=>
                        'form-control')) }}  
                                
                            </div>
                          </div>
                          

                           <!------------------Education-------------------------------->

                           <div id="Education" class="ContainerToAppend">
                                         <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> Education1</label> 
                                            </div>
                                            <input type="hidden" id="Education" name="Education" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                          {{ Form::select('Education', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'Education')->pluck('ddText','ddText')->toArray(), $patient_details->Education, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

                                          
                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='Educationbtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='Educationbtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='EducationTextBoxesGroup' class="col-md-12"></div>

                          <!---------------------end-Education------------------------------>
                       
                           <div class="col-md-12">
                            <hr style="border-top: 1px solid !important;" />
                          </div>

                           <div class="col-md-12 text-center">
                          {{ Form::label('GeneralExamination','General Examination', array('class'=>'')) }}
                          </div>

                          <div class="col-md-12">
                            <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamBuild" class="form-control">Build</label>
                              </div>
                              </div>

                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" name="GenExamBuild" id="GenExamBuild" value="{{ $patient_details->GenExamBuild }}" />                           
                              </div>
                              </div>
                              </div>  

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamHeight"  class="form-control">Height</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="input-group">
                               <div class="form-line" style="display: flex;">
                                <input type="text" class="form-control" id="GenExamHeight" name="GenExamHeight" value="{{ $patient_details->GenExamHeight }}">
                                </div>
                              <span class="input-group-addon myaddon" id="basic-addon">cm</span>
                              </div>
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamWeight"  class="form-control">Weight</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="input-group">
                               <div class="form-line" style="display: flex;">
                                <input type="text" class="form-control" id="GenExamWeight" name="GenExamWeight" value="{{ $patient_details->GenExamWeight }}" />
                                </div>
                              <span class="input-group-addon myaddon" id="basic-addon">cm</span>
                              </div>
                              </div>
                          </div>

                           <div class="col-md-12">
                            <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="BMI" class="form-control">BMI</label>
                              </div>
                              </div>

                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" name="BMI" id="BMI" value="{{ $patient_details->BMI }}" />
                              </div>
                              </div>
                              </div>  

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="Temp"  class="form-control">Temp</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="Temp" name="Temp" value="{{ $patient_details->Temp }}" />
                              </div>
                              </div>
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="AG"  class="form-control">AG</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="AG" name="AG" value="{{ $patient_details->AG }}" />
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamPulse" class="form-control">Pulse</label>
                              </div>
                              </div>

                              <div class="col-md-3">
                              <div class="input-group">
                              <div class="form-line" style="display: flex;">
                              <input type="text" class="form-control" id="GenExamPulse" name="GenExamPulse" value="{{ $patient_details->GenExamPulse }}" />
                              </div>
                              <span class="input-group-addon myaddon">per min</span>
                              </div>
                              </div>  

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamBP"  class="form-control">BP</label>
                              </div>
                              </div>


                               <div class="col-md-3">
                                <div class="row">
                                <div class="col-xs-4" style="padding: 0px !important;">
                                <input type="text" class="form-control" id="GenExamBP" name="GenExamBP" value="{{ $patient_details->GenExamBP }}" style="width:100px"/>
                                </div>
                                <div class="col-xs-1" style="padding: 0px !important;">
                                <span for="startDate"><h1 style="margin-top: 0px;margin-top: -7px;padding: 5px;"> /</h1></span>
                                </div>
                                <div class="col-xs-4" style="padding: 0px !important;">
                                <input type="text" class="form-control" id="GenExamBP_lower" name="GenExamBP_lower" value="{{ $patient_details->GenExamBP_lower }}" style="width:100px"/>
                                </div>
                                <div class="col-xs-1" style="">
                                <div class="form-group labelgrp" style="margin-left: 0px;">
                                <label for="GenExamBP"  class="form-control">mmhg</label>
                                </div>
                                </div>
                                </div>
                              
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamRR"  class="form-control">RR</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="input-group">
                              <div class="form-line" style="display: flex;">
                              <input type="text" class="form-control" id="GenExamRR" name="GenExamRR" value="{{ $patient_details->GenExamRR }}" />
                              </div>
                              <span class="input-group-addon myaddon">per min</span>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamPallor" class="form-control">Pallor</label>
                              </div>
                              </div>

                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" name="GenExamPallor" id="GenExamPallor" value="{{ $patient_details->GenExamPallor }}" />
                              </div>
                              </div>
                              </div>  

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamCyanosis"  class="form-control">Cyanosis</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="GenExamCyanosis" name="GenExamCyanosis" value="{{ $patient_details->GenExamCyanosis }}" />
                              </div>
                              </div>
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamIcterus"  class="form-control">Icterus</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="GenExamIcterus" name="GenExamIcterus" value="{{ $patient_details->GenExamIcterus }}" />
                              </div>
                              </div>
                              </div>
                          </div>
                          
                          <div class="col-md-12">
                            <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamEdema" class="form-control">Edema</label>
                              </div>
                              </div>

                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" name="GenExamEdema" id="GenExamEdema" value="{{ $patient_details->GenExamEdema }}" />
                              </div>
                              </div>
                              </div>  

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="GenExamSkin"  class="form-control">Skin</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="GenExamSkin" name="GenExamSkin" value="{{ $patient_details->GenExamSkin }}" />
                              </div>
                              </div>
                              </div>

                              <div class="col-md-1">
                              <div class="form-group labelgrp">
                              <label for="presentPregnencyDate"  class="form-control">CB</label>
                              </div>
                              </div>


                              <div class="col-md-3">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="presentPregnencyDate" name="presentPregnencyDate" value="{{ $patient_details->presentPregnencyDate }}" />
                              </div>
                              </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                            <hr style="    border-top: 1px solid !important;" />
                          </div>
                          <div class="col-md-12 text-center">
                         {{ Form::label('SystemicExamination','Systemic Examination') }}
                          </div>


                      <!------------------------cvs------------------------->
                            <div id="SysExamCVS" class="ContainerToAppend">
                                         <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> CVS</label> 
                                            </div>
                                            <input type="hidden" id="SysExamCVS" name="SysExamCVS" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                          {{ Form::select('SysExamCVS', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'SysExamCVS')->pluck('ddText','ddText')->toArray(), $patient_details->SysExamCVS, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='SysExamCVSbtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='SysExamCVSbtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='SysExamCVSTextBoxesGroup' class="col-md-12"></div>
                                  
                                  <!------------------------RS------------------------->
                            <div id="SysExamRS" class="ContainerToAppend">
                                         <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> RS</label> 
                                            </div>
                                            <input type="hidden" id="SysExamRS" name="SysExamRS" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                          {{ Form::select('SysExamRS', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'SysExamRS')->pluck('ddText','ddText')->toArray(), $patient_details->SysExamRS, array('class'=> 'form-control select2','data-live-search'=>'true')) }}


                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='SysExamRSbtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='SysExamRSbtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='SysExamRSTextBoxesGroup' class="col-md-12"></div>



                        <!-----------------------RS-end---------------------------->
                          
                           <div class="col-md-12">
                            <div class="col-md-2">
                              <div class="form-group labelgrp">
                                <label for="SysExamPA" class="">PA</label>
                              </div>
                            </div>
                            <div class="col-md-10">
                              {{ Form::textarea('SysExamPA', Request::old('SysExamPA',$patient_details->SysExamPA), array('class'=> 'form-control')) }}   
                            </div>
                          </div>
                          <div class="col-md-12">
                            <hr style="    border-top: 1px solid !important;" />
                          </div>
                          <div class="col-md-12">
                            {{ Form::label('SysExamLocalExam','Local/Examination') }}
                            {{ Form::textarea('SysExamLocalExam', Request::old('SysExamLocalExam',$patient_details->SysExamLocalExam), array('class'=> 'form-control')) }}
                          </div>

                            <!---------------------Provisional Diagnosis----------------->
                               <div id="ProvisionalDiagnosis" class="ContainerToAppend">
                                         <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> Provisional Diagnosis1</label> 
                                            </div>
                                            <input type="hidden" id="ProvisionalDiagnosis" name="ProvisionalDiagnosis" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                      {{ Form::select('ProvisionalDiagnosis', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'ProvisionalDiagnosis')->pluck('ddText','ddText')->toArray(),$patient_details->ProvisionalDiagnosis, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='ProvisionalDiagnosisbtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='ProvisionalDiagnosisbtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='ProvisionalDiagnosisTextBoxesGroup' class="col-md-12"></div>


                                  <!--------------------Investigation Advice----------------------->

                                        <div id="InvestigationAdvice" class="ContainerToAppend">
                                         <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> Investigation Advice</label> 
                                            </div>
                                            <input type="hidden" id="InvestigationAdvice" name="InvestigationAdvice" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                          {{ Form::select('InvestigationAdvice', array('Select'=>'-Select-') + $md_form_dropdowns->where('fieldName', 'InvestigationAdvice')->pluck('ddText','ddText')->toArray(), $patient_details->InvestigationAdvice, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='InvestigationAdvicebtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='InvestigationAdvicebtnsave'>Save Option</button>
                                            
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='InvestigationAdviceTextBoxesGroup' class="col-md-12"></div>
                          <!-------------------end--Investigation Advice----------------->
                          
                        

                              <div class="col-md-12">
                               {{ Form::label('TreatmentAdvice','Treatment Advice') }} 
                               {{ Form::textarea('TreatmentAdvice', Request::old('TreatmentAdvice',$patient_details->TreatmentAdvice), array('class'=> 'form-control')) }}
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('Remark','Remark') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Remark', Request::old('Remark',$patient_details->Remark), array('class'=> 'form-control autocompleteTxt')) }}                            
                              </div>
                              </div>
                              </div> 

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('FollowUpDoctor_id','Doctor') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                            {{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $doctorlist->toArray(),$selectdoc, array('class' => 'form-control select2','disabled' => true)) }}
                              </div>
                              </div> 
                              
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('appointment_dt','Follow-Up Date') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('appointment_dt', Request::old('appointment_dt'), array('class'=> 'form-control datepicker')) }}                          
                              </div>
                              </div>
                              </div>
                              


                             
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label>Follow up Time Slot</label> 
                              </div>
                              </div>

                              <div class="col-md-4">
                            
                               <select class="form-control select2" id="FollowUpTimeSlot" name="FollowUpTimeSlot"></select>
                              </div>
                              </div>
                                  

                            </div>
							
	<!-------------------------------Email-to-other----------------------------------------->
							 <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Email To :</label>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="form-line">
                                       
                                        <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                        </div>
                                        </div> 
                                        <div class="col-md-2">
                                          <button type="submit"  name="SendEmail" class="btn btn-success " value="SendEmail" >Email To                                                           Other</button>
                                       </div>
                                      </div>
							
	<!--------------------------------end-Email-to-other----------------------------------->						
                             <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-3">
                                <div class="form-group">
                                <a class="btn btn-primary btn-lg" href="{{ url('/AddEdit/prescription/').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i> Add Prescription </a>&nbsp;
                                <a class="btn btn-primary btn-lg" href="{{ url('/report_files/').'/'.$casedata['id'].'/edit' }}"><i class="glyphicon glyphicon-chevron-left"></i> Add Report </a>&nbsp;
                                <button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit"><i class="fa fa-plus"></i> Submit</button>&nbsp;
								<button type="submit" name="SubmitMail" class="btn btn-primary btn-lg" value="SubmitMail"><i class="fa fa-plus"></i> Submit & Mail</button>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                                      
                                </div>
                                </div>
                               
                            </div>

                            
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>


</div>

        @endsection

@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script src="{{asset('drawingboardJs/drawingboard.min.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2();  
    //     $('.datepicker').datepicker({
    //     format: "yyyy-mm-dd",
    //     weekStart: 1,
    //     clearBtn: true,
    //     daysOfWeekHighlighted: "0,6",
    //     autoclose: true,
    //     todayHighlight: true,
    // }); 
    
   $("#appointment_dt").on('change.dp', function (e) {

            $(this).datepicker('hide');
            
        
        $("#FollowUpTimeSlot").empty();
        //alert(this.value);         //Date in full format alert(new Date(this.value));
        var inputDate = new Date(this.value);
        var FollowUpDoctor_id = $("#FollowUpDoctor_id").val();
       

        var appointment_dt = $('#appointment_dt').val();
       
        
        var url1="{{url('avaibaletimeslotscasemaster')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
        //alert(url1);
    

        $.ajax({
            url:url1,
           
            type:'GET',
            success:function(response) {
        
             if(response==0)
                 {
                    $('<option value="0">No Slots Available</option>').appendTo($("#FollowUpTimeSlot"));
                 }

                    else
                 {
                 
                        for(var i=0;i<response['timeslot1'].length;i++){
                  
                     var starttime= response['timeslot1'][i];
                    
                  
                     var toAppend = '<option value="'+starttime+'">'+starttime+'</option>';
                      $('#FollowUpTimeSlot').append(toAppend);
                  
                  
               

                
               
            }
   

                 }
              }
        }); 



    }); 
        
        $("#Tabseyehistory a[href='"+$("#field_type_id").val()+"']").tab('show');
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
            $("#field_type_id").val(target);
            $("#memory_id").val('');
        });
        $("#TabContainerDiv a.memoryList").on('click',function(e){
            e.preventDefault();
            $("#memory_id").val($(this).data('id'));
            $("button[name='mem_delete']").addClass('hidden');
            $.get('/getMemoryDetials/'+$(this).data('id'),function(data){
                 $("input[name='title']").val(data.title);
                 $("input[name='memory_data']").val(data.data);
                 if(data.field_type_id = "1"){
                    $("input[name='complaint']").val(data.data);
                 }
                 if(data.field_type_id = "2"){
                    $("input[name='Diagnosis']").val(data.data);
                 }
                 if(data.field_type_id = "3"){
                    $("input[name='Treatment']").val(data.data);
                 }
                 $("button[name='mem_delete']").removeClass('hidden');
            });
           
        });    
    });
</script>

<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>

<script>    
     jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} ">
</script>
<script>
        var url = "{{ url('/caseHistoryAutocomplete') }}";
        jq(".autocompleteTxt").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ url('/caseHistoryAutocomplete') }}",
                    dataType: "json",
                    data: {
                        query: request.term,
                        PropertyName: jq(this.element).attr('name')//'Complaints' 
                    },
                    success: function(data) {
                        data = JSON.parse(JSON.stringify(data));
                        response(data);
                    }
                });
            }
        });
</script>


<!---------------------------------------------------------------->
<!-- History Set Option -->
<script type="text/javascript">
     var Historycnt = 1;
$("#Historybtn").click(function () {
      
  if(Historycnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+Historycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="History"><input class="form-control"  type="text" id="optionsval'+Historycnt+'" placeholder="value'+Historycnt+'" name="optionsval[]"></div><span class="input-group-addon HistoryremoveButton" type="button" id="HistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#HistoryTextBoxesGroup").append(newTextBoxDiv);
  Historycnt++;
     });

$(document).on('click', '.HistoryremoveButton', function(e) {
Historycnt--;
   var target = $("#HistoryTextBoxesGroup").find("#TextBoxDiv" +Historycnt);
  $(target).remove();
});

</script>


<!-- PastPersonalHistory Set Option -->
<script type="text/javascript">
     var PastPersonalHistorycnt = 1;
$("#PastPersonalHistorybtn").click(function () {
      
  if(PastPersonalHistorycnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+PastPersonalHistorycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="PastPersonalHistory"><input class="form-control"  type="text" id="optionsval'+PastPersonalHistorycnt+'" placeholder="value'+PastPersonalHistorycnt+'" name="optionsval[]"></div><span class="input-group-addon PastPersonalHistoryremoveButton" type="button" id="PastPersonalHistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#PastPersonalHistoryTextBoxesGroup").append(newTextBoxDiv);
  PastPersonalHistorycnt++;
     });

$(document).on('click', '.PastPersonalHistoryremoveButton', function(e) {
PastPersonalHistorycnt--;
   var target = $("#PastPersonalHistoryTextBoxesGroup").find("#TextBoxDiv" +PastPersonalHistorycnt);
  $(target).remove();
});

</script>


<!-- ObstetricText Set Option -->
<script type="text/javascript">
     var ObstetricTextcnt = 1;
$("#ObstetricTextbtn").click(function () {
      
  if(ObstetricTextcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+ObstetricTextcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="ObstetricText"><input class="form-control"  type="text" id="optionsval'+ObstetricTextcnt+'" placeholder="value'+ObstetricTextcnt+'" name="optionsval[]"></div><span class="input-group-addon ObstetricTextremoveButton" type="button" id="ObstetricTextremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#ObstetricTextTextBoxesGroup").append(newTextBoxDiv);
  ObstetricTextcnt++;
     });

$(document).on('click', '.ObstetricTextremoveButton', function(e) {
ObstetricTextcnt--;
   var target = $("#ObstetricTextTextBoxesGroup").find("#TextBoxDiv" +ObstetricTextcnt);
  $(target).remove();
});

</script>


<!-- Education Set Option -->
<script type="text/javascript">
     var Educationcnt = 1;
$("#Educationbtn").click(function () {
      
  if(Educationcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+Educationcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="Education"><input class="form-control"  type="text" id="optionsval'+Educationcnt+'" placeholder="value'+Educationcnt+'" name="optionsval[]"></div><span class="input-group-addon EducationremoveButton" type="button" id="EducationremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#EducationTextBoxesGroup").append(newTextBoxDiv);
  Educationcnt++;
     });

$(document).on('click', '.EducationremoveButton', function(e) {
Educationcnt--;
   var target = $("#EducationTextBoxesGroup").find("#TextBoxDiv" +Educationcnt);
  $(target).remove();
});

</script>


<!-- SysExamCVS Set Option -->
<script type="text/javascript">
     var SysExamCVScnt = 1;
$("#SysExamCVSbtn").click(function () {
      
  if(SysExamCVScnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+SysExamCVScnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="SysExamCVS"><input class="form-control"  type="text" id="optionsval'+SysExamCVScnt+'" placeholder="value'+SysExamCVScnt+'" name="optionsval[]"></div><span class="input-group-addon SysExamCVSremoveButton" type="button" id="SysExamCVSremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SysExamCVSTextBoxesGroup").append(newTextBoxDiv);
  SysExamCVScnt++;
     });

$(document).on('click', '.SysExamCVSremoveButton', function(e) {
SysExamCVScnt--;
   var target = $("#SysExamCVSTextBoxesGroup").find("#TextBoxDiv" +SysExamCVScnt);
  $(target).remove();
});

</script>


<!-- SysExamRS Set Option -->
<script type="text/javascript">
     var SysExamRScnt = 1;
$("#SysExamRSbtn").click(function () {
      
  if(SysExamRScnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+SysExamRScnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="SysExamRS"><input class="form-control"  type="text" id="optionsval'+SysExamRScnt+'" placeholder="value'+SysExamRScnt+'" name="optionsval[]"></div><span class="input-group-addon SysExamRSremoveButton" type="button" id="SysExamRSremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SysExamRSTextBoxesGroup").append(newTextBoxDiv);
  SysExamRScnt++;
     });

$(document).on('click', '.SysExamRSremoveButton', function(e) {
SysExamRScnt--;
   var target = $("#SysExamRSTextBoxesGroup").find("#TextBoxDiv" +SysExamRScnt);
  $(target).remove();
});

</script>

<!-- ProvisionalDiagnosis Set Option -->
<script type="text/javascript">
     var ProvisionalDiagnosiscnt = 1;
$("#ProvisionalDiagnosisbtn").click(function () {
      
  if(ProvisionalDiagnosiscnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+ProvisionalDiagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="ProvisionalDiagnosis"><input class="form-control"  type="text" id="optionsval'+ProvisionalDiagnosiscnt+'" placeholder="value'+ProvisionalDiagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon ProvisionalDiagnosisremoveButton" type="button" id="ProvisionalDiagnosisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#ProvisionalDiagnosisTextBoxesGroup").append(newTextBoxDiv);
  ProvisionalDiagnosiscnt++;
     });

$(document).on('click', '.ProvisionalDiagnosisremoveButton', function(e) {
ProvisionalDiagnosiscnt--;
   var target = $("#ProvisionalDiagnosisTextBoxesGroup").find("#TextBoxDiv" +ProvisionalDiagnosiscnt);
  $(target).remove();
});

</script>

<!-- InvestigationAdvice Set Option -->
<script type="text/javascript">
     var InvestigationAdvicecnt = 1;
$("#InvestigationAdvicebtn").click(function () {
      
  if(InvestigationAdvicecnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+InvestigationAdvicecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="md"><input class="form-control"  type="hidden"  name="fieldName" value="InvestigationAdvice"><input class="form-control"  type="text" id="optionsval'+InvestigationAdvicecnt+'" placeholder="value'+InvestigationAdvicecnt+'" name="optionsval[]"></div><span class="input-group-addon InvestigationAdviceremoveButton" type="button" id="InvestigationAdviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#InvestigationAdviceTextBoxesGroup").append(newTextBoxDiv);
  InvestigationAdvicecnt++;
     });

$(document).on('click', '.InvestigationAdviceremoveButton', function(e) {
InvestigationAdvicecnt--;
   var target = $("#InvestigationAdviceTextBoxesGroup").find("#TextBoxDiv" +InvestigationAdvicecnt);
  $(target).remove();
});

</script>
<!-------------------------------------------->








<!-------------------------------------------------------->
<script>
// complaint Add Option
  function isEmpty( el ){
      return !$.trim(el.html())
  }


// History Add Option

$("#Historybtnsave").click(function () {
        var content=$("#HistoryTextBoxesGroup").val();
        if (isEmpty($('#HistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// PastPersonalHistory Add Option

$("#PastPersonalHistorybtnsave").click(function () {
        var content=$("#PastPersonalHistoryTextBoxesGroup").val();
        if (isEmpty($('#PastPersonalHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past PastPersonalHistory", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// ObstetricText Add Option

$("#ObstetricTextbtnsave").click(function () {
        var content=$("#ObstetricTextTextBoxesGroup").val();
        if (isEmpty($('#ObstetricTextTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past Text", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// Education Add Option

$("#Educationbtnsave").click(function () {
        var content=$("#EducationTextBoxesGroup").val();
        if (isEmpty($('#EducationTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past Education", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// SysExamCVS Add Option

$("#SysExamCVSbtnsave").click(function () {
        var content=$("#SysExamCVSTextBoxesGroup").val();
        if (isEmpty($('#SysExamCVSTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past CVS", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// SysExamRS Add Option

$("#SysExamRSbtnsave").click(function () {
        var content=$("#SysExamRSTextBoxesGroup").val();
        if (isEmpty($('#SysExamRSTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past RS", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// ProvisionalDiagnosis Add Option

$("#ProvisionalDiagnosisbtnsave").click(function () {
        var content=$("#ProvisionalDiagnosisTextBoxesGroup").val();
        if (isEmpty($('#ProvisionalDiagnosisTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past Provisional Diagnosis", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// InvestigationAdvice Add Option

$("#InvestigationAdvicebtnsave").click(function () {
        var content=$("#InvestigationAdviceTextBoxesGroup").val();
        if (isEmpty($('#InvestigationAdviceTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#mdform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("mdinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past Investigation Advice", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>
@endsection