@extends('adminlayouts.master')
 

 @php
	//echo "================ : ".Request::segment(3); exit;
 @endphp
@section('style')
<style>

    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}


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
    #button {
  display: inline-block;
  background-color: #FF9800;
  text-decoration: none;
  width: 36px;
  height: 37px;
  text-align: center;
  border-radius: 4px;
  position: fixed;
  bottom: 52px;
  right: 33px;
  transition: background-color .3s, 
    opacity .5s, visibility .5s;
  opacity: 0;
  color: white;
  visibility: hidden;
  z-index: 1000;
}
#button::after {
 
  font-family: 'Material Icons';
  font-weight: bolder;
  font-style: normal;
  font-size: 1em;
  line-height: 40px;
  color: white;
}
#button:hover {
  cursor: pointer;
  background-color: #333;
}
#button:active {
  background-color: #555;
}
#button.show {
  opacity: 1;
  visibility: visible;
}
.details-section {
    color: initial;
    /* background-color: white; */
    text-align: center;
    margin-bottom: 7px;
    padding-top: 4px;
    padding-bottom: 1px;
    margin-top: -2px;
}

</style>

<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
<!-- Styles -->
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

</style>
<style type="text/css">
  
/*---------signup-step-------------*/
.bg-color{
    background-color: #333;
}
.signup-step-container{
  
    padding-bottom: 60px;
}


    .wizard .nav-tabs {
        position: relative;
        margin-bottom: 0;
        border-bottom-color: transparent;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 78%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 27%;
    z-index: 1;
}

.connecting-line1 {
    top: 76%;
    margin: 0 auto;
    background: #e0e0e0;
    height: 2px;
    left: 0;
    right: 0;
    z-index: 1;
    width: 78%;
    position: absolute;
}


.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: inline-block;
    border-radius: 50%;
    background: #fff;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 16px;
    color: #0e214b;
    font-weight: 500;
    border: 1px solid #ddd;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
        background: #E91E63 !important;
    color: #fff;
    border-color: #E91E63 !important;
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}
.wizard .nav-tabs > li.active > a i{
    color: #E91E63 !important;
}

.wizard .nav-tabs > li {
    width: 20%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: red;
    transition: 0.1s ease-in-out;
}



.wizard .nav-tabs > li a {
    width: 30px;
    height: 30px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
    background-color: transparent;
    position: relative;
    top: 0;
}
.wizard .nav-tabs > li a i{
    position: absolute;
    top: -15px;
    font-style: normal;
    font-weight: 400;
    white-space: nowrap;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 15px;
    font-weight: 700;
    color: #000;

}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 20px;
}


.wizard h3 {
    margin-top: 0;
}
.prev-step,
.next-step{
    font-size: 13px;
    padding: 8px 24px;
    border: none;
    border-radius: 4px;
    margin-top: 30px;
}
.next-step{
    background-color: #0db02b;
}
.skip-btn{
    background-color: #cec12d;
}
.step-head{
    font-size: 20px;
    text-align: center;
    font-weight: 500;
    margin-bottom: 20px;
}
.term-check{
    font-size: 14px;
    font-weight: 400;
}
.custom-file {
    position: relative;
    display: inline-block;
    width: 100%;
    height: 40px;
    margin-bottom: 0;
}
.custom-file-input {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 40px;
    margin: 0;
    opacity: 0;
}
.custom-file-label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1;
    height: 40px;
    padding: .375rem .75rem;
    font-weight: 400;
    line-height: 2;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: .25rem;
}
.custom-file-label::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    display: block;
    height: 38px;
    padding: .375rem .75rem;
    line-height: 2;
    color: #495057;
    content: "Browse";
    background-color: #e9ecef;
    border-left: inherit;
    border-radius: 0 .25rem .25rem 0;
}
.footer-link{
    margin-top: 30px;
}
.all-info-container{

}
.list-content{
    margin-bottom: 10px;
}
.list-content a{
    padding: 10px 15px;
    width: 100%;
    display: inline-block;
    background-color: #f5f5f5;
    position: relative;
    color: #565656;
    font-weight: 400;
    border-radius: 4px;
}
.list-content a[aria-expanded="true"] i{
    transform: rotate(180deg);
}
.list-content a i{
    text-align: right;
    position: absolute;
    top: 15px;
    right: 10px;
    transition: 0.5s;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fdfdfd;
}
.list-box{
    padding: 10px;
}
.signup-logo-header .logo_area{
    width: 200px;
}
.signup-logo-header .nav > li{
    padding: 0;
}
.signup-logo-header .header-flex{
    display: flex;
    justify-content: center;
    align-items: center;
}
/*-----------custom-checkbox-----------*/
/*----------Custom-Checkbox---------*/
input[type="checkbox"]{
    position: relative;
    display: inline-block;
    margin-right: 5px;
}
input[type="checkbox"]::before,
input[type="checkbox"]::after {
    position: absolute;
    content: "";
    display: inline-block;   
}
input[type="checkbox"]::before{
    height: 16px;
    width: 16px;
    border: 1px solid #999;
    left: 0px;
    top: 0px;
    background-color: #fff;
    border-radius: 2px;
}
input[type="checkbox"]::after{
    height: 5px;
    width: 9px;
    left: 4px;
    top: 4px;
}
input[type="checkbox"]:checked::after{
    content: "";
    border-left: 1px solid #fff;
    border-bottom: 1px solid #fff;
    transform: rotate(-45deg);
}
input[type="checkbox"]:checked::before{
    background-color: #18ba60;
    border-color: #18ba60;
}

#blood_investigation { display: flow-root; }




@media (max-width: 767px){
    .sign-content h3{
        font-size: 40px;
    }
    .wizard .nav-tabs > li a i{
        display: none;
    }
    .signup-logo-header .navbar-toggle{
        margin: 0;
        margin-top: 8px;
    }
    .signup-logo-header .logo_area{
        margin-top: 0;
    }
    .signup-logo-header .header-flex{
        display: block;
    }
}

.chiefcomplainremoveButton, .opthalhistoryremoveButton,.lidsremoveButton,.dvnremoveButton,.nvnremoveButton,.WithPinholeremoveButton,.PGPremoveButton,.DVNWithGlassesremoveButton,.NVNWithGlassesremoveButton,.orbitremoveButton,.conjremoveButton,.cornearemoveButton,.ac1removeButton,.irisremoveButton,.pupilremoveButton,.IOPremoveButton,.CDRatioremoveButton,.PachymetryremoveButton,.cctremoveButton,.K1removeButton,.K2removeButton,.lenspowerremoveButton,.axial_lengthremoveButton,.KCremoveButton,.lensremoveButton,.vitreoremoveButton,.retinaremoveButton,.onhremoveButton,.macularemoveButton,.sacremoveButton,.systanicExaminationremoveButton,.treatmentAdviceremoveButton,.systemichistoryremoveButton,.colorvisionremoveButton,.perimetryspButton,.schimertestoneremoveButton,.octremoveButton,.eomremoveButton{
  color: #700;
  cursor: pointer;
}

.chiefcomplainremoveButton ,.opthalhistoryremoveButton,.lidsremoveButton,.dvnremoveButton,.nvnremoveButton,.WithPinholeremoveButton,.PGPremoveButton,.DVNWithGlassesremoveButton,.NVNWithGlassesremoveButton,.orbitremoveButton,.conjremoveButton,.cornearemoveButton,.ac1removeButton,.irisremoveButton,.pupilremoveButton,.IOPremoveButton,.CDRatioremoveButton,.PachymetryremoveButton,.cctremoveButton,.K1removeButton,.K2removeButton,.lenspowerremoveButton,.axial_lengthremoveButton,.KCremoveButton,.lensremoveButton,.vitreoremoveButton,.retinaremoveButton,.onhremoveButton,.macularemoveButton,.sacremoveButton,.systanicExaminationremoveButton,.treatmentAdviceremoveButton,.systemichistoryremoveButton,.colorvisionremoveButton,.perimetryspButton,.schimertestoneremoveButton,.octremoveButton,.eomremoveButton:hover {
  color: #f00;
}
</style>
 
@endsection

@section('content')
<div class="container-fluid">
  <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
		<a style="float: right;" href="{{ url('/bill_details/'.$casedata['id'].'/edit') }}" class="list-group-item">Opd Bill</a> <span> &nbsp;</span>
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
                    <span id="result"></span>
                    <div class="card">
                        <!-- Back to top button -->

                       <form action="" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
                      {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control','id'=>'caseid')) }}
                           <input type="hidden" name="patient_emailId" id="patient_emailId" value="{{$casedata['patient_emailId']}} ">
                        {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2 style="
    display: inline;
">
                                Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . $casedata['visit_time']}}  
								
								
                            </h2>

                          
                        </div>
	@php	
		$patient_activity_background = array('In' => 'background:green', 'Out' => 'background:red');
	@endphp
						
<div class="col-md-12" style="background: lightgrey; ">					
<div class="row" style=" text-align: center; font-size: 20px; ">

<div class=" col-md-3" style="{{(isset($patient_activity->status) && $patient_activity->status != "") ? $patient_activity_background[$patient_activity->status] : ''}}">
<label>Ophtometry     : </label>
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="form-control patient-ativity" data-case_id="{{$casedata['id']}}" data-type="ophthalmetry" type="radio" name="patient_activity_state" value="In" {{(isset($patient_activity->status) && $patient_activity->status == "In") ? 'checked' : ''}}>&nbsp;IN&nbsp;&nbsp;&nbsp;
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="patient-ativity form-control" data-case_id="{{$casedata['id']}}" data-type="ophthalmetry" type="radio" name="patient_activity_state" value="Out" {{(isset($patient_activity->status) && $patient_activity->status == "Out") ? 'checked' : ''}}>&nbsp;Out
</div>

<div class=" col-md-3"  style="{{(isset($doctor_activity->status) && $doctor_activity->status != "") ? $patient_activity_background[$doctor_activity->status] : ''}}">
<label>Doctor : </label>
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="form-control patient-ativity" data-case_id="{{$casedata['id']}}" data-type="patient_doctor_state" type="radio" name="patient_doctor_state" value="In" {{(isset($doctor_activity->status) && $doctor_activity->status == "In") ? 'checked' : ''}}>&nbsp;IN&nbsp;&nbsp;&nbsp;
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="patient-ativity form-control" data-case_id="{{$casedata['id']}}" data-type="patient_doctor_state" type="radio" name="patient_doctor_state" value="Out" {{(isset($doctor_activity->status) && $doctor_activity->status == "Out") ? 'checked' : ''}}>&nbsp;Out
</div>

<div class=" col-md-3"  style="{{(isset($procedure_activity->status) && $procedure_activity->status != "") ? $patient_activity_background[$procedure_activity->status] : ''}}">
<label>Procedure : </label>
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="form-control patient-ativity" data-case_id="{{$casedata['id']}}" data-type="doctor_procedure" type="radio" name="patient_procedure_state" value="In" {{(isset($procedure_activity->status) && $procedure_activity->status == "In") ? 'checked' : ''}}>&nbsp;IN&nbsp;&nbsp;&nbsp;
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="patient-ativity form-control" data-case_id="{{$casedata['id']}}" data-type="doctor_procedure" type="radio" name="patient_procedure_state" value="Out" {{(isset($procedure_activity->status) && $procedure_activity->status == "Out") ? 'checked' : ''}}>&nbsp;Out
</div>

<div class=" col-md-3"  style="{{(isset($consultant_activity->status) && $consultant_activity->status != "") ? $patient_activity_background[$consultant_activity->status] : ''}}">
<label>Counselor: </label>
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="form-control patient-ativity" data-case_id="{{$casedata['id']}}" data-type="consultant_activity" type="radio" name="consultant_activity_state" value="In" {{(isset($consultant_activity->status) && $consultant_activity->status == "In") ? 'checked' : ''}}>&nbsp;IN&nbsp;&nbsp;&nbsp;
<input style="display: inline-block;width: 20px;opacity: 1;left: auto;position: relative;top: 12px;" class="patient-ativity form-control" data-case_id="{{$casedata['id']}}" data-type="consultant_activity" type="radio" name="consultant_activity_state" value="Out" {{(isset($consultant_activity->status) && $consultant_activity->status == "Out") ? 'checked' : ''}}>&nbsp;Out
</div>
</div>
</div>
                        <?php if(!empty($casedata['infection']) || !empty($casedata['miscellaneous_history'])) {?>
                         
						 <div class="header bg-yellow" style=" clear: both; ">
						 
                            <div class="col-md-12" style="margin-top: -10px;">
							<h2>
							<marquee>
                                <div style="color:red; font-weight:bold; display: inline-block;">Allergy : <span class="details-section">{{ $casedata['infection'] }}</span></div> 
                                <div style="color:red; font-weight:bold; display: inline-block; margin-left: 200px;">Miscellaneous History : <span class="details-section">{{ $casedata['miscellaneous_history'] }}</span></div>
							
								@if(count($form_details->patients_systemic_history) > 0)

								@php 
									foreach($form_details->patients_systemic_history as $patients_systemic_history_row) {
										$patients_systemic_history_values_array[] = $patients_systemic_history_row->value;
									}
								@endphp
								<div style="color:red; font-weight:bold; display: inline-block; margin-left: 200px;">Systemic History : <span class="details-section">{{ implode(', ', $patients_systemic_history_values_array) }}</span></div>
								@endif
								
								</marquee>
							</h2>
							
							
								
                            </div>
							
                        </div>
						
                        <?php } ?>
                           {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly','id'=>'case_number')) }}
                        <div class="body">

                        <div class="row clearfix">
                            <a id="button" ><i class="material-icons" style="font-size: 33px !important;">keyboard_arrow_up</i></a>
                        <div class="col-md-12">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/dynamicForm/6/').'/'.$casedata['id'].'/edit/Opd' }}" class="casemasterlinks">Squint Evaluation</a></p>      
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/dynamicForm/7/').'/'.$casedata['id'].'/edit/Opd' }}" class="casemasterlinks">Paediatric Eye Evaluation</a></p>
                        
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/dynamicForm/8/').'/'.$casedata['id'].'/edit/Opd' }}" class="casemasterlinks">Ptosis Proforma</a></p>
                        
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/fundusImage/').'/'. $casedata['id'] }}" class="casemasterlinks">Fundus Image</a></p>
                       
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/AddEdit/prescription/').'/'.$casedata['id']}}" class="casemasterlinks">Medicine Prescription</a></p>
                        
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/glassPrescription/').'/'.$casedata['id'].'/edit' }}" class="casemasterlinks">Glass Prescription</a></p>
                       
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/backrecord/').'/'.$casedata['id']}}" class="casemasterlinks">Back Records</a></p>
                       
                        </div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/ViewMedicalDetails').'/'.$casedata['id'] }}" class="casemasterlinks">View</a></p>
                       
                        </div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/PrintMedicalDetails').'/'.$casedata['id'] }}" class="casemasterlinks">Print</a></p>
                       
                        </div>
                        </div>
                        <div class="signup-step-container">
                        <div class="col-md-12">
                            <div class="wizard">
                            <div class="wizard-inner">
                               <div class="connecting-line"></div>
                               <ul class="nav nav-tabs" role="tablist" id="myTab">
                                <li role="presentation" @if(Request::segment(3) == '') class="active" @endif>
                                    <!-- <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Complaint</i></a> -->

									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}"><span class="round-tab">1 </span> <i>Complaint</i></a>
                                </li>
                                <li role="presentation" @if(Request::segment(3) == '2') class="active" @endif>
                                    <!-- <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Vision</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/2"><span class="round-tab">2 </span> <i>Vision</i></a>
                                </li>
                                 <li role="presentation" @if(Request::segment(3) == '3') class="active" @endif>
                                    <!-- <a href="#step7" data-toggle="tab" aria-controls="step7" role="tab"><span class="round-tab">3</span> <i>Refraction</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/3"><span class="round-tab">3 </span> <i>Refraction</i></a>

                                </li>
                                <li role="presentation" @if(Request::segment(3) == '4') class="active" @endif>
                                    <!-- <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">4</span> <i>Finding</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/4"><span class="round-tab">4 </span> <i>Finding</i></a>
                                </li>
                                <li role="presentation" @if(Request::segment(3) == '5') class="active" @endif>
                                    <!-- <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">5</span> <i>Glaucoma</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/5"><span class="round-tab">5 </span> <i>Glaucoma</i></a>
                                </li>
                                 <li role="presentation" @if(Request::segment(3) == '6') class="active" @endif>
                                    <!-- <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab"><span class="round-tab">6</span> <i>A Scan</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/6"><span class="round-tab">6 </span> <i>A Scan</i></a>
                                </li>
                                 <div class="connecting-line1"></div>
                                <li role="presentation" @if(Request::segment(3) == '7') class="active" @endif>
                                    <!-- <a href="#step6" data-toggle="tab" aria-controls="step6" role="tab"><span class="round-tab">7</span> <i>SP Tests</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/7"><span class="round-tab">7 </span> <i>SP Tests</i></a>
                                </li>
                                
                                <li role="presentation" @if(Request::segment(3) == '8') class="active" @endif>
                                    <!-- <a href="#step8" data-toggle="tab" aria-controls="step8" role="tab"><span class="round-tab">8</span> <i>Other Details</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/8"><span class="round-tab">8 </span> <i>Other Details</i></a>
                                </li>
                                <li role="presentation" @if(Request::segment(3) == '9') class="active" @endif>
                                   <!--  <a href="#step9" data-toggle="tab" aria-controls="step9" role="tab"><span class="round-tab">9</span> <i>Follow-up</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/9"><span class="round-tab">9 </span> <i>Follow-up</i></a>
                                </li>
                                <li role="presentation" @if(Request::segment(3) == '10') class="active" @endif>
                                    <!-- <a href="#step10" data-toggle="tab" aria-controls="step10" role="tab"><span class="round-tab">10</span> <i>Uploads</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/10"><span class="round-tab">10 </span> <i>Uploads</i></a>
                                </li>

								<li role="presentation" @if(Request::segment(3) == '11') class="active" @endif>
                                    <!-- <a href="#step11" data-toggle="tab" aria-controls="step11" role="tab"><span class="round-tab">11</span> <i>Laser Procedure</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/11"><span class="round-tab">11 </span> <i>Laser Procedure</i></a>
                                </li>

								<li role="presentation" @if(Request::segment(3) == '12') class="active" @endif>
                                    <!-- <a href="#step12" data-toggle="tab" aria-controls="step12" role="tab"><span class="round-tab">12</span> <i>Images Draw</i></a> -->
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/12"><span class="round-tab">12 </span> <i>Images Draw</i></a>
                                </li>
								
								<li role="presentation" @if(Request::segment(3) == '13') class="active" @endif>
									<a href="{{ url('/AddEditEyeDetails').'/'.$casedata['id'] }}/13"><span class="round-tab">13 </span> <i>Fix Surgery</i></a>
                                </li>
                                
                            </ul>
                            
                        </div>
                        <!-- end of wizard inner -->
    
                              <div class="tab-content" id="main_form">
@if(Request::segment(3) == '')
<div class="tab-pane active" role="tabpanel" id="step1">
@include('EyeForm.steps.step1_content')
</div>
@endif
<!-- End Of 1st tab1 -->

<!-- star Of 2nd tab1 -->
@if(Request::segment(3) == '2')
<div class="tab-pane  active" role="tabpanel" id="step2">
@include('EyeForm.steps.step2_content')
</div>
@endif
<!-- end of 2nd tab -->

@if(Request::segment(3) == '4')
<div class="tab-pane  active" role="tabpanel" id="step3">
@include('EyeForm.steps.step3_content')
</div>
@endif
<!-- start with 4th tab-->

@if(Request::segment(3) == '5')
<div class="tab-pane  active" role="tabpanel" id="step4"> 
@include('EyeForm.steps.step4_content')
</div>
@endif

<!-- end of 4th tab -->
<!-- start with 5th tab-->
@if(Request::segment(3) == '6')
<div class="tab-pane  active" role="tabpanel" id="step5">
@include('EyeForm.steps.step5_content')
</div>
@endif
<!-- end of 5th tab -->
@if(Request::segment(3) == '7')
<div class="tab-pane active" role="tabpanel" id="step6">
@include('EyeForm.steps.step6_content')
</div>
@endif

@if(Request::segment(3) == '3')
<div class="tab-pane active" role="tabpanel" id="step7"> 
@include('EyeForm.steps.step7_content')
</div>
@endif

<!-- start with 8th tab-->
@if(Request::segment(3) == '8')
<div class="tab-pane  active" role="tabpanel" id="step8"> 
@include('EyeForm.steps.step8_content')
</div>
@endif

<!-- end of 8th tab -->

@if(Request::segment(3) == '9')
<div class="tab-pane active" role="tabpanel" id="step9">
@include('EyeForm.steps.step9_content')
</div>
@endif

@if(Request::segment(3) == '10')
<div class="tab-pane  active" role="tabpanel" id="step10">
@include('EyeForm.steps.step10_content')
</div>
@endif

@if(Request::segment(3) == '11')
<div class="tab-pane  active" role="tabpanel" id="step11">
@include('EyeForm.steps.step11_content')
</div>
@endif

@if(Request::segment(3) == '12')
<div class="tab-pane  active" role="tabpanel" id="step12">
@include('EyeForm.steps.step12_content')
</div>
@endif

@if(Request::segment(3) == '13')
<div class="tab-pane  active" role="tabpanel" id="step13">
@include('EyeForm.steps.step13_content')
</div>
@endif

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
                  
<div id="templateContainner" style="display:none">
    <div id="ChiefComplaintTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('ChiefComplaint_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Chief Complaint OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('ChiefComplaint_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Chief Complaint OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>

				<div class="col-md-12">
					<div class="col-md-2">
						<div class="form-group labelgrp">
							
						</div>
					</div>

					<div class="col-md-3">
						{{ Form::text('ChiefComplaint_OD_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</div>

					<div class="col-md-3">
						{{ Form::text('ChiefComplaint_OS_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</div>

					<div class="col-md-4">
						
					</div>
				</div>
        </div>

		
    </div>
    <div id="OpthalHistoryTemplate">
         <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="OpthalHistory[]" name="OpthalHistory[]" class="hiddenCounter" value="" />
            </div>
            <div class="col-md-3">
                {{ Form::select('OpthalHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('OpthalHistory_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>

			<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					
				</div>
			</div>

			<div class="col-md-3">
				{{ Form::text('OpthalHistory_OD_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-3">
				{{ Form::text('OpthalHistory_OS_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-4">
				
			</div>
		</div>
        </div>
    </div>

    <div id="SystemicHistoryTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="systemicHistory[]" name="systemicHistory[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                    {{ Form::select('SystemicHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemic_history')->pluck('ddText','ddText')->toArray(), array_key_exists('systemic_history', $defaultValues)?$defaultValues['systemic_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
		
                </div>
               
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>

				<div class="col-md-12">
					<div class="col-md-2">
						<div class="form-group labelgrp">
							
						</div>
					</div>

					<div class="col-md-6">
						{{ Form::text('SystemicHistory_OD_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</div>

					<div class="col-md-4">
						
					</div>
				</div>
        </div>
    </div>

    
    
    
    
    
    
    
    
    
    
    
    
    
    <div id="diagnoTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="diagno[]" name="diagno[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                    {{ Form::select('diagno_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Diagnosis OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('diagno_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Diagnosis OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="OCTTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="OCT[]" name="OCT[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-3">
            {{ Form::select('OCT_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'OCT OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
              {{ Form::select('OCT_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'OCT OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="EOMTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="EOM[]" name="EOM[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-3">
              {{ Form::select('EOM_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'EOM OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
         {{ Form::select('EOM_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'EOM OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
</div>


 <!-- Modal -->
  <div class="modal fade" id="img_Modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Document</h4>
        </div>
        <div class="modal-body"  id='print_ascan_document'>
			<img style="width: 100%;" id="modal_img" src="">
			<div id="image_data"></div>
        </div>
        <div class="modal-footer">
          <button type="button"  onclick='printDiv();' class="btn btn-default">print</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
	function printDiv() 
{
var divToPrint=document.getElementById('print_ascan_document');
var newWin=window.open('','Print-Window');
newWin.document.open();
newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
newWin.document.close();
setTimeout(function(){newWin.close();},10);
}

	$(document).on('click', '.show-image', function() {
		//alert($(this).data('src'));
		$('#image_data').html('');
		$('#modal_img').attr('src', $(this).data('src'));
		$('#image_data').html($(this).data('info'));
		$('#img_Modal').modal('show');
	});
  </script>
 @endsection

@section('scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->

 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script src="{{asset('drawingboardJs/drawingboard.min.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>

<script type="text/javascript">

    $("#showBloodDiv").click(function () {
        $("#blood_investigation").toggle();
    })
var bloodcnt = 1;
$("#addBloodtitlebtn").click(function () {
      
  if(bloodcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+bloodcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="text" id="optionsval'+bloodcnt+'" placeholder="value'+bloodcnt+'" name="optionsval[]"></div><span class="input-group-addon treatmentAdviceremoveButton" type="button" id="treatmentAdviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

    $("#bloodTestGroup").append(newTextBoxDiv);
        bloodcnt++;
     });

        $(document).on('click','.set-dropdown-options_blood_investigation',function() {
           // var form_name = $(this).data('form_name');
           // var field_name = $(this).data('field_name');
            
            var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

            $.ajax({
                url:"{{route('get_update_dropdown_options_blood_investigation')}}",
                method:'post',
                datatype: 'json',
                success:function(response) {
                    console.log(response);                 
                    $("#bloodTestGroupEdit").html(response);
                }
            });

           
            //$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').show();

            $("#bloodTestGroupEdit").show();
        });
    $(document).on('click','.cancel-dropdown-options-btn',function() {
        $('#bloodTestGroupEdit').hide();
        $('#bloodTestGroupEdit').html('');
    });

        $(document).on('click','.update-dropdown-options-btn_blood_ign',function() {
            //alert('clicked');

           // var clicked_element = $(this);

           // var form_target = $(this).closest('.update-dropdown-options-form');

            //var id = form_target.attr('id');

            var form_data = $('#update-dropdown-options-form-blood-ivn :input').serialize();

            $.ajax({
                url:"{{route('update_dropdown_options_blood_ivn')}}",
                method:'post',
                data:{'form_data': form_data},
                datatype: 'json',
                success:function(response) {
                    console.log(response);

                    location.reload();
                    /*
                    swal({title: "Options", text: "Update Successfully!", type: "success"},
                     function(){ 
                      location.reload();
                      }
                    );
                    */
                    //clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
                }
            });
        });

        $(document).on('click','.remove-initial-options-BI',function() {
           var closest =  $(this).closest('.initial_options');
            //alert("input value :;"+$(this).closest('.initial_options').prev().val());
            var idToDelete = $(this).closest('.initial_options').prev().val()

            var r = confirm("Do you really want to delete record ?");
            if (r == true) {
                 $.ajax({
                    url:"{{route('delete_bloodinvestigatinTitles')}}",
                    method:'post',
                    data:{ 'idToDelete':idToDelete },
                    datatype: 'json',
                    success:function(response) {
                        //console.log(response);                 
                        //$("#bloodSubcategoryTestGroupEdit").html(response);
                         closest.remove();

                    }
                }); 
            } 
        });
        $(document).on('click','.remove-initial-options-parent',function() {
           var closest =  $(this).closest('.initial_options');
            //alert("input value :;"+$(this).closest('.initial_options').prev().val());
            var idToDelete = $(this).closest('.initial_options').prev().val();
            var parenttitle='';

            var temp = confirm("Do you really want to delete record ?");
            if (temp == true) {
                 $.ajax({
                    url:"{{route('delete_bloodinvestigatinTitles')}}",
                    method:'post',
                    data:{ 'idToDelete':idToDelete,'parent': 'parenttitle' },
                    datatype: 'json',
                    success:function(response) {
                        //console.log(response);                 
                        //$("#bloodSubcategoryTestGroupEdit").html(response);
                         closest.remove();

                    }
                }); 
            } 
        });        
/***************************** sub title ******************************************************/

        $(document).on('click','#addsubcategoriesbtn',function() {
           // var form_name = $(this).data('form_name');
           // var field_name = $(this).data('field_name');
            var selectedID = $("#blood_titles option:selected").attr("data-id");
            //alert("selectedID" +selectedID);
           // var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

            $.ajax({
                url:"{{route('get_update_dropdown_options_blood_investigation')}}",
                method:'post',
                data:{ 'subtitle':'subtitle','selectedID':selectedID },
                datatype: 'json',
                success:function(response) {
                    console.log(response);                 
                    $("#bloodSubcategoryTestGroupEdit").html(response);
                }
            });

           
            //$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').show();

            $("#bloodSubcategoryTestGroupEdit").show();
        });
        $(document).on('click','.update-dropdown-options-btn_blood_ign_subtitle',function() {
           

            var form_data = $('#update-dropdown-options-form-blood-ivn-subtitle :input').serialize();

            $.ajax({
                url:"{{route('update_dropdown_options_blood_ivn_subtitle')}}",
                method:'post',
                data:{'form_data': form_data},
                datatype: 'json',
                success:function(response) {
                    console.log(response);

                    location.reload();
                    /*
                    swal({title: "Options", text: "Update Successfully!", type: "success"},
                     function(){ 
                      location.reload();
                      }
                    );
                    */
                   // clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
                }
            });
        });

    $(document).on('click','.cancel-dropdown-options-btn-subtitle',function() {
        $('#bloodSubcategoryTestGroupEdit').hide();
        $('#bloodSubcategoryTestGroupEdit').html('');
    });
//=======================================================================================//

$(document).on('click', '.treatmentAdviceremoveButton', function(e) {
bloodcnt--;
   var target = $("#bloodTestGroup").find("#TextBoxDiv" +bloodcnt);
  $(target).remove();
});


$( "#blood_titles" ).change(function() {
    $("#addsubcategoriesbtn").show();
    $("#subCategorysave").show();

});
$("#bloodTitlebtnsave").click(function () {
  
        var content=$("#bloodTestGroup").val();
        if (isEmpty($('#bloodTestGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("AddBloodTitle") }}',
            method:'post',
            data:data,
            success:function(str)
            {
                //alert(str);
                $("#blood_titles").empty().append(str);

             swal({title: "Option For Blood Investigation Title", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
$("#subCategorysave").click(function () {
        var content=$("#bloodSubcategoryTestGroup").val();
        if (isEmpty($('#bloodSubcategoryTestGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
        var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("AddBloodSubTitle") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Blood Investigation Title", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


var addSubcategoriescnt = 0;
$("#addsubcategoriesbtn").click(function () {
    if($("#blood_titles").val() == '') {
        swal({title: "Please select first title", type: "warning"});
    } else {
          if(addSubcategoriescnt>10){
                     swal("Only 10 Options Values are allow!");
                    return false;
          }
          
        var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+addSubcategoriescnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="text" id="optionsval'+addSubcategoriescnt+'" placeholder="value'+addSubcategoriescnt+'" name="optionsval_subtitles[]"></div><span class="input-group-addon subcategorymovemoveButton" type="button" id="subcategorymovemoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

        $("#bloodSubcategoryTestGroup").append(newTextBoxDiv);
          addSubcategoriescnt++;
    }
});

$(document).on('click', '.subcategorymovemoveButton', function(e) {
addSubcategoriescnt--;
   var target = $("#bloodSubcategoryTestGroup").find("#TextBoxDiv" +addSubcategoriescnt);
  $(target).remove();
});

</script>


<script type="text/javascript">
    var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


</script>

<script>

$(document).ready(function() {

$('.bloodtests').on('change', function() {
	//alert(this.value);

	var test_type = $(this).data('type');
	var test = $(this).val();
	var is_checked = $(this).is(':checked') ? 1 : 0;

	console.log(test +' : '+ is_checked);

	var caseid=$("#caseid").val();
    var case_number=$("#case_number").val();

	var url="{{ url('manage-bloodinvestigation') }}";

	$.ajax({
		url:url,
		method:'post',
		data:{form_type: 'eyeform', test_type:test_type, test:test, is_checked:is_checked, caseid:caseid,case_number:case_number},
		success:function(data)
		{
		/*
		swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
		 function(){ 
		  location.reload();
		  }
		);
		*/
		}
	});
});

/*
    $('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    var id= this.id;
    if(id=="uveiitis_chk")
    {
        var uv_chkval=1;
        // alert("uv chk value "+uv_chkval);

    }
    else
    {
        var uv_chkval=0;
       // alert("uv chk value "+uv_chkval);
    }

     if(id=="preoperative_chk")
    {
        var pre_chkval=1;
        //alert("pre_chk value "+pre_chkval);

    }
    else
    {
         var pre_chkval=0;
        //alert("pre_chk value "+pre_chkval);
    }
     var caseid=$("#caseid").val();
     var case_number=$("#case_number").val();
     var url="{{ url('bloodinvestigation') }}/"+uv_chkval+"/"+pre_chkval+"/"+caseid;
     //alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:{uv_chkval:uv_chkval,pre_chkval:pre_chkval,caseid:caseid,case_number:case_number},
            success:function(data)
            {
            
            swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
});
*/

    //set initial state.
    // $('#textbox1').val($(this).is(':checked'));
    
    // $('#uveiitis_chk').change(function() {
    //      $(this).siblings('input[type="checkbox"]').not(this).prop('checked', false);
    //     if($(this).is(":checked")) {
    //         var checked=1;
    //         //alert(checked);
    //     }
    //     else
    //     {
    //         var checked=0;
    //     }
    //     var caseid=$("#caseid").val();
    //    var url="{{ url('bloodinvestigation1') }}/"+checked+"/"+caseid;
       
    //    //alert(url);

    //     $.ajax({
    //         url:url,
    //         method:'post',
    //         data:{checked:checked,caseid:caseid},
    //         success:function(data)
    //         {
                
    //             var txt="is "+data;
    //            swal({title: "Investigation For Uveiitis", text: txt, type: "success"},
    //          function(){ 
    //           location.reload();
    //           }
    //         );
    //         }
    //     })
            
    // });

    // $('#preoperative_chk').change(function() {
    //     if($(this).is(":checked")) {
    //         var checked=1;
    //     }
    //     else
    //     {
    //         var checked=0;
    //     }
    //     var caseid=$("#caseid").val();
    //    var url="{{ url('bloodinvestigation2') }}/"+checked+"/"+caseid;

    //     $.ajax({
    //         url:url,
    //         method:'post',
    //         data:{checked:checked,caseid:caseid},
    //         success:function(data)
    //         {
                
    //             var txt="is "+data;
    //            swal({title: " Pre Operative Investigation ", text: txt, type: "success"},
    //          function(){ 
    //           location.reload();
    //           }
    //         );
    //         }
    //     })
            
    // });
});
$(document).ready(function(){

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
         
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>

<!-- Systemic History Set Option -->
<script type="text/javascript">

</script>

<!-- Opthal History Set Option -->
<script type="text/javascript">
		 var opthahistorycnt = 1;
	$("#opthahistorybtn").click(function () {
		  
	  if(opthahistorycnt>10){
				swal("Only 10 Options Values are allow!");
				return false;
	  }
	  
	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+opthahistorycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Opthal History OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Opthal History OS"><input class="form-control"  type="text" id="optionsval'+opthahistorycnt+'" placeholder="value'+opthahistorycnt+'" name="optionsval[]"></div><span class="input-group-addon opthalhistoryremoveButton" type="button" id="opthalhistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#OpthalTextBoxesGroup").append(newTextBoxDiv);
	  opthahistorycnt++;
		 });

	$(document).on('click', '.opthalhistoryremoveButton', function(e) {
	opthahistorycnt--;
	   var target = $("#OpthalTextBoxesGroup").find("#TextBoxDiv" +opthahistorycnt);
	  $(target).remove();
	});

</script>

<!-- Chief Complaint Set Option -->
<script type="text/javascript">
$(document).ready(function(){

    var counter = 1;

    $("#chiefcomplaintbtn").click(function () {
      
  if(counter>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+counter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Chief Complaint OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Chief Complaint OS"><input class="form-control"  type="text" id="optionsval'+counter+'" placeholder="value'+counter+'" name="optionsval[]"></div><span class="input-group-addon chiefcomplainremoveButton" type="button" id="chiefcomplainremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#ChiefTextBoxesGroup").append(newTextBoxDiv);
  counter++;
     });

$(document).on('click', '.chiefcomplainremoveButton', function(e) {
counter--;
   var target = $("#ChiefTextBoxesGroup").find("#TextBoxDiv" +counter);
  $(target).remove();
});
});
</script>

<!-- DVN (UC) Set Option -->
<script type="text/javascript">
     var dvncnt = 1;
$("#dvnbtn").click(function () {
      
  if(dvncnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+dvncnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="dvn_od"><input class="form-control"  type="hidden"  name="fieldName2" value="dvn_os"><input class="form-control"  type="text" id="optionsval'+dvncnt+'" placeholder="value'+dvncnt+'" name="optionsval[]"></div><span class="input-group-addon dvnremoveButton" type="button" id="dvnremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#dvnTextBoxesGroup").append(newTextBoxDiv);
  dvncnt++;
     });

$(document).on('click', '.dvnremoveButton', function(e) {
dvncnt--;
   var target = $("#dvnTextBoxesGroup").find("#TextBoxDiv" +dvncnt);
  $(target).remove();
});

</script>


<!-- NVN (UC) Set Option -->
<script type="text/javascript">
     var nvncnt = 1;
$("#nvnbtn").click(function () {
      
  if(nvncnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+nvncnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="nvn_od"><input class="form-control"  type="hidden"  name="fieldName2" value="nvn_os"><input class="form-control"  type="text" id="optionsval'+nvncnt+'" placeholder="value'+nvncnt+'" name="optionsval[]"></div><span class="input-group-addon nvnremoveButton" type="button" id="nvnremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#nvnTextBoxesGroup").append(newTextBoxDiv);
  nvncnt++;
     });

$(document).on('click', '.nvnremoveButton', function(e) {
nvncnt--;
   var target = $("#nvnTextBoxesGroup").find("#TextBoxDiv" +nvncnt);
  $(target).remove();
});

</script>


<!-- WithPinhole Set Option -->
<script type="text/javascript">
     var WithPinholecnt = 1;
$("#WithPinholebtn").click(function () {
      
  if(WithPinholecnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+WithPinholecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="withpinhole_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="withpinhole_OS"><input class="form-control"  type="text" id="optionsval'+WithPinholecnt+'" placeholder="value'+WithPinholecnt+'" name="optionsval[]"></div><span class="input-group-addon WithPinholeremoveButton" type="button" id="WithPinholeremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#WithPinholeTextBoxesGroup").append(newTextBoxDiv);
  WithPinholecnt++;
     });

$(document).on('click', '.WithPinholeremoveButton', function(e) {
WithPinholecnt--;
   var target = $("#WithPinholeTextBoxesGroup").find("#TextBoxDiv" +WithPinholecnt);
  $(target).remove();
});

</script>

<!-- PGP Set Option -->
<script type="text/javascript">
     var PGPcnt = 1;
$("#PGPbtn").click(function () {
      
  if(PGPcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+PGPcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="visualacuity_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="visualacuity_OS"><input class="form-control"  type="text" id="optionsval'+PGPcnt+'" placeholder="value'+PGPcnt+'" name="optionsval[]"></div><span class="input-group-addon PGPremoveButton" type="button" id="PGPremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#PGPTextBoxesGroup").append(newTextBoxDiv);
  PGPcnt++;
     });

$(document).on('click', '.PGPremoveButton', function(e) {
PGPcnt--;
   var target = $("#PGPTextBoxesGroup").find("#TextBoxDiv" +PGPcnt);
  $(target).remove();
});

</script>


<!-- DVN (With Glasses) Set Option -->

<script type="text/javascript">
     var DVNWithGlassescnt = 1;
//$("#DVNWithGlassesbtn").click(function () {
$(document).on('click',"#DVNWithGlassesbtn", function () {

      
  if(DVNWithGlassescnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+DVNWithGlassescnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="colour_vision_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="colour_vision_OS"><input class="form-control"  type="text" id="optionsval'+DVNWithGlassescnt+'" placeholder="value'+DVNWithGlassescnt+'" name="optionsval[]"></div><span class="input-group-addon DVNWithGlassesremoveButton" type="button" id="DVNWithGlassesremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#DVNWithGlassesTextBoxesGroup").append(newTextBoxDiv);
  DVNWithGlassescnt++;
     });

$(document).on('click', '.DVNWithGlassesremoveButton', function(e) {
DVNWithGlassescnt--;
   var target = $("#DVNWithGlassesTextBoxesGroup").find("#TextBoxDiv" +DVNWithGlassescnt);
  $(target).remove();
});

</script>


<!-- NVN (With Glasses) Set Option -->NVNWithGlasses
<script type="text/javascript">
     var NVNWithGlassescnt = 1;
//$("#NVNWithGlassesbtn").click(function () {

$(document).on('click',"#NVNWithGlassesbtn", function () {
      
  if(NVNWithGlassescnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+NVNWithGlassescnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="withglasses_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="withglasses_OS"><input class="form-control"  type="text" id="optionsval'+NVNWithGlassescnt+'" placeholder="value'+NVNWithGlassescnt+'" name="optionsval[]"></div><span class="input-group-addon NVNWithGlassesremoveButton" type="button" id="NVNWithGlassesremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#NVNWithGlassesTextBoxesGroup").append(newTextBoxDiv);
  NVNWithGlassescnt++;
     });

$(document).on('click', '.NVNWithGlassesremoveButton', function(e) {
NVNWithGlassescnt--;
   var target = $("#NVNWithGlassesTextBoxesGroup").find("#TextBoxDiv" +NVNWithGlassescnt);
  $(target).remove();
});

</script>
<!-- Finding Lids Set Option -->
<script type="text/javascript">
     var lidscnt = 1;
//$("#lidsbtn").click(function () {
     
$(document).on('click',"#lidsbtn", function () {
  if(lidscnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+lidscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="LIDS OD"><input class="form-control"  type="hidden"  name="fieldName2" value="LIDS OS"><input class="form-control"  type="text" id="optionsval'+lidscnt+'" placeholder="value'+lidscnt+'" name="optionsval[]"></div><span class="input-group-addon lidsremoveButton" type="button" id="lidsremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#LidsTextBoxesGroup").append(newTextBoxDiv);
  lidscnt++;
     });

$(document).on('click', '.lidsremoveButton', function(e) {
lidscnt--;
   var target = $("#LidsTextBoxesGroup").find("#TextBoxDiv" +lidscnt);
  $(target).remove();
});

</script>

<!-- Finding Orbit Set Option -->
<script type="text/javascript">
     var orbitcnt = 1;
//$("#orbitbtn").click(function () {
$(document).on('click',"#orbitbtn", function () {
      
  if(orbitcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+orbitcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="OrbitSacsEyeMotility OD"><input class="form-control"  type="hidden"  name="fieldName2" value="OrbitSacsEyeMotility OS"><input class="form-control"  type="text" id="optionsval'+orbitcnt+'" placeholder="value'+orbitcnt+'" name="optionsval[]"></div><span class="input-group-addon orbitremoveButton" type="button" id="orbitremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#OrbitTextBoxesGroup").append(newTextBoxDiv);
  orbitcnt++;
     });

$(document).on('click', '.orbitremoveButton', function(e) {
orbitcnt--;
   var target = $("#OrbitTextBoxesGroup").find("#TextBoxDiv" +orbitcnt);
  $(target).remove();
});

</script>

<!-- Finding Conj Set Option -->
<script type="text/javascript">
     var conjcnt = 1;
//$("#conjbtn").click(function () {
$(document).on('click',"#conjbtn", function () {

      
  if(conjcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+conjcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Conj And Lids OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Conj And Lids OS"><input class="form-control"  type="text" id="optionsval'+conjcnt+'" placeholder="value'+conjcnt+'" name="optionsval[]"></div><span class="input-group-addon conjremoveButton" type="button" id="conjremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#ConjTextBoxesGroup").append(newTextBoxDiv);
  conjcnt++;
     });

$(document).on('click', '.conjremoveButton', function(e) {
conjcnt--;
   var target = $("#ConjTextBoxesGroup").find("#TextBoxDiv" +conjcnt);
  $(target).remove();
});

</script>


<!-- Finding Cornea Set Option -->
<script type="text/javascript">
     var corneacnt = 1;
//$("#corneabtn").click(function () {
  $(document).on('click',"#corneabtn", function () {
    
  if(corneacnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+corneacnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Cornea OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Cornea OS"><input class="form-control"  type="text" id="optionsval'+corneacnt+'" placeholder="value'+corneacnt+'" name="optionsval[]"></div><span class="input-group-addon cornearemoveButton" type="button" id="cornearemoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#CorneaTextBoxesGroup").append(newTextBoxDiv);
  corneacnt++;
     });

$(document).on('click', '.cornearemoveButton', function(e) {
corneacnt--;
   var target = $("#CorneaTextBoxesGroup").find("#TextBoxDiv" +corneacnt);
  $(target).remove();
});

</script>


<!-- Finding AC1 Set Option -->
<script type="text/javascript">
     var ac1cnt = 1;
//$("#ac1abtn").click(function () {
   $(document).on('click',"#ac1abtn", function () {
     
  if(ac1cnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+ac1cnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="AC OD"><input class="form-control"  type="hidden"  name="fieldName2" value="AC OS"><input class="form-control"  type="text" id="optionsval'+ac1cnt+'" placeholder="value'+ac1cnt+'" name="optionsval[]"></div><span class="input-group-addon ac1removeButton" type="button" id="ac1removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#AC1TextBoxesGroup").append(newTextBoxDiv);
  ac1cnt++;
     });

$(document).on('click', '.ac1removeButton', function(e) {
ac1cnt--;
   var target = $("#AC1TextBoxesGroup").find("#TextBoxDiv" +ac1cnt);
  $(target).remove();
});

</script>

<!-- Finding Iris Set Option -->
<script type="text/javascript">
     var iriscnt = 1;
//$("#irisbtn").click(function () {
   $(document).on('click',"#irisbtn", function () {
      
  if(iriscnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+iriscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="IRIS OD"><input class="form-control"  type="hidden"  name="fieldName2" value="IRIS OS"><input class="form-control"  type="text" id="optionsval'+iriscnt+'" placeholder="value'+iriscnt+'" name="optionsval[]"></div><span class="input-group-addon irisremoveButton" type="button" id="irisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#IrisTextBoxesGroup").append(newTextBoxDiv);
  iriscnt++;
     });

$(document).on('click', '.irisremoveButton', function(e) {
iriscnt--;
   var target = $("#IrisTextBoxesGroup").find("#TextBoxDiv" +iriscnt);
  $(target).remove();
});

</script>

<!-- Finding Pupil Set Option -->
<script type="text/javascript">
     var pupilcnt = 1;
//$("#pupilbtn").click(function () {
   $(document).on('click',"#pupilbtn", function () {
      
  if(pupilcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+pupilcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="pupilIrisac OD"><input class="form-control"  type="hidden"  name="fieldName2" value="pupilIrisac OS"><input class="form-control"  type="text" id="optionsval'+pupilcnt+'" placeholder="value'+pupilcnt+'" name="optionsval[]"></div><span class="input-group-addon pupilremoveButton" type="button" id="pupilremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#PupilTextBoxesGroup").append(newTextBoxDiv);
  pupilcnt++;
     });

$(document).on('click', '.pupilremoveButton', function(e) {
pupilcnt--;
   var target = $("#PupilTextBoxesGroup").find("#TextBoxDiv" +pupilcnt);
  $(target).remove();
});

</script>

<!-- Finding Lens Set Option -->
<script type="text/javascript">
     var lenscnt = 1;
//$("#lensbtn").click(function () {
   $(document).on('click',"#lensbtn", function () {
      
  if(lenscnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+lenscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="lens OD"><input class="form-control"  type="hidden"  name="fieldName2" value="lens OS"><input class="form-control"  type="text" id="optionsval'+lenscnt+'" placeholder="value'+lenscnt+'" name="optionsval[]"></div><span class="input-group-addon lensremoveButton" type="button" id="lensremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#LensTextBoxesGroup").append(newTextBoxDiv);
  lenscnt++;
     });

$(document).on('click', '.lensremoveButton', function(e) {
lenscnt--;
   var target = $("#LensTextBoxesGroup").find("#TextBoxDiv" +lenscnt);
  $(target).remove();
});

</script>


<!-- Finding Vitreo Set Option -->
<script type="text/javascript">
     var vitreocnt = 1;
//$("#vitreobtn").click(function () {
    $(document).on('click',"#vitreobtn", function () {
     
  if(vitreocnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+vitreocnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="vitreoretinal OD"><input class="form-control"  type="hidden"  name="fieldName2" value="vitreoretinal OS"><input class="form-control"  type="text" id="optionsval'+vitreocnt+'" placeholder="value'+vitreocnt+'" name="optionsval[]"></div><span class="input-group-addon vitreoremoveButton" type="button" id="vitreoremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#VitreoTextBoxesGroup").append(newTextBoxDiv);
  vitreocnt++;
     });

$(document).on('click', '.vitreoremoveButton', function(e) {
vitreocnt--;
   var target = $("#VitreoTextBoxesGroup").find("#TextBoxDiv" +vitreocnt);
  $(target).remove();
});

</script>


<!-- Finding Retina Set Option -->
<script type="text/javascript">
     var retinacnt = 1;
//$("#retinabtn").click(function () {
     $(document).on('click',"#retinabtn", function () {
     
  if(retinacnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+retinacnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Retina OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Retina OS"><input class="form-control"  type="text" id="optionsval'+retinacnt+'" placeholder="value'+retinacnt+'" name="optionsval[]"></div><span class="input-group-addon retinaremoveButton" type="button" id="retinaremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#RetinaTextBoxesGroup").append(newTextBoxDiv);
  retinacnt++;
     });

$(document).on('click', '.retinaremoveButton', function(e) {
retinacnt--;
   var target = $("#RetinaTextBoxesGroup").find("#TextBoxDiv" +retinacnt);
  $(target).remove();
});

</script>



<!-- Finding ONH Set Option -->
<script type="text/javascript">
     var onhcnt = 1;
//$("#onhbtn").click(function () {
      $(document).on('click',"#onhbtn", function () {
     
  if(onhcnt>10){
           swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+onhcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="ONH OD"><input class="form-control"  type="hidden"  name="fieldName2" value="ONH OS"><input class="form-control"  type="text" id="optionsval'+onhcnt+'" placeholder="value'+onhcnt+'" name="optionsval[]"></div><span class="input-group-addon onhremoveButton" type="button" id="onhremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#ONHTextBoxesGroup").append(newTextBoxDiv);
  onhcnt++;
     });

$(document).on('click', '.onhremoveButton', function(e) {
onhcnt--;
   var target = $("#ONHTextBoxesGroup").find("#TextBoxDiv" +onhcnt);
  $(target).remove();
});

</script>


<!-- Finding Macula Set Option -->
<script type="text/javascript">
     var maculacnt = 1;
//$("#maculabtn").click(function () {
        $(document).on('click',"#maculabtn", function () {
    
  if(maculacnt>10){
           swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+maculacnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Macula OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Macula OS"><input class="form-control"  type="text" id="optionsval'+maculacnt+'" placeholder="value'+maculacnt+'" name="optionsval[]"></div><span class="input-group-addon macularemoveButton" type="button" id="macularemoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#MaculaTextBoxesGroup").append(newTextBoxDiv);
  maculacnt++;
     });

$(document).on('click', '.macularemoveButton', function(e) {
maculacnt--;
   var target = $("#MaculaTextBoxesGroup").find("#TextBoxDiv" +maculacnt);
  $(target).remove();
});

</script>


<!-- Finding Sac Set Option -->
<script type="text/javascript">
     var saccnt = 1;
//$("#sacbtn").click(function () {
$(document).on('click',"#sacbtn", function () {
    
  if(saccnt>10){
 swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+saccnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="sac OD"><input class="form-control"  type="hidden"  name="fieldName2" value="sac OS"><input class="form-control"  type="text" id="optionsval'+saccnt+'" placeholder="value'+saccnt+'" name="optionsval[]"></div><span class="input-group-addon sacremoveButton" type="button" id="sacremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SacTextBoxesGroup").append(newTextBoxDiv);
  saccnt++;
     });

$(document).on('click', '.sacremoveButton', function(e) {
saccnt--;
   var target = $("#SacTextBoxesGroup").find("#TextBoxDiv" +saccnt);
  $(target).remove();
});

</script>   
    <!-- IOP Set Option -->
<script type="text/javascript">
     var IOPcnt = 1;
$("#IOPbtn").click(function () {
      
  if(IOPcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+IOPcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="IOP_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="IOP_OS"><input class="form-control"  type="text" id="optionsval'+IOPcnt+'" placeholder="value'+IOPcnt+'" name="optionsval[]"></div><span class="input-group-addon IOPremoveButton" type="button" id="IOPremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#IOPTextBoxesGroup").append(newTextBoxDiv);
  IOPcnt++;
     });

$(document).on('click', '.IOPremoveButton', function(e) {
IOPcnt--;
   var target = $("#IOPTextBoxesGroup").find("#TextBoxDiv" +IOPcnt);
  $(target).remove();
});

</script>


<!-- CD Ratio Set Option -->
<script type="text/javascript">
     var CDRatiocnt = 1;
$("#CDRatiobtn").click(function () {
      
  if(CDRatiocnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+CDRatiocnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Ratio OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Ratio OS"><input class="form-control"  type="text" id="optionsval'+CDRatiocnt+'" placeholder="value'+CDRatiocnt+'" name="optionsval[]"></div><span class="input-group-addon CDRatioremoveButton" type="button" id="CDRatioremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#CDRatioTextBoxesGroup").append(newTextBoxDiv);
  CDRatiocnt++;
     });

$(document).on('click', '.CDRatioremoveButton', function(e) {
CDRatiocnt--;
   var target = $("#CDRatioTextBoxesGroup").find("#TextBoxDiv" +CDRatiocnt);
  $(target).remove();
});

</script>


<!-- Pachymetry Set Option -->
<script type="text/javascript">
     var Pachymetrycnt = 1;
$("#Pachymetrybtn").click(function () {
      
  if(Pachymetrycnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+Pachymetrycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="Pachymetry_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="Pachymetry_OS"><input class="form-control"  type="text" id="optionsval'+Pachymetrycnt+'" placeholder="value'+Pachymetrycnt+'" name="optionsval[]"></div><span class="input-group-addon PachymetryremoveButton" type="button" id="PachymetryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#PachymetryTextBoxesGroup").append(newTextBoxDiv);
  Pachymetrycnt++;
     });

$(document).on('click', '.PachymetryremoveButton', function(e) {
Pachymetrycnt--;
   var target = $("#PachymetryTextBoxesGroup").find("#TextBoxDiv" +Pachymetrycnt);
  $(target).remove();
});

</script>


<!-- C.C.T Set Option -->
<script type="text/javascript">
     var cctcnt = 1;
$("#cctbtn").click(function () {
      
  if(cctcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+cctcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="CCT_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="CCT_OS"><input class="form-control"  type="text" id="optionsval'+cctcnt+'" placeholder="value'+cctcnt+'" name="optionsval[]"></div><span class="input-group-addon cctremoveButton" type="button" id="cctremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#cctTextBoxesGroup").append(newTextBoxDiv);
  cctcnt++;
     });

$(document).on('click', '.cctremoveButton', function(e) {
cctcnt--;
   var target = $("#cctTextBoxesGroup").find("#TextBoxDiv" +cctcnt);
  $(target).remove();
});

</script>


<!-- K1 Set Option -->
<script type="text/javascript">
     var K1cnt = 1;
$("#K1btn").click(function () {
      
  if(cctcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+K1cnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="k1_od"><input class="form-control"  type="hidden"  name="fieldName2" value="k1_os"><input class="form-control"  type="text" id="optionsval'+K1cnt+'" placeholder="value'+K1cnt+'" name="optionsval[]"></div><span class="input-group-addon K1removeButton" type="button" id="K1removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#K1TextBoxesGroup").append(newTextBoxDiv);
  K1cnt++;
     });

$(document).on('click', '.K1removeButton', function(e) {
K1cnt--;
   var target = $("#K1TextBoxesGroup").find("#TextBoxDiv" +K1cnt);
  $(target).remove();
});

</script>


<!-- K2 Set Option -->
<script type="text/javascript">
     var K2cnt = 1;
$("#K2btn").click(function () {
      
  if(K2cnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+K2cnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="k2_od"><input class="form-control"  type="hidden"  name="fieldName2" value="k2_os"><input class="form-control"  type="text" id="optionsval'+K2cnt+'" placeholder="value'+K2cnt+'" name="optionsval[]"></div><span class="input-group-addon K2removeButton" type="button" id="K2removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#K2TextBoxesGroup").append(newTextBoxDiv);
  K2cnt++;
     });

$(document).on('click', '.K2removeButton', function(e) {
K2cnt--;
   var target = $("#K2TextBoxesGroup").find("#TextBoxDiv" +K2cnt);
  $(target).remove();
});

</script>


<!-- Lens Power Set Option -->
<script type="text/javascript">
     var lenspowercnt = 1;
$("#lenspowerbtn").click(function () {
      
  if(lenspowercnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+lenspowercnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="lenspower_od"><input class="form-control"  type="hidden"  name="fieldName2" value="lenspower_os"><input class="form-control"  type="text" id="optionsval'+lenspowercnt+'" placeholder="value'+lenspowercnt+'" name="optionsval[]"></div><span class="input-group-addon lenspowerremoveButton" type="button" id="lenspowerremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#lenspowerTextBoxesGroup").append(newTextBoxDiv);
  lenspowercnt++;
     });

$(document).on('click', '.lenspowerremoveButton', function(e) {
lenspowercnt--;
   var target = $("#lenspowerTextBoxesGroup").find("#TextBoxDiv" +lenspowercnt);
  $(target).remove();
});

</script>


<!-- Axial length Set Option -->
<script type="text/javascript">
     var axial_lengthcnt = 1;
$("#axial_lengthbtn").click(function () {
      
  if(axial_lengthcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+axial_lengthcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="axial_length_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="axial_length_OS"><input class="form-control"  type="text" id="optionsval'+axial_lengthcnt+'" placeholder="value'+axial_lengthcnt+'" name="optionsval[]"></div><span class="input-group-addon axial_lengthremoveButton" type="button" id="axial_lengthremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#axial_lengthTextBoxesGroup").append(newTextBoxDiv);
  axial_lengthcnt++;
     });

$(document).on('click', '.axial_lengthremoveButton', function(e) {
axial_lengthcnt--;
   var target = $("#axial_lengthTextBoxesGroup").find("#TextBoxDiv" +axial_lengthcnt);
  $(target).remove();
});

</script>

<!-- Lens type Set Option -->
<script type="text/javascript">
     var lens_typecnt = 1;
$("#lens_typebtn").click(function () {
      
  if(lens_typecnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+lens_typecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="lens_type_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="lens_type_OS"><input class="form-control"  type="text" id="optionsval'+lens_typecnt+'" placeholder="value'+lens_typecnt+'" name="optionsval[]"></div><span class="input-group-addon lens_typeremoveButton" type="button" id="lens_typeremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#lens_typeTextBoxesGroup").append(newTextBoxDiv);
  lens_typecnt++;
     });

$(document).on('click', '.lens_typeremoveButton', function(e) {
lens_typecnt--;
   var target = $("#lens_typeTextBoxesGroup").find("#TextBoxDiv" +lens_typecnt);
  $(target).remove();
});

</script>


<!-- KC Set Option -->
<script type="text/javascript">
     var KCcnt = 1;
$("#KCbtn").click(function () {
      
  if(KCcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+KCcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="KC_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="KC_OS"><input class="form-control"  type="text" id="optionsval'+KCcnt+'" placeholder="value'+KCcnt+'" name="optionsval[]"></div><span class="input-group-addon KCremoveButton" type="button" id="KCremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#KCTextBoxesGroup").append(newTextBoxDiv);
  KCcnt++;
     });

$(document).on('click', '.KCremoveButton', function(e) {
KCcnt--;
   var target = $("#KCTextBoxesGroup").find("#TextBoxDiv" +KCcnt);
  $(target).remove();
});
</script>

<!-- ANTERIOR SEGMENT Set Option -->

<script type="text/javascript">
      var otherDetailsAnteriorSegmentcnt = 1;
$("#otherDetailsAnteriorSegmentbtn").click(function () {
      
  if(otherDetailsAnteriorSegmentcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsAnteriorSegmentcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsAnteriorSegment"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsAnteriorSegment"><input class="form-control"  type="text" id="optionsval'+otherDetailsAnteriorSegmentcnt+'" placeholder="value'+otherDetailsAnteriorSegmentcnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsAnteriorSegmentremoveButton" type="button" id="otherDetailsAnteriorSegmentremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsAnteriorSegmentTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsAnteriorSegmentcnt++;
     });

$(document).on('click', '.otherDetailsAnteriorSegmentremoveButton', function(e) {
otherDetailsAnteriorSegmentcnt--;
   var target = $("#otherDetailsAnteriorSegmentTextBoxesGroup").find("#TextBoxDiv" +otherDetailsAnteriorSegmentcnt);
  $(target).remove();
});
</script>
<!-- blood investigation title ------>


<!-- POSTERIOR SEGMENT Set Option -->

<script type="text/javascript">
     var treatmentAdvicecnt = 1;
$("#treatmentAdvicebtn").click(function () {
      
  if(treatmentAdvicecnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+treatmentAdvicecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="treatmentAdvice"><input class="form-control"  type="hidden"  name="fieldName2" value="treatmentAdvice"><input class="form-control"  type="text" id="optionsval'+treatmentAdvicecnt+'" placeholder="value'+treatmentAdvicecnt+'" name="optionsval[]"></div><span class="input-group-addon treatmentAdviceremoveButton" type="button" id="treatmentAdviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#treatmentAdviceTextBoxesGroup").append(newTextBoxDiv);
  treatmentAdvicecnt++;
     });

$(document).on('click', '.treatmentAdviceremoveButton', function(e) {
treatmentAdvicecnt--;
   var target = $("#treatmentAdviceTextBoxesGroup").find("#TextBoxDiv" +treatmentAdvicecnt);
  $(target).remove();
});

</script>



<!-- Color Vision  Set Option -->
<script type="text/javascript">
     var colorvisioncnt = 1;
$("#ColourVisionbtn").click(function () {
      
  if(colorvisioncnt>10){
 swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+colorvisioncnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="colour OD"><input class="form-control"  type="hidden"  name="fieldName2" value="colour OS"><input class="form-control"  type="text" id="optionsval'+colorvisioncnt+'" placeholder="value'+colorvisioncnt+'" name="optionsval[]"></div><span class="input-group-addon colorvisionremoveButton" type="button" id="colorvisionremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#ColourVisionTextBoxesGroup").append(newTextBoxDiv);
  colorvisioncnt++;
     });

$(document).on('click', '.colorvisionremoveButton', function(e) {
colorvisioncnt--;
   var target = $("#ColourVisionTextBoxesGroup").find("#TextBoxDiv" +colorvisioncnt);
  $(target).remove();
});

</script>



<!-- Schimer Test 1 Set Option -->
<script type="text/javascript">
     var schimertestonecnt = 1;
$("#schimertestonebtn").click(function () {
      
  if(schimertestonecnt>10){
 swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+schimertestonecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="schimerTest1_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="schimerTest1_OS"><input class="form-control"  type="text" id="optionsval'+schimertestonecnt+'" placeholder="value'+schimertestonecnt+'" name="optionsval[]"></div><span class="input-group-addon schimertestoneremoveButton" type="button" id="schimertestoneremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SchimerTestOneTextBoxesGroup").append(newTextBoxDiv);
  schimertestonecnt++;
     });

$(document).on('click', '.schimertestoneremoveButton', function(e) {
schimertestonecnt--;
   var target = $("#SchimerTestOneTextBoxesGroup").find("#TextBoxDiv" +schimertestonecnt);
  $(target).remove();
});

</script>



<!-- Schimer Test 2 Set Option -->
<script type="text/javascript">
     var schimertesttwocnt = 1;
$("#schimertesttwobtn").click(function () {
      
  if(schimertesttwocnt>10){
 swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+schimertesttwocnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="schimerTest2_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="schimerTest2_OS"><input class="form-control"  type="text" id="optionsval'+schimertesttwocnt+'" placeholder="value'+schimertesttwocnt+'" name="optionsval[]"></div><span class="input-group-addon schimertesttworemoveButton" type="button" id="schimertesttworemoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SchimerTestTwoTextBoxesGroup").append(newTextBoxDiv);
  schimertesttwocnt++;
     });

$(document).on('click', '.schimertesttworemoveButton', function(e) {
schimertesttwocnt--;
   var target = $("#SchimerTestTwoTextBoxesGroup").find("#TextBoxDiv" +schimertesttwocnt);
  $(target).remove();
});

</script>

<!-- Optical Coherence tomography (OCT)Set Option -->
<script type="text/javascript">
     var octcnt = 1;
$("#octbtn").click(function () {
      
  if(octcnt>10){
 swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+octcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="OCT OD"><input class="form-control"  type="hidden"  name="fieldName2" value="OCT OS"><input class="form-control"  type="text" id="optionsval'+octcnt+'" placeholder="value'+octcnt+'" name="optionsval[]"></div><span class="input-group-addon octremoveButton" type="button" id="octremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#OCTTextBoxesGroup").append(newTextBoxDiv);
  octcnt++;
     });

$(document).on('click', '.octremoveButton', function(e) {
octcnt--;
   var target = $("#OCTTextBoxesGroup").find("#TextBoxDiv" +octcnt);
  $(target).remove();
});

</script>



<!-- Extra Ocular Movement (EOM) (OCT)Set Option -->
<script type="text/javascript">
     var eomcnt = 1;
$("#eombtn").click(function () {
      
  if(eomcnt>10){
 swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+eomcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="EOM OD"><input class="form-control"  type="hidden"  name="fieldName2" value="EOM OS"><input class="form-control"  type="text" id="optionsval'+eomcnt+'" placeholder="value'+eomcnt+'" name="optionsval[]"></div><span class="input-group-addon eomremoveButton" type="button" id="eomremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#EOMTextBoxesGroup").append(newTextBoxDiv);
  eomcnt++;
     });

$(document).on('click', '.eomremoveButton', function(e) {
eomcnt--;
   var target = $("#EOMTextBoxesGroup").find("#TextBoxDiv" +eomcnt);
  $(target).remove();
});

</script>
<!-- Code To add Option in Database -->
<script type="text/javascript">
     function isEmpty( el ){
      return !$.trim(el.html())
  }

// Systemic History Add Option
/*
      $("#systemichistorybtnsave").click(function () {
        var content=$("#SystemicHistoryTextBoxesGroup").val();
        if (isEmpty($('#SystemicHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("systemicinsert.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Systemic History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
*/



// Chief Complaint Add Option

      $("#chiefcomplaintbtnsave").click(function () {
        var content=$("#ChiefTextBoxesGroup").val();
        if (isEmpty($('#ChiefTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Chief Complaint", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Opthal History Add Option

      $("#opthahistorybtnsave").click(function () {
        var content=$("#OpthalTextBoxesGroup").val();
        if (isEmpty($('#OpthalTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Opthal History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


    // DVN (UC) Add Option

      $("#DVNbtnsave").click(function () {
        var content=$("#dvnTextBoxesGroup").val();
        if (isEmpty($('#dvnTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For DVN (UC)", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// NVN (UC) Add Option

      $("#nvnbtnsave").click(function () {
        var content=$("#nvnTextBoxesGroup").val();
        if (isEmpty($('#nvnTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For NVN (UC)", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// With Pinhole Add Option

      $("#WithPinholebtnsave").click(function () {
        var content=$("#WithPinholeTextBoxesGroup").val();
        if (isEmpty($('#WithPinholeTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For With Pinhole", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// PGP Add Option

      $("#PGPbtnsave").click(function () {
        var content=$("#PGPTextBoxesGroup").val();
        if (isEmpty($('#PGPTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For PGP", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// DVN (With Glasses) Add Option

      $("#DVNWithGlassesbtnsave").click(function () {
        var content=$("#DVNWithGlassesTextBoxesGroup").val();
        if (isEmpty($('#DVNWithGlassesTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For DVN (With Glasses)", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// NVN (With Glasses) Add Option

      $("#NVNWithGlassesbtnsave").click(function () {
        var content=$("#NVNWithGlassesTextBoxesGroup").val();
        if (isEmpty($('#NVNWithGlassesTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For NVN (With Glasses)", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
// Lids Add Option

      //$("#lidsbtnsave").click(function () {
		$(document).on('click', "#lidsbtnsave", function () {
        var content=$("#LidsTextBoxesGroup").val();
        if (isEmpty($('#LidsTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Lids", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

  
// Orbit Add Option

      //$("#orbitbtnsave").click(function () {
$(document).on('click',"#orbitbtnsave", function (e) {

        var content=$("#OrbitTextBoxesGroup").val();
        if (isEmpty($('#OrbitTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Orbit", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// Conj Add Option

      //$("#conjbtnsave").click(function () {
$(document).on('click',"#conjbtnsave", function (e) {
        var content=$("#ConjTextBoxesGroup").val();
        if (isEmpty($('#ConjTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Conj", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Cornea Add Option

      //$("#corneabtnsave").click(function () {
$(document).on('click',"#corneabtnsave", function (e) {
        var content=$("#CorneaTextBoxesGroup").val();
        if (isEmpty($('#CorneaTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Cornea", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
 
// AC1 Add Option

      //$("#ac1btnsave").click(function () {
$(document).on('click',"#ac1btnsave", function (e) {
        var content=$("#AC1TextBoxesGroup").val();
        if (isEmpty($('#AC1TextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For AC1", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

 
// Iris Add Option

      //$("#irisbtnsave").click(function () {
$(document).on('click',"#irisbtnsave", function (e) {
        var content=$("#IrisTextBoxesGroup").val();
        if (isEmpty($('#IrisTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Iris", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Pupil Add Option

     // $("#pupilbtnsave").click(function () {
$(document).on('click',"#pupilbtnsave", function (e) {
        var content=$("#PupilTextBoxesGroup").val();
        if (isEmpty($('#PupilTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Pupil", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// Lens Add Option

     // $("#lensbtnsave").click(function () {
$(document).on('click',"#lensbtnsave", function (e) {
        var content=$("#LensTextBoxesGroup").val();
        if (isEmpty($('#LensTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Lens", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// Vitreo Add Option

     // $("#vitreobtnsave").click(function () {
$(document).on('click',"#vitreobtnsave", function (e) {
        var content=$("#VitreoTextBoxesGroup").val();
        if (isEmpty($('#VitreoTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Vitreo", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });  

// Retina Add Option

     // $("#retinabtnsave").click(function () {
$(document).on('click',"#retinabtnsave", function (e) {
        var content=$("#RetinaTextBoxesGroup").val();
        if (isEmpty($('#RetinaTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Retina", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
  
 // ONH Add Option

      //$("#onhbtnsave").click(function () {
$(document).on('click',"#onhbtnsave", function (e) {
        var content=$("#ONHTextBoxesGroup").val();
        if (isEmpty($('#ONHTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For ONH", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


    // Macula Add Option

      //$("#maculabtnsave").click(function () {
$(document).on('click',"#maculabtnsave", function (e) {
        var content=$("#MaculaTextBoxesGroup").val();
        if (isEmpty($('#MaculaTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Macula", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


     // Sac Add Option

     // $("#sacbtnsave").click(function () {
$(document).on('click',"#sacbtnsave", function (e) {
        var content=$("#SacTextBoxesGroup").val();
        if (isEmpty($('#SacTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Sac", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
    

      // IOP Add Option

      $("#IOPbtnsave").click(function () {
        var content=$("#IOPTextBoxesGroup").val();
        if (isEmpty($('#IOPTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For IOP", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // CD Ratio Add Option

      $("#CDRatiobtnsave").click(function () {
        var content=$("#CDRatioTextBoxesGroup").val();
        if (isEmpty($('#CDRatioTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For CD Ratio", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // Pachymetry Add Option

      $("#Pachymetrybtnsave").click(function () {
        var content=$("#PachymetryTextBoxesGroup").val();
        if (isEmpty($('#PachymetryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Pachymetry", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // CctAdd Option

      $("#cctbtnsave").click(function () {
        var content=$("#cctTextBoxesGroup").val();
        if (isEmpty($('#cctTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For cct", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


 // CctAdd Option

      $("#cctbtnsave").click(function () {
        var content=$("#cctTextBoxesGroup").val();
        if (isEmpty($('#cctTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For cct", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // K1 Add Option

      $("#K1btnsave").click(function () {
        var content=$("#K1TextBoxesGroup").val();
        if (isEmpty($('#K1TextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For K1", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // K2 Add Option

      $("#K2btnsave").click(function () {
        var content=$("#K2TextBoxesGroup").val();
        if (isEmpty($('#K2TextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For K2", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


       // lenspower Add Option

      $("#lenspowerbtnsave").click(function () {
        var content=$("#lenspowerTextBoxesGroup").val();
        if (isEmpty($('#lenspowerTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Lens Power", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // axial_length Add Option

      $("#axial_lengthbtnsave").click(function () {
        var content=$("#axial_lengthTextBoxesGroup").val();
        if (isEmpty($('#axial_lengthTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Axial length", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

	// lens_type Add Option

      $("#lens_typebtnsave").click(function () {
        var content=$("#lens_typeTextBoxesGroup").val();
        if (isEmpty($('#lens_typeTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Type of Lens", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // KC Add Option

      $("#KCbtnsave").click(function () {
        var content=$("#KCTextBoxesGroup").val();
        if (isEmpty($('#KCTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For KC", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
    
// ANTERIOR SEGMENT Add Option//
$("#otherDetailsAnteriorSegmentbtnsave").click(function () {
        var content=$("#otherDetailsAnteriorSegmentTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsAnteriorSegmentTextBoxesGroup'))) 

        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For ANTERIOR SEGMENT", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// POSTERIOR SEGMENT Add Option//
$("#treatmentAdvicebtnsave").click(function () {
        var content=$("#treatmentAdviceTextBoxesGroup").val();
        if (isEmpty($('#treatmentAdviceTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("segmentinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For POSTERIOR SEGMENT", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
    // Color Vision Add Option

      $("#ColourVisionbtnsave").click(function () {
        var content=$("#ColourVisionTextBoxesGroup").val();
        if (isEmpty($('#ColourVisionTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Color Vision", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

          // Schimer Test 1 Add Option

      $("#schimertestonebtnsave").click(function () {
        var content=$("#SchimerTestOneTextBoxesGroup").val();
        if (isEmpty($('#SchimerTestOneTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Schimer Test 1", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

         //Optical Coherence tomography (OCT) Add Option

      $("#octbtnsave").click(function () {
        var content=$("#OCTTextBoxesGroup").val();
        if (isEmpty($('#OCTTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Optical Coherence tomography (OCT)", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


         //Extra Ocular Movement (EOM) Add Option

      $("#eombtnsave").click(function () {
        var content=$("#EOMTextBoxesGroup").val();
        if (isEmpty($('#EOMTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Extra Ocular Movement (EOM)", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

        // Schimer Test 1 Add Option

      $("#schimertestonebtnsave").click(function () {
        var content=$("#SchimerTestOneTextBoxesGroup").val();
        if (isEmpty($('#SchimerTestOneTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Schimer Test 1", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


               // Schimer Test 2 Add Option

      $("#schimertesttwobtnsave").click(function () {
        var content=$("#SchimerTestTwoTextBoxesGroup").val();
        if (isEmpty($('#SchimerTestTwoTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Schimer Test 2", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>

<script type="text/javascript">

    var defaultOptions = {
        controls: [
            'Color',
            {
                Size: {
                    type: 'dropdown'
                }
            },
            // {
            //     DrawingMode: {
            //         filler: false
            //     }
            // },
            { Navigation: { back: false, forward: false } },
            //'Download'
        ],
        controlsPosition:"top right",
        size: 6,
        color: "rgb(127, 0, 0)",
        webStorage: false,
        enlargeYourContainer: false,
        //background: '/images/OdImg1.PNG',
        stretchImg: true
    }

    
    var OdImg1 = new DrawingBoard.Board('OdImg1_canvas', $.extend( {}, defaultOptions, {background: '/images/OdImg1.PNG'}));
    var OsImg1 = new DrawingBoard.Board('OsImg1_canvas', $.extend( {}, defaultOptions, {background: '/images/OsImg1.PNG'}));
    var OdImg2 = new DrawingBoard.Board('OdImg2_canvas', $.extend( {}, defaultOptions, {background: '/images/OdImg2.PNG'}));
    var OsImg2 = new DrawingBoard.Board('OsImg2_canvas', $.extend( {}, defaultOptions, {background: '/images/OsImg2.PNG'}));

    var retino_scopy_OD = new DrawingBoard.Board('retino_scopy_OD_canvas', $.extend( {}, defaultOptions, {background: '/images/retino_scopy.PNG'}));
    var retino_scopy_OS = new DrawingBoard.Board('retino_scopy_OS_canvas', $.extend( {}, defaultOptions, {background: '/images/retino_scopy.PNG'}));

    var gonio_od = new DrawingBoard.Board('gonio_od_canvas', $.extend( {}, defaultOptions, {background: '/images/gonio.PNG'}));
    var gonio_os = new DrawingBoard.Board('gonio_os_canvas', $.extend( {}, defaultOptions, {background: '/images/gonio.PNG'}));



    $(document).ready(function () {
        
        
         $("#appointment_dt").on('change.dp', function (e) {
                $("#appdate").empty();
                $("#appdate2").empty();
                $("#appdate1").empty();
                $("#noslot").empty();
                $("#Morning").css("display","none");
                 $("#slodrec").css("display","block");
                $("#Afternoon").css("display","none");
                $("#Evening").css("display","none");
                //alert(this.value);         //Date in full format alert(new Date(this.value));
                var inputDate = new Date(this.value);
                var doctor_id = $("#doctor_id option:selected").val();
                var appointment_dt = $("#appointment_dt").val();
                 //alert(appointment_dt);
                $('#startdate').data('date')
                //alert(appointment_dt);
                
                
                 var inputDate = new Date(this.value);
        var FollowUpDoctor_id = $("#FollowUpDoctor_id").val();
       

        var appointment_dt = $('#appointment_dt').val();
       
        
        //var url1="{{url('avaibaletimeslotscasemaster')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
        
                var url1 = "{{url('avaibaletimeslots')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
                //alert(url1);
                var data=$("#createAppointment").serialize();
                $.ajax({
                    url:url1,
                    type:'GET',
                    data:data,
                    success:function(response) {
                      //alert(response);
                         if(response==0)
                         {
                            $("#slotsrec").addClass("noscroll");
                            $("#slotdiv").css("display","block");
                            $("#noslot").html("<h3>No Slots Available</h3>");
                            // $('<div class="col-md-6"></div>').appendTo($("#appdate"));
                         }
                         else
                         {
                          for(var i=0;i<response['slottime'].length;i++){
                            var slotime= response['slottime'][i];
                             var starttime= response['timeslot1'][i];
                            if(slotime=="Morning")
                            {
                                $("#Morning").css("display","block");
                                $("#slotdiv").css("display","block");
                                $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate"));  
                            }
                             else if(slotime=="Afternoon")
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         {
                             $("#Afternoon").css("display","block");
                             $("#slotdiv").css("display","block");
                             $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate2")); 
                         }
                         else if(slotime=="Evening")
                         {
                             $("#Evening").css("display","block");
                             $("#slotdiv").css("display","block");
                              $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate1")); 
                         }
                    }
                         }
                     },
                }); 
            });
     $(document).on('click', '#slotsrec input[type="radio"]', function() {
     //alert($(this).val());
     $("#FollowUpTimeSlot").empty();
      $("#FollowUpTimeSlot").val($(this).val());
    });
 $("#appointment_dt1").on('change.dp', function (e) {

           
        
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
                //alert(response);
        
             if(response==0)
                 {
                    $("#FollowUpTimeSlot").append('<option value=" ">No Slots Available</option>');
                    $("#FollowUpTimeSlot").selectpicker("refresh");
                 }

                    else
                 {
                 
                        for(var i=0;i<response['timeslot1'].length;i++){
                  
                     var starttime= response['timeslot1'][i];
                    
                  
                     var toAppend = '<option value="'+starttime+'">'+starttime+'</option>';
                     

                      $("#FollowUpTimeSlot").append(toAppend);
                    $("#FollowUpTimeSlot").selectpicker("refresh");
                  
                  
               

                
               
            }
   

                 }
              }
        }); 



    });

   $('.select2').select2({width: '100%'});
        $(".ImageDelete").on('click',function(){
            var deleteBtn = $(this);
            var  postData = {
                        'case_id': $("input[type='hidden'][name='case_id']").val(),
                        'imageName': deleteBtn.val(),//
                        '_token': $("input[type='hidden'][name='_token']").val()
                    };
            $.ajax({
                    url: "{{ url('/eyeform/deleteImage') }}",
                    type:'POST',
                    //dataType: "json",
                    data: postData,
                    success: function(data) {
                        // deleteBtn.closest('div.col-md-6').find('img').attr('src', '');
                        deleteBtn.closest('div.col-md-6').html('');
                    }
                });
            return false;
        });

        $("#eyeform").on("submit", function () {
            
            var ImgData_OdImg1 = OdImg1.getImg();
            ImgData_OdImg1 = (OdImg1.history.initialItem == ImgData_OdImg1) ? '' : ImgData_OdImg1;
            $("#OdImg1").val(ImgData_OdImg1);

            var ImgData_OsImg1 = OsImg1.getImg();
            ImgData_OsImg1 = (OsImg1.history.initialItem == ImgData_OsImg1) ? '' : ImgData_OsImg1;
            $("#OsImg1").val(ImgData_OsImg1);

            var ImgData_OdImg2 = OdImg2.getImg();
            ImgData_OdImg2 = (OdImg2.history.initialItem == ImgData_OdImg2) ? '' : ImgData_OdImg2;
            $("#OdImg2").val(ImgData_OdImg2);

            var ImgData_OsImg2 = OsImg2.getImg();
            ImgData_OsImg2 = (OsImg2.history.initialItem == ImgData_OsImg2) ? '' : ImgData_OsImg2;
            $("#OsImg2").val(ImgData_OsImg2);

            var ImgData_retino_scopy_OD = retino_scopy_OD.getImg();
            ImgData_retino_scopy_OD = (retino_scopy_OD.history.initialItem == ImgData_retino_scopy_OD) ? '' : ImgData_retino_scopy_OD;
            $("#retino_scopy_OD").val(ImgData_retino_scopy_OD);

            var ImgData_retino_scopy_OS = retino_scopy_OS.getImg();
            ImgData_retino_scopy_OS = (retino_scopy_OS.history.initialItem == ImgData_retino_scopy_OS) ? '' : ImgData_retino_scopy_OS;
            $("#retino_scopy_OS").val(ImgData_retino_scopy_OS);

            var ImgData_gonio_od = gonio_od.getImg();
            ImgData_gonio_od = (gonio_od.history.initialItem == ImgData_gonio_od) ? '' : ImgData_gonio_od;
            $("#gonio_od").val(ImgData_gonio_od);

            var ImgData_gonio_os = gonio_os.getImg();
            ImgData_gonio_os = (gonio_os.history.initialItem == ImgData_gonio_os) ? '' : ImgData_gonio_os;
            $("#gonio_os").val(ImgData_gonio_os);

            OdImg1.clearWebStorage();
            OsImg1.clearWebStorage();
            OdImg2.clearWebStorage();
            OsImg2.clearWebStorage();

            retino_scopy_OD.clearWebStorage();
            retino_scopy_OS.clearWebStorage();
         
            gonio_od.clearWebStorage();
            gonio_os.clearWebStorage();
        });

         

            //$('.addmore').click(function(e) {
			$(document).on('click', '.addmore', function(e) {
				//alert('hiiii');
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
			//alert($(this).data('templatediv'));

			//console.log($(template).html());
            $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
            // $("#surgeryDetails").find('#patient_name').val('');
            $(this).closest('div.ContainerToAppend').append($(template).html());
            $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
            // .each(function(index,ele){
            //     $(ele).select2({width: '80%'});
            // });
        });
        //    $('.addmore').click(function(e){
        //     e.preventDefault();

        //     var template = $("#"+$(this).data('templatediv')).clone();
        //     template.find('.bootstrap-select').replaceWith(function() { return $('select', this); })    
        //     template.find('.select').selectpicker(); 
            

        //     $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
        //     // $("#surgeryDetails").find('#patient_name').val('');
        //     $(this).closest('div.ContainerToAppend').append($(template).html());
            
        //     // .each(function(index,ele){
        //     //     $(ele).select2({width: '80%'});
        //     // });
        // });



        // $('.addmore').click(function(e){
           
        //     e.preventDefault();
        //     var template = $("#"+$(this).data('templatediv')).clone();
     
        // template.find('.bootstrap-select').replaceWith(function() { return $('select', this); })    
        // template.find('.select').selectpicker(); 
        // var cnt= ($(this).closest('div.ContainerToAppend').find('div.removethis').length );
        // $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.removethis').length + 1));
        //     // $("#surgeryDetails").find('#patient_name').val('');
        // $(this).closest('div.ContainerToAppend').append($(template).html());
             
      
        //     // .each(function(index,ele){
        //     //     $(ele).select2({width: '80%'});
        //     // });
        // });
        //$('.ContainerToAppend').on('click', '.removeItem' ,function(e){
		$(document).on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });

        //$(".removeDbItem").click(function(e) {
		$(document).on('click', '.removeDbItem', function(e) {
			var ClickedButton = $(this);
			var containerDiv = $(this).closest('div.form-group.row');

			var delete_type = ClickedButton.data('type');
			var url='{{ url("eyeform/deleteMultiEntry") }}/'+ $(ClickedButton).data('deleteid');
			//alert(url);
			swal({
				title: "Are you sure?",
				text: "This Will Remove !",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}, function () {
					
				$.ajax({ url: url, 
					type: 'DELETE',
					data: {
						_method: 'delete', 
						_token :$("input[name='_token'][type='hidden']").val(),
						id : $(ClickedButton).data('deleteid'),
						type: delete_type
					}
				})
				.success(function() {
					$(containerDiv).remove();
					$(ClickedButton).button('reset');

					swal({title: "Deleted", text: "Successfully!!!", type: "success"},
						function(){ 
							location.reload();
						}
					);
				}).error(function(){
				$(ClickedButton).button('reset');
				});

				 location.reload();
			});
			e.preventDefault();

        });


    }); //document ready
</script>

<!-- Perymetry  Set Option -->
<script type="text/javascript">
var perimetryspcnt = 1;
$("#PerimetrySpbtn").click(function () {

if(perimetryspcnt>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+perimetryspcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="perimetry_sp OD"><input class="form-control"  type="hidden"  name="fieldName2" value="perimetry_sp OS"><input class="form-control"  type="text" id="optionsval'+perimetryspcnt+'" placeholder="value'+perimetryspcnt+'" name="optionsval[]"></div><span class="input-group-addon perimetryspButton" type="button" id="perimetryspButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#PerimetrySpTextBoxesGroup").append(newTextBoxDiv);
perimetryspcnt++;
});

$(document).on('click', '.perimetryspButton', function(e) {
perimetryspcnt--;
var target = $("#PerimetrySpTextBoxesGroup").find("#TextBoxDiv" +perimetryspcnt);
$(target).remove();
});


// Color Vision Add Option

$("#PerimetrySpbtnsave").click(function () {
var content=$("#PerimetrySpTextBoxesGroup").val();
if (isEmpty($('#PerimetrySpTextBoxesGroup'))) 
{
swal({
title: "Please Add Some Option by clicking on",
text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
html: true
});
}
else 
{
var data=$("#eyeform").serialize();
event.preventDefault();
$.ajax({
url:'{{ route("dynamic-field.insert") }}',
method:'post',
data:data,
success:function(data)
{
swal({title: "Option For Perimetry", text: "Added Successfully!", type: "success"},
function(){ 
location.reload();
}
);
}
})
}

});

</script>

<!-- Perymetry  Set Option -->
<script type="text/javascript">
var laserspcnt = 1;
$("#LaserSpbtn").click(function () {

if(laserspcnt>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+laserspcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="laser_sp OD"><input class="form-control"  type="hidden"  name="fieldName2" value="laser_sp OS"><input class="form-control"  type="text" id="optionsval'+laserspcnt+'" placeholder="value'+laserspcnt+'" name="optionsval[]"></div><span class="input-group-addon laserspButton" type="button" id="laserspButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#LaserSpTextBoxesGroup").append(newTextBoxDiv);
laserspcnt++;
});

$(document).on('click', '.laserspButton', function(e) {
laserspcnt--;
var target = $("#LaserSpTextBoxesGroup").find("#TextBoxDiv" +laserspcnt);
$(target).remove();
});


// Color Vision Add Option

$("#LaserSpbtnsave").click(function () {
var content=$("#LaserSpTextBoxesGroup").val();
if (isEmpty($('#LaserSpTextBoxesGroup'))) 
{
swal({
title: "Please Add Some Option by clicking on",
text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
html: true
});
}
else 
{
var data=$("#eyeform").serialize();
event.preventDefault();
$.ajax({
url:'{{ route("dynamic-field.insert") }}',
method:'post',
data:data,
success:function(data)
{
swal({title: "Option For Laser", text: "Added Successfully!", type: "success"},
function(){ 
location.reload();
}
);
}
})
}

});

</script>

<!-- Perymetry  Set Option -->
<script type="text/javascript">
var oculizerspcnt = 1;
$("#OculizerSpbtn").click(function () {

if(oculizerspcnt>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+oculizerspcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="oculizer_sp OD"><input class="form-control"  type="hidden"  name="fieldName2" value="oculizer_sp OS"><input class="form-control"  type="text" id="optionsval'+oculizerspcnt+'" placeholder="value'+oculizerspcnt+'" name="optionsval[]"></div><span class="input-group-addon oculizerspButton" type="button" id="oculizerspButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#OculizerSpTextBoxesGroup").append(newTextBoxDiv);
oculizerspcnt++;
});

$(document).on('click', '.oculizerspButton', function(e) {
oculizerspcnt--;
var target = $("#OculizerSpTextBoxesGroup").find("#TextBoxDiv" +oculizerspcnt);
$(target).remove();
});


// Color Vision Add Option

$("#OculizerSpbtnsave").click(function () {
var content=$("#OculizerSpTextBoxesGroup").val();
if (isEmpty($('#OculizerSpTextBoxesGroup'))) 
{
swal({
title: "Please Add Some Option by clicking on",
text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
html: true
});
}
else 
{
var data=$("#eyeform").serialize();
event.preventDefault();
$.ajax({
url:'{{ route("dynamic-field.insert") }}',
method:'post',
data:data,
success:function(data)
{
swal({title: "Option For Oculizer", text: "Added Successfully!", type: "success"},
function(){ 
location.reload();
}
);
}
})
}

});

</script>

<!-- Perymetry  Set Option -->
<script type="text/javascript">
var ffaspcnt = 1;
$("#FfaSpbtn").click(function () {

if(ffaspcnt>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+ffaspcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="ffa_sp OD"><input class="form-control"  type="hidden"  name="fieldName2" value="ffa_sp OS"><input class="form-control"  type="text" id="optionsval'+ffaspcnt+'" placeholder="value'+ffaspcnt+'" name="optionsval[]"></div><span class="input-group-addon ffaspButton" type="button" id="ffaspButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#FfaSpTextBoxesGroup").append(newTextBoxDiv);
ffaspcnt++;
});

$(document).on('click', '.ffaspButton', function(e) {
ffaspcnt--;
var target = $("#FfaSpTextBoxesGroup").find("#TextBoxDiv" +ffaspcnt);
$(target).remove();
});


// Color Vision Add Option

$("#FfaSpbtnsave").click(function () {
var content=$("#FfaSpTextBoxesGroup").val();
if (isEmpty($('#FfaSpTextBoxesGroup'))) 
{
swal({
title: "Please Add Some Option by clicking on",
text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
html: true
});
}
else 
{
var data=$("#eyeform").serialize();
event.preventDefault();
$.ajax({
url:'{{ route("dynamic-field.insert") }}',
method:'post',
data:data,
success:function(data)
{
swal({title: "Option For Color Ffa", text: "Added Successfully!", type: "success"},
function(){ 
location.reload();
}
);
}
})
}

});

</script>

<script type="text/javascript">
     var otherDetailsDiagnosiscnt = 1;
$("#otherDetailsDiagnosisbtn").click(function () {
      
  if(otherDetailsDiagnosiscnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsDiagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsDiagnosis"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsDiagnosis"><input class="form-control"  type="text" id="optionsval'+otherDetailsDiagnosiscnt+'" placeholder="value'+otherDetailsDiagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsDiagnosisremoveButton" type="button" id="otherDetailsDiagnosisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsDiagnosisTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsDiagnosiscnt++;
     });

$(document).on('click', '.otherDetailsDiagnosisremoveButton', function(e) {
otherDetailsDiagnosiscnt--;
   var target = $("#otherDetailsDiagnosisTextBoxesGroup").find("#TextBoxDiv" +otherDetailsDiagnosiscnt);
  $(target).remove();
});

// ANTERIOR SEGMENT Add Option//
$("#otherDetailsDiagnosisbtnsave").click(function () {
        var content=$("#otherDetailsDiagnosisTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsDiagnosisTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Diagnosis", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

</script>
 <script type="text/javascript">
     var otherDetailsPosteriorSegmentcnt = 1;
$("#otherDetailsPosteriorSegmentbtn").click(function () {
      
  if(otherDetailsPosteriorSegmentcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsPosteriorSegmentcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsPosteriorSegment"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsPosteriorSegment"><input class="form-control"  type="text" id="optionsval'+otherDetailsPosteriorSegmentcnt+'" placeholder="value'+otherDetailsPosteriorSegmentcnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsPosteriorSegmentremoveButton" type="button" id="otherDetailsPosteriorSegmentremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsPosteriorSegmentTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsPosteriorSegmentcnt++;
     });

$(document).on('click', '.otherDetailsPosteriorSegmentremoveButton', function(e) {
otherDetailsPosteriorSegmentcnt--;
   var target = $("#otherDetailsPosteriorSegmentTextBoxesGroup").find("#TextBoxDiv" +otherDetailsPosteriorSegmentcnt);
  $(target).remove();
});


// Posterior SEGMENT Add Option//
$("#otherDetailsPosteriorSegmentbtnsave").click(function () {
        var content=$("#otherDetailsPosteriorSegmentTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsPosteriorSegmentTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Posterior Segment", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

</script>
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>
<script>    
    jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>

 
<script>
		$(document).on('click','.update-dropdown-options-btn',function() {
			//alert('clicked');

			var clicked_element = $(this);

			var form_target = $(this).closest('.update-dropdown-options-form');

			var id = form_target.attr('id');

			var form_data = $('#'+ id +' :input').serialize();

			$.ajax({
				url:"{{route('update-dropdown-options')}}",
				method:'post',
				data:{'form_data': form_data},
				datatype: 'json',
				success:function(response) {
					console.log(response);

					location.reload();
					/*
					swal({title: "Options", text: "Update Successfully!", type: "success"},
					 function(){ 
					  location.reload();
					  }
					);
					*/
					clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
				}
			});
		});

		$(document).on('click','.remove-initial-options',function() {
			$(this).closest('.initial_options').remove();
		});


		$(document).on('click','.set-dropdown-options',function() {
			var form_name = $(this).data('form_name');
			var field_name = $(this).data('field_name');
			
			var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

			$.ajax({
				url:"{{route('get-update-dropdown-options')}}",
				method:'post',
				data:{'form_name': form_name,'form_field': field_name},
				datatype: 'json',
				success:function(response) {
					console.log(response);
					
					element_to_show.html(response.view);
				}
			});

			console.log(form_name + ' : '+  field_name);
			//$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').show();

			element_to_show.show();
		});

$(document).on('click','.cancel-dropdown-options-btn',function() {
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').hide();
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').html('');
});
</script>


<script>
var systemichistorycnt = 1;
$(document).ready(function() {
$("#systemichistorybtn").click(function () {

if(systemichistorycnt>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+systemichistorycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="systemic_history"><input class="form-control"  type="text" id="optionsval'+systemichistorycnt+'" placeholder="value'+systemichistorycnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SystemicHistoryTextBoxesGroup").append(newTextBoxDiv);
systemichistorycnt++;
});

$(document).on('click', '.systemichistoryremoveButton', function(e) {
systemichistorycnt--;
var target = $("#SystemicHistoryTextBoxesGroup").find("#TextBoxDiv" +systemichistorycnt);
$(target).remove();
});
});

// Systemic History Add Option

      $("#systemichistorybtnsave").click(function () {
        var content=$("#SystemicHistoryTextBoxesGroup").val();
        if (isEmpty($('#SystemicHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Systemic History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

		 $('.ContainerToAppend').on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });

	</script>
 <script src="{{ url('/')}}/assets/js/eyeform/eyeform.js"></script>   

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    //$("#a_scan_images").on("change", function(e) {
	$(".img-thumb-upload").on("change", function(event) {

        console.log("File uploaded");
      var files = event.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          //alert(event.target.id);
		  /*
		  $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#a_scan_images");
          */

		   $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter('#'+event.target.id);

		  $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
	
									  //------------------------------------------------------------------

$('.blood_select_all').on("change", function(e) {
	//alert('hi');
	var parent = $(this).closest('.blood-category');
	
	if($(this).is(':checked')) {
	
		parent.find('.bloodtests').each(function() {
	
			if($(this).is(':checked')) {
				
	
			} else {
				
	
				$(this).trigger('click');
			}
		});
	} else {
		
	
		parent.find('.bloodtests').each(function() {
			
	
			if($(this).is(':checked')) {
				
	
				$(this).trigger('click');
			} else {
				
	
			}
		});
	}
});
});
</script>

@section('scripts_wpaint')
 <!-- jQuery UI -->
<script type="text/javascript" src="{{ url('/')}}/wpaint/lib/jquery.ui.core.1.10.3.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/wpaint/lib/jquery.ui.widget.1.10.3.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/wpaint/lib/jquery.ui.mouse.1.10.3.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/wpaint/lib/jquery.ui.draggable.1.10.3.min.js"></script>

<!-- wColorPicker -->
<link rel="Stylesheet" type="text/css" href="{{ url('/')}}/wpaint/lib/wColorPicker.min.css" />
<script type="text/javascript" src="{{ url('/')}}/wpaint/lib/wColorPicker.min.js"></script>

<!-- wPaint -->
<link rel="Stylesheet" type="text/css" href="{{ url('/')}}/wpaint/wPaint.min.css" />
<script type="text/javascript" src="{{ url('/')}}/wpaint/wPaint.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/wpaint/plugins/main/wPaint.menu.main.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/wpaint/plugins/text/wPaint.menu.text.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/wpaint/plugins/shapes/wPaint.menu.main.shapes.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/wpaint/plugins/file/wPaint.menu.main.file.min.js"></script>

<script>
function saveImg(image) {
          var _this = this;

          $.ajax({
            type: 'POST',
            url: '/test/upload.php',
            data: {image: image},
            success: function (resp) {

              // internal function for displaying status messages in the canvas
              _this._displayStatus('Image saved successfully');

              // doesn't have to be json, can be anything
              // returned from server after upload as long
              // as it contains the path to the image url
              // or a base64 encoded png, either will work
              resp = $.parseJSON(resp);

              // update images array / object or whatever
              // is being used to keep track of the images
              // can store path or base64 here (but path is better since it's much smaller)
              images.push(resp.img);

              // do something with the image
              $('#wPaint-img').attr('src', image);
            }
          });
        }
/*
        function loadImgBg () {

          // internal function for displaying background images modal
          // where images is an array of images (base64 or url path)
          // NOTE: that if you can't see the bg image changing it's probably
          // becasue the foregroud image is not transparent.
          this._showFileModal('bg', images);
        }

        function loadImgFg () {

          // internal function for displaying foreground images modal
          // where images is an array of images (base64 or url path)
          this._showFileModal('fg', images);
        }
		*/

		function loadImage_png(img) {
			//$("#wPaint").wPaint("image", 'img.png');
			$("#wPaint").wPaint("image", img);
		}

		function saveImage()
		{
			var imageData = $("#wPaint").wPaint("image");
			
			//$("#canvasImage").attr('src', imageData);
			//$("#canvasImageData").val(imageData);
			var fundus_image_name = $('#fundus_image_name').val();

			var fundus_image_eye = $('input[name=fundus_image_eye]:checked').val();
			//alert(fundus_image_eye);

			var fundus_image_description = $('#fundus_image_description').val();

			 $.ajax({
            type: 'POST',
            url: '{{url("upload_fundus_image")}}',
            data: {image: imageData, case_id : '{{$casedata["id"]}}', fundus_image_name : fundus_image_name, fundus_image_eye : fundus_image_eye, fundus_image_description : fundus_image_description},
            success: function (resp) {
					location.reload();
            }
          });
		}

		function clearCanvas() {
			$("#wPaint").wPaint("clear");
		}


		$(document).ready(function() {

			// init wPaint
			$('#wPaint').wPaint({
			  menuOffsetLeft: -35,
			  menuOffsetTop: -50,
			  saveImg: saveImg,
			  autoScaleImage:  false, 
				  menuOrientation: 'horizontal',
			  //loadImgBg: loadImgBg,
			  //loadImgFg: loadImgFg
			});
		});

		$(document).on('click', '.remove-fundus-image', function() {
			var image_id = $(this).data('image_id');

			$.ajax({
				type: 'POST',
				url: '{{url("remove_fundus_image")}}',
				data: {image_id: image_id, main_image : 0},
				success: function (resp) {
					location.reload();
				}
			});
		});

		$(document).on('click', '.remove-fundus-main-image', function() {
			var image_id = $(this).data('image_id');
			var target_element = $(this);
			$.ajax({
				type: 'POST',
				url: '{{url("remove_fundus_image")}}',
				data: {image_id: image_id, main_image : 1},
				success: function (resp) {
					//location.reload();
					target_element.parent().remove();
				}
			});
		});
		</script>
@endsection