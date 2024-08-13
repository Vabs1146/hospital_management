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
<div class="card">
	<form action="{{ url('/patients/save' ) }}" method="POST" class="form-horizontal" id="patient_form">
			{{ csrf_field() }}
			<div class="header bg-pink">
				<h2>Patient Info</h2>
				<span id="balance_amount" style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
			</div>
			<div class="body">
			  <input class="form-control" id="ipd_number_used" name="ipd_number_used" value="{{$initial_data['ipd_number_used']}}" type="hidden">
			  <input class="form-control" id="uhid_number_used" name="uhid_number_used" value="{{$initial_data['uhid_number_used']}}" type="hidden">
			  <input class="form-control" id="ipd_number_format" name="ipd_number_format" value="{{$initial_data['ipd_number_format']}}" type="hidden">
			  <input class="form-control" id="ipd_number_prefix" name="ipd_number_prefix" value="{{$initial_data['ipd_number_prefix']}}" type="hidden">
			  <input class="form-control" id="uhid_number_format" name="uhid_number_format" value="{{$initial_data['uhid_number_format']}}" type="hidden">
			  <input class="form-control" id="uhid_number_prefix" name="uhid_number_prefix" value="{{$initial_data['uhid_number_prefix']}}" type="hidden">

				<div class="row clearfix ">
					<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Date & Time</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{date('Y-m-d - h:i A')}}" type="text">
							</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">IPD No. </label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control" id="ipd_no" name="ipd_no" value="{{$initial_data['ipd_number']}}" type="text">
							</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">UHID No. </label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control" id="uhid_no" name="uhid_no" value="{{$initial_data['uhid_number']}}" type="text">
							</div>
							</div>
						</div>
					</div>

					<!-- <div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">In OPD Patient </label>
							</div>
						</div>
						<div class="col-md-10">
							<div class="form-group">
							<div class="form-line">
								{{ Form::text('', Request::old('case_number'), array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Type Patient Name / mobile no / case number / UHID no','id'=>'')) }}       
							</div>
							</div>
						</div>
					</div> -->

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Name <b class="star">*</b></label>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_name', null, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'First Name ','id'=>'patient_name')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_middle_name', null, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Middle Name','id'=>'patient_middle_name')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_last_name', null, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Surname','id'=>'patient_last_name')) }}                          
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
				 <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Select Date." data-date-format="dd-mm-yyyy">  
				
				<!-- <input type="text" class="form-control datepicker_formatted" id="date_of_birth" name="date_of_birth" placeholder="Select Date." value="">      -->
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Age</label>
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_age', Request::old('patient_age'), array('id'=>'patient_age','class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label class="form-control">Gender </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="demo-radio-button" style="padding-top: 6px">
			<input type="radio" name="gender" id="gender_male" value="Male" />
			<label for="gender_male">Male</label>
			<input type="radio" name="gender" id="gender_female" value="Female" />
			<label for="gender_female">Female</label>
			</div>
		</div>
	</div>
</div>


<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Adhar Card no.</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('adhar_card_number', Request::old('adhar_card_number'), array('class' => 'form-control', 'placeholder'=>'Adhar Card')) }}                            
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Admission type</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		
		<select name="admission_type" id="admission_type" class="form-control">
			<option value="">Select Admission Type</option>
			<option value="General">General</option>
			<option value="FTND">FTND</option>
			<option value="LSCS">LSCS</option>
			<option value="Surgery">Surgery</option>
		</select>
		</div>
		</div>
	</div>
</div>

<div class="col-md-12">                           


<div class="col-md-2">
<div class="form-group labelgrp">
{{ Form::label('tpa_company','TPA Company') }} 
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<div class="form-line">
{{ Form::text('tpa_company', null, array('class' => 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>
</div>

<div class="col-md-2">
<div class="form-group labelgrp">
{{ Form::label('insurance_company','Insurance Company') }}
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<div class="form-line">
{{ Form::text('insurance_company', null, array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
</div>
</div>
</div>

</div>



<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control"> Address </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_address', Request::old('patient_address'), array('class' => 'form-control', 'placeholder'=>'Address')) }}                            
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_area', Request::old('patient_area'), array('class' => 'form-control', 'placeholder'=>'Area')) }}                            
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('city', Request::old('city'), array('class' => 'form-control', 'placeholder'=>'City')) }}                            
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('district', Request::old('district'), array('class' => 'form-control', 'placeholder'=>'District')) }}                            
		</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Email ID </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('patient_email', null, array('class' => 'form-control')) }}                             
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Contact No. </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_contact', Request::old('patient_contact'), array('class' => 'form-control', '')) }}                           
		</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control"> Blood Group</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('blood_group', Request::old('blood_group'), array('class' => 'form-control', 'placeholder'=>'Blood Group')) }}                            
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Maritial Status</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('marital_status', Request::old('marital_status'), array('class' => 'form-control', '')) }}                           
		</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="responsible_realtive_name" class="form-control">Responsible Relative Name & Relationship</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('responsible_realtive_name', Request::old('responsible_realtive_name'), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('responsible_realtive_relation', Request::old('responsible_realtive_relation'), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>


<div class="col-md-12" style="background: white;">
	<!-- <div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control"> Address</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('relative_address', Request::old('relative_address'), array('class' => 'form-control', 'placeholder'=>'Address')) }}                            
		</div>
		</div>
	</div> -->

	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Contact No. </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('relative_contact_number', Request::old('relative_contact_number'), array('class' => 'form-control', '')) }}                           
		</div>
		</div>
	</div>
</div>



<!-- <div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Weight</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('weight', Request::old('weight'), array('class' => 'form-control', 'placeholder'=>'Weight in Kg')) }}                            
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Height</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('height', Request::old('height'), array('class' => 'form-control', '')) }}                           
		</div>
		</div>
	</div>
</div> -->

<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Date of Admission & Time</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('admission_date_time', Request::old('admission_date_time'), array('class' => 'form-control datetimepicker')) }}  
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Consulting Doctor </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{-- Form::text('consulting_doctor', Request::old('consulting_doctor'), array('class' => 'form-control')) --}}  

				<select name="consulting_doctor" class="form-control">
					<option value="">Select Doctor</option>
					@foreach($all_docotrs as $all_doctor_key => $all_doctor)
						<option value="{{$all_doctor_key}}" >{{$all_doctor}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Referring Doctor </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('referring_doctor', Request::old('referring_doctor'), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>
<div class="col-md-12" style="background: white;">
					<hr>   
					</div>
<div class="col-md-12" style="background: white;">	
<div>Admission in </div>
</div>
<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Ward Type  </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{-- Form::text('ward_type', Request::old('ward_type'), array('class' => 'form-control')) --}}  
			<select name="ward_type" class="form-control">
				<option value="">Select ward</option>
				@foreach($ipd_ward_types as $ipd_ward_type)
					<option value="{{$ipd_ward_type->id}}">{{$ipd_ward_type->name}}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Bed No. </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{-- Form::text('bed_number', Request::old('bed_number'), array('class' => 'form-control')) --}}  
			<select name="bed_number" class="form-control">
				<option value="">Select bed</option>
				@foreach($ipd_bed_numbers as $ipd_bed_number)
					<option value="{{$ipd_bed_number->id}}">{{$ipd_bed_number->name}}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Advance Amount </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('advance_amount', Request::old('advance_amount'), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Payment Mode </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
{{-- Form::text('payment_mode', Request::old('payment_mode'), array('class' => 'form-control')) --}}  

<select name="payment_mode" id="payment_mode" class="form-control select2" placeholder="select payment mode">
	<option value="">Select</option> 
	@foreach($payment_modes_array as $key => $val)
	<option value="{{$key}}">{{$val}}</option> 
	@endforeach
</select>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Payment ID No. </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('payment_id_number', Request::old('payment_id_number'), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>

					<!-- ====================End panel========================== -->                     

				</div>

				<div class="row clearfix">
					<div class="col-md-8 col-md-offset-2" >
						<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Submit
						</button>&nbsp;

						<!-- <button name="submitMsg" class="btn btn-success btn-lg" value="submitMsg" ><i class="fa fa-plus"></i> Print
						</button>&nbsp;
						
						<button formaction="{{ url('/patientDetails/SaveEyeExamination2') }}" name="submit" class="btn btn-success btn-lg" value="submit" >Advance Amount Payment Receipt</button>&nbsp; -->

					</div>
				</div>
			</div>
	</form>
</div>
</div>
</div>


</div>

<div id="patientPictureModal" class="modal fade" role="dialog"></div>

<div id="templateContainner" style="display:none"></div>

@endsection
@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript"></script>
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} "></script>
<script>    
jq = $.noConflict(true);
//alert(jq);
$('.datepicker_formatted').bootstrapMaterialDatePicker({ 
        format: 'DD-MM-YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
});
		/*
$('#date_of_birth').bootstrapMaterialDatePicker({ 
        format: 'DD-MM-YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
});
		*/
$('#date_of_birth').on('change', function() {
	//alert($(this).val());

	dob = new Date($(this).val());

	//alert(dob);
	var today = new Date();
	var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

	//alert(age);
	$('#patient_age').val(age);
});
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>
@endsection

