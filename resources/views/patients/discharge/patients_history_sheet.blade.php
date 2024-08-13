&nbsp;@extends('adminlayouts.master')
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
          <form action="{{ url('/save-history-sheet') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>PATIENT`S HISTORY SHEET</h2>
          </div>
           <input type="hidden" id="id" name="patient_history_sheet_id" value="{{ isset($patient_history_sheet->id) ? $patient_history_sheet->id : ''}}" >
              <div class="body">
                  <div class="row clearfix ">

				  <input type="hidden" name="registration_id" value="{{$registration_data->id}}">


				  <!-- =================================================================================== -->
<!-- <h1>General Information</h1> -->
<div class="col-md-12">

						<!-- <div class="col-md-2">
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
						</div> -->
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Date & Time : </label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{isset($patients_history_sheet['date_time'])? $patients_history_sheet['date_time']->value_1 : ''}}" type="text">
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
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Age :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_age', $registration_data->age, array('id'=>'patient_age','class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
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
			<label class="form-control"> Height :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('height', $registration_data->height, array('id'=>'height','class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Weight :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('weight', $registration_data->weight, array('id'=>'weight','class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('chief_complaints','Chief Complaints') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('chief_complaints', Request::old('chief_complaints',isset($patients_history_sheet['chief_complaints']) ? $patients_history_sheet['chief_complaints']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('systemic_examination','Systemic Examination') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('systemic_examination', Request::old('systemic_examination',isset($patients_history_sheet['systemic_examination']) ? $patients_history_sheet['systemic_examination']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('local_examination','Local  Examination') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('local_examination', Request::old('local_examination',isset($patients_history_sheet['local_examination']) ? $patients_history_sheet['local_examination']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('past_history','Past History') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('past_history', Request::old('past_history',isset($patients_history_sheet['past_history']) ? $patients_history_sheet['past_history']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('personal_history','Personal History') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('personal_history', Request::old('personal_history',isset($patients_history_sheet['personal_history']) ? $patients_history_sheet['personal_history']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('drug_allergies','Drug Allergies') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('drug_allergies', Request::old('drug_allergies',isset($patients_history_sheet['drug_allergies']) ? $patients_history_sheet['drug_allergies']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('family_history','Family History') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('family_history', Request::old('family_history',isset($patients_history_sheet['family_history']) ? $patients_history_sheet['family_history']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('proctoscopy','PR (Proctoscopy) / PV') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('proctoscopy', Request::old('proctoscopy',isset($patients_history_sheet['proctoscopy']) ? $patients_history_sheet['proctoscopy']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('menstrual_history','Menstrual History / Obstetric History') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('menstrual_history', Request::old('menstrual_history',isset($patients_history_sheet['menstrual_history']) ? $patients_history_sheet['menstrual_history']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('treatment_history','Treatment History :') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('treatment_history', Request::old('treatment_history',isset($patients_history_sheet['treatment_history']) ? $patients_history_sheet['treatment_history']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('final_notes','Notes :') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('final_notes', Request::old('final_notes',isset($patients_history_sheet['final_notes']) ? $patients_history_sheet['final_notes']->value_1 : ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

</div>

<!-- ================================================================================= -->

@php
$database_table = "patients_history_sheet";
$dropdown_lable = "Provisional Diagnosis";
$is_two = "";

$element_key = "provisional_diagnosis";

$value_1 = "";
$value_2 = "";

//$saved_data = $form_details->eyeformmultipleentry()->where('field_name', 'planOfManagement')->get();

$saved_data = isset($patients_history_sheet['provisional_diagnosis']) ? $patients_history_sheet['provisional_diagnosis']  : [];

@endphp
@include('form_elements.dropdown')
<!-- ================================================================================= -->


<!-- ===================================================================== -->


  
                  </div>    

<div class="row clearfix">
	<div class="col-md-8 col-md-offset-2">
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
			<i class="fa fa-plus"></i> Submit
			</button>

			<a class="btn btn-info btn-lg" href="{{ url('/patients-listing') }}">Back</a>

			<a class="btn btn-default btn-lg" href="{{ url('/patients_history_sheet/print').'/'.$registration_data->id  }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>

			
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>


<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
     <script type="text/javascript">
       $(document).ready(function() {
       });
       $(".select2").select2();
     </script>
  @endsection  