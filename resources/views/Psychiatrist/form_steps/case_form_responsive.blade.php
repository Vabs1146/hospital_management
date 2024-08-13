
<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Complaint" aria-expanded="true" aria-controls="Complaint">
		Case Form
		</a>
	</h4>
</div>

<div id="Complaint" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
	
	<!-- ========================================================================== -->
<br>
<!--<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="">Patient Reg.:</label> 
		</div>
	</div>

	<div class="col-md-4">
		{{ Form::text('patient_registration', Request::old('patient_registration', $patient_registration), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-1">
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
			<label class="">Date:</label> 
		</div>
	</div>
	<div class="col-md-4">
		{{ Form::date('patient_registration_date', Request::old('patient_registration_date', $patient_registration_date), array('class'=> 'form-control', 'autocomplete'=>'off')) }}	
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">Name:</label> 
		</div>
	</div>

	<div class="col-md-4">
		{{ Form::text('first_name', Request::old('first_name', $first_name), array('class'=> 'form-control', 'placeholder'=> 'first name', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		{{ Form::text('middle_name', Request::old('middle_name', $middle_name), array('class'=> 'form-control', 'placeholder'=> 'middle name', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		{{ Form::text('last_name', Request::old('last_name', $last_name), array('class'=> 'form-control', 'autocomplete'=>'off', 'placeholder'=> 'last name')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="">Age:</label> 
		</div>
	</div>

	<div class="col-md-4">
		{{ Form::text('patient_age', Request::old('patient_age', $patient_age), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-1">
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
			<label class="">Sex:</label> 
		</div>
	</div>
	<div class="col-md-4">
		<input type="radio" name="patient_gender" = "Male" style="position: initial; opacity: 1;"> Male
		<input type="radio" name="patient_gender" = "Female" style="position: initial; opacity: 1;"> Female
		<input type="radio" name="patient_gender" = "Other" style="position: initial; opacity: 1;"> Other
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">Address:</label> 
		</div>
	</div>

	<div class="col-md-12">
		{{ Form::text('patient_address_1', Request::old('patient_address_1', $patient_address_1), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-12">
		{{ Form::text('patient_address_2', Request::old('patient_address_2', $patient_address_2), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-12">
		{{ Form::text('patient_address_3', Request::old('patient_address_3', $patient_address_3), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>-->
<form action="{{ url('save-psychiatrist-case-form') }}" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
 
                        {{ csrf_field() }}
                        {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
                        {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
						
<div class="col-md-12">
<br>
	<div class="col-md-4">
		<label class="labelgrp">Education:</label> 
		{{ Form::text('patient_education', isset($psychiatrist->patient_education) ? $psychiatrist->patient_education : '', array('class'=> 'form-control', 'placeholder'=> 'education', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		<label class="labelgrp">Profession/Occupation:</label> 
		{{ Form::text('patient_occupation', isset($psychiatrist->patient_occupation) ? $psychiatrist->patient_occupation : '', array('class'=> 'form-control', 'placeholder'=> 'profession/occupation', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		<label class="labelgrp">Contact No.:</label> 
		{{ Form::text('patient_contact_number', isset($psychiatrist->patient_contact_number) ? $psychiatrist->patient_contact_number : '', array('class'=> 'form-control', 'placeholder'=> 'contact number', 'autocomplete'=>'off')) }}
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

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">Name of the relative/Accompanying Person:</label> 
		</div>
	</div>

	<div class="col-md-4">
		{{ Form::text('relative_first_name', isset($psychiatrist->relative_first_name) ? $psychiatrist->relative_first_name : '', array('class'=> 'form-control', 'placeholder'=> 'Relative First Name', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		{{ Form::text('relative_middle_name', isset($psychiatrist->relative_middle_name) ? $psychiatrist->relative_middle_name : '', array('class'=> 'form-control', 'placeholder'=> 'Relative Middle Name', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-4">
		{{ Form::text('relative_last_name', isset($psychiatrist->relative_last_name) ? $psychiatrist->relative_last_name : '', array('class'=> 'form-control', 'placeholder'=> 'Relative Last Name', 'autocomplete'=>'off')) }}
	</div>
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

	
	
<!-- ========================================================================= -->
@include('Psychiatrist.form_steps.symptoms_responsive')
<!-- ========================================================================= -->


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
		
		<input multiple type="file" name="question_6_files[]">
	</div>
	
	
	<div class="col-md-12">
		@foreach($psychiatrist_case_form_files as $psychiatrist_case_form_files_row)<input type="hidden" name="psychiatrist_case_form_files_all_ids[]" value="{{$psychiatrist_case_form_files_row->id}}">
		
		<div class="col-md-3">
			<input type="hidden" name="psychiatrist_case_form_files_all_ids_not_deleted[]" value="{{$psychiatrist_case_form_files_row->id}}">
			<img class="img-responsive" src="{{ url('/').'/psychiatrist_files/'.$psychiatrist_case_form_files_row->file}}">
			<a class="btn btn-info delete-psychiatrist-case-form-files" href="javascript:void(0)" id="">Delete</a>
		</div>
		@endforeach
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class="">7. Has any member of your family / relative taken psychiatric treatment in the past ?</label> 
		</div>
	</div>

	<div class="col-md-12" id="family_history_div">
		<div class="row" >
			<div class="col-md-2">
				{{ Form::text('question_7_rlation[]', null, array('class'=> 'form-control', 'placeholder'=> 'relation', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-4">
				{{ Form::text('question_7_name[]', null, array('class'=> 'form-control', 'placeholder'=> 'name', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-4">
				{{ Form::text('question_7_doctor[]', null, array('class'=> 'form-control', 'placeholder'=> 'doctor name', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-2">
				<a class="btn btn-info" href="javascript:void(0)" id="add-more-family-history">Add More</a>
			</div>
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


<!-- ========================================================================= -->
<!-- ========================================================================= -->
@include('Psychiatrist.form_steps.footer_section_responsive')
<!-- ========================================================================= -->	

	
 <div class="col-md-12"></div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-primary waves-effect"><i class="fa fa-plus"></i> Submit
                                </button>
									
									<!-- <a class="btn btn-primary waves-effect btn-lg" href="{{url('/ViewEyeDetails').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> View </a> -->
									
								<a class="btn btn-primary waves-effect btn-lg" href="{{url('/print-psyciatrist-case-form').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> Print </a>
									
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('/case_masters') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
                                    </div>
                                </div>
                               
                            </div>

	<!-- ========================================================================== -->
</form>	
</div>
