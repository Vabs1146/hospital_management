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
@endsection
@section('content')
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
          <form action="{{ url('/Patients/save-discharge') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Add/Edit discharge </h2>
          </div>
           <input type="hidden" id="id" name="discharge_id" value="{{ isset($discharge_data->id) ? $discharge_data->id : ''}}" >
              <div class="body">
                  <div class="row clearfix ">

				  <input type="hidden" name="registration_id" value="{{$registration_data->id}}">


				  <!-- =================================================================================== -->
<h1>General Information</h1>
<div class="col-md-12">

						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">UHID No.  :</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control" id="uhid_no" name="uhid_no" value="{{$registration_data->uhid_number}}" type="text">
							</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">IPD No. :</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control" id="ipd_no" name="ipd_no" value="{{$registration_data->ipd_number}}" type="text">
							</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Date & Time :</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{isset($discharge_data->discharge_summary_date_time)? $discharge_data->discharge_summary_date_time : ''}}" type="text">
							</div>
							</div>
						</div>
					</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Name <b class="star">*</b> :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_name', $registration_data->first_name, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'First Name ','id'=>'patient_name', 'required')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_middle_name', $registration_data->middle_name, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Middle Name','id'=>'patient_middle_name')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_last_name', $registration_data->last_name, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Surname','id'=>'patient_last_name')) }}                          
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<!-- <div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="dob" class="form-control"> Date of Birth :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				<input type="text" class="form-control datepicker_formatted" id="date_of_birth" name="date_of_birth" placeholder="Select Date." value="{{$registration_data->date_of_birth}}">                           
			</div>
		</div>
	</div> -->

	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Age :</label>
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_age', $registration_data->age, array('id'=>'patient_age','class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label class="form-control">Gender :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="demo-radio-button" style="padding-top: 6px">
			<input type="radio" name="gender" id="gender_male" value="Male" {{ ($registration_data->gender == 'Male') ? 'checked' : '' }} />
			<label for="gender_male">Male</label>
			<input type="radio" name="gender" id="gender_female" value="Female" {{ ($registration_data->gender == 'Female') ? 'checked' : '' }} />
			<label for="gender_female">Female</label>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="address" class="form-control">Address :</label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('address', $registration_data->address, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Address','id'=>'address')) }}                          
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="primary_consultant" class="form-control">Primary Consultant :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			<select name="primary_consultant" class="form-control">
				<option value="">Select Doctor</option>
				@foreach($all_doctors as $all_doctor_key => $all_doctor)
					<option value="{{$all_doctor_key}}" {{ (isset($discharge_summary['primary_consultant']) && $discharge_summary['primary_consultant']->value_1 == $all_doctor_key) ? 'selected' : ''}}>{{$all_doctor}}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">	
	<div class="col-md-3">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Date of Admission & Time :</label>
		</div>
	</div>
	@php
	$admission_date_time = isset($discharge_summary['admission_date_time']) ? $discharge_summary['admission_date_time']->value_1 : '';
	@endphp
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('admission_date_time', Request::old('admission_date_time', $admission_date_time), array('class' => 'form-control datetimepicker')) }}  
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Discharge Date & Time :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line"> 
	@php
	$discharge_date_time = isset($discharge_summary['discharge_date_time']) ? $discharge_summary['discharge_date_time']->value_1 : '';
	@endphp
			{{ Form::text('discharge_date_time', Request::old('discharge_date_time', $discharge_date_time), array('class' => 'form-control datetimepicker')) }}  
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('diagnosis','Diagnosis') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
	@php
	$diagnosis = isset($discharge_summary['diagnosis']) ? $discharge_summary['diagnosis']->value_1 : '';
	@endphp
				{{ Form::textarea('diagnosis', Request::old('diagnosis', $diagnosis), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                        
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="discharge_against_medical_advice" class="form-control">Discharge Against Medical Advice :</label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
	@php
	$discharge_against_medical_advice = isset($discharge_summary['discharge_against_medical_advice']) ? $discharge_summary['discharge_against_medical_advice']->value_1 : '';
	@endphp
				{{ Form::text('discharge_against_medical_advice', $discharge_against_medical_advice, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Discharge Against Medical Advice','id'=>'discharge_against_medical_advice')) }}                          
			</div>
		</div>
	</div>
</div>

<h1>Clinical Examination </h1>


<div class="col-md-12" style="background: white;">
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">BP :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
	@php
	$bp_1 = isset($discharge_summary['bp_1']) ? $discharge_summary['bp_1']->value_1 : '';
	@endphp
	@php
	$bp_2 = isset($discharge_summary['bp_2']) ? $discharge_summary['bp_2']->value_1 : '';
	@endphp
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('bp_1', $bp_1, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'bp_1')) }}                          
			</div>
			/
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('bp_2', $bp_2, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'bp_2')) }}                          
			</div>
			MMHG 
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Pulse  :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
	@php
	$pulse_1 = isset($discharge_summary['pulse_1']) ? $discharge_summary['pulse_1']->value_1 : '';
	@endphp
	@php
	$pulse_2 = isset($discharge_summary['pulse_2']) ? $discharge_summary['pulse_2']->value_1 : '';
	@endphp
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('pulse_1', $pulse_1, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'pulse_1')) }}                          
			</div>
			/
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('pulse_2', $pulse_2, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'pulse_2')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">R.R  :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
	@php
	$rr_1 = isset($discharge_summary['rr_1']) ? $discharge_summary['rr_1']->value_1 : '';
	@endphp
	@php
	$rr_2 = isset($discharge_summary['rr_2']) ? $discharge_summary['rr_2']->value_1 : '';
	@endphp
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('rr_1', $rr_1, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'rr_1')) }}                          
			</div>
			/
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('rr_2', $rr_2, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'rr_2')) }}  
			</div>
		</div>
	</div>
</div>
	@php
	$rs = isset($discharge_summary['rs']) ? $discharge_summary['rs']->value_1 : '';
	@endphp
	@php
	$temperature = isset($discharge_summary['temperature']) ? $discharge_summary['temperature']->value_1 : '';
	@endphp
	@php
	$cvs = isset($discharge_summary['cvs']) ? $discharge_summary['cvs']->value_1 : '';
	@endphp

<div class="col-md-12" style="background: white;">
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">RS :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('rs', $rs, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'rs')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Temperature :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('temperature', $temperature, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'temperature')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">CVS :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line" >
				{{ Form::text('cvs', $cvs, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'cvs')) }}                          
			</div>
		</div>
	</div>
</div>
	@php
	$consulting_doctor = isset($discharge_summary['consulting_doctor']) ? $discharge_summary['consulting_doctor']->value_1 : '';
	@endphp

<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Consulting Doctor :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{-- Form::text('consulting_doctor', Request::old('consulting_doctor', $registration_data->consulting_doctor), array('class' => 'form-control')) --}} 
			
			<select name="consulting_doctor" class="form-control">
				<option value="">Select Doctor</option>
				@foreach($all_doctors as $all_doctor_key => $all_doctor)
					<option value="{{$all_doctor_key}}" {{ ($consulting_doctor == $all_doctor_key) ? 'selected' : ''}}>{{$all_doctor}}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>
</div>
				 <!--  ===================================================================================== -->
	@php
	$history_of_present_illness = isset($discharge_summary['history_of_present_illness']) ? $discharge_summary['history_of_present_illness']->value_1 : '';
	@endphp

	@php
	$chief_complaints = isset($discharge_summary['chief_complaints']) ? $discharge_summary['chief_complaints']->value_1 : '';
	@endphp
	
	@php
	$medical = isset($discharge_summary['medical']) ? $discharge_summary['medical']->value_1 : '';
	@endphp

	@php
	$surgical = isset($discharge_summary['surgical']) ? $discharge_summary['surgical']->value_1 : '';
	@endphp
	
	@php
	$course_in_hospital = isset($discharge_summary['course_in_hospital']) ? $discharge_summary['course_in_hospital']->value_1 : '';
	@endphp

	@php
	$hemodynamic_condition = isset($discharge_summary['hemodynamic_condition']) ? $discharge_summary['hemodynamic_condition']->value_1 : '';
	@endphp
	
	@php
	$discharge_temperature = isset($discharge_summary['discharge_temperature']) ? $discharge_summary['discharge_temperature']->value_1 : '';
	@endphp

	@php
	$discharge_pulse_1 = isset($discharge_summary['discharge_pulse_1']) ? $discharge_summary['discharge_pulse_1']->value_1 : '';
	@endphp
	
	@php
	$discharge_pulse_2 = isset($discharge_summary['discharge_pulse_2']) ? $discharge_summary['discharge_pulse_2']->value_1 : '';
	@endphp

	@php
	$discharge_bp_1 = isset($discharge_summary['discharge_bp_1']) ? $discharge_summary['discharge_bp_1']->value_1 : '';
	@endphp


	@php
		$target_elements = ['discharge_bp_2', 'discharge_rr_1', 'discharge_rr_2', 'diet', 'treatment_advice',
		 'treatment_on_discharge',
		 'consult_symptoms',
		 'final_notes',
		 'followup_1',
		 'followup_2',
		 'followup_3',
		 'followup_4'
		 ];

		foreach($target_elements as $target_elements_val) {
			${$target_elements_val} = isset($discharge_summary[$target_elements_val]) ? $discharge_summary[$target_elements_val]->value_1 : '';
		}
	@endphp
                          
 <h1>History of Present Illness</h1>                          
<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('chief_complaints','Chef Complaints') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('chief_complaints', Request::old('chief_complaints', $chief_complaints), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('history_of_present_illness','History of Present Illness') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('history_of_present_illness', Request::old('history_of_present_illness',$history_of_present_illness), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

 <h1>Past History</h1>   
<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('medical','Medical') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('medical', Request::old('medical',$medical), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('surgical','Surgical') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('surgical', Request::old('surgical', $surgical), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

 <h1>Course in The Hospital & Discussion</h1>   
<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('course_in_hospital','Course in The Hospital ') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('course_in_hospital', Request::old('course_in_hospital', $course_in_hospital), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<!-- <div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('history_clinical_findings','History & Clinical Findings') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('history_clinical_findings', Request::old('history_clinical_findings',isset($discharge_data->history_clinical_findings) ? $discharge_data->history_clinical_findings : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div> -->
 <h1>Patient`s Condition on Discharge </h1>   
<div class="col-md-12" style="background: white;">
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Hemodynamic Condition  :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('hemodynamic_condition', $hemodynamic_condition, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'hemodynamic_condition')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Temperature :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('discharge_temperature', $discharge_temperature, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'discharge_temperature')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Pulse  :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('discharge_pulse_1', $discharge_pulse_1, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'discharge_pulse_1')) }}                          
			</div>
			/
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('discharge_pulse_2', $discharge_pulse_2, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'discharge_pulse_2')) }}                          
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">BP :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('discharge_bp_1', $discharge_bp_1, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'discharge_bp_1')) }}                          
			</div>
			/
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('discharge_bp_2', $discharge_bp_2, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'discharge_bp_2')) }}                          
			</div>
			MMHG 
		</div>
	</div>
	
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">R.R  :</label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('discharge_rr_1', $discharge_rr_1, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'discharge_rr_1')) }}                          
			</div>
			/
			<div class="form-line" style="width:50px;    display: inline-block;">
				{{ Form::text('discharge_rr_2', $discharge_rr_2, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'','id'=>'discharge_rr_2')) }}  
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('diet','Diet ') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('diet', Request::old('diet', $diet), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>


<!-- <div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('on_examination','On Examination') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('on_examination', Request::old('on_examination',isset($discharge_data->on_examination) ? $discharge_data->on_examination: ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('operative_procedure','Operative Procedure') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('operative_procedure', Request::old('operative_procedure',isset($discharge_data->operative_procedure) ? $discharge_data->operative_procedure : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('investigation','Investigation') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('investigation', Request::old('investigation', isset($discharge_data->investigation) ? $discharge_data->investigation : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('surgical_maternity_notes','Surgical / Maternity Notes') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('surgical_maternity_notes', Request::old('surgical_maternity_notes', isset($discharge_data->surgical_maternity_notes) ? $discharge_data->surgical_maternity_notes : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div> -->

<!-- <div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('treatment_given','Treatment Given') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('treatment_given', Request::old('treatment_given',isset($discharge_data->treatment_given) ? $discharge_data->treatment_given : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('treatment_advice','Treatment Advice') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('treatment_advice', Request::old('treatment_advice',isset($discharge_data->treatment_advice) ? $discharge_data->treatment_advice : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('treatment_on_discharge','Treatment On Discharge') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('treatment_on_discharge', Request::old('treatment_on_discharge',isset($discharge_data->treatment_on_discharge) ? $discharge_data->treatment_on_discharge : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div> -->
<h1>Instruction on Discharge</h1>
<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('treatment_advice','Please come to the hospital or contact your doctor immediately if') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('treatment_advice', Request::old('treatment_advice', $treatment_advice), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('consult_symptoms','In case of following (as applicable) please consult your doctor immediately') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('consult_symptoms', Request::old('consult_symptoms', $consult_symptoms), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">Follow-up :</label>
		</div>
	</div>
	</div>
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<!-- <label class="form-control">Follow-up :</label> -->
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datepicker" id="followup_1" placeholder="Follow up 1" name="followup_1" value="{{$followup_1}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datepicker" id="followup_2" placeholder="Follow up 2" name="followup_2" value="{{$followup_2}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datepicker" id="followup_3" placeholder="Follow up 3" name="followup_3" value="{{$followup_3}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datepicker" id="followup_4" placeholder="Follow up 4" name="followup_4" value="{{$followup_4}}" type="text">
		</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('final_notes','Notes') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('final_notes', Request::old('final_notes', $final_notes), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>
          
                  </div>    

<div class="row clearfix">
	<div class="col-md-8 col-md-offset-2">
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
			<i class="fa fa-plus"></i> Submit
			</button>

			<a class="btn btn-info btn-lg" href="{{ url('/patients-listing') }}">Back</a>

			<a class="btn btn-default btn-lg" href="{{ url('/patients/discharge/print').'/'.$registration_data->id  }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>

			
		</div>
	</div>
</div>
                </div>
           </form>
           @include('patients.prescriptions.medicine_prescription')
            </div>
        </div>
</div>
</div>

 

  @endsection
  @section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>


<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
     <script type="text/javascript">
       $(document).ready(function() {
       });
       $(".select2").select2();
     </script>
  @endsection  