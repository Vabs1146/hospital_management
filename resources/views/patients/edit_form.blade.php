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
				<form action="{{ url('/patients/save') }}" method="POST" class="form-horizontal" id="patient_form">
					{{ csrf_field() }}

					<input type="hidden" name="registration_id" value="{{$registration_data->id}}">
					<div class="header bg-pink">
						<h2>Edit Patient</h2>
						<span id="balance_amount"
							style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
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
											<input class="form-control datetimepicker" id="date_time" name="date_time"
												value="{{$registration_data->registration_date_time}}" type="text">
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
											<input class="form-control" id="ipd_no" name="ipd_no"
												value="{{$registration_data->ipd_number}}" type="text">
										</div>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control">UHID No. :</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											<input class="form-control" id="uhid_no" name="uhid_no"
												value="{{$registration_data->uhid_number}}" type="text">
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12" style="background: white;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="patient_name" class="form-control">Name <b class="star">*</b>
											:</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_name', $registration_data->first_name, array('class' => 'form-control autocompleteTxt', 'placeholder' => 'First Name ', 'id' => 'patient_name', 'required')) }}
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_middle_name', $registration_data->middle_name, array('class' => 'form-control autocompleteTxt', 'placeholder' => 'Middle Name', 'id' => 'patient_middle_name')) }}
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_last_name', $registration_data->last_name, array('class' => 'form-control autocompleteTxt', 'placeholder' => 'Surname', 'id' => 'patient_last_name')) }}
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12" style="background: white;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control">Gender <b class="star">*</b>:</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<div class="demo-radio-button" style="padding-top: 6px">
											<input name="gender" type="radio" id="radio_8"
												class=" with-gap radio-col-pink" value="Male" {{ ($registration_data->gender == 'Male') ? 'checked' : '' }} />
											<label for="radio_8">Male</label>

											<input name="gender" type="radio" id="radio_10"
												class="with-gap radio-col-deep-purple" value="Female" required {{ ($registration_data->gender == "Female") ? "checked=\"checked\"" : "" }} />
											<label for="radio_10">Female</label>

											<input name="gender" type="radio" id="radio_11"
												class="with-gap radio-col-deep-purple" value="Baby" required {{ ($registration_data->gender == "Baby") ? "checked=\"checked\"" : "" }} />
											<label for="radio_11">Baby</label>

											<input name="gender" type="radio" id="radio_12"
												class="with-gap radio-col-deep-purple" value="Master" required {{ ($registration_data->gender == "Master") ? "checked=\"checked\"" : "" }} />
											<label for="radio_12">Master</label>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="dob" class="form-control"> Date of Birth :</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											<input type="date" class="form-control" id="date_of_birth"
												name="date_of_birth" placeholder="Select Date."
												data-date-format="dd-mm-yyyy"
												value="{{($registration_data->date_of_birth) ? date('Y-m-d', strtotime($registration_data->date_of_birth)) : ''}}">
										</div>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group labelgrp">
										<label class="form-control"> Age (Years)</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_age', Request::old('patient_age', $registration_data->age), array('id' => 'patient_age', 'class' => 'form-control', 'readonly')) }}
										</div>
									</div>
								</div>	
								<div class="col-md-1">
									<div class="form-group labelgrp">
										<label class="form-control">Month</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('admission_month', Request::old('admission_month', $registration_data->admission_month), array('id' => 'admission_month', 'class' => 'form-control', 'readonly')) }}
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
											{{ Form::text('adhar_card_number', $registration_data->adhar_card_number, array('class' => 'form-control', 'placeholder' => 'Adhar Card')) }}
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
												<option value="General"
													{{($registration_data->admission_type == 'General') ? 'selected' : ''}}>General</option>
												<option value="FTND" {{($registration_data->admission_type == 'FTND') ? 'selected' : ''}}>FTND</option>
												<option value="LSCS" {{($registration_data->admission_type == 'LSCS') ? 'selected' : ''}}>LSCS</option>
												<option value="Surgery"
													{{($registration_data->admission_type == 'Surgery') ? 'selected' : ''}}>Surgery</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12">


								<div class="col-md-2">
									<div class="form-group labelgrp">
										{{ Form::label('tpa_company', 'TPA Company') }}
									</div>
								</div>


								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('tpa_company', $registration_data->tpa_company, array('class' => 'form-control', 'autocomplete' => 'off')) }}
										</div>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group labelgrp">
										{{ Form::label('insurance_company', 'Insurance Company') }}
									</div>
								</div>


								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('insurance_company', $registration_data->insurance_company, array('class' => 'form-control', 'autocomplete' => 'off')) }}
										</div>
									</div>
								</div>

							</div>


							<div class="col-md-12" style="background: white;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control"> Address :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_address', $registration_data->address, array('class' => 'form-control', 'placeholder' => 'Address')) }}
										</div>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_area', $registration_data->area, array('class' => 'form-control', 'placeholder' => 'Area')) }}
										</div>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('city', $registration_data->city, array('class' => 'form-control', 'placeholder' => 'City')) }}
										</div>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('district', $registration_data->district, array('class' => 'form-control', 'placeholder' => 'District')) }}
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12" style="background: white;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control">Email ID :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_email', $registration_data->email, array('class' => 'form-control')) }}
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control">Contact No.<b class="star">*</b> :</label>
									</div> 
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_contact', Request::old('patient_contact', $registration_data->contact), array('class' => 'form-control', 'required')) }}
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12" style="background: white;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control"> Blood Group :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('blood_group', Request::old('blood_group', $registration_data->blood_group), array('class' => 'form-control', 'placeholder' => 'Blood Group')) }}
										</div>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control">Maritial Status :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('marital_status', Request::old('marital_status', $registration_data->marital_status), array('class' => 'form-control', '')) }}
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12" style="background: white;">

								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="responsible_realtive_name" class="form-control">Responsible Relative
											Name & Relationship :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('responsible_realtive_name', Request::old('responsible_realtive_name', $registration_data->responsible_realtive_name), array('class' => 'form-control')) }}
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('responsible_realtive_relation', Request::old('responsible_realtive_relation', $registration_data->responsible_realtive_relation), array('class' => 'form-control')) }}
										</div>
									</div>
								</div>
							</div>


							<div class="col-md-12" style="background: white;">
								<!-- <div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control"> Address :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('relative_address', Request::old('relative_address', $registration_data->relative_address), array('class' => 'form-control', 'placeholder'=>'Address')) }}                            
		</div>
		</div>
	</div> -->

								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control">Contact No. :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('relative_contact_number', Request::old('relative_contact_number', $registration_data->relative_contact_number), array('class' => 'form-control', '')) }}
										</div>
									</div>
								</div>
							</div>



							<!-- <div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Weight :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('weight', Request::old('weight', $registration_data->weight), array('class' => 'form-control', 'placeholder'=>'Weight in Kg')) }}                            
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Height :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('height', Request::old('height', $registration_data->height), array('class' => 'form-control', '')) }}                           
		</div>
		</div>
	</div>
</div> -->

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
											{{-- Form::text('consulting_doctor', Request::old('consulting_doctor',
											$registration_data->consulting_doctor), array('class' => 'form-control'))
											--}}

											<select name="consulting_doctor" class="form-control">
												<option value="">Select Doctor</option>
												@foreach($all_docotrs as $all_doctor_key => $all_doctor)
													<option value="{{$all_doctor_key}}" {{ ($registration_data->consulting_doctor == $all_doctor_key) ? 'selected' : ''}}>{{$all_doctor}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="referedby" class="form-control">Referring Doctor :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('referring_doctor', Request::old('referring_doctor', $registration_data->referring_doctor), array('class' => 'form-control')) }}
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
										<label for="referedby" class="form-control">Ward Type :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{-- Form::text('ward_type', Request::old('ward_type',
											$registration_data->ward_type), array('class' => 'form-control')) --}}
											<select name="ward_type" class="form-control">
												<option value="">Select ward</option>
												@foreach($ipd_ward_types as $ipd_ward_type)
													<option value="{{$ipd_ward_type->id}}"
														{{($registration_data->ward_type == $ipd_ward_type->id) ? 'selected' : ''}}>{{$ipd_ward_type->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="referedby" class="form-control">Bed No. :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{-- Form::text('bed_number', Request::old('bed_number',
											$registration_data->bed_number), array('class' => 'form-control')) --}}
											<select name="bed_number" class="form-control">
												<option value="">Select bed</option>
												@foreach($ipd_bed_numbers as $ipd_bed_number)
													<option value="{{$ipd_bed_number->id}}"
														{{($registration_data->bed_number == $ipd_bed_number->id) ? 'selected' : ''}}>{{$ipd_bed_number->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12" style="background: white;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="referedby" class="form-control">Advance Amount :</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('advance_amount', Request::old('advance_amount', $registration_data->advance_amount), array('class' => 'form-control')) }}
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="referedby" class="form-control">Payment Mode :</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											{{-- Form::text('payment_mode', Request::old('payment_mode',
											$payment_modes_array[$registration_data->payment_mode]), array('class' =>
											'form-control')) --}}


											<select name="payment_mode" id="payment_mode" class="form-control select2"
												placeholder="select payment mode">
												<option value="">Select</option>
												@foreach($payment_modes_array as $key => $val)
													<option value="{{$key}}" {{($registration_data->payment_mode == $key) ? 'selected' : ''}}>{{$val}}</option>
												@endforeach
											</select>

										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="referedby" class="form-control">Payment ID No. :</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('payment_id_number', Request::old('payment_id_number', $registration_data->payment_id_number), array('class' => 'form-control')) }}
										</div>
									</div>
								</div>
							</div>

						</div>



					</div>

					<div class="row clearfix">
						<div class="col-md-8 col-md-offset-2">
							<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i
									class="fa fa-plus"></i> Update
							</button>&nbsp;

							<!-- <button name="submitMsg" class="btn btn-success btn-lg" value="submitMsg" ><i class="fa fa-plus"></i> Print
						</button>&nbsp; -->

							<a class="btn btn-info btn-lg"
								href="{{ url('/patients-registration-print/' . $registration_data->id) }}">Print</a>

							<a class="btn btn-info btn-lg" href="{{ url('/patients-listing') }}">Back</a>

							@if($registration_data->advance_amount)
								<a class="btn btn-info btn-lg"
									href="{{ url('/print-advance-receipt/' . $registration_data->id) }}">View Advance
									Receipt</a>
							@endif

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
	/*
			$('#date_of_birth').bootstrapMaterialDatePicker({ 
			format: 'DD-MM-YYYY',
			clearButton: true,
			weekStart: 1,
			time: false
	});
			*/

	document.addEventListener('DOMContentLoaded', function () {
        const dobInput = document.getElementById('date_of_birth');
        const ageInput = document.getElementById('patient_age');
        const monthsInput = document.getElementById('admission_month');

        function calculateAge() {
            const dobValue = dobInput.value;
            if (dobValue) {
                const dob = new Date(dobValue);
                const today = new Date();

                let ageYears = today.getFullYear() - dob.getFullYear();
                let ageMonths = today.getMonth() - dob.getMonth();

                // Adjust years and months if necessary
                if (ageMonths < 0) {
                    ageYears--;
                    ageMonths += 12;
                }

                ageInput.value = ageYears;
                monthsInput.value = ageMonths;
            } else {
                ageInput.value = '';
                monthsInput.value = '';
            }
        }

        dobInput.addEventListener('change', calculateAge);
    });
</script>

@endsection