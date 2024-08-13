@extends('adminlayouts.master')
@section('style')
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

</style>
@endsection
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

.removeButton {
  color: #700;
  cursor: pointer;
}

.removeButton:hover {
  color: #f00;
}
</style>
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
                    <div class="card">
                        <form action="{{ url('/patientDetails/SaveEyeExamination') }}" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
 
                        {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2>
                                Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . $casedata['visit_time']}}  
                            </h2>
                          
                        </div>
                        <div class="body">
                        <div class="row clearfix">
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
                        <p class="font-bold col-pink"><a href="{{ url('/glassPrescription/').'/'.$casedata['id'].'/edit' }}" class="casemasterlinks">Medicine Prescription</a></p>
                        
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="{{ url('/glassPrescription/').'/'.$casedata['id'].'/edit' }}" class="casemasterlinks">Glass Prescription</a></p>
                       
                        </div>
                        <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink">Ptosis Proforma</p>
                        <p class="font-bold col-orange">Ptosis Proforma</p>
                        </div> -->

                        
                        </div>
                        <div class="signup-step-container">
                        <div class="col-md-12">
                            <div class="wizard">
                            <div class="wizard-inner">
                               <div class="connecting-line"></div>
                               <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Complaint</i></a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Vision</i></a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Finding</i></a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Glaucoma</i></a>
                                </li>
                                 <li role="presentation" class="">
                                    <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab"><span class="round-tab">5</span> <i>A Scan</i></a>
                                </li>
                                 <div class="connecting-line1"></div>
                                <li role="presentation" class="">
                                    <a href="#step6" data-toggle="tab" aria-controls="step6" role="tab"><span class="round-tab">6</span> <i>SP Tests</i></a>
                                </li>
                                 <li role="presentation" class="">
                                    <a href="#step7" data-toggle="tab" aria-controls="step7" role="tab"><span class="round-tab">7</span> <i>Refraction</i></a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#step8" data-toggle="tab" aria-controls="step8" role="tab"><span class="round-tab">8</span> <i>Other Details</i></a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#step9" data-toggle="tab" aria-controls="step9" role="tab"><span class="round-tab">9</span> <i>Follow-up</i></a>
                                </li>
                            </ul>
                            
                        </div>
                        <!-- end of wizard inner -->
    
                              <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        {{ Form::label('CNS','General Complaints') }} 
                                        </div>
                                        </div>

                                        <div class="col-md-9">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('CNS', Request::old('CNS',$form_details->CNS), array('class' => 'form-control')) }}                           
                                        </div>
                                        </div>
                                        </div> 
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <label>OD</label>
                                        </div>
                                        </div>

                                        <div class="col-md-5">
                                        <div class="form-group ">
                                        <label>OS</label>
                                        </div>
                                        </div>
                                    </div>

                                    <div id="chiefComplaint" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Chief Complaint</label> 
                                        </div>
                                        <input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-4">
{{ Form::select('ChiefComplaint_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Chief Complaint OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Chief Complaint OD', $defaultValues)?$defaultValues['Chief Complaint OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::select('ChiefComplaint_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Chief Complaint OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Chief Complaint OS', $defaultValues)?$defaultValues['Chief Complaint OS']:null, array('class'=> 'form-control ','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-2">
                                        <button type="button" name="add" id='addButton' class="btn btn-success btn-lg">Add </button>
                                        
                                        <button type='button' class=" btn-lg btn btn-primary" id='getButtonValue'>Save</button>
                                        </div>
                                    </div>
                                    <div id='TextBoxesGroup' class="col-md-12">

                                    </div>

                                    </div>


                                    <div id="ChiefComplaintTemplate" class="col-md-12" style="display: none;">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label></label>
                                            <input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <div class="form-line">
                                            {{ Form::text('doctor_name', Request::old('doctor_name'), array('class' => 'form-control')) }}                            
                                            </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <div class="form-line">
                                            {{ Form::text('doctor_name', Request::old('doctor_name'), array('class' => 'form-control')) }}                            
                                            </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-2">
                                            <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove1</button>
                                        </div>
                                    </div>


                                    <div class="dbMultiEntryContainer">
                                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ChiefComplaint')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>

                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>

                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>

                                    <div id="OpthalHistory" class="ContainerToAppend">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label>Opthal History</label> 
                                            </div>
                                            <input type="hidden" id="OpthalHistory[]" name="OpthalHistory[]" class="hiddenCounter" value="1" />
                                            </div>  

                                            <div class="col-md-4">
                                            {{ Form::select('OpthalHistory_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Opthal History OD', $defaultValues)?$defaultValues['Opthal History OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                            </div>

                                            <div class="col-md-4">
                                            {{ Form::select('OpthalHistory_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Opthal History OS', $defaultValues)?$defaultValues['Opthal History OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                            </div>

                                            <div class="col-md-2">
                                            <button id="addOpthalHistory" class="btn btn-default addmore" data-templateDiv="OpthalHistoryTemplate">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dbMultiEntryContainer">
                                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OpthalHistory')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>

                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>

                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div id="SystemicHistory" class="ContainerToAppend">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            {{ Form::label('CNS','Systemic History') }} 
                                            <input type="hidden" id="SystemicHistory[]" name="SystemicHistory[]" class="hiddenCounter" value="1" />
                                            </div>
                                            </div>

                                            <div class="col-md-8">
                                            <div class="form-group">
                                            <div class="form-line">
                                            {{ Form::text('SystemicHistory_OD[]', "", array('class'=> 'form-control')) }}
                                            </div>
                                            </div>
                                            </div>

                                            <div class="col-md-2">
                                            <button id="addOpthalHistory" class="btn btn-default addmore" data-templateDiv="SystemicHistoryTemplate">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dbMultiEntryContainer">
                                     @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'SystemicHistory')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Family History</label>
                                        </div>
                                        </div>

                                        <div class="col-md-9">
                                        {{ Form::textarea('familyHistory', Request::old('familyHistory',$form_details->familyHistory), array('class'=> 'form-control')) }}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Birth History</label>
                                        </div>
                                        </div>

                                        <div class="col-md-9">
                                        {{ Form::textarea('birthHistory', Request::old('birthHistory',$form_details->birthHistory), array('class'=> 'form-control')) }}
                                        </div>
                                    </div>

                                </div>
                                <!-- End Of 1st tab1 -->

                                <div class="tab-pane" role="tabpanel" id="step2">
                                   <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>DVN  (UC)</label>
                                        </div>      
                                        </div>

                                       <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('dvn_od', Request::old('dvn_od',$form_details->dvn_od), array('class'=> 'form-control')) }}   
                                        </div>
                                        </div>
                                        </div>

                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('dvn_os', Request::old('dvn_os',$form_details->dvn_os), array('class'=> 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                       <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>NVN  (UC)</label>
                                        </div>   
                                        </div>

                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('nvn_od', Request::old('nvn_od',$form_details->nvn_od), array('class'=> 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>

                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('nvn_os', Request::old('nvn_os',$form_details->nvn_os), array('class'=> 'form-control')) }}  
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>With Pinhole</label>
                                        </div>
                                        </div>

                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('withpinhole_OD', Request::old('withpinhole_OD',$form_details->withpinhole_OD), array('class'=> 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>

                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('withpinhole_OS', Request::old('withpinhole_OS',$form_details->withpinhole_OS), array('class'=> 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>PGP</label>
                                        </div>  
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('visualacuity_OD', Request::old('visualacuity_OD',$form_details->visualacuity_OD), array('class'=> 'form-control')) }}        
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('visualacuity_OS', Request::old('visualacuity_OS',$form_details->visualacuity_OS), array('class'=> 'form-control')) }}       
                                        </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>DVN (With Glasses)</label>
                                        </div>  
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('colour_vision_OD', Request::old('colour_vision_OD',$form_details->colour_vision_OD), array('class'=> 'form-control')) }}        
                                        </div>
                                        </div>
                                        </div>

                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('colour_vision_OS', Request::old('colour_vision_OS',$form_details->colour_vision_OS), array('class'=> 'form-control')) }} 
                                        </div>
                                        </div>  
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>NVN (With Glasses) </label>
                                        </div>   
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('withglasses_OD', Request::old('withglasses_OD',$form_details->withglasses_OD), array('class'=> 'form-control')) }}        
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('withglasses_OS', Request::old('withglasses_OS',$form_details->withglasses_OS), array('class'=> 'form-control')) }}                                                
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <!-- end of 2nd tab -->
                                <div class="tab-pane" role="tabpanel" id="step3">
                                <div id="ConjAndLids" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label>Lids</label>
                                            </div>
                                            <input type="hidden" id="ConjAndLids[]" name="ConjAndLids[]" class="hiddenCounter" value="1" />   
                                        </div>

                                        <div class="col-md-4">
                                            {{ Form::select('Lids_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'LIDS OD')->pluck('ddText','ddText')->toArray(), array_key_exists('LIDS OD', $defaultValues)?$defaultValues['LIDS OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                            {{ Form::select('Lids_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'LIDS OS')->pluck('ddText','ddText')->toArray(), array_key_exists('LIDS OS', $defaultValues)?$defaultValues['LIDS OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-2">
                                            <button id="ConjAndLids" class="btn btn-default addmore" data-templateDiv="ConjAndLidsTemplate">Add</button>
                                        </div>
                                    </div>
                                </div> 
                                <div id="Lids" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                                <label> Orbit</label>
                                            </div>
                                            <input type="hidden" id="Lids[]" name="Lids[]" class="hiddenCounter" value="1" />   
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::select('OrbitSacsEyeMotility_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'OrbitSacsEyeMotility OD')->pluck('ddText','ddText')->toArray(), array_key_exists('OrbitSacsEyeMotility OD', $defaultValues)?$defaultValues['OrbitSacsEyeMotility OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::select('OrbitSacsEyeMotility_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'OrbitSacsEyeMotility OS')->pluck('ddText','ddText')->toArray(), array_key_exists('OrbitSacsEyeMotility OS', $defaultValues)?$defaultValues['OrbitSacsEyeMotility OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                            <button id="Lids" class="btn btn-default addmore" data-templateDiv="LidsTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="AC" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                                <label>Conj</label>
                                            </div>
                                            <input type="hidden" id="AC[]" name="AC[]" class="hiddenCounter" value="1" />   
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::select('ConjAndLids_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Conj And Lids OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Conj And Lids OD', $defaultValues)?$defaultValues['Conj And Lids OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                            {{ Form::select('ConjAndLids_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Conj And Lids OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Conj And Lids OS', $defaultValues)?$defaultValues['Conj And Lids OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                            <button id="AC" class="btn btn-default addmore" data-templateDiv="ACTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ConjAndLids')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="IRIS" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Cornea</label>
                                        </div>
                                        <input type="hidden" id="IRIS[]" name="IRIS[]" class="hiddenCounter" value="1" />   
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::select('cornia_od[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Cornea OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Cornea OD', $defaultValues)?$defaultValues['Cornea OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::select('cornia_os[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Cornea OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Cornea OS', $defaultValues)?$defaultValues['Cornea OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-2">
                                        <button id="IRIS" class="btn btn-default addmore" data-templateDiv="IRISTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                   @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'cornia')->get() as $item)
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-4">
                                        <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                        </div>
                                        <div class="col-md-4">
                                        <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                        </div>
                                        <div class="col-md-2">
                                        <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    {{-- <input type="button" value="CheckCanvas" id="checkCanvas"> --}}
                                    </div>

                                    <div class="col-md-5">

                                    <div class="col-md-6">
                                    <div class="example1" data-example="OdImg1">
                                    <div class="board" id="OdImg1_canvas"></div>
                                    </div>
                                    <input type="hidden" name="OdImg1" id="OdImg1"/>
                                    </div>

                                    <div class="col-md-6">
                                       @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1))   
                                        <button type="button" value="OdImg1" class="ImageDelete pull-right" >Delete</button>
                                        <p>&nbsp;</p>
                                        <center id="wPaint-OdImg1"> 
                                        <img src={{ Storage::disk('local')->url($form_details->OdImg1)."?".filemtime(Storage::path($form_details->OdImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                        </center>
                                        @endif
                                    </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="col-md-6">
                                        <div class="example1" data-example1="OsImg1">
                                        <div class="board" id="OsImg1_canvas">
                                        </div>
                                        </div>
                                        <input type="hidden" name="OsImg1" id="OsImg1"/>
                                        </div>
                                        <div class="col-md-6">
                                           @if (!empty($form_details->OsImg1) && !is_null($form_details->OsImg1))
                                            <button type="button" value="OsImg1" class="ImageDelete pull-right" >Delete</button>
                                            <p>&nbsp;</p>
                                            <center id="wPaint-OsImg1"> 
                                            <img src={{ Storage::disk('local')->url($form_details->OsImg1)."?".filemtime(Storage::path($form_details->OsImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
                                            </center>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="sac" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>AC1</label>
                                        </div>
                                        <input type="hidden" id="sac[]" name="sac[]" class="hiddenCounter" value="1" />   
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::select('AC_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'AC OD')->pluck('ddText','ddText')->toArray(), array_key_exists('AC OD', $defaultValues)?$defaultValues['AC OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::select('AC_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'AC OS')->pluck('ddText','ddText')->toArray(), array_key_exists('AC OS', $defaultValues)?$defaultValues['AC OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-2">
                                        <button id="sac" class="btn btn-default addmore" data-templateDiv="sacTemplate">Add</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'AC')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="Retina" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Iris</label>
                                        </div>
                                        <input type="hidden" id="Retina[]" name="Retina[]" class="hiddenCounter" value="1" />   
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('IRIS_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OD')->pluck('ddText','ddText')->toArray(), array_key_exists('IRIS OD', $defaultValues)?$defaultValues['IRIS OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('IRIS_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OS')->pluck('ddText','ddText')->toArray(), array_key_exists('IRIS OS', $defaultValues)?$defaultValues['IRIS OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="Retina" class="btn btn-default addmore" data-templateDiv="RetinaTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'IRIS')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="Macula" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Pupil</label>
                                        </div>
                                        <input type="hidden" id="Macula[]" name="Macula[]" class="hiddenCounter" value="1" /> 
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('pupilIrisac_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'pupilIrisac OD')->pluck('ddText','ddText')->toArray(), array_key_exists('pupilIrisac OD', $defaultValues)?$defaultValues['pupilIrisac OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('pupilIrisac_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'pupilIrisac OS')->pluck('ddText','ddText')->toArray(), array_key_exists('pupilIrisac OS', $defaultValues)?$defaultValues['pupilIrisac OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="Macula" class="btn btn-default addmore" data-templateDiv="MaculaTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pupilIrisac')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="ONH" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label>Lens</label>
                                            </div>
                                            <input type="hidden" id="ONH[]" name="ONH[]" class="hiddenCounter" value="1" />   
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('lens_od[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'lens OD')->pluck('ddText','ddText')->toArray(), array_key_exists('lens OD', $defaultValues)?$defaultValues['lens OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('lense_os[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'lens OS')->pluck('ddText','ddText')->toArray(), array_key_exists('lens OS', $defaultValues)?$defaultValues['lens OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="ONH" class="btn btn-default addmore" data-templateDiv="ONHTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'lens')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                    <label>Fundus</label>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="col-md-6">
                                    <div class="example1" data-example="OdImg2">
                                    <div class="board" id="OdImg2_canvas" ></div>
                                    </div>
                                    <input type="hidden" name="OdImg2" id="OdImg2"/>
                                    </div>
                                    <div class="col-md-6">
                                    @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2))
                                    <button type="button" value="OdImg2" class="ImageDelete pull-right" >Delete</button>
                                    <p>&nbsp;</p>
                                    <center id="wPaint-OdImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OdImg2)."?".filemtime(Storage::path($form_details->OdImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
                                    </center>
                                    @endif
                                    </div>
                                    </div>

                                    <div class="col-md-5">
                                    <div class="col-md-6">
                                    <div class="example1" data-example="OsImg2">
                                    <div class="board" id="OsImg2_canvas"></div>
                                    </div>
                                    <input type="hidden" name="OsImg2" id="OsImg2"/>
                                    </div>
                                    <div class="col-md-6">
                                    @if (!empty($form_details->OsImg2) && !is_null($form_details->OsImg2))
                                    <button type="button" value="OsImg2" class="ImageDelete pull-right" >Delete</button>
                                    <p>&nbsp;</p>
                                    <center id="wPaint-OsImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OsImg2)."?".filemtime(Storage::path($form_details->OsImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
                                    </center>
                                    @endif
                                    </div>
                                    </div>
                                </div>
                                <div id="OrbitSacsEyeMotility" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Vitreo</label>
                                        <input type="hidden" id="OrbitSacsEyeMotility[]" name="OrbitSacsEyeMotility[]" class="hiddenCounter" value="1" /> 
                                        </div>  
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('vitreoretinal_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OD')->pluck('ddText','ddText')->toArray(), array_key_exists('vitreoretinal OD', $defaultValues)?$defaultValues['vitreoretinal OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('vitreoretinal_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OS')->pluck('ddText','ddText')->toArray(), array_key_exists('vitreoretinal OS', $defaultValues)?$defaultValues['vitreoretinal OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="OrbitSacsEyeMotility" class="btn btn-default addmore" data-templateDiv="OrbitSacsEyeMotilityTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'vitreoretinal')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="cornia" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Retina</label>
                                        </div>
                                        <input type="hidden" id="cornia[]" name="cornia[]" class="hiddenCounter" value="1" />  
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('Retina_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Retina OD', $defaultValues)?$defaultValues['Retina OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('Retina_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Retina OS', $defaultValues)?$defaultValues['Retina OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="cornia" class="btn btn-default addmore" data-templateDiv="corniaTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Retina')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="pupilIrisac" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>ONH</label>
                                        </div>
                                        <input type="hidden" id="pupilIrisac[]" name="pupilIrisac[]" class="hiddenCounter" value="1" />
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('ONH_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'ONH OD')->pluck('ddText','ddText')->toArray(), array_key_exists('ONH OD', $defaultValues)?$defaultValues['ONH OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('ONH_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'ONH OS')->pluck('ddText','ddText')->toArray(), array_key_exists('ONH OS', $defaultValues)?$defaultValues['ONH OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="pupilIrisac" class="btn btn-default addmore" data-templateDiv="pupilIrisacTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ONH')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="lens" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Macula</label>
                                        </div>
                                        <input type="hidden" id="lens[]" name="lens[]" class="hiddenCounter" value="1" />  
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('Macula_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Macula OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Macula OD', $defaultValues)?$defaultValues['Macula OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('Macula_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Macula OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Macula OS', $defaultValues)?$defaultValues['Macula OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="lens" class="btn btn-default addmore" data-templateDiv="lensTemplate">Add</button>
                                        </div>
                                    </div>
                                </div>
                                                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Macula')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="vitreoretinal" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Sac</label>
                                        <input type="hidden" id="vitreoretinal[]" name="vitreoretinal[]" class="hiddenCounter" value="1" />
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('sac_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'sac OD')->pluck('ddText','ddText')->toArray(), array_key_exists('sac OD', $defaultValues)?$defaultValues['sac OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-4">
                                        {{ Form::select('sac_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'sac OS')->pluck('ddText','ddText')->toArray(), array_key_exists('sac OS', $defaultValues)?$defaultValues['sac OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        <div class="col-md-2">
                                        <button id="vitreoretinal" class="btn btn-default addmore" data-templateDiv="vitreoretinalTemplate">Add
                                        </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="dbMultiEntryContainer">
                                    @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'sac')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}"/>
                                            </div>
                                            <div class="col-md-4">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}"/>
                                            </div>
                                            <div class="col-md-2">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                </div>


                                <div class="tab-pane" role="tabpanel" id="step4">
                                <div class="col-md-12">
                                       <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label> IOP  </label>
                                        </div>      
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('IOP_OD', Request::old('IOP_OD',$form_details->IOP_OD), array('class'=> 'form-control')) }}  
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('IOP_OS', Request::old('IOP_OS',$form_details->IOP_OS), array('class'=> 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>CD Ratio  </label>
                                        </div>   
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        {{ Form::select('Ratio_OD', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Ratio OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Ratio OD', $defaultValues)?$defaultValues['Ratio OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        {{ Form::select('Ratio_OS', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Ratio OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Ratio OS', $defaultValues)?$defaultValues['Ratio OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>
                                        </div>
                                </div>
                                
                                    <div class="col-md-12">
                                       <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Pachymetry  </label>
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('Pachymetry_OD', Request::old('Pachymetry_OD',$form_details->Pachymetry_OD), array('class'=> 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('Pachymetry_OS', Request::old('Pachymetry_OS',$form_details->Pachymetry_OS), array('class'=> 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>C.C.T.  </label>
                                        </div>  
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('CCT_OD', Request::old('CCT_OD',$form_details->CCT_OD), array('class'=> 'form-control')) }}       
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-5">
                                        <div class="form-group">
                                        <div class="form-line">
                                         {{ Form::text('CCT_OS', Request::old('CCT_OS',$form_details->CCT_OS), array('class'=> 'form-control')) }}     
                                        </div>
                                        </div>
                                        </div>
                                    </div>


                                 <div class="col-md-12">
                                        <div class="col-md-2"> 
                                        </div>
                                        <div class="col-md-5">
                                        <div class="col-md-6">
                                        <div class="example1" data-example="gonio_od">
                                        <div class="board" id="gonio_od_canvas"></div>
                                        </div>
                                        <input type="hidden" name="gonio_od" id="gonio_od">
                                        </div>
                                        <div class="col-md-6">
                                        @if (!empty($form_details->gonio_od) && !is_null($form_details->gonio_od))   
                                        <button type="button" value="gonio_od" class="ImageDelete pull-right" >Delete</button>
                                        <p>&nbsp;</p>
                                        <center id="wPaint-gonio_od"> 
                                        <img src={{ Storage::disk('local')->url($form_details->gonio_od)."?".filemtime(Storage::path($form_details->gonio_od)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                        </center>
                                        @endif
                                        </div>
                                        </div>

                                       <div class="col-md-5">
                                       <div class="col-md-6">
                                       <div class="example1" data-example1="gonio_os">
                                        <div class="board" id="gonio_os_canvas"></div>
                                        </div>
                                        <input type="hidden" name="gonio_os" id="gonio_os">
                                        </div>
                                        <div class="col-md-6">
                                        @if (!empty($form_details->gonio_os) && !is_null($form_details->gonio_os))
                                        <button type="button" value="gonio_os" class="ImageDelete pull-right" >Delete</button>
                                        <p>&nbsp;</p>
                                        <center id="wPaint-gonio_os"> 
                                        <img src={{ Storage::disk('local')->url($form_details->gonio_os)."?".filemtime(Storage::path($form_details->gonio_os)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
                                        </center>
                                        @endif
                                        </div>
                                        </div>
                                 </div> 
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step5">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                    <label>K1</label>
                                    </div>      
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('k1_od', Request::old('k1_od',$form_details->k1_od), array('class'=> 'form-control ')) }}  
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('k1_os', Request::old('k1_os',$form_details->k1_os), array('class'=> 'form-control ')) }}
                                    </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                    <label>K2</label>
                                    </div>   
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('k2_od', Request::old('k2_od',$form_details->k2_od), array('class'=> 'form-control ')) }}
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('k2_os', Request::old('k2_os',$form_details->k2_os), array('class'=> 'form-control ')) }} 
                                    </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                    <label>Lens Power</label>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('lenspower_od', Request::old('lenspower_od',$form_details->lenspower_od), array('class'=> 'form-control ')) }}
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('lenspower_os', Request::old('lenspower_os',$form_details->lenspower_os), array('class'=> 'form-control ')) }}
                                    </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                    <label>Axial length</label>
                                    </div>  
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('axial_length_OD', Request::old('axial_length_OD',$form_details->axial_length_OD), array('class'=> 'form-control ')) }}      
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('axial_length_OS', Request::old('axial_length_OS',$form_details->axial_length_OS), array('class'=> 'form-control ')) }}       
                                    </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                    <label> KC</label>
                                    </div>  
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('KC_OD', Request::old('KC_OD',$form_details->KC_OD), array('class'=> 'form-control ')) }}        
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::text('KC_OS', Request::old('KC_OS',$form_details->KC_OS), array('class'=> 'form-control ')) }}
                                    </div>
                                    </div>  
                                    </div>
                                </div>
                                    
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step6">
                                 <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label> Colour  Vision</label>
                                        </div>       
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::select('colour_OD', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'colour OD')->pluck('ddText','ddText')->toArray(), array_key_exists('colour OD', $defaultValues)?$defaultValues['colour OD']:null, array('class'=> 'form-control select2')) }}
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                        {{ Form::select('colour_OS', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'colour OS')->pluck('ddText','ddText')->toArray(), array_key_exists('colour OS', $defaultValues)?$defaultValues['colour OS']:null, array('class'=> 'form-control select2')) }}
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label> Schimer Test 1</label>
                                        </div>     
                                        </div>

                                        <div class="col-md-4">
                                        <div class="input-group">
                                        <div class="form-line">
                                        {{ Form::text('schimerTest1_OD', Request::old('schimerTest1_OD',$form_details->schimerTest1_OD), array('class'=> 'form-control','aria-describedby'=>"basic-addon" )) }}
                                        </div>
                                        <span class="input-group-addon myaddon" id="basic-addon">MM</span>
                                        </div>
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                        <div class="input-group">
                                        <div class="form-line">
                                        {{ Form::text('schimerTest1_OS', Request::old('schimerTest1_OS',$form_details->schimerTest1_OS), array('class'=> 'form-control','aria-describedby'=>"basic-addon" )) }}
                                        </div>
                                        <span class="input-group-addon myaddon" id="basic-addon">MM</span>
                                        </div>
                                        </div>                                        
                                    </div>
                                    

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label> Schimer Test 2</label>
                                        </div> 
                                        </div>

                                        <div class="col-md-4">
                                        <div class="input-group">
                                        <div class="form-line">
                                        {{ Form::text('schimerTest2_OD', Request::old('schimerTest2_OD',$form_details->schimerTest2_OD), array('class'=> 'form-control','aria-describedby'=>"basic-addon" )) }}
                                        </div>
                                        <span class="input-group-addon myaddon" id="basic-addon">MM</span>
                                        </div>
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                        <div class="input-group">
                                        <div class="form-line">
                                        {{ Form::text('schimerTest2_OS', Request::old('schimerTest2_OS',$form_details->schimerTest2_OS), array('class'=> 'form-control','aria-describedby'=>"basic-addon" )) }}
                                        </div>
                                        <span class="input-group-addon myaddon" id="basic-addon">MM</span>
                                        </div>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label> Optical Coherence tomography (OCT)
                                        </label>
                                        </div>
                                        <input type="hidden" id="OCT[]" name="OCT[]" class="hiddenCounter" value="1" />
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::text('OCT_OD[]', null, array('class'=> 'form-control')) }}
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                        {{ Form::text('OCT_OS[]',  null, array('class'=> 'form-control')) }}
                                        </div>

                                        <div class="col-md-2">
                                        <button id="OCT" class="btn btn-default addmore" data-templateDiv="OCTTemplate">Add</button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get() as $item)
                                        <div class="col-md-2">   
                                        </div>

                                        <div class="col-md-4">
                                        <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                        <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                        </div>

                                        <div class="col-md-2">
                                        <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                        </div>
                                         @endforeach
                                    </div>


                                    <div class="col-md-12"> 
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Extra Ocular Movement (EOM)</label>
                                        <input type="hidden" id="EOM[]" name="EOM[]" class="hiddenCounter" value="1" />
                                        </div>          
                                        </div>

                                        <div class="col-md-4">
                                        {{ Form::text('EOM_OD[]', null, array('class'=> 'form-control')) }}
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                        {{ Form::text('EOM_OS[]',  null, array('class'=> 'form-control')) }}
                                        </div>

                                        <div class="col-md-2">
                                        <button id="EOM" class="btn btn-default addmore" data-templateDiv="EOMTemplate">Add</button>
                                        </div>    
                                    </div>


                                    <div class="col-md-12">
                                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item)
                                        <div class="col-md-2">    
                                        </div>

                                        <div class="col-md-4">
                                        <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                        </div>
                                                                       
                                        <div class="col-md-4">
                                        <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
                                        </div>

                                        <div class="col-md-2">
                                        <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                        </div>
                                         @endforeach
                                    </div>
                                </div>
                    
                                <div class="tab-pane" role="tabpanel" id="step7">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th colspan="3" class="text-center">Right</th>
                                            <th colspan="3" class="text-center">Left</th>
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>SPH</th>
                                            <th>CYL</th>
                                            <th>Axis</th>
                                            <th>SPH</th>
                                            <th>CYL</th>
                                            <th>Axis</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        <td>AR Undilated</td>
                                        <td>
                                        {{ Form::text('sph_r_undi', Request::old('sph_r_undi', $form_details->sph_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('cyl_r_undi', Request::old('cyl_r_undi', $form_details->cyl_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('Axis_r_undi', Request::old('Axis_r_undi', $form_details->Axis_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('sph_l_undi', Request::old('sph_l_undi', $form_details->sph_l_undi), array('class'
                                                => 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('cyl_l_undi', Request::old('cyl_l_undi', $form_details->cyl_l_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('Axis_l_undi', Request::old('Axis_l_undi', $form_details->Axis_l_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>AR Dilated</td>
                                        <td>
                                        {{ Form::text('sph_r_di', Request::old('sph_r_di', $form_details->sph_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('cyl_r_di', Request::old('cyl_r_di', $form_details->cyl_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('Axis_r_di', Request::old('Axis_r_di', $form_details->Axis_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('sph_l_di', Request::old('sph_l_di', $form_details->sph_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('cyl_l_di', Request::old('cyl_l_di', $form_details->cyl_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        <td>
                                        {{ Form::text('Axis_l_di', Request::old('Axis_l_di', $form_details->Axis_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        {{-- <input type="button" value="CheckCanvas" id="checkCanvas"> --}}
                                    </div>
                                    <div class="col-md-5">
                                    <div class="col-md-6">
                                    <div class="example1" data-example="retino_scopy_OD">
                                    <div class="board" id="retino_scopy_OD_canvas"  style="min-height:150px"></div>
                                    </div>
                                    <input type="hidden" name="retino_scopy_OD" id="retino_scopy_OD">
                                    </div>
                                    <div class="col-md-6" style="min-height:100px">
                                    @if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD))   
                                    <button type="button" value="retino_scopy_OD" class="ImageDelete pull-right" >Delete</button>
                                    <p>&nbsp;</p>
                                    <center id="wPaint-retino_scopy_OD"> 
                                    <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OD)."?".filemtime(Storage::path($form_details->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                    </center>
                                    @endif
                                    </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="col-md-6">
                                    <div class="example1" data-example1="retino_scopy_OS">
                                    <div class="board" id="retino_scopy_OS_canvas" style="min-height:150px"></div>
                                    </div>
                                    <input type="hidden" name="retino_scopy_OS" id="retino_scopy_OS">
                                    </div>
                                    <div class="col-md-6">
                                    @if (!empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))
                                    <button type="button" value="retino_scopy_OS" class="ImageDelete pull-right" >Delete</button>
                                    <p>&nbsp;</p>
                                    <center id="wPaint-retino_scopy_OS"> 
                                    <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OS)."?".filemtime(Storage::path($form_details->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
                                    </center>
                                    @endif
                                    </div>
                                    </div>
                                </div>           
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step8">
                                <div class="col-md-12">
                                        <div class="col-md-2 ">
                                        <div class="form-group labelgrp">
                                        {{ Form::label('systanicExamination','ANTERIOR SEGMENT') }} 
                                        </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('systanicExamination', Request::old('systanicExamination',$form_details->systanicExamination), array('class' => 'form-control')) }}    
                                        </div>
                                        </div>
                                        </div>     
                                    </div>


                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Advice  </label>
                                        </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::textarea('Advice_OD', Request::old('Advice_OD',$form_details->Advice_OD), array('class'=> 'form-control advicetxtarea')) }} 
                                        </div>
                                        </div>
                                        </div>     
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Blood Investigation</label>   
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" id="md_checkbox_22" class="filled-in chk-col-pink" />
                                        <label for="md_checkbox_22"><b>Investigation For Uveiitis</b></label>
                                       <ul class="list-group1">
                                            <li class="list-group-item1" style="">Cbc</li>
                                            <li class="list-group-item1" style="">Esr</li>
                                            <li class="list-group-item1" style="">Fbs/ppbs</li>
                                            <li class="list-group-item1" style="">Mantoux test</li>
                                            <li class="list-group-item1" style="">Chest x-ray</li>
                                            <li class="list-group-item1" style="">Suptum for TB</li>
                                            <li class="list-group-item1" style="">SERUM ACE</li>
                                            <li class="list-group-item1" style="">CECT CHEST</li>
                                            <li class="list-group-item1" style="">BAL</li>
                                            <li class="list-group-item1" style="">RA FACTOR</li>
                                            <li class="list-group-item1" style="">ANTI dsDNA,ANA</li>
                                            <li class="list-group-item1" style="">P-ANCA,C-ANCA</li>
                                            <li class="list-group-item1" style="">Serum homocysteine</li>
                                            <li class="list-group-item1" style="">HLA B27</li>
                                            <li class="list-group-item1" style="">IgG and IgM anti Toxo antibodies</li>
                                            <li class="list-group-item1" style="">HIV,HCV</li>
                                            <li class="list-group-item1" style="">VDRL</li>
                                        </ul>
                                        </div>
                                        </div>

                                        <div class="col-md-4">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" id="md_checkbox_23" class="filled-in chk-col-pink" />
                                        <label for="md_checkbox_23"><b>Pre Operative Investigations</b></label>
                                        <ul class="list-group1">
                                        <li class="list-group-item1" style="">CBC</li>
                                        <li class="list-group-item1" style="">ESR</li>
                                        <li class="list-group-item1" style="">FBS/PPBS</li>
                                        <li class="list-group-item1" style="">HIV 1&2</li>
                                        <li class="list-group-item1" style="">HbsAG</li>
                                        <li class="list-group-item1" style="">HCV</li>
                                        <li class="list-group-item1" style="">URINE ROUTINE/MICROSCOPE</li>
                                        <li class="list-group-item1" style="">BUN</li>
                                        <li class="list-group-item1" style="">S CREATININE</li>
                                        <li class="list-group-item1" style="">S ELECTROLYTES</li>
                                        <li class="list-group-item1" style="">Chest x-ray and ECG</li>
                                        </ul>
                                        </div>
                                        </div>
                                  
                                </div>




                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        {{ Form::label('treatmentAdvice','POSTERIOR SEGMENT') }}
                                        </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('treatmentAdvice', Request::old('treatmentAdvice',$form_details->treatmentAdvice), array('class' => 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>     
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        {{ Form::label('localExamReport','Additional Information') }} 
                                         </div>
                                         </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('localExamReport', Request::old('localExamReport',$form_details->localExamReport), array('class' => 'form-control')) }}
                                        </div>
                                        </div>
                                        </div>     
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        {{ Form::label('surgery','Surgery')  }} 
                                        </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                        <div class="form-line">
                                        {{ Form::text('surgery', Request::old('surgery', $form_details->surgery), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
                                        </div>
                                        </div>
                                        </div>     
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        {{ Form::label('Before_file', 'Before image') }} 
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group"> 
                                        {{ Form::file('Before_file', Request::old('Before_file'), array('class'=> 'form-control')) }}
                                        @if(isset($casedata['Before_file']) && $casedata['Before_file'] != null)
                                        <a href="{{Storage::disk('local')->url($casedata['Before_file']) }}" class="" target="_blank"> Before Image link</a>              
                                        @endif 
                                        </div>
                                        </div> 
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        {{ Form::label('After_file', 'After image') }} 
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        {{ Form::file('After_file', Request::old('After_file'), array('class'=> 'form-control')) }}
                                        @if(isset($casedata['After_file']) && $casedata['After_file'] != null)
                                        <a href="{{ Storage::disk('local')->url($casedata['After_file']) }}" class="" target="_blank"> After Image link</a>              
                                        @endif
                                        </div>
                                        </div>    
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Upload Case Paper Image</label>
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        {{ Form::file('reportImage', Request::old('reportImage'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }}
                                        </div>
                                        </div> 
                                    </div> 
                                    <div class="col-md-12 col-md-offset-4"> 
                                        <div class="col-md-4">
                                        <button type="submit" name="submit_reportImage" class="btn btn-lg" value="submit_reportImage"><i class="fa fa-plus"></i> Add
                                        </button>&nbsp;
                                        <a class="btn btn-default btn-lg" href="{{ url('/ViewEyeReportFiles/').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> View Report Files  
                                        </a>
                                        </div>
                                    </div>   
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step9">
                                  <div class="row">
                                <div class="col-md-12 col-md-offset-1">
                                    <div class="col-md-2 ">
                                    <div class="form-group labelgrp">
                                    {{ Form::label('FollowUpDoctor_id','Doctor : ') }} 
                                    </div>
                                    </div>
                                    <div class="col-md-6 ">
                                    <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $doctorlist->toArray(),
                                    Request::old('FollowUpDoctor_id'), array('class' => 'form-control','data-live-search'=>'true')) }}                        
                                    </div>
                                    </div>
                                    </div>     
                                  </div>

                                <div class="col-md-12 col-md-offset-1">
                                    <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                    {{ Form::label('appointment_dt','Date : ') }} 
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <div class="input-group date" id="bs_datepicker_component_container">
                                        <div class="form-line">
                                            <input type="text" class="form-control dp" id="appointment_dt" name="appointment_dt" placeholder="Select Date." data-date-format="yyyy-mm-dd" required autocomplete="off">
                                        </div>
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                    </div>
                                    </div>
                                    </div>     
                                </div>


                                <div class="col-sm-offset-2 col-sm-10">
                                    <div id="Morning" class="align-items-center" style="display: none;margin-bottom: 5px;"><b>Morning Slot</b>
                                    </div>
                                    <div id="appdate">
                                    </div>
                                </div>


                                <div class="col-md-12 col-md-offset-1">
                                    <div class="col-md-2 ">
                                    <div class="form-group labelgrp">
                                    <label>Follow up Time Slot</label>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <div class="form-line">
                                    <select class="form-control" id="FollowUpTimeSlot" name="FollowUpTimeSlot" data-live-search="true"></select>                    
                                    </div>
                                    </div>
                                    </div>     
                                </div>
                                    
                                </div> 
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step10">
                                    <h4 class="text-center">Step 10</h4>
                                    
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
</div>
                  
<div id="templateContainner" style="display:none">
    <div id="ChiefComplaintTemplate" class="col-md-12">
                <div class="col-md-2">
                    <div class="form-group labelgrp">
                        <label></label>
                              
                    <input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="" />
             
            </div>
                </div>
                <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('doctor_name', Request::old('doctor_name'), array('class' => 'form-control')) }}                            
                              </div>
                              </div>
                              </div> 
                <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('doctor_name', Request::old('doctor_name'), array('class' => 'form-control')) }}                            
                              </div>
                              </div>
                              </div> 
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
       
    </div>
    <div id="OpthalHistoryTemplate">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="OpthalHistory[]" name="OpthalHistory[]" class="hiddenCounter" value="" />
            </div>
            <div class="col-md-4">
                {{ Form::select('OpthalHistory_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('OpthalHistory_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="SystemicHistoryTemplate">   
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="SystemicHistory[]" name="SystemicHistory[]" class="hiddenCounter" value="" />
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <div class="form-line">
                {{ Form::text('SystemicHistory_OD[]', "", array('class'=> 'form-control')) }}
            </div>
            </div>
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="ConjAndLidsTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="ConjAndLids[]" name="ConjAndLids[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('ConjAndLids_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Conj And Lids OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('ConjAndLids_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Conj And Lids OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="LidsTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="Lids[]" name="Lids[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('Lids_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'LIDS OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('Lids_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'LIDS OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="ACTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="AC[]" name="AC[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('AC_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'AC OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('AC_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'AC OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="IRISTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="IRIS[]" name="IRIS[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('IRIS_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('IRIS_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="sacTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="sac[]" name="sac[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('sac_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'sac OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('sac_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'sac OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="RetinaTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="Retina[]" name="Retina[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('Retina_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('Retina_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="MaculaTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="Macula[]" name="Macula[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('Macula_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Macula OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('Macula_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Macula OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="ONHTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="ONH[]" name="ONH[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                {{ Form::select('ONH_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'ONH OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('ONH_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'ONH OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="OrbitSacsEyeMotilityTemplate">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="OrbitSacsEyeMotility[]" name="OrbitSacsEyeMotility[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-4">
                    {{ Form::select('OrbitSacsEyeMotility_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'OrbitSacsEyeMotility OD')->pluck('ddText','ddText')->toArray(),null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                    {{ Form::select('OrbitSacsEyeMotility_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'OrbitSacsEyeMotility OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="corniaTemplate">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="cornia[]" name="cornia[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                {{ Form::select('cornia_od[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Cornea OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('cornia_os[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Cornea OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="pupilIrisacTemplate">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="pupilIrisac[]" name="pupilIrisac[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                {{ Form::select('pupilIrisac_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'pupilIrisac OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('pupilIrisac_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'pupilIrisac OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="lensTemplate">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="lens[]" name="lens[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                {{ Form::select('lens_od[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'lens OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('lense_os[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'lens OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="vitreoretinalTemplate">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="vitreoretinal[]" name="vitreoretinal[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                {{ Form::select('vitreoretinal_OD[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('vitreoretinal_OS[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="diagnoTemplate">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="diagno[]" name="diagno[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                    {{ Form::select('diagno_od[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Diagnosis OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('diagno_os[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'Diagnosis OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="OCTTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="OCT[]" name="OCT[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                    {{ Form::text('OCT_OD[]', null, array('class'=> 'form-control')) }}
            </div>
            <div class="col-md-4">
                {{ Form::text('OCT_OS[]',  null, array('class'=> 'form-control')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="EOMTemplate" >
        <div class="form-group row">
            <div class="col-md-2">
                <input type="hidden" id="EOM[]" name="EOM[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-4">
                    {{ Form::text('EOM_OD[]', null, array('class'=> 'form-control')) }}
            </div>
            <div class="col-md-4">
                {{ Form::text('EOM_OS[]',  null, array('class'=> 'form-control')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
</div>


 @endsection

@section('scripts')


<script src="{{asset('drawingboardJs/drawingboard.min.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>


        <script type="text/javascript">

$(document).ready(function(){

    var counter = 1;

    $("#addButton").click(function () {
      
  if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+counter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="text" id="optionsval'+counter+'" placeholder="value'+counter+'" name="optionsval[]"></div><span class="input-group-addon removeButton" type="button" id="removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#TextBoxesGroup").append(newTextBoxDiv);




  counter++;
     });


$(document).on('click', '.removeButton', function(e) {
counter--;
   var target = $("#TextBoxesGroup").find("#TextBoxDiv" +counter);
  $(target).remove();
});


     $("#getButtonValue").click(function () {
     var data=$("#eyeform").serialize();
    // alert(data)
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
                $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
            location.reload();
            }
        })
     });
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
     
 $("#appointment_dt").datepicker().on('change.dp', function (e) {

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
                //alert(response);
        
             if(response==0)
                 {
                    $("#FollowUpTimeSlot").append('<option value="0">No Slots Available</option>');
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

        $('.addmore').click(function(e){
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
            $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
            // $("#surgeryDetails").find('#patient_name').val('');
            $(this).closest('div.ContainerToAppend').append($(template).html());
            $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '80%'});
            // .each(function(index,ele){
            //     $(ele).select2({width: '80%'});
            // });
        });
        $('.ContainerToAppend').on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.form-group').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });
        $(".removeDbItem").click(function(e){
            e.preventDefault();
            if(confirm('You really want to delete this record?')) {
               var ClickedButton = $(this);
               var containerDiv = $(this).closest('div.form-group.row');
               $(ClickedButton).button('loading');
               $.ajax({ url: '{{ url('/eyeform/deleteMultiEntry') }}/' + $(ClickedButton).data('deleteid'), 
                    type: 'DELETE',
                    data: {_method: 'delete', 
                           _token :$("input[name='_token'][type='hidden']").val(),
                           id : $(ClickedButton).data('deleteid')
                          }
                    })
                .success(function() {
                    $(containerDiv).remove();
                    $(ClickedButton).button('reset');
                }).error(function(){
                    $(ClickedButton).button('reset');
                });
            }
        });


    }); //document ready
</script>
 
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>
<script>    
    jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>

 
@endsection


 </script>
