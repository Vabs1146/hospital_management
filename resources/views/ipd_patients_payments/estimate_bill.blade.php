@extends('adminlayouts.master')
@section('style')

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

@php 
//echo "==========>>>>>>>>>>>> <pre>"; print_r($registration_data); exit;
@endphp
<div class="card">
	<form action="{{ url('/save-ipd-estimate-bill' ) }}" method="POST" class="form-horizontal" id="patient_form">
			{{ csrf_field() }}

			<input type="hidden" name="registration_id" value="{{$registration_data->id}}">
			<div class="header bg-pink">
				<h2>Estimated Bill</h2>
				<span id="balance_amount" style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
			</div>
			<div class="body">
				<div class="row clearfix ">
					<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Date & Time :</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{$estimated_bill_data->date_time}}" type="text">
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
		<label for="referedby" class="form-control">Date of Discharge & Time :</label>
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
			{{-- Form::text('consulting_doctor', Request::old('consulting_doctor', $all_docotrs[$registration_data->consulting_doctor]), array('class' => 'form-control')) --}}  

			<select name="consulting_doctor" class="form-control">
				<option value="">Select Doctor</option>
				@foreach($all_doctors as $all_doctor_key => $all_doctor)
					<option value="{{$all_doctor_key}}" {{ ($registration_data->consulting_doctor == $all_doctor_key) ? 'selected' : ''}}>{{$all_doctor}}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>
</div>

<!-- <div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Diagnosis :</label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('diagnosis', Request::old('diagnosis', isset($estimated_bill_data->diagnosis) ? $estimated_bill_data->diagnosis : ''), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div> -->
<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Patient Paid Payment :</label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('patient_paid_payment', Request::old('patient_paid_payment', $total_payment), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>
<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Hospital Total Charges :</label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('hospital_total_charges', Request::old('hospital_total_charges', $total_bill), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>
<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Balance Amount  :</label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('balance_amount', Request::old('balance_amount', ($total_bill - $total_payment)), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>

</div>

				                 

				</div>

				<div class="row clearfix">
					<div class="col-md-8 col-md-offset-2" >
						<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Update
						</button>&nbsp;

						<!-- <button name="submitMsg" class="btn btn-success btn-lg" value="submitMsg" ><i class="fa fa-plus"></i> Print
						</button>&nbsp; -->

						<a class="btn btn-info btn-lg" href="{{ url('/print-ipd-estimate-bill/'.$registration_data->id) }}">Print</a>
						
						{{--
						<a class="btn btn-info btn-lg" href="{{ url('/patients-listing') }}">Back</a>

						@if($registration_data->advance_amount)
						<a class="btn btn-info btn-lg" href="{{ url('/print-advance-receipt/'.$registration_data->id) }}">View Advance Receipt</a>
						@endif
						--}}
						<!-- <button formaction="{{ url('/patientDetails/SaveEyeExamination2') }}" name="submit" class="btn btn-success btn-lg" value="submit" >Advance Amount Payment Receipt</button>&nbsp; -->

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
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript"></script>
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} "></script>
<script>    
jq = $.noConflict(true);
//alert(jq);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>

<script>
$('.datepicker_formatted').bootstrapMaterialDatePicker({ 
        format: 'DD-MM-YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
});
</script>

@endsection

