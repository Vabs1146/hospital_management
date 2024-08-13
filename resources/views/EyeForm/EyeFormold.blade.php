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

.chiefcomplainremoveButton, .opthalhistoryremoveButton,.lidsremoveButton,.dvnremoveButton,.nvnremoveButton,.WithPinholeremoveButton,.PGPremoveButton,.DVNWithGlassesremoveButton,.NVNWithGlassesremoveButton,.orbitremoveButton,.conjremoveButton,.cornearemoveButton,.ac1removeButton,.irisremoveButton,.pupilremoveButton,.IOPremoveButton,.CDRatioremoveButton,.PachymetryremoveButton,.cctremoveButton,.K1removeButton,.K2removeButton,.lenspowerremoveButton,.axial_lengthremoveButton,.KCremoveButton,.lensremoveButton,.vitreoremoveButton,.retinaremoveButton,.onhremoveButton,.macularemoveButton,.sacremoveButton,.systanicExaminationremoveButton,.treatmentAdviceremoveButton,.systemichistoryremoveButton,.colorvisionremoveButton,.schimertestoneremoveButton,.octremoveButton,.eomremoveButton{
  color: #700;
  cursor: pointer;
}

.chiefcomplainremoveButton ,.opthalhistoryremoveButton,.lidsremoveButton,.dvnremoveButton,.nvnremoveButton,.WithPinholeremoveButton,.PGPremoveButton,.DVNWithGlassesremoveButton,.NVNWithGlassesremoveButton,.orbitremoveButton,.conjremoveButton,.cornearemoveButton,.ac1removeButton,.irisremoveButton,.pupilremoveButton,.IOPremoveButton,.CDRatioremoveButton,.PachymetryremoveButton,.cctremoveButton,.K1removeButton,.K2removeButton,.lenspowerremoveButton,.axial_lengthremoveButton,.KCremoveButton,.lensremoveButton,.vitreoremoveButton,.retinaremoveButton,.onhremoveButton,.macularemoveButton,.sacremoveButton,.systanicExaminationremoveButton,.treatmentAdviceremoveButton,.systemichistoryremoveButton,.colorvisionremoveButton,.schimertestoneremoveButton,.octremoveButton,.eomremoveButton:hover {
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
                       <form action="{{ url('/patientDetails/SaveEyeExamination') }}" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
 
                        {{ csrf_field() }}
                        {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
                        {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
                         <div class="header bg-pink">
                            <h2>
                              Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . $casedata['visit_time']}}
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                 <a id="button" ><i class="material-icons" style="font-size: 33px !important;">keyboard_arrow_up</i></a>
                               <div class="top-nav s-12 l-10">
            <p class="nav-text"></p>
            <ul class="">
                <li><a> OPD :- </a></li>
                <a href="{{url('/AddEditEyeDetails/setNormal').'/'.$casedata['id'] }}">Normal Case Paper</a>
              <a> / </a>
              <a href="{{ url('/fundusImage/').'/'. $casedata['id'] }}">Fundus Image</a>
              <a> / </a>
              <a href="{{ url('/AddEdit/prescription/').'/'. $casedata['id'] }}">Add Prescription </a>
              <a> / </a>
              <a href="{{ url('/glassPrescription/').'/'.$casedata['id'].'/edit' }}">Glass Prescription </a>
              <a> / </a>
              <a href="{{ url('/report_files/').'/'.$casedata['id'].'/edit' }}">Add Report  </a>
              <a> / </a>
              <a href="{{ url('/dynamicForm/6/').'/'.$casedata['id'].'/edit/Opd' }}">Squint Details  </a>
              <a> / </a>
              <a href="{{ url('/dynamicForm/7/').'/'.$casedata['id'].'/edit/Opd' }}">Paediatric Eye Evaluation  </a>
              <a> / </a>
              <a href="{{ url('/dynamicForm/8/').'/'.$casedata['id'].'/edit/Opd' }}">Ptosis Proforma  </a>
              <a> / </a>
              <a href="{{ url('/PrintEyeDetails/').'/'.$casedata['id'] }}">Print </a>
              <a> / </a>
              <a href="{{ url('/ViewEyeReportFiles/').'/'.$casedata['id'] }}">Report File view </a>
              <li><a> IPD :- </a></li>
              <a href="{{ url('/eyeOperationRecord/').'/'.$casedata['id'].'/edit' }}">Operation Record</a>
              <a> / </a>
              <a href="{{ url('/eyeoperation/').'/'.$casedata['id'].'/edit' }}">Operation Theater Notes</a>
              <a> / </a>
              <a href="{{ url('/insuranceBill/').'/'.$casedata['id'].'/edit' }}">IPD Bill </a>
              <a> / </a>
              <a href="{{ url('/discharge/').'/'.$casedata['id'].'/1/edit' }}">Discharge  </a>  
          </div>
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
              <hr>
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
              <hr/>
               <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                  <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
<!-- start of panel complaint -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.complaint')
</div>
<!-- end of panel complaint -->
<!-- start of panel Vision -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.vision')
</div>
<!-- End Of Vision Panel -->
<!-- Start of Refraction panel -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.refraction')
</div>
<!-- End of Refraction -->
<!-- Start of Finding -->

<div class="panel panel-primary">
@include('EyeForm.old_form_steps.finding')
</div>

<!-- end of Finding Panel -->
<!-- Start of Glaucoma panel -->

<div class="panel panel-primary">
@include('EyeForm.old_form_steps.glaucoma')
</div>
<!-- End of Glaucoma panel -->
<!-- Start of A Scan panel -->

<div class="panel panel-primary">
@include('EyeForm.old_form_steps.ascan')
</div>
<!-- End Of  A Scan Panel -->
<!-- Start of Sp Tests -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.sp_test')
</div>
<!-- End of Sp tests -->
<!-- Start of Other Details -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.other_details')
</div>
<!-- End of Other Details -->

<!-- Start of Follow-up Panel -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.followup')
</div>
<!-- End of Follow-up Panel -->

<!-- Start of Laser Procedure Panel -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.laser_procedure')
</div>
<!-- End of Laser Procedure Panel -->

<!-- Start of Image Draw Panel -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.image_draw')
</div>
<!-- End of Image Draw Panel -->

<!-- Start of Fix Surgery Panel -->
<div class="panel panel-primary">
@include('EyeForm.old_form_steps.fix_surgery')
</div>
<!-- End of Fix Surgery Panel -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="top-nav s-12 l-10">
            <p class="nav-text"></p>
            <ul class="">
                <li><a> OPD :- </a></li>
              <a href="{{ url('/fundusImage/').'/'. $casedata['id'] }}">Fundus Image</a>
              <a> / </a>
              <a href="{{ url('/AddEdit/prescription/').'/'. $casedata['id'] }}">Add Prescription </a>
              <a> / </a>
              <a href="{{ url('/glassPrescription/').'/'.$casedata['id'].'/edit' }}">Glass Prescription </a>
              <a> / </a>
              <a href="{{ url('/report_files/').'/'.$casedata['id'].'/edit' }}">Add Report  </a>
              <a> / </a>
              <a href="{{ url('/dynamicForm/6/').'/'.$casedata['id'].'/edit/Opd' }}">Squint Details  </a>
              <a> / </a>
              <a href="{{ url('/dynamicForm/7/').'/'.$casedata['id'].'/edit/Opd' }}">Paediatric Eye Evaluation  </a>
              <a> / </a>
              <a href="{{ url('/dynamicForm/8/').'/'.$casedata['id'].'/edit/Opd' }}">Ptosis Proforma  </a>
              <a> / </a>
              <a href="{{ url('/PrintEyeDetails/').'/'.$casedata['id'] }}">Print </a>
              <a> / </a>
              <a href="{{ url('/ViewEyeReportFiles/').'/'.$casedata['id'] }}">Report File view </a>
              <li><a> IPD :- </a></li>
              <a href="{{ url('/eyeOperationRecord/').'/'.$casedata['id'].'/edit' }}">Operation Record</a>
              <a> / </a>
              <a href="{{ url('/eyeoperation/').'/'.$casedata['id'].'/edit' }}">Operation Theater Notes</a>
              <a> / </a>
              <a href="{{ url('/insuranceBill/').'/'.$casedata['id'].'/edit' }}">IPD Bill </a>
              <a> / </a>
              <a href="{{ url('/discharge/').'/'.$casedata['id'].'/1/edit' }}">Discharge  </a>
              
              
          </div>
                        </div>

                                <!-- End of Follow-up Panel -->

                             
                             
                              
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-primary waves-effect"><i class="fa fa-plus"></i> Submit
                                </button>
									
									<a class="btn btn-primary waves-effect btn-lg" href="{{url('/ViewEyeDetails').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> View </a>
									
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('/case_masters') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
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
        </div>
    </div>
    <div id="SystemicHistoryTemplate">   
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="SystemicHistory[]" name="SystemicHistory[]" class="hiddenCounter" value="" />
            </div>
            <div class="col-md-8">
                {{ Form::text('SystemicHistory_OD[]', "", array('class'=> 'form-control')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
    <div id="ConjAndLidsTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="ConjAndLids[]" name="ConjAndLids[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('ConjAndLids_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'LIDS OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('ConjAndLids_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'LIDS OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="LidsTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="Lids[]" name="Lids[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('Lids_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'OrbitSacsEyeMotility OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('Lids_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'OrbitSacsEyeMotility OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="ACTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="AC[]" name="AC[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('AC_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Conj And Lids OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('AC_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Conj And Lids OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="IRISTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="IRIS[]" name="IRIS[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('IRIS_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Cornea OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('IRIS_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Cornea OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="sacTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="sac[]" name="sac[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('sac_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'AC OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('sac_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'AC OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="RetinaTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="Retina[]" name="Retina[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('Retina_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('Retina_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="MaculaTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="Macula[]" name="Macula[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('Macula_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'pupilIrisac OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('Macula_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'pupilIrisac OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="ONHTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="ONH[]" name="ONH[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('ONH_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'lens OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('ONH_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'lens OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="OrbitSacsEyeMotilityTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="OrbitSacsEyeMotility[]" name="OrbitSacsEyeMotility[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                    {{ Form::select('OrbitSacsEyeMotility_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OD')->pluck('ddText','ddText')->toArray(),null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                    {{ Form::select('OrbitSacsEyeMotility_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="corniaTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="cornia[]" name="cornia[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-3">
                {{ Form::select('cornia_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('cornia_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="pupilIrisacTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="pupilIrisac[]" name="pupilIrisac[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-3">
                {{ Form::select('pupilIrisac_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'ONH OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('pupilIrisac_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'ONH OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="lensTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="lens[]" name="lens[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-3">
                {{ Form::select('lens_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Macula OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('lense_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Macula OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
            </div>
        </div>
    </div>
    <div id="vitreoretinalTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="vitreoretinal[]" name="vitreoretinal[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-3">
                {{ Form::select('vitreoretinal_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'sac OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('vitreoretinal_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'sac OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-2">
                <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
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


@endsection

@section('scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->

 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script src="{{asset('drawingboardJs/drawingboard.min.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
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
/*
$(document).ready(function() {

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
*/
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
     var systemichistorycnt = 1;
$("#systemichistorybtn").click(function () {
      
  if(systemichistorycnt>10){
            alert("Only 10 textboxes allow");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-8 col-md-offset-2" id="TextBoxDiv'+systemichistorycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="field_name" value="SystemicHistory"><input class="form-control"  type="text" id="optionsval'+systemichistorycnt+'" placeholder="value'+systemichistorycnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SystemicHistoryTextBoxesGroup").append(newTextBoxDiv);
  systemichistorycnt++;
     });

$(document).on('click', '.systemichistoryremoveButton', function(e) {
systemichistorycnt--;
   var target = $("#SystemicHistoryTextBoxesGroup").find("#TextBoxDiv" +systemichistorycnt);
  $(target).remove();
});

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
$("#DVNWithGlassesbtn").click(function () {
      
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
$("#NVNWithGlassesbtn").click(function () {
      
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
$("#lidsbtn").click(function () {
      
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
$("#orbitbtn").click(function () {
      
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
$("#conjbtn").click(function () {
      
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
$("#corneabtn").click(function () {
      
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
$("#ac1abtn").click(function () {
      
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
$("#irisbtn").click(function () {
      
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
$("#pupilbtn").click(function () {
      
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
$("#lensbtn").click(function () {
      
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
$("#vitreobtn").click(function () {
      
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
$("#retinabtn").click(function () {
      
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
$("#onhbtn").click(function () {
      
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
$("#maculabtn").click(function () {
      
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
$("#sacbtn").click(function () {
      
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
     var systanicExaminationcnt = 1;
$("#systanicExaminationbtn").click(function () {
      
  if(systanicExaminationcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+systanicExaminationcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="systanicExamination"><input class="form-control"  type="hidden"  name="fieldName2" value="systanicExamination"><input class="form-control"  type="text" id="optionsval'+systanicExaminationcnt+'" placeholder="value'+systanicExaminationcnt+'" name="optionsval[]"></div><span class="input-group-addon systanicExaminationremoveButton" type="button" id="systanicExaminationremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#systanicExaminationTextBoxesGroup").append(newTextBoxDiv);
  systanicExaminationcnt++;
     });

$(document).on('click', '.systanicExaminationremoveButton', function(e) {
systanicExaminationcnt--;
   var target = $("#systanicExaminationTextBoxesGroup").find("#TextBoxDiv" +systanicExaminationcnt);
  $(target).remove();
});

</script>

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
             swal({title: "Option For Colour vision", text: "Added Successfully!", type: "success"},
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
             swal({title: "Option For With Glass", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
// Lids Add Option

      $("#lidsbtnsave").click(function () {
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

      $("#orbitbtnsave").click(function () {
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

      $("#conjbtnsave").click(function () {
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

      $("#corneabtnsave").click(function () {
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

      $("#ac1btnsave").click(function () {
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

      $("#irisbtnsave").click(function () {
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

      $("#pupilbtnsave").click(function () {
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

      $("#lensbtnsave").click(function () {
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

      $("#vitreobtnsave").click(function () {
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

      $("#retinabtnsave").click(function () {
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

      $("#onhbtnsave").click(function () {
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

      $("#maculabtnsave").click(function () {
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

      $("#sacbtnsave").click(function () {
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
$("#systanicExaminationbtnsave").click(function () {
        var content=$("#systanicExaminationTextBoxesGroup").val();
        if (isEmpty($('#systanicExaminationTextBoxesGroup'))) 
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

         

            $('.addmore').click(function(e){
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
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
        $('.ContainerToAppend').on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });
        $(".removeDbItem").click(function(e){
 var ClickedButton = $(this);
var containerDiv = $(this).closest('div.form-group.row');
var url='{{ url("eyeform/deleteMultiEntry") }}/'+ $(ClickedButton).data('deleteid');
alert(url);
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
                    data: {_method: 'delete', 
                           _token :$("input[name='_token'][type='hidden']").val(),
                           id : $(ClickedButton).data('deleteid')
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
       
         // location.reload();
    });
            e.preventDefault();
            // if(confirm('You really want to delete this record?')) {
              
            //    $(ClickedButton).button('loading');
            // var url='{{ url("eyeform/deleteMultiEntry") }}/'+ $(ClickedButton).data('deleteid');

            //  alert(url);

            //    $.ajax({ url: '{{ url('/eyeform/deleteMultiEntry') }}/' + $(ClickedButton).data('deleteid'), 
            //         type: 'DELETE',
            //         data: {_method: 'delete', 
            //                _token :$("input[name='_token'][type='hidden']").val(),
            //                id : $(ClickedButton).data('deleteid')
            //               }
            //         })
            //     .success(function() {
            //         $(containerDiv).remove();
            //         $(ClickedButton).button('reset');
            //     }).error(function(){
            //         $(ClickedButton).button('reset');
            //     });
            // }
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
		
		$('input[name="surgery_advance_amount"]').keyup(function() {
			
			console.log($('input[name="surgery_advance_amount"]').val());
			
			$('input[name="advance_amount"]').val($('input[name="surgery_advance_amount"]').val());
		});
		
		$('input[name="advance_amount"]').keyup(function() {
			console.log($('input[name="advance_amount"]').val());
			$('input[name="surgery_advance_amount"]').val($('input[name="advance_amount"]').val());
		});
		</script>
@endsection

