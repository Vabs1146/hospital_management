@php

//echo "======>>>> <pre>"; print_r($casedata); exit;
@endphp
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
<div class="container">
    <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach

		<span> &nbsp;</span><a href="{{ url('/PrintMedicalDetails').'/'.$casedata['id'] }}" class="list-group-item active">Print</a><span> &nbsp;</span>
		<a href="{{ url('/ViewMedicalDetails').'/'.$casedata['id'] }}" class="list-group-item active">View</a>
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
            <form action="{{ url('/patientDetails/SaveAnxiousCaseHistory') }}" method="POST" class="form-horizontal" id="gynform">
            {{--  {{ Form::model($casedata, array('route' => array('case_masters.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}  --}}
               {{ csrf_field() }}
                         <div class="header bg-pink">
							<h2>
                                Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . @$casedata['visit_time']}}  
                            </h2>
                          
                        </div>
						<?php if(!empty($casedata['infection']) || !empty($casedata['miscellaneous_history'])) {?>
                         
						 <div class="header bg-yellow">
						 
                            <div class="col-md-12" style="margin-top: -10px;">
							<h2>
							<marquee>
                                <div style="color:red; font-weight:bold; display: inline-block;">Allergy : <span class="details-section" style="color:#000;">{{ $casedata['infection'] }}</span></div> 
                                <div style="color:red; font-weight:bold; display: inline-block; margin-left: 200px;">Miscellaneous History : <span class="details-section" style="color:#000;">{{ $casedata['miscellaneous_history'] }}</span></div>
								
								</marquee>
							</h2>
                            </div>
                        </div>
						
                        <?php } ?>
                        <div class="body">
                           {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
                            {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
							 {{ Form::hidden('casehisfem_patient_emailId', Request::old('patient_emailId',$casedata['patient_emailId']), array('class'=> 'form-control')) }}
                          <div class="row clearfix">
						 <!--  -------------------------------------------------------------------------- -->


		
							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="wife_name" class="form-control">Wife Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('wife_name', $patient_details->wife_name, array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="wife_age" class="form-control"> Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('wife_age', Request::old('wife_age', $patient_details->wife_age), array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="husband_name" class="form-control">Husband Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('husband_name', $patient_details->husband_name, array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="husband_age" class="form-control"> Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('husband_age', Request::old('husband_age', $patient_details->husband_age), array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Married Since :</label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('married_since', $patient_details->married_since, array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Menstrual History :</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('menstrual_history', $patient_details->menstrual_history, array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                            </div>






<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">LMP :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('lmp', $patient_details->lmp, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Obstetric History :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('obstetric_history', $patient_details->obstetric_history, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	





<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">H/O Other Medical Surgical Illness :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('other_medical_surgical_illness', $patient_details->other_medical_surgical_illness, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">H/O Othe Art Procedure In Past :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('other_art_procedure_past', $patient_details->other_art_procedure_past, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">HSG :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('hsg', $patient_details->hsg, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Laproscopy :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('laproscopy', $patient_details->laproscopy, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Hsf :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('hsf', $patient_details->hsf, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Hormones :</label>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">LH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('lh', $patient_details->lh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">FSH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('fsh', $patient_details->fsh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">TSH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('tsh', $patient_details->tsh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">Prolactin :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('prolactin', $patient_details->prolactin, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">AMH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('amh', $patient_details->amh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Folliculometry :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('folliculometry', $patient_details->folliculometry, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>

<div class="col-md-12">
                          
                            
	{{ Form::label('SysExamLocalExam','Adviced :') }} 
	{{ Form::textarea('adviced', Request::old('adviced',$patient_details->adviced), array('class'=> 'form-control ')) }}
 

</div>

<!-- ============================================================================ -->
                            
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
                              {{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $doctorlist->toArray(),$selectdoc, array('class' => 'form-control select2','disabled' => 'true')) }}
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
							<div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Email To :</label>
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="form-line">
                                        <input type="email" name="casehisemail" id="casehisemail" class="form-control">
                                        </div>
                                        </div>
                                      </div> 

                                      <div class="col-md-2">
                                        <button type="submit"  name="casehisfemalesendbtn" class="btn btn-success " value="casehisfemalesendbtn" >Email To Other</button> 
                                      </div>
                                  </div>		
                        

						 <!-- ============================================================================================ -->
						  
						  </div>

                          
                 
                    
                                  

                            </div>
<div class="row clearfix">
	<div class="col-md-8 col-md-offset-3">
		<div class="form-group">
			<a class="btn btn-primary btn-lg" href="{{ url('/AddEdit/entprescription/').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i> Add Prescription </a>
			<a class="btn btn-primary btn-lg" href="{{ url('/report_files/').'/'.$casedata['id'].'/edit' }}"><i class="glyphicon glyphicon-chevron-left"></i> Add Report </a>
			<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit" >
			<i class="fa fa-plus"></i> Submit
			</button>
			<button type="submit" name="casehisfemalsubbtn" class="btn btn-primary btn-lg" value="casehisfemalsubbtn" >
			<i class="fa fa-plus"></i> Submit & Mail
			</button>
			<a class="btn btn-primary btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> 
		</div>
	</div>
</div>
<br><br>
<div class="row clearfix">
	<div class="col-md-8 col-md-offset-3">
		<div class="form-group">
			<a class="btn btn-primary btn-lg" href="{{ url('/ivf-icsi').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i> ICSI </a>
			<a class="btn btn-primary btn-lg" href="{{ url('/ivf-od').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i>OD </a>
			<a class="btn btn-primary btn-lg" href="{{ url('/ivf-ed').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i>ED </a>
			<a class="btn btn-primary btn-lg" href="{{ url('/ivf-fet').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i> FET </a>
		</div>
	</div>
</div>
                            <br><br>
                            
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
         
           $("#appointment_dt").on('change.dp', function (e) {

        
        $("#FollowUpTimeSlot").empty();
        
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

<!-------------------------------------------->


<!-- History Set Option -->
<script type="text/javascript">
     var Historycnt = 1;
	$("#Historybtn").click(function () {
		  
	  if(Historycnt>10){
				 swal("Only 10 Options Values are allow!");
				return false;
	  }
	  
	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+Historycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="History"><input class="form-control"  type="text" id="optionsval'+Historycnt+'" placeholder="value'+Historycnt+'" name="optionsval[]"></div><span class="input-group-addon HistoryremoveButton" type="button" id="HistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+PastPersonalHistorycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="PastPersonalHistory"><input class="form-control"  type="text" id="optionsval'+PastPersonalHistorycnt+'" placeholder="value'+PastPersonalHistorycnt+'" name="optionsval[]"></div><span class="input-group-addon PastPersonalHistoryremoveButton" type="button" id="PastPersonalHistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#PastPersonalHistoryTextBoxesGroup").append(newTextBoxDiv);
  PastPersonalHistorycnt++;
     });

$(document).on('click', '.PastPersonalHistoryremoveButton', function(e) {
PastPersonalHistorycnt--;
   var target = $("#PastPersonalHistoryTextBoxesGroup").find("#TextBoxDiv" +PastPersonalHistorycnt);
  $(target).remove();
});

</script>


<!-- menarch Set Option -->
<script type="text/javascript">
     var menarchcnt = 1;
$("#menarchbtn").click(function () {
      
  if(menarchcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+menarchcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="menarch"><input class="form-control"  type="text" id="optionsval'+menarchcnt+'" placeholder="value'+menarchcnt+'" name="optionsval[]"></div><span class="input-group-addon menarchremoveButton" type="button" id="menarchremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#menarchTextBoxesGroup").append(newTextBoxDiv);
  menarchcnt++;
     });

$(document).on('click', '.menarchremoveButton', function(e) {
menarchcnt--;
   var target = $("#menarchTextBoxesGroup").find("#TextBoxDiv" +menarchcnt);
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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+ObstetricTextcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="ObstetricText"><input class="form-control"  type="text" id="optionsval'+ObstetricTextcnt+'" placeholder="value'+ObstetricTextcnt+'" name="optionsval[]"></div><span class="input-group-addon ObstetricTextremoveButton" type="button" id="ObstetricTextremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+Educationcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="Education"><input class="form-control"  type="text" id="optionsval'+Educationcnt+'" placeholder="value'+Educationcnt+'" name="optionsval[]"></div><span class="input-group-addon EducationremoveButton" type="button" id="EducationremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+SysExamCVScnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="SysExamCVS"><input class="form-control"  type="text" id="optionsval'+SysExamCVScnt+'" placeholder="value'+SysExamCVScnt+'" name="optionsval[]"></div><span class="input-group-addon SysExamCVSremoveButton" type="button" id="SysExamCVSremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+SysExamRScnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="SysExamRS"><input class="form-control"  type="text" id="optionsval'+SysExamRScnt+'" placeholder="value'+SysExamRScnt+'" name="optionsval[]"></div><span class="input-group-addon SysExamRSremoveButton" type="button" id="SysExamRSremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+ProvisionalDiagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="ProvisionalDiagnosis"><input class="form-control"  type="text" id="optionsval'+ProvisionalDiagnosiscnt+'" placeholder="value'+ProvisionalDiagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon ProvisionalDiagnosisremoveButton" type="button" id="ProvisionalDiagnosisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+InvestigationAdvicecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="gyn"><input class="form-control"  type="hidden"  name="fieldName" value="InvestigationAdvice"><input class="form-control"  type="text" id="optionsval'+InvestigationAdvicecnt+'" placeholder="value'+InvestigationAdvicecnt+'" name="optionsval[]"></div><span class="input-group-addon InvestigationAdviceremoveButton" type="button" id="InvestigationAdviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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


// menarch Add Option

$("#menarchbtnsave").click(function () {
        var content=$("#menarchTextBoxesGroup").val();
        if (isEmpty($('#menarchTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past Menarche", text: "Added Successfully!", type: "success"},
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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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
 var data=$("#gynform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("gyninsert-field.insert") }}',
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