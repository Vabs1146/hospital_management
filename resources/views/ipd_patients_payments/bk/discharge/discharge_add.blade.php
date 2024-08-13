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
           <input type="hidden" id="id" name="discharge_id" value="{{ $discharge_data->id or ''}}" >
              <div class="body">
                  <div class="row clearfix ">

				  <input type="hidden" name="registration_id" value="{{$registration_data->id}}">


				  <!-- =================================================================================== -->
<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Date & Time :</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{$discharge_data->discharge_summary_date_time or ''}}" type="text">
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
		<label for="dob" class="form-control"> Date of Birth :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				<input type="text" class="form-control datepicker_formatted" id="date_of_birth" name="date_of_birth" placeholder="Select Date." value="{{$registration_data->date_of_birth}}">                           
			</div>
		</div>
	</div>

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
		<label for="referedby" class="form-control">Date of Admission & Time :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('admission_date_time', Request::old('admission_date_time', $registration_data->admission_date_time), array('class' => 'form-control datetimepicker')) }}  
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Discharge Date & Time :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('discharge_date_time', Request::old('discharge_date_time', $discharge_data->discharge_date_time), array('class' => 'form-control datetimepicker')) }}  
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Consulting Doctor :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('consulting_doctor', Request::old('consulting_doctor', $registration_data->consulting_doctor), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>
				 <!--  ===================================================================================== -->
                          
                           
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('diagnosis','Diagnosis') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('diagnosis', Request::old('diagnosis', $discharge_data->diagnosis or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                        
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('history_clinical_findings','History & Clinical Findings') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('history_clinical_findings', Request::old('history_clinical_findings',$discharge_data->history_clinical_findings or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('on_examination','On Examination') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('on_examination', Request::old('on_examination',$discharge_data->on_examination or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
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
				{{ Form::textarea('operative_procedure', Request::old('operative_procedure',$discharge_data->operative_procedure or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
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
				{{ Form::textarea('investigation', Request::old('investigation',$discharge_data->investigation or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
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
				{{ Form::textarea('surgical_maternity_notes', Request::old('surgical_maternity_notes',$discharge_data->surgical_maternity_notes or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">                      
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('treatment_given','Treatment Given') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('treatment_given', Request::old('treatment_given',$discharge_data->treatment_given or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
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
				{{ Form::textarea('treatment_advice', Request::old('treatment_advice',$discharge_data->treatment_advice or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
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
				{{ Form::textarea('treatment_on_discharge', Request::old('treatment_on_discharge',$discharge_data->treatment_on_discharge or ''), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
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
			<input class="form-control datepicker" id="followup_1" placeholder="Follow up 1" name="followup_1" value="{{$discharge_data->followup_1}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datepicker" id="followup_2" placeholder="Follow up 2" name="followup_2" value="{{$discharge_data->followup_2}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datepicker" id="followup_3" placeholder="Follow up 3" name="followup_3" value="{{$discharge_data->followup_3}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datepicker" id="followup_4" placeholder="Follow up 4" name="followup_4" value="{{$discharge_data->followup_4}}" type="text">
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

			<a class="btn btn-default btn-lg" href="{{ url('/patients/discharge/print').'/'.$discharge_data->id  }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>

			
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