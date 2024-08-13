@extends('adminlayouts.master')
<style type="text/css">
.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
color: #700;
cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
color: #f00;
}

</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<style>
.labelgrp {
    text-align: left !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
<div class="list-group list-group-horizontal">
@forelse ($DateWiseRecordLst as $VisitListDateWise)
@if($case_master['id'] == $VisitListDateWise['id'])
<a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
@else
<a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
<div class="header bg-pink">
<h2>
Discharge Summary
</h2>

</div>



<div class="body">
	<form id="discharge_form" action="{{ url('/discharge'.( isset($case_master) ? "/1/" . $case_master['id'] : "")) }}" method="POST" enctype = 'multipart/form-data' >
		{{ csrf_field() }}
		<input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group labelgrp">
						<label for="case_number" class="form-control">Case Number :</label>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}"> 
						</div>
					</div>
				</div> 

				<div class="col-md-2">
					<div class="form-group labelgrp">
						<label for="IPD_no" class="form-control">IPD No. :</label>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="IPD_no" id="IPD_no" class="form-control" readonly='readonly' value="{{ $case_master['IPD_no'] or ''}}"> 
						</div>
					</div>
				</div> 

				<div class="col-md-2">
					<div class="form-group labelgrp">
						<label for="uhid_no" class="form-control">UHID No. :</label>
					</div>
				</div>


				<div class="col-md-2">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="uhid_no" id="uhid_no" class="form-control" value="{{ $case_master['uhid_no'] or ''}}">
						</div>  
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="col-md-3">
					<div class="form-group labelgrp">
						<label for="patient_name" class="form-control">Name Of Patient :</label>
					</div>
				</div>


				<div class="col-md-4">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ $case_master['patient_name'] or ''}}">
						</div>  
					</div>
				</div>

				<div class="col-md-1">
					<div class="form-group labelgrp">
						<label for="name_of_age" class="form-control">Age :</label>
					</div>
				</div>


				<div class="col-md-1">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="patient_age" id="patient_age" class="form-control"  value="{{ $case_master['patient_age'] or ''}}">
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="form-group labelgrp">
						<label for="male_female" class="form-control">Sex :</label>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group" style="padding-top: 6px">
						<input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_master->male_female == "Male")? "checked=\"checked\"" : "" }}   />
						<label for="radio_8">Male</label>
						<input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple" value="Female" required   {{ ($case_master->male_female == "Female")? "checked=\"checked\"" : "" }} />
						<label for="radio_10">Female</label>
					</div>
				</div>   

				
			</div>

			

			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group labelgrp">
						{{ Form::label('patient_address','Address') }}
					</div>
				</div>

				<div class="col-md-10">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('patient_address', Request::old('patient_address',$case_master->patient_address), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
			</div> 

			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group labelgrp">
						{{ Form::label('surgeon_name','Surgon Name') }}
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<div class="form-line">
							{{-- Form::text('surgeon_name', Request::old('surgeon_name',$discharge->surgeon_name), array('class' => 'form-control')) --}}
							{{ Form::select('surgeon_name', array(''=>'Please select') + $doctorlist->toArray(), Request::old('surgon_name', $discharge->surgeon_name), array('class' => 'form-control select2',  'id'=>'Surgeon','data-live-search'=>'true')) }} 
						</div>
					</div>
				</div>
			</div> 

<!-- ================================================================================= -->
<div id="anaesthetistSurgeon" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('anaesthetistSurgeon','Anaesthetist Surgon') }} 
			</div>
		</div>

		<div class="col-md-6">
			<select class="form-control select2" data-live-search='true' name="anaesthetistSurgeon">
				<option>--Select--</option>
				<?php 
				//echo "<pre> =============";print_r($newDischargeData);exit;

				foreach ($form_dropdowns->where('fieldName', 'anaesthetistSurgeon')->pluck('ddText','ddText')->toArray() as $key => $value) { ?>
						<option value="{{$key}}" <?php if(isset($newDischargeData['anaesthetistSurgeon'][0]) && $newDischargeData['anaesthetistSurgeon'][0]->field_value == $value) { echo "selected";} ?>>{{$value}}</option>
				<?php } ?>
				
			 </select>
		
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='anaesthetistSurgeonbtn' class="btn btn-success  set-dropdown-options"  data-field_name="anaesthetistSurgeon" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='anaesthetistSurgeonbtnsave'>Save Option</button>
		</div>
	</div>
	<div id='anaesthetistSurgeonTextBoxesGroup' class="col-md-12">

	</div> 



	<!-- set-dropdown-options -->
	
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'anaesthetistSurgeon';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>
</div>

<script type="text/javascript">
	var anaesthetistSurgeoncnt = 1;
	$("#anaesthetistSurgeonbtn").click(function () {

		if(anaesthetistSurgeoncnt>10){
			swal("Only 10 Options Values are allow!");
			return false;
		}

		var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+anaesthetistSurgeoncnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="anaesthetistSurgeon"><input class="form-control"  type="hidden"  name="fieldName2" value="anaesthetistSurgeon"><input class="form-control"  type="text" id="optionsval'+anaesthetistSurgeoncnt+'" placeholder="value'+anaesthetistSurgeoncnt+'" name="optionsval[]"></div><span class="input-group-addon anaesthetistSurgeonremoveButton" type="button" id="anaesthetistSurgeonremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

		$("#anaesthetistSurgeonTextBoxesGroup").append(newTextBoxDiv);
		anaesthetistSurgeoncnt++;
	});

	$(document).on('click', '.anaesthetistSurgeonremoveButton', function(e) {
		anaesthetistSurgeoncnt--;
		var target = $("#anaesthetistSurgeonTextBoxesGroup").find("#TextBoxDiv" +anaesthetistSurgeoncnt);
		$(target).remove();
	});

	// ANTERIOR SEGMENT Add Option//
	$("#anaesthetistSurgeonbtnsave").click(function () {
		var content=$("#anaesthetistSurgeonTextBoxesGroup").val();
		if (isEmpty($('#anaesthetistSurgeonTextBoxesGroup'))) {
			swal({
				title: "Please Add Some Option by clicking on",
				text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
				html: true
			});
		} else {
			var data=$("#discharge_form").serialize();
			event.preventDefault();
			$.ajax({
				url:'{{ route("dynamic-field.insert") }}',
				method:'post',
				data:data,
				success:function(data) {
					swal({title: "Option For Anaesthetist Surgeon", text: "Added Successfully!", type: "success"},
						function() { 
							location.reload();
						}
					);
				}
			})
		}

	});

</script>
<!-- ================================================================================= -->  

<!-- ================================================================================= -->
<div id="anesthesia" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('anesthesia','Anesthesia') }} 
			</div>
		</div>

		<div class="col-md-6">
			<select class="form-control select2" data-live-search='true' name="anesthesia">
				<option>--Select--</option>
				<?php 
				//echo "<pre> =============";print_r($form_dropdowns->where('fieldName', 'anaesthetistSurgeon')->pluck('ddText','ddText')->toArray());exit;

				foreach ($form_dropdowns->where('fieldName', 'anesthesia')->pluck('ddText','ddText')->toArray() as $key => $value) { ?>
						<option value="{{$key}}" <?php if(isset($newDischargeData['anesthesia'][0]) && $newDischargeData['anesthesia'][0]->field_value == $value) { echo "selected";} ?>>{{$value}}</option>
				<?php } ?>
				
			 </select>

		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='anesthesiabtn' class="btn btn-success  set-dropdown-options"  data-field_name="anesthesia" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='anesthesiabtnsave'>Save Option</button>
		</div>
	</div>
	<div id='anesthesiaTextBoxesGroup' class="col-md-12">

	</div> 



	<!-- set-dropdown-options -->
	
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'anesthesia';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>
</div>

<script type="text/javascript">
	var anesthesiacnt = 1;
	$("#anesthesiabtn").click(function () {

		if(anesthesiacnt>10){
			swal("Only 10 Options Values are allow!");
			return false;
		}

		var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+anesthesiacnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="anesthesia"><input class="form-control"  type="hidden"  name="fieldName2" value="anesthesia"><input class="form-control"  type="text" id="optionsval'+anesthesiacnt+'" placeholder="value'+anesthesiacnt+'" name="optionsval[]"></div><span class="input-group-addon anesthesiaremoveButton" type="button" id="anesthesiaremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

		$("#anesthesiaTextBoxesGroup").append(newTextBoxDiv);
		anesthesiacnt++;
	});

	$(document).on('click', '.anesthesiaremoveButton', function(e) {
		anesthesiacnt--;
		var target = $("#anesthesiaTextBoxesGroup").find("#TextBoxDiv" +anesthesiacnt);
		$(target).remove();
	});

	// ANTERIOR SEGMENT Add Option//
	$("#anesthesiabtnsave").click(function () {
		var content=$("#anesthesiaTextBoxesGroup").val();
		if (isEmpty($('#anesthesiaTextBoxesGroup'))) {
			swal({
				title: "Please Add Some Option by clicking on",
				text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
				html: true
			});
		} else {
			var data=$("#discharge_form").serialize();
			event.preventDefault();
			$.ajax({
				url:'{{ route("dynamic-field.insert") }}',
				method:'post',
				data:data,
				success:function(data) {
					swal({title: "Option For Anesthesia", text: "Added Successfully!", type: "success"},
						function() { 
							location.reload();
						}
					);
				}
			})
		}

	});

</script>
<!-- ================================================================================= -->  

<!-- ================================================================================= -->
<!-- ================================================================================= -->

<div id="surgery" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('surgery','Surgery/Procedure') }} 
			</div>
			<input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-6">
			{{ Form::select('surgery[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery', $defaultValues)?$defaultValues['surgery']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='surgerysetbtn' class="btn btn-success set-dropdown-options"  data-field_name="surgery" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='surgerybtnsave'>Save Option</button>
			<button id="addsurgery" class="btn btn-default addmore" data-templateDiv="surgeryTemplate">Add</button>
		</div>
	</div>
	<div id='surgeryTextBoxesGroup' class="col-md-12"> </div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-6">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-2">
			<button class="removeDbItemSurgery btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<!-- ================================================================================= -->
<!-- ================================================================================= -->

<!-- ==================================================================================================================================== -->
<div classs="col-md-12">  </div>


  <script>

$(document).ready(function(){
	var surgerycnt = 1;
	$("#surgerysetbtn").click(function () {
      
  if(surgerycnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+surgerycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="surgery"><input class="form-control"  type="hidden"  name="fieldName2" value="surgery"><input class="form-control"  type="text" id="optionsval'+surgerycnt+'" placeholder="value'+surgerycnt+'" name="optionsval[]"></div><span class="input-group-addon surgeryremoveButton" type="button" id="surgeryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#surgeryTextBoxesGroup").append(newTextBoxDiv);
  surgerycnt++;
	});

$(document).on('click', '.surgeryremoveButton', function(e) {
surgerycnt--;
   var target = $("#surgeryTextBoxesGroup").find("#TextBoxDiv" +surgerycnt);
  $(target).remove();
});

$("#surgerybtnsave").click(function () {
        var content=$("#surgeryTextBoxesGroup").val();
        if (isEmpty($('#surgeryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#discharge_form").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Surgery", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
});
</script>
<!-- =============================================================================================================================== -->

<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group labelgrp">
						{{ Form::label('admission_reason','Reason of Admission') }}
					</div>
				</div>

				<div class="col-md-10">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('admission_reason', Request::old('admission_reason',$case_master->admission_reason), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
			</div> 

<!-- =============================================================================================================================== -->

			<div class="col-md-12">
				<!-- <div class="col-md-2">
					<div class="form-group labelgrp">
						{{ Form::label('patient_mobile','Tel.') }} 
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('patient_mobile', Request::old('patient_mobile',$case_master->patient_mobile), array('class' => 'form-control')) }}            
						</div>
					</div>
				</div>   -->

				<div class="col-md-3">
					<div class="form-group labelgrp">
						{{ Form::label('admission_date_time','Admission Date & Time') }} 
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('admission_date_time', Request::old('admission_date_time',$case_master['admission_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group labelgrp">
						{{ Form::label('surgery_date_time','Surgery Date & Time') }} 
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('surgery_date_time', Request::old('surgery_date_time',$case_master['surgery_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }} 
						</div>
					</div>
				</div>  
			</div>

			<div class="col-md-12">
				<div class="col-md-3">
					<div class="form-group labelgrp">
						{{ Form::label('discharge_date_time','Discharge Date & Time ') }}
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('discharge_date_time', Request::old('discharge_date_time',$case_master['discharge_date_time']), array('class' => 'form-control datetimepicker')) }}
						</div>
					</div>
				</div>
			</div>

<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group labelgrp">
						{{ Form::label('elective_emergency','Elective / Emergency') }}
					</div>
				</div>

				<div class="col-md-10">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('elective_emergency', Request::old('elective_emergency',$case_master->elective_emergency), array('class' => 'form-control')) }}
						</div>
					</div>
				</div>
			</div> 


			<!-- ==================================================================================================================================== -->
<div classs="col-md-12 dropdown-container">
    <span class="dropdown-container">
    <div id="discharge_iol_history" class="ContainerToAppend">
      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-3">
            <div class="form-group labelgrp">
              <label class="">Name of IOL</label> 
            </div>
            <input type="hidden" id="discharge_iolHistory[]" name="discharge_iolHistory[]" class="hiddenCounter" value="1" />  
          </div>

          <div class="col-md-4">
            {{ Form::select('discharge_iol[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_history')->pluck('ddText','ddText')->toArray(), array_key_exists('discharge_iol_history', $defaultValues)?$defaultValues['discharge_iol_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>

          <div class="col-md-5">
            <button type="button" name="add" id='discharge_iolsetbtn' class="btn btn-success set-dropdown-options" data-field_name="discharge_iol_history" data-form_name="EyeForm">Set Option </button>

            <button type='button' class="btn btn-primary" id='discharge_iolbtnsave'>Save Option</button>

            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="discharge_ioltemplate">Add</button>
          </div>
        </div>
        <div class="col-md-3">        </div>
      </div>
    </div>
    <div id='discharge_iolTextBoxesGroup' class="col-md-12">

    </div>
	<!-- set-dropdown-options -->
	
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'discharge_iol_history';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>    
     <div class="dbMultiEntryContainer">
		<?php if(isset($newDischargeData['discharge_iol'])) { ?>
       @foreach ($newDischargeData['discharge_iol'] as $item)
          <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" readonly value="{{$item->field_value}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="discharge_iol_history">Remove</button>
              </div>
          </div>
          @endforeach
		 <?php } ?>
		 
      </div>
    </span> 
    <div id="templateContainner" style="display:none">
      <div id="discharge_ioltemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="discharge_iolHistory[]" name="discharge_iolHistory[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                      {{ Form::select('discharge_iol[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_history')->pluck('ddText','ddText')->toArray(), array_key_exists('discharge_iol_history', $defaultValues)?$defaultValues['discharge_iol_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div>


  <script>

$(document).ready(function(){
	var discharge_iolcnt = 1;
	$("#discharge_iolsetbtn").click(function () {

	if(discharge_iolcnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+discharge_iolcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="discharge_iol_history"><input class="form-control"  type="text" id="optionsval'+discharge_iolcnt+'" placeholder="value'+discharge_iolcnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#discharge_iolTextBoxesGroup").append(newTextBoxDiv);
	discharge_iolcnt++;
	});

	$(document).on('click', '.systemichistoryremoveButton', function(e) {
discharge_iolcnt--;
var target = $("#discharge_iolTextBoxesGroup").find("#TextBoxDiv" +discharge_iolcnt);
$(target).remove();
});

$("#discharge_iolbtnsave").click(function () {
       
        var content=$("#discharge_iolTextBoxesGroup").val();
        if (isEmpty($('#discharge_iolTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#discharge_form").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For IOL", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
});
</script>
<!-- =============================================================================================================================== -->

<!-- ==================================================================================================================================== -->
<div classs="col-md-12 dropdown-container">
    <span class="dropdown-container">
    <div id="diagnosis_history" class="ContainerToAppend">
      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-3">
            <div class="form-group labelgrp">
              <label class="">Diagnosis</label> 
            </div>
            <input type="hidden" id="diagnosisHistory[]" name="diagnosisHistory[]" class="hiddenCounter" value="1" />  
          </div>

          <div class="col-md-4">
            {{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>

          <div class="col-md-5">
            <button type="button" name="add" id='diagnosissetbtn' class="btn btn-success set-dropdown-options" data-field_name="diagnosis_history" data-form_name="EyeForm">Set Option </button>

            <button type='button' class="btn btn-primary" id='diagnosisbtnsave'>Save Option</button>

            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="diagnosistemplate">Add</button>
          </div>
        </div>
        <div class="col-md-3">        </div>
      </div>
    </div>
    <div id='diagnosisTextBoxesGroup' class="col-md-12">

    </div>
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'diagnosis';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>    
     <div class="dbMultiEntryContainer">
		 <?php if(isset($newDischargeData['diagnosis'])) { ?>
       @foreach ($newDischargeData['diagnosis'] as $item)
          <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" readonly value="{{$item->field_value}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="diagnosis_history">Remove</button>
              </div>
          </div>
          @endforeach
		 <?php } ?>
      </div>
    </span> 
    <div id="templateContainner" style="display:none">
      <div id="diagnosistemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="diagnosisHistory[]" name="diagnosisHistory[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                      {{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div>


  <script>

$(document).ready(function(){
	var diagnosiscnt = 1;
	$("#diagnosissetbtn").click(function () {

	if(diagnosiscnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+diagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="diagnosis_history"><input class="form-control"  type="text" id="optionsval'+diagnosiscnt+'" placeholder="value'+diagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#diagnosisTextBoxesGroup").append(newTextBoxDiv);
	diagnosiscnt++;
	});

	$(document).on('click', '.systemichistoryremoveButton', function(e) {
diagnosiscnt--;
var target = $("#diagnosisTextBoxesGroup").find("#TextBoxDiv" +diagnosiscnt);
$(target).remove();
});

$("#diagnosisbtnsave").click(function () {
       
        var content=$("#diagnosisTextBoxesGroup").val();
        if (isEmpty($('#diagnosisTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#discharge_form").serialize();
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
});
</script>
<!-- =============================================================================================================================== -->

<!-- ==================================================================================================================================== -->
<div classs="col-md-12">
    <span class="dropdown-container">
    <div id="systemicDiseases_history" class="ContainerToAppend">
      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-3">
            <div class="form-group labelgrp">
              <label class="">Systemic Diseases</label> 
            </div>
            <input type="hidden" id="systemicDiseasesHistory[]" name="systemicDiseasesHistory[]" class="hiddenCounter" value="1" />  
          </div>

          <div class="col-md-4">
            {{ Form::select('systemicDiseases[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemicDiseases_history')->pluck('ddText','ddText')->toArray(), array_key_exists('systemicDiseases_history', $defaultValues)?$defaultValues['systemicDiseases_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>

          <div class="col-md-5">
            <button type="button" name="add" id='systemicDiseasessetbtn' class="btn btn-success set-dropdown-options" data-field_name="systemicDiseases_history" data-form_name="EyeForm">Set Option </button>

            <button type='button' class="btn btn-primary" id='systemicDiseasesbtnsave'>Save Option</button>

            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="systemicDiseasestemplate">Add</button>
          </div>
        </div>
        <div class="col-md-3">        </div>
      </div>
    </div>
    <div id='systemicDiseasesTextBoxesGroup' class="col-md-12">

    </div>
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'systemicDiseases_history';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>     
     <div class="dbMultiEntryContainer">
		 <?php if(isset($newDischargeData['systemicDiseases'])) { ?>
       @foreach ($newDischargeData['systemicDiseases'] as $item)
          <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" readonly value="{{$item->field_value}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="systemicDiseases_history">Remove</button>
              </div>
          </div>
          @endforeach
		 <?php } ?>
      </div>
    </span> 
    <div id="templateContainner" style="display:none">
      <div id="systemicDiseasestemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="systemicDiseasesHistory[]" name="systemicDiseasesHistory[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                      {{ Form::select('systemicDiseases[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemicDiseases_history')->pluck('ddText','ddText')->toArray(), array_key_exists('systemicDiseases_history', $defaultValues)?$defaultValues['systemicDiseases_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div>


  <script>

$(document).ready(function(){
	var systemicDiseasescnt = 1;
	$("#systemicDiseasessetbtn").click(function () {

	if(systemicDiseasescnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+systemicDiseasescnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="systemicDiseases_history"><input class="form-control"  type="text" id="optionsval'+systemicDiseasescnt+'" placeholder="value'+systemicDiseasescnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#systemicDiseasesTextBoxesGroup").append(newTextBoxDiv);
	systemicDiseasescnt++;
	});

	$(document).on('click', '.systemichistoryremoveButton', function(e) {
systemicDiseasescnt--;
var target = $("#systemicDiseasesTextBoxesGroup").find("#TextBoxDiv" +systemicDiseasescnt);
$(target).remove();
});

$("#systemicDiseasesbtnsave").click(function () {
       
        var content=$("#systemicDiseasesTextBoxesGroup").val();
        if (isEmpty($('#systemicDiseasesTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#discharge_form").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Systemic Diseases", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
});
</script>
<!-- =============================================================================================================================== -->

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('general_condition','General Condition') }}
		</div>
	</div>

	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('general_condition', Request::old('general_condition',$discharge->general_condition), array('class' => 'form-control')) }}
			</div>
		</div>
	</div>
</div>


<!-- ==================================================================================================================================== -->
<div classs="col-md-12">
    <span class="dropdown-container">
    <div id="operationNotes_history" class="ContainerToAppend">
      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-3">
            <div class="form-group labelgrp">
              <label class="">Operation Notes</label> 
            </div>
            <input type="hidden" id="operationNotesHistory[]" name="operationNotesHistory[]" class="hiddenCounter" value="1" />  
          </div>

          <div class="col-md-4">
            {{ Form::select('operationNotes[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'operationNotes_history')->pluck('ddText','ddText')->toArray(), array_key_exists('operationNotes_history', $defaultValues)?$defaultValues['operationNotes_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>

          <div class="col-md-5">
            <button type="button" name="add" id='operationNotessetbtn' class="btn btn-success set-dropdown-options" data-field_name="operationNotes_history" data-form_name="EyeForm">Set Option </button>

            <button type='button' class="btn btn-primary" id='operationNotesbtnsave'>Save Option</button>

            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="operationNotestemplate">Add</button>
          </div>
        </div>
        <div class="col-md-3">        </div>
      </div>
    </div>
    <div id='operationNotesTextBoxesGroup' class="col-md-12">

    </div>
  	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'systemicDiseases_history';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>       
     <div class="dbMultiEntryContainer">
		 <?php if(isset($newDischargeData['operationNotes'])) { ?>
       @foreach ($newDischargeData['operationNotes'] as $item)
          <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" readonly value="{{$item->field_value}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="operationNotes_history">Remove</button>
              </div>
          </div>
          @endforeach
		 <?php } ?>
      </div>
    </span> 
    <div id="templateContainner" style="display:none">
      <div id="operationNotestemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="operationNotesHistory[]" name="operationNotesHistory[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                      {{ Form::select('operationNotes[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'operationNotes_history')->pluck('ddText','ddText')->toArray(), array_key_exists('operationNotes_history', $defaultValues)?$defaultValues['operationNotes_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div>


  <script>

$(document).ready(function(){
	var operationNotescnt = 1;
	$("#operationNotessetbtn").click(function () {

	if(operationNotescnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+operationNotescnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="operationNotes_history"><input class="form-control"  type="text" id="optionsval'+operationNotescnt+'" placeholder="value'+operationNotescnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#operationNotesTextBoxesGroup").append(newTextBoxDiv);
	operationNotescnt++;
	});

	$(document).on('click', '.systemichistoryremoveButton', function(e) {
operationNotescnt--;
var target = $("#operationNotesTextBoxesGroup").find("#TextBoxDiv" +operationNotescnt);
$(target).remove();
});

$("#operationNotesbtnsave").click(function () {
       
        var content=$("#operationNotesTextBoxesGroup").val();
        if (isEmpty($('#operationNotesTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#discharge_form").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Operation Notes", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
});
</script>
<!-- =============================================================================================================================== -->

<!-- ==================================================================================================================================== -->
<div classs="col-md-12">
    <span class="dropdown-container">
    <div id="advice_history" class="ContainerToAppend">
      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-3">
            <div class="form-group labelgrp">
              <label class="">Advice</label> 
            </div>
            <input type="hidden" id="adviceHistory[]" name="adviceHistory[]" class="hiddenCounter" value="1" />  
          </div>

          <div class="col-md-4">
            {{ Form::select('advice[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'advice_history')->pluck('ddText','ddText')->toArray(), array_key_exists('advice_history', $defaultValues)?$defaultValues['advice_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>

          <div class="col-md-5">
            <button type="button" name="add" id='advicesetbtn' class="btn btn-success set-dropdown-options" data-field_name="advice_history" data-form_name="EyeForm">Set Option </button>

            <button type='button' class="btn btn-primary" id='advicebtnsave'>Save Option</button>

            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="advicetemplate">Add</button>
          </div>
        </div>
        <div class="col-md-3">        </div>
      </div>
    </div>
    <div id='adviceTextBoxesGroup' class="col-md-12">

    </div>
 	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'advice_history';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>     
     <div class="dbMultiEntryContainer">
		<?php if(isset($newDischargeData['advice'])) { ?>
       @foreach ($newDischargeData['advice'] as $item)
          <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" readonly value="{{$item->field_value}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="advice_history">Remove</button>
              </div>
          </div>
          @endforeach
		 <?php } ?>
      </div>
    </span> 
    <div id="templateContainner" style="display:none">
      <div id="advicetemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="adviceHistory[]" name="adviceHistory[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                      {{ Form::select('advice[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'advice_history')->pluck('ddText','ddText')->toArray(), array_key_exists('advice_history', $defaultValues)?$defaultValues['advice_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div>


  <script>

$(document).ready(function(){
	var advicecnt = 1;
	$("#advicesetbtn").click(function () {

	if(advicecnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+advicecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="advice_history"><input class="form-control"  type="text" id="optionsval'+advicecnt+'" placeholder="value'+advicecnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#adviceTextBoxesGroup").append(newTextBoxDiv);
	advicecnt++;
	});

	$(document).on('click', '.systemichistoryremoveButton', function(e) {
advicecnt--;
var target = $("#adviceTextBoxesGroup").find("#TextBoxDiv" +advicecnt);
$(target).remove();
});

$("#advicebtnsave").click(function () {
       
        var content=$("#adviceTextBoxesGroup").val();
        if (isEmpty($('#adviceTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#discharge_form").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Advice", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
});
</script>
<!-- =============================================================================================================================== -->

<!-- ==================================================================================================================================== -->
<div classs="col-md-12">
    <span class="dropdown-container">
    <div id="surgicalStepsNotes_history" class="ContainerToAppend">
      <div class="col-md-12">
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group labelgrp">
              <label class="">Surgical Steps Notes</label> 
            </div>
            <input type="hidden" id="surgicalStepsNotesHistory[]" name="surgicalStepsNotesHistory[]" class="hiddenCounter" value="1" />  
          </div>

          <div class="col-md-5">
            {{ Form::select('surgicalStepsNotes[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgicalStepsNotes_history')->pluck('ddText','ddText')->toArray(), array_key_exists('surgicalStepsNotes_history', $defaultValues)?$defaultValues['surgicalStepsNotes_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>

          <div class="col-md-4">
            <button type="button" name="add" id='surgicalStepsNotessetbtn' class="btn btn-success set-dropdown-options" data-field_name="surgicalStepsNotes_history" data-form_name="EyeForm">Set Option </button>

            <button type='button' class="btn btn-primary" id='surgicalStepsNotesbtnsave'>Save Option</button>

            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="surgicalStepsNotestemplate">Add</button>
          </div>
        </div>
        <!-- <div class="col-md-3">        </div> -->
      </div>
    </div>
    <div id='surgicalStepsNotesTextBoxesGroup' class="col-md-12">

    </div>
 	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
		@php 
		$dropdown_options_field_name = 'surgicalStepsNotes_history';
		$dropdown_options_form_name = 'EyeForm';
		@endphp
	</div>      
     <div class="dbMultiEntryContainer">
		 <?php if(isset($newDischargeData['surgicalStepsNotes'])) { ?>
       @foreach ($newDischargeData['surgicalStepsNotes'] as $item)
          <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
              <input type="text" class="form-control" readonly value="{{$item->field_value}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="surgicalStepsNotes_history">Remove</button>
              </div>
          </div>
          @endforeach
		 <?php } ?>
      </div>
    </span> 
    <div id="templateContainner" style="display:none">
      <div id="surgicalStepsNotestemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="surgicalStepsNotesHistory[]" name="surgicalStepsNotesHistory[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                      {{ Form::select('surgicalStepsNotes[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgicalStepsNotes_history')->pluck('ddText','ddText')->toArray(), array_key_exists('surgicalStepsNotes_history', $defaultValues)?$defaultValues['surgicalStepsNotes_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div>

  <script>

$(document).ready(function(){
	var surgicalStepsNotescnt = 1;
	$("#surgicalStepsNotessetbtn").click(function () {

	if(surgicalStepsNotescnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+surgicalStepsNotescnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="surgicalStepsNotes_history"><input class="form-control"  type="text" id="optionsval'+surgicalStepsNotescnt+'" placeholder="value'+surgicalStepsNotescnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#surgicalStepsNotesTextBoxesGroup").append(newTextBoxDiv);
	surgicalStepsNotescnt++;
	});

	$(document).on('click', '.systemichistoryremoveButton', function(e) {
surgicalStepsNotescnt--;
var target = $("#surgicalStepsNotesTextBoxesGroup").find("#TextBoxDiv" +surgicalStepsNotescnt);
$(target).remove();
});

$("#surgicalStepsNotesbtnsave").click(function () {
       
        var content=$("#surgicalStepsNotesTextBoxesGroup").val();
        if (isEmpty($('#surgicalStepsNotesTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#discharge_form").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Surgical Steps Notes", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
});
</script>
<!-- =============================================================================================================================== -->

<!-- =============================================================================================================================== -->


			<div class="col-md-12">
				<div class="col-md-2">
					<div class="form-group">
						{{ Form::label('followup','Followup') }}  
					</div> 
				</div> 
				<div class="col-md-4" id="appointment_append_div">
					<div class="form-group">
						<div class="form-line" id="datepicker_clone">
							{{ Form::text('appointment_date', Request::old('appointment_date',''), array('class' => 'form-control datepicker', 'autocomplete'=>'off', 'id' => 'appointment_dt')) }}
						</div> 
												
					</div> 

					@foreach($appointment as $value)
						<div class="row">
							<div class="col-md-12"><div class="col-md-8"> 
								<input class="form-control" type="text" name="appointment_date" autocomplete="off" value="{{$value->date}}" readonly></div>
							<div class="col-md-4"><span class="btn btn-danger removeDbItemAppointment" data-id="{{$value->id}}">Remove</span></div>
							</div>
					</div>
					 @endforeach
				</div>
<!-- 				<div class="col-md-2">
					<button type="button" name="btn_add" id="btn_add_more" class="btn btn-danger" value="">Add</button>
				</div> -->
<!-- 				<div class="col-md-2">
					<div class="form-group">
					{{ Form::label('followup','Image Upload') }}  
					</div> 
				</div>  
				<div class="col-md-4">
					<div class="form-group">
						<div class="form-line">
							{{ Form::file('dischargeimg', Request::old('dischargeimg'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }}
						</div> 
					</div> 
				</div>
			</div>-->

			<div class="col-md-12">
			<label class="form-label">
			In case of Emergency : 1. Severe Redness/watering pain or 2. Sudden diminished vision
			Pls. contact : 8055821212 ( Dr. Sandeep C. Joshi)                           
			</label>
			</div>


			<div class="col-md-12">
			<div class="col-md-9 col-md-offset-3">
			<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
			</button>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/discharge') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/discharge/print/1').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
			</div>
			</div> 
		</div>
	</form> 
	

</div>                             
  
</div>
@include('shared.add_prescription', ['id'=>$case_master->id])

{{-- @include('shared.add_appointment_multi', ['id'=>$case_master->id]) --}}

</div>
</div>
</div>


<script>

    $(".removeDbItemSurgery").click(function(e) {
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
					/*
					swal({title: "Deleted", text: "Successfully!!!", type: "success"},
						function(){ 
							location.reload();
						}
					);
					*/
				}).error(function(){
				$(ClickedButton).button('reset');
				});

				 location.reload();
			});
			e.preventDefault();

        });        

   $(".removeDbItem").click(function(e) {
      var ClickedButton = $(this);
      var containerDiv = $(this).closest('div.form-group.row');

      swal({
        title: "Are you sure?",
        text: "This Will Remove !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      }, function () {
          
        $.ajax({ url: '{{ url("dischargedeleteField") }}',
          method:'POST',
          data: {
            _token :$("input[name='_token'][type='hidden']").val(),
            id : $(ClickedButton).data('deleteid'),
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


function isEmpty( el ){
      return !$.trim(el.html())
  }
$('.addmore').click(function(e) {
	e.preventDefault();
	var template = $("#"+$(this).data('templatediv')).clone();
	
	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
	
	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
	
});
	$("#btn_add_more").click(function(){
		//alert($('.radio-col-teal:checked').val());
		alert("click");
		var html = '<div class="row"><div class="col-md-12"> <input type="hidden" name="appointment_id[]" readonly value="">'; 
		html += '<input class="form-control datepicker" type="text" name="appointment_date[]" autocomplete="off"></div>';

		$('#appointment_append_div').append($("#datepicker_clone").clone());

	});
	
	$(document).ready(function(){
            $("#appointment_dt").on('change.dp', function (e) {
               
              	
                var appointment_dt = $("#appointment_dt").val();
                //alert(appointment_dt);
                $("#appointment_dt").val('');
				$('#selected_date').html(appointment_dt);
		 		var html = '<div class="row"><div class="col-md-12"><div class="col-md-8"> <input type="hidden" name="appointment_id[]" readonly value="">'; 
				html += '<input class="form-control" type="text" name="appointment_date[]" autocomplete="off" value="'+appointment_dt+'" readonly></div>';
				html += '<div class="col-md-4"><span class="btn btn-danger remove-date">Remove</span></div></div>';              
		             
               $('#appointment_append_div').append(html);
             
            });

            
            $(document).on('click', '.remove-date', function() {
            	//alert("In date");
            	$(this).parent().parent().hide();
            })

      $(".removeDbItemAppointment").click(function(e) {
          var ClickedButton = $(this);
          var id = $(this).attr('data-id');
          alert(" class name is"+id)

          swal({
            title: "Are you sure?",
            text: "This Will Remove !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          }, function () {
              
            $.ajax({ url: '{{ url("deleteAppointment") }}',
              method:'POST',
              data: {
                _token :$("input[name='_token'][type='hidden']").val(),
                id : id,
              }
            })
            .success(function() {
             // $(containerDiv).remove();
             // $(ClickedButton).button('reset');
             
              swal({title: "Deleted", text: "Successfully!!!", type: "success"},
                function(){ 
                 // location.reload();
                 ClickedButton.parent().parent().hide();
                }
              );
            }).error(function(){
            $(ClickedButton).button('reset');
            });

            // location.reload();
          });
          e.preventDefault();

            });        
    });
</script>
<!-- ==================================== Update dropdown options ================================================ -->
<script>
		$(document).on('click','.set-dropdown-options',function() {
			var table_name = $(this).data('table_name');
			var form_name = $(this).data('form_name');
			var field_name = $(this).data('field_name');
			
			var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

			var url = "{{route('get-update-dropdown-options')}}";
			if(table_name == "medical_store") {
				
			}

			$.ajax({
				url: url,
				method:'post',
				data:{'table_name': table_name, 'form_name': form_name,'form_field': field_name},
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

		$(document).on('click','.update-dropdown-options-btn',function() {
			//alert('clicked');

			var clicked_element = $(this);

			var form_target = $(this).closest('.update-dropdown-options-form');

			var id = form_target.attr('id');
			var table_name = $(this).data('table_name');

			var form_data = $('#'+ id +' :input').serialize();

			var url = "{{route('update-dropdown-options')}}";
			if(table_name == "medical_store") {
				
			}

			//alert(table_name);

			$.ajax({
				url: url,
				method:'post',
				data:{'form_data': form_data},
				datatype: 'json',
				success:function(response) {
					console.log(response);

					location.reload();
					
					clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
				}
			});
		});

		$(document).on('click','.remove-initial-options',function() {
			$(this).closest('.initial_options').remove();
		});

$(document).on('click','.cancel-dropdown-options-btn',function() {
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').hide();
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').html('');
});


</script>
@endsection


