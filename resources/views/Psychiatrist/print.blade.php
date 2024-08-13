<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{url('/')}}/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
@media print {

[class*="col-sm-"] {
  float: left;
}

[class*="col-xs-"] {
  float: left;
}

[class*="col-md-"] {
  float: left;
}

.col-sm-12, .col-xs-12 {
  width:100% !important;
}

.col-sm-11, .col-xs-11 {
  width:91.66666667% !important;
}

.col-sm-10, .col-xs-10 {
  width:83.33333333% !important;
}

.col-sm-9, .col-xs-9 {
  width:75% !important;
}

.col-sm-8, .col-xs-8 {
  width:66.66666667% !important;
}

.col-sm-7, .col-xs-7 {
  width:58.33333333% !important;
}

.col-sm-6, .col-xs-6, .col-md-6 {
  width:50% !important;
}

.col-sm-5, .col-xs-5 {
  width:41.66666667% !important;
}

.col-sm-4, .col-xs-4 {
  width:33.33333333% !important;
}

.col-sm-3, .col-xs-3 {
  width:25% !important;
}

.col-sm-2, .col-xs-2 {
  width:16.66666667% !important;
}

.col-sm-1, .col-xs-1 {
  width:8.33333333% !important;
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
  font-size: 13px;
}

a[href]:after {
  content: none;
}

.noprint {
	display:none !important;	
}


.labelgrp {
    text-align: left !important;
}

.form-control {
	border:none;
	border-bottom:1px solid;
	box-shadow:none;
}

table{
	width:100%;
}

table {
	border: solid white !important;
	border-width: 1px 0 0 1px !important;
	border-bottom-style: none;
}

th, td {
	border: solid white !important;
	border-width: 0 1px 1px 0 !important;
	border-bottom-style: none;
} 

#installment_details table, #installment_details tr, #installment_details td, #installment_details th {
	border:1px solid black !important;
} 
#installment_details td {
	height:20px;
}

#installment_details th {
	text-align:center;
	height:30px;
}
}


.form-control {
	border:none;
	border-bottom:1px solid;
	box-shadow:none;
}

table{
	width:100%;
}

table {
	border: solid white !important;
	border-width: 1px 0 0 1px !important;
	border-bottom-style: none;
}

th, td {
	border: solid white !important;
	border-width: 0 1px 1px 0 !important;
	border-bottom-style: none;
} 

#installment_details table, #installment_details tr, #installment_details td, #installment_details th {
	border:1px solid black !important;
} 
#installment_details td {
	height:20px;
}

#installment_details th {
	text-align:center;
	height:30px;
}
	
</style>
       
          <div class="container-fluid">
           
            <div class="clearfix"></div>
            

            <div class="row print_div">
              <div class=" col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
				  
				  
<div class="col-sm-12">
	<div class="col-sm-2">
	<label class="labelgrp">Patient Reg.</label> 
	</div>
	<div class="col-sm-4">
	
	</div>
	<div class="col-sm-2">
	<label class="labelgrp">Date.</label> 
	</div>
	<div class="col-sm-4">
	
	</div>
</div>
                    
			
<div style="width: 100%;height: 20px;display: inline-block;"></div> 		
<div style="border:1px solid; border-radius:5px;display: inline-block;">

<div style="width: 100%;height: 25px;display: inline-block;"></div> 
<div class="col-sm-12">
	<div class="col-sm-2">
	<label class="labelgrp">Name:</label> 
	</div>
	<div class="col-sm-10">
		{{ Form::text('patient_education', $casedata->patient_name, array('class'=> 'form-control', 'placeholder'=> 'education', 'autocomplete'=>'off', 'style'=> 'width:100%')) }}
	</div>
</div>

<div class="col-sm-12">
	<div class="col-sm-2">
	<label class="labelgrp">Age/Sex:</label> 
	</div>
	<div class="col-sm-10">
		{{ Form::text('patient_education', $casedata['patient_age'] .' '.$casedata['male_female'], array('class'=> 'form-control', 'placeholder'=> 'education', 'autocomplete'=>'off', 'style'=> 'width:100%')) }}
	</div>
</div>

<div class="col-sm-12">
	<div class="col-sm-2">
	<label class="labelgrp">Address:</label> 
	</div>
	<div class="col-sm-10">
		{{ Form::text('patient_education', $casedata['address'], array('class'=> 'form-control', 'placeholder'=> '', 'autocomplete'=>'off', 'style'=> 'width:100%')) }}
	</div>
</div>

<div class="col-md-12">
<br>
	<div class="col-md-4">
		<label class="labelgrp">Education:</label> 
		{{ Form::text('patient_education', isset($psychiatrist->patient_education) ? $psychiatrist->patient_education : '', array('class'=> 'form-control', 'placeholder'=> 'education', 'autocomplete'=>'off', 'style'=> 'width:100px; display:inline-block;')) }}
	</div>
	<div class="col-md-4">
		<label class="labelgrp">Profession/Occupation:</label> 
		{{ Form::text('patient_occupation', isset($psychiatrist->patient_occupation) ? $psychiatrist->patient_occupation : '', array('class'=> 'form-control', 'placeholder'=> 'profession/occupation', 'autocomplete'=>'off', 'style'=> 'width:100px; display:inline-block;')) }}
	</div>
	<div class="col-md-2">
		<label class="labelgrp">Contact No.:</label> 
		{{ Form::text('patient_contact_number', isset($psychiatrist->patient_contact_number) ? $psychiatrist->patient_contact_number : '', array('class'=> 'form-control', 'placeholder'=> 'contact number', 'autocomplete'=>'off', 'style'=> 'width:100px; display:inline-block;')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">Marital Status:</label> 
		</div>
	</div>
	<div class="col-md-2">
		<input type="radio" name="patient_marital_status" value = "Single" style="position: initial; opacity: 1;" {{isset($psychiatrist->patient_marital_status) && $psychiatrist->patient_marital_status == "Single" ? 'checked' : '' }}> Single
	</div>
	<div class="col-md-2">
		<input type="radio" name="patient_marital_status" value = "Married" style="position: initial; opacity: 1;" {{isset($psychiatrist->patient_marital_status) && $psychiatrist->patient_marital_status == "Married" ? 'checked' : '' }}> Married
	</div>
	<div class="col-md-2">
		<input type="radio" name="patient_marital_status" value = "Separated" style="position: initial; opacity: 1;" {{isset($psychiatrist->patient_marital_status) && $psychiatrist->patient_marital_status == "Separated" ? 'checked' : '' }}> Separated
	</div>
	<div class="col-md-2">
		<input type="radio" name="patient_marital_status" value = "Divorce" style="position: initial; opacity: 1;" {{isset($psychiatrist->patient_marital_status) && $psychiatrist->patient_marital_status == "Divorce" ? 'checked' : '' }}> Divorce
	</div>
	<div class="col-md-2">
		<input type="radio" name="patient_marital_status" value = "Widow" style="position: initial; opacity: 1;" {{isset($psychiatrist->patient_marital_status) && $psychiatrist->patient_marital_status == "Widow" ? 'checked' : '' }}> Widow
	</div>
	<div class="col-md-2">
		<input type="radio" name="patient_marital_status" value = "Widower" style="position: initial; opacity: 1;" {{isset($psychiatrist->patient_marital_status) && $psychiatrist->patient_marital_status == "Widower" ? 'checked' : '' }}> Widower
	</div>
</div>

<div class="col-sm-12">
	<div class="col-sm-6">
		<div class="form-group labelgrp">
			<label class="">Name of the relative/Accompanying Person:</label> 
		</div>
	</div>

	<div class="col-sm-6">
		{{ Form::text('relative_first_name', $psychiatrist->relative_first_name .' '.$psychiatrist->relative_middle_name .' '.$psychiatrist->relative_last_name, array('class'=> 'form-control', 'placeholder'=> 'Relative First Name', 'autocomplete'=>'off')) }}
	</div>
</div>

<div style="width: 100%;height: 25px;display: inline-block;"></div> 
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">Information about complaints / difficulties.</label> 
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">1. When did the trouble start ?</label> 
			<br><label class=""> त्रास कधी सुरू झाला ?</label> 
		</div>
	</div>

	<div class="col-md-4">
		{{ Form::text('question_1', isset($psychiatrist->question_1) ? $psychiatrist->question_1 : '', array('class'=> 'form-control', 'placeholder'=> '', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		<input type="radio" name="question_1_duration" value = "Year" style="position: initial; opacity: 1;"  {{isset($psychiatrist->question_1_duration) && $psychiatrist->question_1_duration == "Year" ? 'checked' : '' }}> Year
		<input type="radio" name="question_1_duration" value = "Month" style="position: initial; opacity: 1;"  {{isset($psychiatrist->question_1_duration) && $psychiatrist->question_1_duration == "Month" ? 'checked' : '' }}> Month
		<input type="radio" name="question_1_duration" value = "Day" style="position: initial; opacity: 1;"  {{isset($psychiatrist->question_1_duration) && $psychiatrist->question_1_duration == "Day" ? 'checked' : '' }}> Day
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">2. Since when it increased?</label> 
			<br><label class="">त्रास कधीपासून वाढला ?</label> 
		</div>
	</div>

	<div class="col-md-4">
		{{ Form::text('question_2', isset($psychiatrist->question_2) ? $psychiatrist->question_2 : '', array('class'=> 'form-control', 'placeholder'=> '', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		<input type="radio" name="question_2_duration" value = "Year" style="position: initial; opacity: 1;" {{isset($psychiatrist->question_2_duration) && $psychiatrist->question_2_duration == "Year" ? 'checked' : '' }}> Year
		<input type="radio" name="question_2_duration" value = "Month" style="position: initial; opacity: 1;" {{isset($psychiatrist->question_2_duration) && $psychiatrist->question_2_duration == "Month" ? 'checked' : '' }}> Month
		<input type="radio" name="question_2_duration" value = "Day" style="position: initial; opacity: 1;" {{isset($psychiatrist->question_2_duration) && $psychiatrist->question_2_duration == "Day" ? 'checked' : '' }}> Day
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">3. Which was the first symptom ?</label> 
			<br><label class="">सगळ्यात पहिले लक्षण कोणते होते ?</label> 
		</div>
	</div>

	<div class="col-md-12">
		{{ Form::text('question_3', isset($psychiatrist->question_3) ? $psychiatrist->question_3 : '', array('class'=> 'form-control', 'placeholder'=> '', 'autocomplete'=>'off')) }}
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">4. Which of he following are experienced by the client. (Please tick)</label> 
			<br><label class="">खालील पैकी कोणती लक्षणे पेशंटला जाणवतात. </label>
		</div>
	</div>
</div>

<table style="width:100%;">
	<tr>
		<td colspan="5" style="width:50%;></td>
		<td colspan="5" style="width:50%;></td>
	</tr>
	@include('Psychiatrist.form_steps.symptoms_responsive_print')
	
	<tr>
		<td colspan="3"><span style="">Name: </span></td>
		<td colspan="2">
<input  type="text" class="form-control" name="first_name" id="first_name" placeholder=""  style="width: 30%; display: inline-block;" value="{{$admission_details->branch_name}}">
<input  type="text" class="form-control" name="middle_name" id="middle_name" placeholder=""  style="width: 30%; display: inline-block;" value="{{$admission_details->branch_name}}">
<input  type="text" class="form-control" name="last_name" id="last_name" placeholder=""  style="width: 30%; display: inline-block;" value="{{$admission_details->branch_name}}">
		</td>
	</tr>
	<tr>
		<td colspan="9">@include('Psychiatrist.form_steps.symptoms_responsive_print')</td>
	</tr>	
</table>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">5. Apart from these symptoms, what else would you like to say about your trouble ?</label> 
		</div>
	</div>

	<div class="col-md-12">
		{{ Form::text('question_5', isset($psychiatrist->question_5) ? $psychiatrist->question_5 : '', array('class'=> 'form-control', 'placeholder'=> '', 'autocomplete'=>'off')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">6. Information about previous treatment if any ?</label> 
		</div>
	</div>

	<div class="col-md-6">
		{{ Form::text('question_6', isset($psychiatrist->question_6) ? $psychiatrist->question_6 : '', array('class'=> 'form-control', 'placeholder'=> 'title', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-6">
		{{-- Form::text('question_6', Request::old('question_6', $question_6), array('class'=> 'form-control', 'placeholder'=> '', 'autocomplete'=>'off')) --}}
		
		<!-- <input multiple type="file" name="question_6_files[]"> -->
	</div>
	
	<!--
	<div class="col-md-12">
		@foreach($psychiatrist_case_form_files as $psychiatrist_case_form_files_row)<input type="hidden" name="psychiatrist_case_form_files_all_ids[]" value="{{$psychiatrist_case_form_files_row->id}}">
		
		<div class="col-md-3">
			<input type="hidden" name="psychiatrist_case_form_files_all_ids_not_deleted[]" value="{{$psychiatrist_case_form_files_row->id}}">
			<img class="img-responsive" src="{{ url('/').'/psychiatrist_files/'.$psychiatrist_case_form_files_row->file}}">
			<a class="btn btn-info delete-psychiatrist-case-form-files" href="javascript:void(0)" id="">Delete</a>
		</div>
		@endforeach
	</div>
	-->
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">7. Has any member of your family / relative taken psychiatric treatment in the past ?</label> 
		</div>
	</div>	
	
	<div class="col-md-12" id="family_history_div_edit">
		@foreach($psychiatrist_case_form_family_history as $psychiatrist_case_form_family_history_row) 
		<input type="hidden" name="psychiatrist_case_form_family_all_ids[]" value="{{$psychiatrist_case_form_family_history_row->id}}">
		<div class="row" >
			<input type="hidden" name="psychiatrist_case_form_family_all_ids_not_deleted[]" value="{{$psychiatrist_case_form_family_history_row->id}}">
			<div class="col-md-2">
				{{ Form::text('question_7_rlation_eidt['.$psychiatrist_case_form_family_history_row->id.']', $psychiatrist_case_form_family_history_row->relation, array('class'=> 'form-control', 'placeholder'=> 'relation', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-4">
				{{ Form::text('question_7_name_eidt['.$psychiatrist_case_form_family_history_row->id.']', $psychiatrist_case_form_family_history_row->name, array('class'=> 'form-control', 'placeholder'=> 'name', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-4">
				{{ Form::text('question_7_doctor_eidt['.$psychiatrist_case_form_family_history_row->id.']', $psychiatrist_case_form_family_history_row->doctor, array('class'=> 'form-control', 'placeholder'=> 'doctor name', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-2">
				<a class="btn btn-info delete-edit-family-history" href="javascript:void(0)" id="">Delete</a>
			</div>
		</div>
		@endforeach
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">8. What are the stresses in your life ? Mention briefly.</label> 
		</div>
	</div>
	
	@php 
		$symptoms_arr = isset($psychiatrist->question_8) ? explode('--***--',  $psychiatrist->question_8) : '';
		$is_checked = in_array('Economic', $symptoms_arr) ? 'checked' : '';
	@endphp	

	
	<div class="col-md-6">
		<input  type="checkbox" name="question_8[]" value="Economic" style="position: initial; opacity: 1;" {{$is_checked}}> Economic
	</div>
	
	@php 
		$is_checked = in_array('Pertaining to children', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_8[]" value="Pertaining to children" style="position: initial; opacity: 1;" {{$is_checked}}> Pertaining to children
	</div>
	
	@php 
		$is_checked = in_array('Family Related', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_8[]" value="Family Related" style="position: initial; opacity: 1;" {{$is_checked}}> Family Related
	</div>
	
	
	@php 
		$is_checked = in_array('Occupational', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_8[]" value="Occupational" style="position: initial; opacity: 1;" {{$is_checked}}> Occupational
	</div>
	
	@php 
		$is_checked = in_array('Marital', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_8[]" value="Marital" style="position: initial; opacity: 1;" {{$is_checked}}> Marital
	</div>
	
	
	@php 
		$is_checked = in_array('Related to Health & illness', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_8[]" value="Related to Health & illness" style="position: initial; opacity: 1;" {{$is_checked}}> Related to Health & illness
	</div>
</div>


	@php 
		$symptoms_arr = isset($psychiatrist->question_9) ? explode('--***--',  $psychiatrist->question_9) : [];
	@endphp	

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">9. Who referred you/advised to visit Clinic ? </label> 
		</div>
	</div>

	@php 
		$is_checked = in_array('Family Doctor', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="Family Doctor" style="position: initial; opacity: 1;" {{$is_checked}}> Family Doctor
	</div>
	@php 
		$is_checked = in_array('School', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="School" style="position: initial; opacity: 1;" {{$is_checked}}> School
	</div>

	@php 
		$is_checked = in_array('Any other Doctor', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="Any other Doctor" style="position: initial; opacity: 1;" {{$is_checked}}> Any other Doctor
	</div>
	@php 
		$is_checked = in_array('Office', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="Office" style="position: initial; opacity: 1;" {{$is_checked}}> Office
	</div>

	@php 
		$is_checked = in_array('Relative', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="Relative" style="position: initial; opacity: 1;" {{$is_checked}}> Relative
	</div>
	@php 
		$is_checked = in_array('Any other reason', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="Any other reason" style="position: initial; opacity: 1;" {{$is_checked}}> Any other reason
	</div>

	@php 
		$is_checked = in_array('Friend', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="Friend" style="position: initial; opacity: 1;" {{$is_checked}}> Friend
	</div>
	@php 
		$is_checked = in_array('Self', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="question_9[]" value="Self" style="position: initial; opacity: 1;" {{$is_checked}}> Self
	</div>
</div>
					
                    <div class="clearfix"></div>
                  </div>
                  
                </div>
              </div>


            </div>
          </div>
		  
		<br>  
<div style="border:1px solid; border-radius:5px;display: inline-block;">
	<div class="col-sm-12">
		<div class="col-sm-4">
			<div class="form-group labelgrp">
				<label class="">I the undersigned Mr./Mrs./Ms.</label> 
			</div>
		</div>

		<div class="col-sm-8">
			{{ Form::text('undersigned_first_name', $psychiatrist->undersigned_first_name .' '.$psychiatrist->undersigned_middle_name.' '.$psychiatrist->undersigned_last_name, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="form-group labelgrp">
				<label class="">declare that I have willingly given the information about &nbsp;
				<input  type="radio" name="about_person" value="self" style="position: initial; opacity: 1;" {{isset($psychiatrist->about_person) && $psychiatrist->about_person == "self" ? 'checked' : ''}}> self &nbsp;&nbsp;
				<input  type="radio" name="about_person" value="relative" style="position: initial; opacity: 1;" {{isset($psychiatrist->about_person) && $psychiatrist->about_person == "relative" ? 'checked' : ''}}> relative &nbsp;&nbsp;
				<input  type="radio" name="about_person" value="friend" style="position: initial; opacity: 1;" {{isset($psychiatrist->about_person) && $psychiatrist->about_person == "friend" ? 'checked' : ''}}> friend &nbsp;&nbsp;
				
				Mr./Mrs./Mast/Ms.</label> 
			</div>
		</div>

		<div class="col-md-4">
			{{ Form::text('about_person_first_name', isset($psychiatrist->about_person_first_name) ? $psychiatrist->about_person_first_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('about_person_middle_name', isset($psychiatrist->about_person_middle_name) ? $psychiatrist->about_person_middle_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('about_person_last_name', isset($psychiatrist->about_person_last_name) ? $psychiatrist->about_person_last_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="form-group labelgrp">
				<label class=""> This information is
given with an intention to take help from the mental health professional (Psychiatrist/Psychologist/
Counselor) for the above mentioned problems. I/We am/are willingly ready to follow-up the medication, counseling or testing procedure as and when suggested by the counsulting professional.</label> 
			</div>
		</div>
	</div>

<div class="col-sm-12">
	<div class="col-sm-4">Name:</div>
	<div class="col-sm-4">Signature:</div>
	<div class="col-sm-4">Date:</div>
</div>
<div style="width: 100%;height: 25px;display: inline-block;"></div> 
</div>
        


	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
	<script src="{{url('/')}}/assets/plugins/bootstrap/js/bootstrap.js"></script>
	
	<script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { window.print(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>

</body>
</html>